# Laravel DTO Generator

Generador de DTOs (Data Transfer Objects) personalizados para Laravel 10 o superior.  
Este paquete te permite crear clases DTO basadas en modelos Eloquent de manera automática usando el comando Artisan `make:dto`.

---

## ✨ Características

- Generación automática de clases DTO con `fillable`.
- Personalización de stubs (plantillas).
- Compatible con Laravel 10, 11 y 12.
- Estructura clara basada en PSR-4.
- Soporte para colecciones (`::collection()`).

---

## 🛠 Requisitos

- PHP 8.1 o superior
- Laravel 10, 11 o superior

---

## 📦 Instalación

### Desde Packagist (una vez publicado)

```bash
composer require devedgaralvarez/laravel-dto-generator

---

## 📦 Uso
Después de la instalación, puedes generar un DTO con el siguiente comando Artisan:
```bash
php artisan make:dto NombreDelDto ```

Esto creará una clase en:
```bash
app/Dto/NombreDelDto.php ```
---

## ✅ Roadmap
- [x] Comando make:dto
- [] Validación automática
- [] Integración con form requests
- [] Generación inversa desde modelos

👤 Autor
Edgar Alvarez Valdez
📧 alvarez.nike7@gmail.com
🐙 @DevEdgarAlvarez