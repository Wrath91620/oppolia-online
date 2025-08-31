import requests
import time

BASE_URL = "http://localhost:8000"
HEADERS = {"Content-Type": "application/json", "Accept": "application/json"}
TIMEOUT = 30


def test_accept_order_draft():
    created_order_id = None
    try:
        # Step 1: Create a new order
        order_payload = {
            "customer_name": "Test User",
            "customer_phone": "0123456789"
        }
        create_order_resp = requests.post(
            f"{BASE_URL}/orders",
            headers=HEADERS,
            json=order_payload,
            timeout=TIMEOUT,
        )
        assert create_order_resp.status_code in [200, 201], \
            f"Order creation failed: {create_order_resp.status_code} {create_order_resp.text}"
        order_data = create_order_resp.json()
        created_order_id = order_data.get("id") or order_data.get("order_id")
        assert created_order_id, "Created order ID not found in response"

        # Step 2: Get drafts for this order
        my_orders_resp = requests.get(
            f"{BASE_URL}/my-orders",
            headers=HEADERS,
            timeout=TIMEOUT,
        )
        assert my_orders_resp.status_code == 200, f"Failed to get user's orders: {my_orders_resp.text}"
        orders = my_orders_resp.json()
        target_order = None
        for order in orders:
            if str(order.get("id")) == str(created_order_id):
                target_order = order
                break
        assert target_order, "Created order not found in user's orders"

        drafts = target_order.get("drafts") or target_order.get("order_drafts") or []
        assert drafts, "No drafts found for the created order to accept"

        draft_id = drafts[0].get("id") or drafts[0].get("draft_id")
        assert draft_id, "Draft ID not found in draft data"

        # Step 3: Accept the draft
        accept_url = f"{BASE_URL}/order/{created_order_id}/accept-draft/{draft_id}"
        accept_resp = requests.post(
            accept_url,
            headers=HEADERS,
            timeout=TIMEOUT,
        )
        assert accept_resp.status_code == 200, f"Accept draft request failed: {accept_resp.status_code} {accept_resp.text}"

        accept_resp_json = accept_resp.json()
        updated_status = accept_resp_json.get("status") or accept_resp_json.get("order_status")
        assert updated_status, "Order status not present in accept draft response"
        assert updated_status.lower() in ["draft accepted", "accepted", "in progress", "approved"], \
            f"Unexpected order status after draft acceptance: {updated_status}"

    finally:
        # Cleanup
        if created_order_id:
            try:
                delete_resp = requests.delete(
                    f"{BASE_URL}/orders/{created_order_id}",
                    headers=HEADERS,
                    timeout=TIMEOUT,
                )
                assert delete_resp.status_code in [200, 204, 202], f"Order deletion failed: {delete_resp.status_code} {delete_resp.text}"
            except Exception:
                pass


test_accept_order_draft()
