import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager

BASE = "http://localhost:8000"

def setup_driver():
    opts = Options()
    # opts.add_argument("--headless")  # descomenta para no ver la ventana
    return webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=opts)

def test_cp02_datos_incompletos(driver):
    """CP-02: Guardar sin datos -> alert 'Datos incompletos'"""
    driver.get(f"{BASE}/Views/frmRegistrarcliente.php")
    driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
    
    alert = WebDriverWait(driver, 3).until(EC.alert_is_present())
    time.sleep(1.2)
    assert alert.text == "Datos incompletos", f"Esperaba 'Datos incompletos', salio '{alert.text}'"
    alert.accept()
    print("OK CP-02: Alert 'Datos incompletos'")

def test_cp03_dni_duplicado(driver):
    """CP-03: DNI existente -> 'Error: Código ya existe' en rojo"""
    driver.get(f"{BASE}/Views/frmRegistrarcliente.php")
    driver.find_element(By.NAME, "dni").send_keys("12345678")  # ya existe
    driver.find_element(By.NAME, "nombres").send_keys("Test")
    driver.find_element(By.NAME, "apellidos").send_keys("Dup")
    driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
    
    WebDriverWait(driver, 3).until(EC.url_contains("frmListarcliente.php"))
    assert "Error: Código ya existe" in driver.page_source
    driver.save_screenshot(r"C:\Users\Gian Marco\Downloads\LABORAT-09\capturas\cp03_duplicado.png")
    time.sleep(1.5)
    print("OK CP-03: 'Error: Código ya existe' en lista")

def test_cp01_registro_exitoso(driver):
    """CP-01: DNI nuevo -> 'Cliente registrado' en verde"""
    dni_nuevo = "44778899"  # DNI que no existe
    driver.get(f"{BASE}/Views/frmRegistrarcliente.php")
    driver.find_element(By.NAME, "dni").send_keys(dni_nuevo)
    driver.find_element(By.NAME, "nombres").send_keys("Nuevo")
    driver.find_element(By.NAME, "apellidos").send_keys("Cliente")
    driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
    
    WebDriverWait(driver, 3).until(EC.url_contains("frmListarcliente.php"))
    assert "Cliente registrado" in driver.page_source
    assert dni_nuevo in driver.page_source
    driver.save_screenshot(r"C:\Users\Gian Marco\Downloads\LABORAT-09\capturas\cp01_registrado.png")
    time.sleep(2)
    print("OK CP-01: 'Cliente registrado' + DNI en tabla")

def main():
    # Asegurate de que el servidor PHP este corriendo: php -S 0.0.0.0:8000
    driver = setup_driver()
    try:
        test_cp02_datos_incompletos(driver)
        test_cp03_dni_duplicado(driver)
        test_cp01_registro_exitoso(driver)
        print("\nTODOS LOS TESTS PASARON")
    except Exception as e:
        print(f"\nFALLO: {e}")
    finally:
        driver.quit()

if __name__ == "__main__":
    main()