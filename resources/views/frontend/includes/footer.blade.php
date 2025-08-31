

<footer>
    <section class="py-5 border-top bg-footer" style="direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}; box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);">
        <div class="container">
            <div class="row justify-content-between">
                <div class=" col-md-5 col-sm-12 col-xl-5 col-lg-5">
                    <div class="footer-section1">
                        <img src="{{asset('Frontend/assets/images/icons/AR Logo.png')}}" style="background-color: #509F96 ;">

                    </div>
                    <div class="mt-5">
                        <p class="myfont_5">@lang('footer.We at Oppolia Online take pride in offering the best and highest-quality types of kitchens.')</p>
                    </div>
                    <div class="mt-5">

                        <a href="https://www.instagram.com/oppoliaksa/" target="_blank" class="social-icons">
                            <img src="{{asset('Frontend/assets/images/icons/Instagram.png')}}" >
                        </a>
                        <a href="https://www.tiktok.com/@oppoliaksa" target="_blank" class="social-icons">
                            <img src="{{asset('Frontend/assets/images/icons/TikTok.png')}}" >
                        </a>
                        <a href="https://www.linkedin.com/company/oppoliaksa/" target="_blank" class="social-icons">
                            <img src="{{asset('Frontend/assets/images/icons/LinkedIn.png')}}" >
                        </a>
                        <a href="https://www.google.com/search?client=safari&sca_esv=588723058&hl=en-ae&q=Oppolia+Kitchens+%26+interiors,+%D8%A7%D9%88%D8%A8%D9%88%D9%84%D9%8A%D8%A7+%D9%85%D8%B7%D8%A7%D8%A8%D8%AE+%D9%88%D8%AF%D9%8A%D9%83%D9%88%D8%B1%D8%A7%D8%AA+%D8%AF%D8%A7%D8%AE%D9%84%D9%8A%D8%A9&ludocid=4610826281637624007&lsig=AB86z5W7JjNLlV_eIGUYPXYdH7X7&kgs=71ca67df19bdd42b&shndl=-1&shem=lcspe,lsp&source=sh/x/loc/act/m1/3" target="_blank" class="social-icons">
                            <img src="{{asset('Frontend/assets/images/icons/GMB.png')}}" >
                        </a>
                        <a href="https://x.com/Oppoliaksa" target="_blank" class="social-icons">
                            <img src="{{asset('Frontend/assets/images/icons/x-f.png')}}" >
                        </a>
                        <a href="https://www.facebook.com/people/oppoliaksa/61552423643243/" target="_blank" class="social-icons">
                            <img src="{{asset('Frontend/assets/images/icons/Facebook.png')}}" alt="Image 1">
                        </a>
                    </div>
                </div>
                <div class=" col-md-2 col-sm-12 col-xl-2 col-lg-2">
                    <div class="footer-section2">
                        <div class="mt-3 "><a class="myfont_5 hover-underline" href="{{ route('welcome') }}">@lang('footer.Home')</a></div>

                        <div class="mt-3 "> <a class="myfont_5 hover-underline" href="{{route('home.about') }}">@lang('footer.About')</a></div>
                        <div class="mt-3 "><a class="myfont_5 hover-underline" href="{{route('home.products') }}">@lang('footer.Product')</a></div>
                        <div class="mt-3 "> @auth<a class="myfont_5 hover-underline" href="{{ route('orders.create') }}">@lang('footer.Order now.')</a>@endauth
                            @guest
                                <a class="myfont_5 hover-underline" href="{{ route('orders.create') }} " data-bs-target="#phoneModal">@lang('footer.Order now.')</a>
                            @endguest
                        </div>



                    </div>
                </div>
                <div class=" col-md-2 col-sm-12 col-xl-2 col-lg-2">
                    <div class="footer-section3">
                        <div class="mt-3 "><a class="myfont_5 hover-underline" href="{{  route('category.products', 26)}}" style=" white-space: nowrap;">@lang('footer.New Classic Kitchens')</a></div>
                        <div class="mt-3 "> <a class="myfont_5 hover-underline" href="{{ route('category.products' , 27) }}" style=" white-space: nowrap;">@lang('footer.Modern Kitchens')</a></div>
                        <div class="mt-3 "><a class="myfont_5 hover-underline" href="{{ route('category.products' , 29)}}" style=" white-space: nowrap;">@lang('footer.L-Shaped Kitchens')</a></div>
                        <div class="mt-3 "><a class="myfont_5 hover-underline" href="{{ route('category.products', 30)}}" style=" white-space: nowrap;">@lang('footer.U-Shaped Kitchens')</a></div>
                    </div>
                </div>
                <div class=" col-md-2 col-sm-12 col-xl-2 col-lg-2">
                    <div class="footer-section3">
                        <div class="mt-3 "><a class="myfont_5 hover-underline" href="{{route('home.designers') }}">@lang('footer.Designers')</a></div>
                        <div class="mt-3 "><a class="myfont_5 hover-underline" href="{{ route('home.contact') }}">@lang('footer.Contact')</a></div>
                        <div class="mt-3 "><a class="myfont_5 hover-underline" href="/joinasdesigner">@lang('footer.Join As A Designer')</a></div>
                        <div class="mt-3 "><a class="myfont_5 hover-underline" href="/privacypolicy">@lang('footer.Privacy Policy')</a></div>

                    </div>
                </div>
                <!-- <div class=" col-md-2 col-sm-12 col-xl-2 col-lg-2">
                        <div class="footer-section4">
                            <h5 class="myfont_6">الصفحات الأساسية</h5>
                            <div class="mt-3 "><a href="home.html" class="myfont_5">الصفحة الرئيسية</a></div>

                            <div class="mt-3 "> <a class="myfont_5" href="about.html">عن اوبوليا</a></div>
                            <div class="mt-3 "><a class="myfont_5" href="products.html">المنتجات</a></div>
                            <div class="mt-3 "><a class="myfont_5" href="designers.html">مصممي اوبوليا</a></div>
                            <div class="mt-3 "><a class="myfont_5" href="contact.html">تواصل معنا</a></div>
                        </div>
                    </div>
                </div> -->
                <!--end row-->
            </div>
    </section>

    <section class="footer-strip text-center py-3 border-top positon-absolute bottom-0 bg-under-footer">
        <div class="container">
            <div class="d-flex flex-column flex-lg-row align-items-center gap-3 justify-content-center">
                <p class="mb-0">@ 2025 - Oppolia-Online - @lang('footer.designed_by')</p>
                <!--   <div class="payment-icon">
                       <div class="row row-cols-auto g-2 justify-content-end">
                           <div class="col">
                               <img src="assets/images/icons/visa.png" alt="" />
                           </div>
                           <div class="col">
                               <img src="assets/images/icons/paypal.png" alt="" />
                           </div>
                           <div class="col">
                               <img src="assets/images/icons/mastercard.png" alt="" />
                           </div>
                           <div class="col">
                               <img src="assets/images/icons/american-express.png" alt="" />
                           </div>
                       </div>
                   </div> -->
            </div>
        </div>
    </section>
</footer>
