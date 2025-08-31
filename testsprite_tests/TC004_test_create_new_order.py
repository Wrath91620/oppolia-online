import requests

BASE_URL = "http://localhost:8000"
API_KEY = "a1621845a9dcc1e8fc7b226d130a3ddc7bf6475f"
HEADERS = {
    "Authorization": f"Api-Key {API_KEY}",
    "Content-Type": "application/json",
    "Accept-Language": "en"
}
TIMEOUT = 30

def test_create_new_order():
    # Step 1: Verify homepage loads in English and Arabic
    homepage_en = requests.get(f"{BASE_URL}/", headers={**HEADERS, "Accept-Language": "en"}, timeout=TIMEOUT)
    assert homepage_en.status_code == 200

    homepage_ar = requests.get(f"{BASE_URL}/", headers={**HEADERS, "Accept-Language": "ar"}, timeout=TIMEOUT)
    assert homepage_ar.status_code == 200

    # Step 2: Fetch the order creation form (simulate UI stepper and form loading)
    form_resp = requests.get(f"{BASE_URL}/orders/create", headers=HEADERS, timeout=TIMEOUT)
    assert form_resp.status_code == 200
    assert "form" in form_resp.text.lower()  # basic validation form presence

    # Step 3: Prepare order payload with required details
    order_payload = {
        "customer_name": "Test User",
        "customer_phone": "+1234567890",
        "language": "en",
        "order_items": [
            {
                "product_id": 1,
                "quantity": 2,
                "notes": "Use matte finish"
            }
        ],
        "delivery_address": "123 Test St, Test City",
        "preferred_installation_date": "2025-10-15",
        "special_requests": "Include extra lighting"
    }

    # Step 4: Create the order via POST /orders
    create_resp = requests.post(f"{BASE_URL}/orders", json=order_payload, headers=HEADERS, timeout=TIMEOUT)
    try:
        assert create_resp.status_code == 201 or create_resp.status_code == 200
        response_json = create_resp.json()
        # Validate returned order info contains expected keys and values
        assert "id" in response_json
        assert response_json.get("customer_name") == order_payload["customer_name"]
        assert response_json.get("language") == order_payload["language"]
        assert isinstance(response_json.get("order_items"), list)
        assert len(response_json["order_items"]) == 1
        assert response_json["order_items"][0]["product_id"] == order_payload["order_items"][0]["product_id"]
    finally:
        # Cleanup: Delete the created order to prevent test data accumulation
        if create_resp.status_code in (200, 201):
            order_id = create_resp.json().get("id")
            if order_id:
                del_resp = requests.delete(f"{BASE_URL}/orders/{order_id}", headers=HEADERS, timeout=TIMEOUT)
                # It is OK if deletion fails; just avoid interfering with other systems

test_create_new_order()
