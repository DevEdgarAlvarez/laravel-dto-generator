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
- Laravel 10, 11 o 12

---

## 📦 Instalación

### Desde Packagist (una vez publicado)

```bash
composer require devedgaralvarez/laravel-dto-generator