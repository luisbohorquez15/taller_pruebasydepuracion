<img width="1903" height="910" alt="image" src="https://github.com/user-attachments/assets/6d51ee22-bd75-4295-8963-9dc0732163f0" />

# MediCitas - Sistema de Gestión de Citas Médicas

Este proyecto corresponde a la implementación del taller de **Pruebas y Depuración en Laravel** para la clínica MediCitas (UNAB).

## Descripción del Proyecto
La aplicación cuenta con:
- **Gestión de Citas Médicas:** Modelado de datos para citas, pacientes y médicos.
- **Módulo Frontend:** Vistas web diseñadas con Tailwind CSS para listar y agendar citas médicas.
- **Rutas API:** Endpoints JSON para consulta, agendamiento con notificación vía email y optimización de consultas SQL.
- **Suite de Pruebas Automatizadas:** Cobertura de pruebas HTTP/API usando base de datos en memoria (SQLite) para validación de filtrados, envío de correos y prevención del problema de consulta N+1.

---

## Requisitos
- Docker Desktop
- Laravel Sail

---

## Instalación y Configuración

1. **Iniciar los contenedores del entorno con Sail:**
   ```bash
   ./vendor/bin/sail up -d
