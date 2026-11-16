import { test, expect } from '@playwright/test';

const FORM = '/Views/frmRegistrarcliente.php';
const LISTA = /frmListarcliente\.php/;

test.describe('LABORAT-09 - Registro de clientes', () => {
  test('CP-02: campos obligatorios vacios', async ({ page }) => {
    await page.goto(FORM);

    let mensaje = '';
    page.on('dialog', async (dialog) => {
      mensaje = dialog.message();
      await dialog.accept();
    });

    await page.locator('button[type="submit"]').click();
    await expect.poll(() => mensaje, { timeout: 5000 }).toBe('Datos incompletos');

    console.log('OK CP-02: alert "Datos incompletos"');
  });

  test('CP-03: DNI duplicado', async ({ page }) => {
    await page.goto(FORM);

    await page.fill('input[name="dni"]', '12345678');
    await page.fill('input[name="nombres"]', 'Test');
    await page.fill('input[name="apellidos"]', 'Dup');
    await page.locator('button[type="submit"]').click();

    await expect(page).toHaveURL(LISTA);
    await expect(page.locator('body')).toContainText('Error: Código ya existe');

    console.log('OK CP-03: "Error: Código ya existe"');
  });

  test('CP-01: registro exitoso', async ({ page }) => {
    const dniNuevo = '66778855';

    await page.goto(FORM);

    await page.fill('input[name="dni"]', dniNuevo);
    await page.fill('input[name="nombres"]', 'Nuevo');
    await page.fill('input[name="apellidos"]', 'Cliente');
    await page.locator('button[type="submit"]').click();

    await expect(page).toHaveURL(LISTA);
    await expect(page.locator('body')).toContainText('Cliente registrado');
    await expect(page.locator('body')).toContainText(dniNuevo);

    console.log('OK CP-01: "Cliente registrado" + DNI en tabla');
  });
});
