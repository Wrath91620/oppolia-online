import requests

BASE_URL = "http://localhost:8000"
API_KEY = "a1621845a9dcc1e8fc7b226d130a3ddc7bf6475f"
HEADERS = {
    "Content-Type": "application/json",
    "x-api-key": API_KEY
}

def test_send_otp_for_phone_verification():
    phone_number = "+966512345678"  # Example Saudi Arabia phone number in E.164 format
    url = f"{BASE_URL}/login-phone"
    payload = {
        "phone": phone_number
    }

    try:
        response = requests.post(url, json=payload, headers=HEADERS, timeout=30)
        # Assert HTTP status code is 200 or 201 (accepted for OTP sent)
        assert response.status_code in (200, 201), f"Unexpected status code: {response.status_code}"
        data = response.json()
        # Assert the response contains expected keys indicating OTP was sent
        # Usually a message or success flag would be present
        assert "message" in data or "success" in data or "otp_sent" in data, "No confirmation of OTP sent in response."

    except requests.exceptions.RequestException as e:
        assert False, f"Request failed: {e}"
    except ValueError:
        assert False, "Response is not valid JSON."

test_send_otp_for_phone_verification()