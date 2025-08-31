import requests

BASE_URL = "http://localhost:8000"
API_KEY = "a1621845a9dcc1e8fc7b226d130a3ddc7bf6475f"
HEADERS = {
    "Authorization": f"ApiKey {API_KEY}"
}
TIMEOUT = 30

def test_get_user_notifications():
    url = f"{BASE_URL}/user/notifications"
    try:
        response = requests.get(url, headers=HEADERS, timeout=TIMEOUT)
        # Assert HTTP status code is 200 OK
        assert response.status_code == 200, f"Expected status 200, got {response.status_code}"
        data = response.json()
        # The response should be a list or dict containing notifications
        assert isinstance(data, (list, dict)), "Response data type is not list or dict"
        # Additional validation: Each notification should have expected keys (example: id, message, read, timestamp)
        if isinstance(data, list):
            for notif in data:
                assert isinstance(notif, dict), "Notification item is not a dict"
                # Common keys, adjust if API schema is known
                assert "id" in notif, "Notification missing 'id'"
                assert "message" in notif, "Notification missing 'message'"
                assert "read" in notif, "Notification missing 'read' status"
                assert "timestamp" in notif, "Notification missing 'timestamp'"
        elif isinstance(data, dict):
            # If dict keys are string ids mapping to notifications
            for key, notif in data.items():
                assert isinstance(notif, dict), "Notification item is not dict"
                assert "id" in notif, "Notification missing 'id'"
                assert "message" in notif, "Notification missing 'message'"
                assert "read" in notif, "Notification missing 'read' status"
                assert "timestamp" in notif, "Notification missing 'timestamp'"
    except requests.exceptions.Timeout:
        assert False, "Request timed out"
    except requests.exceptions.RequestException as e:
        assert False, f"Request failed with exception: {str(e)}"

test_get_user_notifications()