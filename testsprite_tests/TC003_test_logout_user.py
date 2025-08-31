import requests

BASE_URL = "http://localhost:8000"
TIMEOUT = 30

def test_logout_user():
    headers = {
        "Accept": "application/json"
    }

    login_phone_url = f"{BASE_URL}/login-phone"
    verify_otp_url = f"{BASE_URL}/verify-otp"
    logout_url = f"{BASE_URL}/logout"

    phone_payload = {"phone": "+1234567890"}

    try:
        resp = requests.post(login_phone_url, json=phone_payload, headers=headers, timeout=TIMEOUT)
        assert resp.status_code == 200

        otp_payload = {"phone": "+1234567890", "otp": "123456"}
        resp = requests.post(verify_otp_url, json=otp_payload, headers=headers, timeout=TIMEOUT)
        assert resp.status_code == 200
        auth_data = resp.json()
        token = auth_data.get("access_token") or auth_data.get("token")
        assert token is not None and isinstance(token, str) and token != ""

        auth_headers = {
            "Accept": "application/json",
            "Authorization": f"Bearer {token}"
        }

        resp = requests.post(logout_url, headers=auth_headers, timeout=TIMEOUT)
        assert resp.status_code == 200 or resp.status_code == 204

        protected_url = f"{BASE_URL}/my-orders"
        resp = requests.get(protected_url, headers=auth_headers, timeout=TIMEOUT)
        assert resp.status_code in (401, 403)

    except requests.exceptions.RequestException as e:
        assert False, f"Request failed: {e}"

test_logout_user()
