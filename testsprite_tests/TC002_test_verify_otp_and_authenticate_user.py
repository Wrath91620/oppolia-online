import requests

BASE_URL = "http://localhost:8000"
TIMEOUT = 30

# No Authorization header for OTP sending and verifying


def test_verify_otp_and_authenticate_user():
    phone_number = "+1234567890"
    send_otp_payload = {"phone": phone_number}

    try:
        # Step 1: Send OTP using /login-phone endpoint (No Auth header)
        response_send_otp = requests.post(
            f"{BASE_URL}/login-phone",
            json=send_otp_payload,
            timeout=TIMEOUT
        )
        assert response_send_otp.status_code == 200, "Failed to send OTP"
        # Expect OTP to be in response or simulate known OTP for test
        send_otp_data = response_send_otp.json()
        # For testing, assume OTP is returned in response under "otp" key (mock/testing environment)
        otp = send_otp_data.get("otp")
        assert otp is not None and isinstance(otp, str), "OTP not returned in response"

        # Step 2: Verify OTP and authenticate user via /verify-otp POST endpoint (No Auth header)
        verify_otp_payload = {
            "phone": phone_number,
            "otp": otp
        }

        response_verify_otp = requests.post(
            f"{BASE_URL}/verify-otp",
            json=verify_otp_payload,
            timeout=TIMEOUT
        )
        assert response_verify_otp.status_code == 200, f"OTP verification failed with status {response_verify_otp.status_code}"
        verify_otp_data = response_verify_otp.json()

        # Validate presence of authentication token or session info
        assert "token" in verify_otp_data or "access_token" in verify_otp_data, "Authentication token missing"
        token = verify_otp_data.get("token") or verify_otp_data.get("access_token")
        assert isinstance(token, str) and len(token) > 0, "Invalid authentication token"

        # Validate user role-based access
        assert "user" in verify_otp_data and "role" in verify_otp_data["user"], "User role info missing"
        role = verify_otp_data["user"]["role"]
        assert role in ["Admin", "Designer", "User", "Sales Manager", "Area Manager"], f"Unexpected user role: {role}"

        # Optional: Test access to homepage or user dashboard based on authenticated token
        auth_headers = {
            "Authorization": f"Bearer {token}"
        }
        response_homepage = requests.get(
            f"{BASE_URL}/",
            headers=auth_headers,
            timeout=TIMEOUT
        )
        assert response_homepage.status_code == 200, "Failed to access homepage with authenticated user"
        homepage_content = response_homepage.text
        assert any(keyword in homepage_content.lower() for keyword in ["homepage", "welcome", "dashboard"]), "Homepage content check failed"

    except requests.RequestException as e:
        assert False, f"Request failed: {e}"


test_verify_otp_and_authenticate_user()
