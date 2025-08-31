import requests
import uuid

BASE_URL = "http://localhost:8000"
API_KEY = "a1621845a9dcc1e8fc7b226d130a3ddc7bf6475f"
HEADERS = {
    "Content-Type": "application/json",
    "X-API-KEY": API_KEY
}

def test_register_as_designer():
    """
    Verify that the /joinasdesigner POST endpoint registers a new designer with valid data and stores the profile correctly.
    """

    # Prepare a unique email and phone to avoid conflict on repeated test runs
    unique_suffix = str(uuid.uuid4())[:8]
    designer_data = {
        "name": f"Test Designer {unique_suffix}",
        "email": f"test_designer_{unique_suffix}@example.com",
        "phone": f"+9665{unique_suffix[:6]}",  # Saudi number format example
        "password": "StrongPassw0rd!",
        "password_confirmation": "StrongPassw0rd!",
        "kitchen_shape": "L-shape",
        "style": "Modern",
        "languages": ["ar", "en"],
        "portfolio_images": [
            # Assuming API accepts base64 encoded images or URLs or file references; 
            # Here just send dummy URLs or placeholders as example
            "https://example.com/image1.jpg",
            "https://example.com/image2.jpg"
        ],
        "bio": "Experienced kitchen designer with expertise in modern and Arabic styles."
    }

    # The PRD and instructions emphasize UI-related elements like multi-language and kitchen shape/style selection.
    # Include kitchen_shape, style, and languages fields to mimic a real registration.

    created_designer_id = None
    try:
        response = requests.post(
            f"{BASE_URL}/joinasdesigner",
            json=designer_data,
            headers=HEADERS,
            timeout=30
        )
        # Validate response is successful registration (usually 201 or 200)
        assert response.status_code in (200, 201), f"Unexpected status code: {response.status_code}"
        response_json = response.json()

        # Validate response body contains expected fields such as an ID or confirmation message
        assert isinstance(response_json, dict), "Response is not a JSON object"
        assert "id" in response_json or "designer_id" in response_json or "data" in response_json, "Response missing designer ID"
        
        # Attempt to get the created designer ID from known possible keys
        if "id" in response_json:
            created_designer_id = response_json["id"]
        elif "designer_id" in response_json:
            created_designer_id = response_json["designer_id"]
        elif "data" in response_json and isinstance(response_json["data"], dict):
            created_designer_id = response_json["data"].get("id")

        assert created_designer_id is not None, "Designer ID not found in response"

        # Optional: Verify stored profile by fetching or other means
        # This endpoint is not defined in PRD, but /designers GET exists, we can check if newly created designer appears
        get_response = requests.get(
            f"{BASE_URL}/designers",
            headers=HEADERS,
            timeout=30
        )
        assert get_response.status_code == 200, "Failed to get designers list"
        designers_list = get_response.json()
        assert isinstance(designers_list, list) or (isinstance(designers_list, dict) and "data" in designers_list), "Designers list response structure unexpected"
        
        found = False
        if isinstance(designers_list, dict) and "data" in designers_list and isinstance(designers_list["data"], list):
            for d in designers_list["data"]:
                if (d.get("id") == created_designer_id or d.get("email") == designer_data["email"]):
                    found = True
                    # Check key profile fields
                    assert d.get("name") == designer_data["name"]
                    break
        elif isinstance(designers_list, list):
            for d in designers_list:
                if (d.get("id") == created_designer_id or d.get("email") == designer_data["email"]):
                    found = True
                    assert d.get("name") == designer_data["name"]
                    break
        assert found, "Registered designer not found in designers list"

    finally:
        # Cleanup: delete the created designer to keep test idempotent, if deletion endpoint exists
        # PRD does not specify a delete designer endpoint, skipping actual delete.
        # If exists, the code may look like:
        # if created_designer_id:
        #     requests.delete(f"{BASE_URL}/designers/{created_designer_id}", headers=HEADERS, timeout=30)
        pass

test_register_as_designer()