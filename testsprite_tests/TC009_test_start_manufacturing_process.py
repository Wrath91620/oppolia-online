import requests
import json

BASE_URL = "http://localhost:8000"
API_KEY = "a1621845a9dcc1e8fc7b226d130a3ddc7bf6475f"
HEADERS = {
    "Accept": "application/json",
    "Content-Type": "application/json",
    "X-API-KEY": API_KEY
}
TIMEOUT = 30


def test_start_manufacturing_process():
    order_id = None
    created_order_id = None
    try:
        # 1. Create a new order (required to have an order to start manufacturing on)
        create_order_payload = {
            # Minimal example payload, expand fields as per API schema if available
            "customer_name": "Test Customer",
            "kitchen_style": "Modern",
            "kitchen_shape": "L",
            "language": "en",
            "details": "Test order for manufacturing start",
            # additional required fields should be added here from domain knowledge
        }
        create_resp = requests.post(
            f"{BASE_URL}/orders",
            headers=HEADERS,
            data=json.dumps(create_order_payload),
            timeout=TIMEOUT
        )
        assert create_resp.status_code == 201, f"Order creation failed: {create_resp.text}"
        created_order = create_resp.json()
        order_id = created_order.get("id") or created_order.get("order_id")
        assert order_id is not None, "Created order ID not found in response"

        # 2. Start manufacturing process for the created order
        start_manufacture_resp = requests.post(
            f"{BASE_URL}/designer/manufacture/start/{order_id}",
            headers=HEADERS,
            timeout=TIMEOUT
        )
        assert start_manufacture_resp.status_code == 200, f"Start manufacturing failed: {start_manufacture_resp.text}"
        start_resp_json = start_manufacture_resp.json()

        # 3. Validate order status updated to "manufacturing_started" or equivalent
        # Assuming response includes order info with status
        order_status = start_resp_json.get("status") or start_resp_json.get("order", {}).get("status")
        assert order_status is not None, "Response missing order status"
        assert order_status.lower() in ["manufacturing_started", "in_manufacturing", "started"], (
            f"Order status not updated correctly, got: {order_status}"
        )

        # 4. Additional validation of response structure
        assert "order" in start_resp_json or "message" in start_resp_json, (
            "Response lacks expected keys 'order' or 'message'"
        )

        # 5. Optionally, retrieve the order and verify status
        get_order_resp = requests.get(
            f"{BASE_URL}/order/{order_id}",
            headers=HEADERS,
            timeout=TIMEOUT
        )
        assert get_order_resp.status_code == 200, f"Fetching order failed: {get_order_resp.text}"
        order_data = get_order_resp.json()
        current_status = order_data.get("status")
        assert current_status is not None, "Order status missing in GET order response"
        assert current_status.lower() in ["manufacturing_started", "in_manufacturing", "started"], (
            f"Order status was not updated after manufacturing start, got: {current_status}"
        )

    finally:
        # Cleanup: Delete the created order if possible
        if order_id:
            try:
                delete_resp = requests.delete(
                    f"{BASE_URL}/orders/{order_id}",
                    headers=HEADERS,
                    timeout=TIMEOUT
                )
                # Accept 200 or 204 as successful deletion
                assert delete_resp.status_code in (200, 204), f"Failed to delete order: {delete_resp.text}"
            except Exception:
                pass


test_start_manufacturing_process()