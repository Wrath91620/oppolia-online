<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Designer;
use App\Notifications\OrderCreated;
use App\Models\Region;
use Illuminate\Support\Facades\Auth; // استدعاء Auth
use Illuminate\Support\Facades\Log;  // استدعاء Log
use App\Notifications\CustomerRequestRedesign;
use App\Models\User;
use App\Models\SubRegion;
use App\Notifications\CustomerChangedDesigner;
use Illuminate\Support\Facades\DB;



class OrderController extends Controller
{
    public function create()
    {  $notifications = auth()->user()->notifications;
        return view('User.order_create', compact( 'notifications'));
    }

    // حفظ الطلب المقدم
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validated = $request->validate([
            'name' => 'sometimes|string', // Optional name field
            'email' => 'sometimes|email', // Optional email field
            'kitchen_area' => 'required|numeric',
            'kitchen_shape' => 'required|string',
            'kitchen_type' => 'required|in:قديم,جديد',
            'expected_cost' => 'required|numeric',
            'time_range' => 'required|string',
            'kitchen_style' => 'required|string',
            'meeting_time' => 'required|date',
            'length_step' => 'required|numeric',
            'width_step' => 'required|numeric',
            'geocode_string' => 'required|string',
            'region_name' => 'required|string', // اسم sub_region مطلوب
        ]);

        try {

            $user = auth()->user();
            if ($request->filled('name') && !$user->name) {
                $user->name = $request->name;
            }
            if ($request->filled('email') && !$user->email) {
                $user->email = $request->email;
            }
            $user->save();

            // جلب الـ SubRegion بناءً على الاسم الإنجليزي
            $subRegion = SubRegion::where('name_en', $request->region_name)->first();

            if (!$subRegion) {
                return redirect()->route('orders.create')->with('error', 'لم يتم العثور على المنطقة الفرعية المطلوبة.');
            }

            // جلب المنطقة الأساسية بناءً على الـ SubRegion
            $region = $subRegion->region;

            // إنشاء الطلب
            $order = Order::create([
                'user_id' => auth()->id(), // id المستخدم الذي طلب الطلب
                'region_id' => $region->id,
                'sub_region_id' => $subRegion->id,
                'kitchen_area' => $request->kitchen_area,
                'kitchen_shape' => $request->kitchen_shape,
                'kitchen_type' => $request->kitchen_type,
                'expected_cost' => $request->expected_cost,
                'time_range' => $request->time_range,
                'kitchen_style' => $request->kitchen_style,
                'meeting_time' => $request->meeting_time,
                'length_step' => $request->length_step,
                'width_step' => $request->width_step,
                'geocode_string' => $request->geocode_string, // إضافة geocode_string هنا
             //   'geocode_string' => '111',
                'order_status' => 'pending', // حالة الطلب الافتراضية
                'processing_stage' => 'تم إرسال الطلب',  // مرحلة الطلب الافتراضية
            ]);

            // جلب المدراء والمصممين بناءً على الـ Region
            $areaManagers = User::where('role', 'Area manager')
                ->where('region_id', $region->id)
                ->get();

            $salesManagers = User::where('role', 'Sales manager')
                ->get();

            // جلب جميع المصممين في نفس المنطقة
            $designers = Designer::join('users', 'designers.user_id', '=', 'users.id')
                ->where('users.region_id', $region->id)
                ->select('designers.*')
                ->get();

            // إرسال إشعار لكل مصمم في نفس المنطقة
            foreach ($designers as $designer) {
                $designer->notify(new OrderCreated($order, $designer));
            }
            foreach ($areaManagers as $manager) {
                $manager->notify(new OrderCreated($order, $manager));
            }

            // إرسال إشعار لكل مدير مبيعات في نفس المنطقة
            foreach ($salesManagers as $manager) {
                $manager->notify(new OrderCreated($order, $manager));
            }

            // إعادة التوجيه بعد نجاح الطلب
            return redirect()->route('orders.myOrders')->with('success', 'تم تقديم طلبك بنجاح وتم إرسال إشعار للمصممين في نفس المنطقة!');

        } catch (\Exception $e) {
            // التعامل مع الأخطاء
            return redirect()->route('orders.create')->with('error', 'خطأ: ' . $e->getMessage());
        }
    }

    /**
     * Handle validation errors and redirect back with form data
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, $this->response($this->formatValidationErrors($validator)));
    }

    /**
     * Create the response for when a request fails validation.
     */
    protected function response(array $errors)
    {
        if (request()->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput()
            ->withErrors($errors);
    }


    public function myOrders()
    {
        try {
            // Get the current authenticated user
            $user = Auth::user();
            $notifications = auth()->user()->notifications;

            // Get all orders for the current user, ordered by newest first
            $orders = Order::where('user_id', $user->id)
                ->orderBy('created_at', 'desc') // ترتيب الطلبات من الأحدث إلى الأقدم
                ->get();

            // Return the view with the orders
            return view('User.my_orders', compact('orders', 'notifications'));
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error fetching user orders: ' . $e->getMessage());

            // Return a view with an error message
            return back()->with('error', 'حدث خطأ أثناء محاولة جلب طلباتك، يرجى المحاولة لاحقاً.');
        }
    }

    public function show($orderId,$notificationId = null)
    {
        // جلب الطلب بناءً على الـ ID مع المسودات
        $order = Order::with('orderDraft')->findOrFail($orderId);
        $notification =auth()->user()->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        $notifications = auth()->user()->notifications;
        if ($order->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'You are not authorized to view this order.');
        }



        // البحث عن مسودة بحالة "finalized"
        $orderDraft = $order->orderDraft->first(function ($draft) {
            return $draft->state === 'finalized';
        });

        // إذا لم توجد مسودة بحالة "finalized"، قم بتطبيق التصفية لاستبعاد الحالات غير المرغوبة
        if (!$orderDraft) {
            $orderDraft = $order->orderDraft->filter(function ($draft) {
                return !in_array($draft->state, ['rejected', 'designer_changed', 'redesign', 'modified']);
            });
        } else {
            // إذا وُجدت مسودة بحالة "finalized"، تحويلها إلى مجموعة لتسهيل التعامل معها في الـ view
            $orderDraft = collect([$orderDraft]);
        }

        $enumValues = DB::select("
        SELECT COLUMN_TYPE
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
        AND TABLE_NAME = 'orders'
        AND COLUMN_NAME = 'processing_stage'
    ")[0]->COLUMN_TYPE;

        // استخراج القيم من النتيجة
        preg_match('/enum\((.*)\)$/', $enumValues, $matches);
        $allstages = str_getcsv($matches[1], ',', "'");
        $all_stages = array_filter($allstages, function($stage) {
            return $stage !== 'change_designer';
        });


        return view('User.show_order', compact('order', 'orderDraft','notifications','all_stages'));
    }

    public function changeDesigner(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect('/')->with('error', 'You are not authorized to view this order.');
        }
        // جلب جميع المصممين في نفس المنطقة
        $designers = Designer::join('users', 'designers.user_id', '=', 'users.id')
            ->where('users.region_id', $order->region_id)
            ->select('designers.*')
            ->get();

        // حذف الإشعارات المرتبطة بالطلب والمصمم السابق بغض النظر عن النوع
        $previousDesigner = Designer::find($order->approved_designer_id); // جلب المصمم السابق
        if ($previousDesigner) {
            // جلب جميع الإشعارات التي تحتوي على order_id و designer_id في حقل الـ data بغض النظر عن نوع الإشعار
            $previousDesignerNotifications = $previousDesigner->notifications()
                ->whereJsonContains('data', ['order_id' => $order->id]) // مرتبط بنفس الـ order_id
                ->whereJsonContains('data', ['designer_id' => $order->approved_designer_id]) // مرتبط بنفس الـ designer_id
                ->get();

            // حذف كل إشعار قديم مرتبط بالطلب والمصمم السابق
            foreach ($previousDesignerNotifications as $notification) {
                $notification->delete();
            }
        }

        // حذف الإشعارات القديمة المرتبطة بالطلب لكل المصممين (بما في ذلك المصمم السابق)
        foreach ($designers as $designer) {
            // جلب جميع الإشعارات المرتبطة بالطلب لهذا المصمم بغض النظر عن النوع
            $designerNotifications = $designer->notifications()
                ->where('type', OrderCreated::class) // نوع الإشعار هو OrderCreated
                ->whereJsonContains('data', ['order_id' => $order->id]) // مرتبط بنفس الطلب
                ->get();

            // حذف كل إشعار قديم مرتبط بالطلب
            foreach ($designerNotifications as $notification) {
                $notification->delete();
            }


        }


            $areaManagers = User::where('role', 'Area manager')
                ->where('region_id', $order->region_id)
                ->get();

            $salesManagers = User::where('role', 'Sales manager')
                ->get();
            foreach ($areaManagers as $areaManager) {
                $areaManager->notify(new CustomerChangedDesigner($order, $areaManager));
            }

            // إرسال إشعار إلى جميع مديري المبيعات
            foreach ($salesManagers as $salesManager) {
                $salesManager->notify(new CustomerChangedDesigner($order, $salesManager));
            }

        // تحديث حالة الطلب
        $order->order_status = 'pending'; // تغيير حالة الطلب إلى معلق
        $order->approved_designer_id = null; // تعيين المصمم الحالي إلى null
        $order->processing_stage = 'change_designer'; // تعيين المرحلة إلى المرحلة الأولى
        $order->save();

        // تحديث حالة مسودة الطلب
        $order->orderDraft()->update(['state' => 'designer_changed']);

        return redirect()->route('orders.myOrders')->with('success', 'تم تغيير المصمم وإرسال إشعار للمصممين في نفس المنطقة.');
    }



    public function redesignDraft(Request $request, $orderId, $draftId)
    {

        try {
            // جلب الطلب بناءً على الـ ID
            $order = Order::findOrFail($orderId);
            if ($order->user_id !== auth()->id()) {
                return redirect('/')->with('error', 'You are not authorized to view this order.');
            }



            // جلب المسودة المرتبطة بالطلب والتي سيتم إعادة تصميمها
            $draft = $order->orderDraft()->where('id', $draftId)->firstOrFail();

            // جلب المصمم المرتبط بالطلب
            $designer = $order->designer;

            // تحديث حالة المسودة إلى 'redesign'
            $draft->update([
                'state' => 'redesign',
            ]);

            // تحديث مرحلة المعالجة في الطلب إلى "state_four"
            $order->update([
                'processing_stage' => 'تم إرسال أسئلة الاستبيان',
            ]);

            // إرسال إشعار للمصمم الذي صمم هذه المسودة
            if ($designer) {
                $designer->notify(new CustomerRequestRedesign($order, $designer)); // إشعار المصمم
            }

            return redirect()->route('orders.myOrders')->with('success', 'تم تغيير حالة المسودة إلى إعادة التصميم وإشعار المصمم.');
        } catch (\Exception $e) {
            // التعامل مع أي خطأ
            return redirect()->route('orders.myOrders')->with('error', 'حدث خطأ أثناء تحديث المسودة: ' . $e->getMessage());
        }
    }

    public function acceptDraft($orderId, $draftId)
    {
        try {
            // جلب الطلب بناءً على الـ ID
            $order = Order::findOrFail($orderId);

            if ($order->user_id !== auth()->id()) {
                return redirect('/')->with('error', 'You are not authorized to view this order.');
            }



            // جلب المسودة بناءً على الـ draftId
            $draft = $order->orderDraft()->where('id', $draftId)->firstOrFail();

            // جلب المصمم المرتبط بالطلب
            $designer = $order->designer;

            // تحديث حالة المسودة إلى 'approved'
            $draft->update([
                'state' => 'approved',
            ]);

            // تحديث مرحلة المعالجة في الطلب إلى "تم الموافقة على التصميم الأولي"
            $order->update([
                'processing_stage' => 'تم الموافقة على التصميم الأولي',
            ]);

            // إرسال إشعار للمصمم بأن العميل وافق على التصميم
            if ($designer) {
                $designer->notify(new \App\Notifications\CustomerApprovedDesign($order, $designer)); // إشعار المصمم
            }

            // إعادة التوجيه مع رسالة نجاح
            return redirect()->route('orders.myOrders')->with('success', 'تم قبول التصميم بنجاح وتم إشعار المصمم.');
        } catch (\Exception $e) {
            // التعامل مع أي خطأ
            return redirect()->route('orders.myOrders')->with('error', 'حدث خطأ أثناء قبول التصميم: ' . $e->getMessage());
        }
    }




}
