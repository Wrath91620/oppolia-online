import requests

BASE_URL = "http://localhost:8000"
API_KEY = "a1621845a9dcc1e8fc7b226d130a3ddc7bf6475f"
HEADERS = {"Authorization": f"ApiKey {API_KEY}", "Content-Type": "application/json"}
TIMEOUT = 30


def test_update_installment_status():
    # Step 1: Create a new installment to update its status
    create_installment_url = f"{BASE_URL}/designer/sales/1/installments"
    # We must create a valid sale ID, here using 1 as an example, but since no sale creation API is provided,
    # we create the installment with minimal required data as placeholder.
    # In a real scenario, the sale ID would be dynamic or created freshly.
    installment_payload = {
        # Assuming the system accepts these fields for creating installment. If unknown, minimal data is sent.
        "due_date": "2025-12-31",
        "amount": 1000,
        "status": "pending"
    }

    try:
        create_response = requests.post(
            create_installment_url, json=installment_payload, headers=HEADERS, timeout=TIMEOUT
        )
        assert create_response.status_code == 201, f"Failed to create installment: {create_response.text}"
        installment_data = create_response.json()
        installment_id = installment_data.get("id")
        assert installment_id is not None, "Installment ID not returned from create"

        # Step 2: Update installment status
        update_status_url = f"{BASE_URL}/installment/update-status"
        update_payload = {
            "id": installment_id,
            "status": "paid"
        }
        update_response = requests.post(update_status_url, json=update_payload, headers=HEADERS, timeout=TIMEOUT)
        assert update_response.status_code == 200, f"Failed to update installment status: {update_response.text}"

        update_resp_data = update_response.json()
        # Validate the response confirms the update or returns the updated installment
        assert ("status" in update_resp_data and update_resp_data["status"] == "paid") or \
               (update_resp_data.get("message") and "updated" in update_resp_data.get("message").lower()), \
            "Installment status update not reflected in response"

        # Step 3: Retrieve or confirm the updated installment reflects the new status
        # No read endpoint specified, so re-update to confirm idempotency and ensure no error
        update_response2 = requests.post(update_status_url, json=update_payload, headers=HEADERS, timeout=TIMEOUT)
        assert update_response2.status_code == 200, "Status re-update failed"
    finally:
        # Clean up: delete the created installment if possible
        if 'installment_id' in locals():
            delete_url = f"{BASE_URL}/installment/{installment_id}"
            try:
                requests.delete(delete_url, headers=HEADERS, timeout=TIMEOUT)
            except Exception:
                pass


test_update_installment_status()