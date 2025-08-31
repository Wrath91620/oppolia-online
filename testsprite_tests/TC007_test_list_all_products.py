import requests

BASE_URL = "http://localhost:8000"
API_KEY = "a1621845a9dcc1e8fc7b226d130a3ddc7bf6475f"
TIMEOUT = 30

def test_list_all_products():
    headers = {
        "Authorization": f"Api-Key {API_KEY}",
        "Accept": "application/json"
    }
    try:
        response = requests.get(f"{BASE_URL}/products", headers=headers, timeout=TIMEOUT)
        response.raise_for_status()
        products = response.json()

        # Assert response is a list (the catalog of products)
        assert isinstance(products, list), "Response is not a list"

        # Assert each product has at least expected keys (id, name, possibly more)
        for product in products:
            assert isinstance(product, dict), "Product item is not a dictionary"
            assert "id" in product, "Product missing 'id'"
            assert "name" in product or "title" in product, "Product missing 'name' or 'title'"

        # Optional: check that the list is not empty (catalog is not empty)
        assert len(products) > 0, "Product list is empty, catalog might be incomplete"

    except requests.exceptions.RequestException as e:
        assert False, f"Request to list products failed: {e}"

test_list_all_products()