# TechVision Solutions - Sistema Web Completo

Sistema web completo con **PHP y MySQL** para una empresa de consultoría tecnológica. Incluye landing page profesional, sistema de gestión de contactos y panel de administración funcional.

## 🎨 Características de Diseño

- **Esquema de colores**: Rojo (#DC143C) y blanco, diseño empresarial profesional
- **Diseño responsive**: Adaptado para dispositivos móviles, tablets y escritorio
- **Animaciones suaves**: Efectos de scroll y transiciones elegantes
- **Tipografía profesional**: Montserrat y Open Sans de Google Fonts

## 📋 Secciones

1. **Header/Navegación**: Menú fijo con logo y navegación responsive
2. **Hero**: Sección principal con llamado a la acción y estadísticas
3. **Servicios**: Grid de 6 servicios con iconos y descripciones
4. **Soluciones**: Sección destacada con lista de beneficios
5. **Nosotros**: Información de la empresa y valores
6. **Contacto**: Formulario de contacto e información de contacto
7. **Footer**: Enlaces, redes sociales y información legal

## 🚀 Cómo Usar

1. Clona el repositorio
2. Abre `index.html` en tu navegador
3. No requiere instalación ni dependencias

## 📱 Responsive

El diseño se adapta a tres breakpoints principales:
- Desktop: > 968px
- Tablet: 640px - 968px  
- Mobile: < 640px

## 🎯 Características Interactivas

- Navegación móvil con menú hamburguesa animado
- Contador animado de estadísticas
- Formulario de contacto funcional
- Animaciones de scroll para tarjetas de servicios
- Header que se adapta al scroll

## 🔧 Tecnologías

### Frontend
- HTML5 semántico
- CSS3 (Grid, Flexbox, Custom Properties)
- JavaScript ES6+ (Vanilla, AJAX)
- SVG para iconos

### Backend
- **PHP 7.4+** con PDO
- **MySQL 5.7+** / MariaDB
- Sistema de autenticación seguro
- API REST para AJAX
- Prepared Statements (seguridad contra SQL Injection)

## 🚀 Instalación Rápida

### Opción 1: Asistente de Instalación
1. Copia los archivos al servidor web
2. Abre `http://localhost/setup.php`
3. Sigue las instrucciones

### Opción 2: Manual
```bash
# Crear base de datos
mysql -u root -p < database.sql

# Configurar credenciales
# Editar config/database.php

# Acceder
http://localhost/        # Sitio público
http://localhost/admin/  # Panel admin (user: admin, pass: admin123)
```

📖 **Documentación completa**: Ver [INSTALL.md](INSTALL.md) y [README_PHP.md](README_PHP.md)

## ✨ Funcionalidades PHP/MySQL

### Sitio Público
- ✅ Formulario de contacto funcional con validación
- ✅ Estadísticas dinámicas desde base de datos
- ✅ Servicios administrables
- ✅ Sistema de newsletter
- ✅ Envío AJAX sin recargar página

### Panel de Administración (`/admin`)
- ✅ Sistema de login seguro (Bcrypt)
- ✅ Dashboard con estadísticas en tiempo real
- ✅ Gestión de contactos (nuevo/leído/respondido)
- ✅ Gestión de suscriptores newsletter
- ✅ Edición de estadísticas del sitio
- ✅ Gestión de testimonios
- ✅ Diseño responsive

### Seguridad
- ✅ Prepared Statements (PDO)
- ✅ Password hashing (Bcrypt)
- ✅ Sanitización de inputs
- ✅ Protección XSS
- ✅ Sesiones seguras

## 📁 Estructura del Proyecto

```
project/
├── config/              # Configuración
│   └── database.php     # Conexión a BD
├── includes/            # Funciones auxiliares
├── api/                 # Endpoints REST
│   ├── contact.php      # API contactos
│   ├── newsletter.php   # API newsletter
│   └── stats.php        # API estadísticas
├── admin/               # Panel administrativo
│   ├── index.php        # Dashboard
│   ├── login.php        # Login
│   ├── contacts.php     # Gestión contactos
│   └── ...
├── database.sql         # Script de BD
├── index.php            # Landing page
├── setup.php            # Asistente instalación
└── README_PHP.md        # Documentación PHP
```

## 📄 Licencia

Proyecto de demostración - Uso libre

## 👥 Empresa Ficticia

**TechVision Solutions** - Empresa ficticia de consultoría tecnológica y desarrollo de software empresarial.

---

**Nota**: Este no es solo un diseño estático. Es una **aplicación web completamente funcional** con backend PHP y MySQL listo para usar o personalizar.
