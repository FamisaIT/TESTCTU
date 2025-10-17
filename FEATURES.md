# Características y Funcionalidades - TechVision Solutions

## 🌟 Resumen Ejecutivo

TechVision Solutions es una **aplicación web completa** con PHP y MySQL que incluye:
- Landing page profesional y responsive
- Sistema de gestión de contactos
- Panel de administración completo
- API REST funcional
- Base de datos MySQL con estructura completa

## 📊 Funcionalidades Principales

### 1. Landing Page Dinámica (index.php)

#### Estadísticas Hero
- **Origen**: Base de datos MySQL (tabla `site_stats`)
- **Editable**: Desde el panel admin
- **Formato**: Cargan dinámicamente vía PHP
- **Ejemplo**: "500+ Clientes", "15+ Años", etc.

```php
// Código en index.php
$stats = $db->query("SELECT * FROM site_stats WHERE is_active = TRUE");
```

#### Servicios
- **Origen**: Tabla `services` en MySQL
- **Incluye**: Título, descripción, icono SVG
- **Admin**: Totalmente administrable
- **Display**: Grid responsive de 6 servicios

#### Formulario de Contacto
- **Tecnología**: AJAX (fetch API)
- **Validación**: Cliente (JS) y Servidor (PHP)
- **Almacenamiento**: MySQL tabla `contacts`
- **Notificación**: Alert al usuario + mensaje en BD
- **Campos**: Nombre, Email, Teléfono, Empresa, Mensaje

```javascript
// Envío AJAX sin recargar página
fetch('api/contact.php', {
    method: 'POST',
    body: formData
})
```

---

### 2. Panel de Administración (/admin)

#### 🔐 Sistema de Login (login.php)

**Características:**
- Autenticación segura con Bcrypt
- Protección contra SQL injection (PDO Prepared Statements)
- Sesiones PHP seguras
- Registro de último login
- Página de login responsive y moderna

**Credenciales por defecto:**
```
Usuario: admin
Contraseña: admin123
```

**Flujo:**
1. Usuario ingresa credenciales
2. Validación en servidor
3. Verificación de hash con password_verify()
4. Creación de sesión
5. Redirección a dashboard

---

#### 📈 Dashboard (index.php)

**Elementos visuales:**
- 4 Tarjetas de estadísticas con iconos:
  - Total de contactos
  - Mensajes nuevos
  - Suscriptores activos
  - Testimonios activos

- **Tabla de mensajes recientes** (últimos 10)
  - Nombre, Email, Empresa
  - Vista previa del mensaje
  - Badge de estado (nuevo/leído/respondido)
  - Fecha de creación
  - Enlace a gestión completa

**Tecnología:**
- Consultas SQL con COUNT() y JOIN
- Formateo de fechas con PHP
- Estados con ENUM en MySQL
- Diseño con CSS Grid

---

#### 📧 Gestión de Contactos (contacts.php)

**Funcionalidades:**
- Vista completa de todos los mensajes
- Tabla responsive con scroll horizontal
- **Estados del mensaje:**
  - 🔵 Nuevo (azul)
  - 🟡 Leído (amarillo)
  - 🟢 Respondido (verde)

**Acciones disponibles:**
- Marcar como leído
- Marcar como respondido
- Ver mensaje completo
- Email clickeable (mailto:)
- Ordenamiento por fecha (DESC)

**Columnas:**
- ID, Nombre, Email, Teléfono, Empresa
- Mensaje completo
- Estado con badge colorido
- Fecha de recepción
- Botones de acción

---

#### 📰 Newsletter (newsletter.php)

**Gestión de suscriptores:**
- Lista completa de emails suscritos
- Estado: Activo / Inactivo
- Fecha de suscripción
- Nombre del suscriptor (opcional)
- Token único de desuscripción

**Campos mostrados:**
- ID, Email, Nombre
- Estado (badge verde/rojo)
- Fecha de suscripción

**Uso futuro:**
- Exportar lista para email marketing
- Sistema de desuscripción vía token
- Envío masivo de newsletters

---

#### 📊 Estadísticas del Sitio (stats.php)

**Editor de estadísticas del Hero:**

Permite modificar los 4 valores mostrados en la página principal:
1. **Clientes Satisfechos** (clients)
2. **Años de Experiencia** (experience)
3. **Proyectos Completados** (projects)
4. **Tasa de Éxito** (success_rate)

**Interfaz:**
- 4 tarjetas editables
- Campos: Clave (solo lectura), Valor, Etiqueta
- Botón "Actualizar" por tarjeta
- Actualización en tiempo real en el sitio
- Mensaje de éxito al guardar

**Ejemplo de uso:**
```
Valor: 600+
Etiqueta: Clientes Satisfechos
```

---

#### ⭐ Testimonios (testimonials.php)

**Gestión de testimonios de clientes:**

**Campos:**
- Nombre del cliente
- Cargo y empresa
- Texto del testimonio
- Rating (1-5 estrellas)
- Estado: Activo/Inactivo
- Destacado: Sí/No

**Características:**
- Tabla completa con todos los testimonios
- Vista de estrellas visual (⭐⭐⭐⭐⭐)
- Badges de estado coloridos
- Datos precargados de ejemplo

**Testimonios de ejemplo incluidos:**
- María González (CEO, Innovatech Solutions)
- Carlos Mendoza (Director de TI, GlobalCorp)
- Ana Rodríguez (Gerente, TechStart Inc)

---

### 3. API REST (/api)

#### POST /api/contact.php

**Función:** Procesar formulario de contacto

**Request:**
```json
POST /api/contact.php
Content-Type: multipart/form-data

name: "Juan Pérez"
email: "juan@example.com"
phone: "555-1234"
company: "Mi Empresa"
message: "Estoy interesado en sus servicios"
```

**Response (Éxito):**
```json
{
    "success": true,
    "message": "¡Gracias por contactarnos! Te responderemos pronto.",
    "data": {
        "contact_id": 123
    }
}
```

**Response (Error):**
```json
{
    "success": false,
    "message": "El email no es válido"
}
```

**Validaciones:**
- Nombre requerido
- Email válido y requerido
- Mensaje requerido
- Teléfono y empresa opcionales
- Sanitización de todos los inputs

---

#### POST /api/newsletter.php

**Función:** Suscripción a newsletter

**Request:**
```json
POST /api/newsletter.php

email: "usuario@example.com"
name: "Usuario" (opcional)
```

**Características:**
- Validación de email único
- Generación de token de desuscripción
- Prevención de duplicados
- Estado inicial: "activo"

---

#### GET /api/stats.php

**Función:** Obtener estadísticas del sitio

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "stat_key": "clients",
            "stat_value": "500+",
            "stat_label": "Clientes Satisfechos"
        },
        {
            "stat_key": "experience",
            "stat_value": "15+",
            "stat_label": "Años de Experiencia"
        },
        ...
    ]
}
```

**Uso:** Actualización dinámica de estadísticas

---

## 🔒 Seguridad Implementada

### 1. SQL Injection Protection
```php
// ✅ CORRECTO - Prepared Statements
$stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();

// ❌ INCORRECTO - Nunca hacer esto
$query = "SELECT * FROM users WHERE email = '$email'";
```

### 2. Password Security
```php
// Hash al crear usuario
$hash = password_hash('admin123', PASSWORD_BCRYPT);

// Verificar al login
password_verify($password, $hash);
```

### 3. XSS Protection
```php
// Sanitizar input
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

// Limpiar datos
$data = trim(stripslashes($data));
```

### 4. Session Security
```php
// Verificar sesión
function requireLogin() {
    if (!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}
```

---

## 💾 Base de Datos

### Diagrama de Tablas

```
┌─────────────────────┐
│   contacts          │
├─────────────────────┤
│ id (PK)            │
│ name               │
│ email              │
│ phone              │
│ company            │
│ message            │
│ status (ENUM)      │
│ created_at         │
└─────────────────────┘

┌─────────────────────┐
│ newsletter_subscribers │
├─────────────────────┤
│ id (PK)            │
│ email (UNIQUE)     │
│ name               │
│ token (UNIQUE)     │
│ status             │
│ subscribed_at      │
└─────────────────────┘

┌─────────────────────┐
│   site_stats        │
├─────────────────────┤
│ id (PK)            │
│ stat_key (UNIQUE)  │
│ stat_value         │
│ stat_label         │
│ display_order      │
│ is_active          │
└─────────────────────┘

┌─────────────────────┐
│   services          │
├─────────────────────┤
│ id (PK)            │
│ title              │
│ description        │
│ icon_svg           │
│ display_order      │
│ is_active          │
└─────────────────────┘

┌─────────────────────┐
│   testimonials      │
├─────────────────────┤
│ id (PK)            │
│ client_name        │
│ client_position    │
│ client_company     │
│ testimonial_text   │
│ rating             │
│ is_featured        │
│ is_active          │
└─────────────────────┘

┌─────────────────────┐
│   admin_users       │
├─────────────────────┤
│ id (PK)            │
│ username (UNIQUE)  │
│ password (HASH)    │
│ email (UNIQUE)     │
│ full_name          │
│ role (ENUM)        │
│ is_active          │
│ last_login         │
└─────────────────────┘
```

---

## 🎨 Diseño y UX

### Landing Page
- **Color principal**: Crimson Red (#DC143C)
- **Tipografía**: Montserrat (títulos), Open Sans (cuerpo)
- **Responsive**: 3 breakpoints (móvil, tablet, desktop)
- **Animaciones**: Scroll reveal, contador animado, transiciones suaves

### Panel Admin
- **Diseño**: Sidebar fijo + header superior
- **Color scheme**: Blanco, grises, acentos de color por función
- **Iconografía**: SVG inline para performance
- **Tablas**: Responsive con scroll horizontal
- **Estados**: Badges coloridos por tipo

---

## 📈 Datos de Ejemplo Incluidos

### Estadísticas
- 500+ Clientes Satisfechos
- 15+ Años de Experiencia
- 1000+ Proyectos Completados
- 98% Tasa de Éxito

### Servicios (6)
1. Desarrollo de Software
2. Consultoría TI
3. Cloud Computing
4. Ciberseguridad
5. Business Intelligence
6. Soporte 24/7

### Testimonios (3)
- María González - CEO Innovatech
- Carlos Mendoza - Director TI GlobalCorp
- Ana Rodríguez - Gerente TechStart

### Usuario Admin
- Username: admin
- Password: admin123
- Role: admin

---

## 🚀 Flujos de Usuario

### Flujo 1: Visitante envía mensaje
1. Visitante llena formulario
2. Click en "Enviar Mensaje"
3. JavaScript valida campos
4. AJAX envía a `api/contact.php`
5. PHP valida y sanitiza datos
6. Guarda en MySQL tabla `contacts`
7. Retorna JSON con resultado
8. Muestra mensaje de éxito
9. Formulario se resetea

### Flujo 2: Admin revisa mensajes
1. Admin accede a `/admin/login.php`
2. Ingresa credenciales
3. Sistema verifica con Bcrypt
4. Crea sesión segura
5. Redirecciona a dashboard
6. Ve estadísticas y mensajes recientes
7. Click en "Ver Todos" → `/admin/contacts.php`
8. Ve lista completa de mensajes
9. Marca mensaje como "leído"
10. Estado actualiza en BD y UI

### Flujo 3: Admin edita estadísticas
1. Admin autenticado accede `/admin/stats.php`
2. Ve 4 tarjetas editables
3. Cambia valor de "Clientes" a "600+"
4. Click en "Actualizar"
5. PHP actualiza MySQL
6. Muestra mensaje de éxito
7. Cambio se refleja en sitio público inmediatamente

---

## 🔧 Personalización Fácil

### Cambiar colores
```css
/* styles.css */
:root {
    --primary-color: #DC143C;  /* Cambiar a tu color */
}
```

### Agregar nuevo servicio
```sql
INSERT INTO services (title, description, icon_svg, display_order) 
VALUES ('Tu Servicio', 'Descripción', '<svg>...</svg>', 7);
```

### Cambiar textos
Editar directamente en `index.php` o crear sistema de contenido en BD.

---

## 📱 Responsive Design

### Breakpoints
- **Desktop**: > 968px (grid completo, sidebar fijo)
- **Tablet**: 640-968px (grid 2 columnas)
- **Mobile**: < 640px (stack vertical, menú hamburguesa)

### Características Mobile
- Menú hamburguesa animado
- Tarjetas apiladas verticalmente
- Formulario adaptado a touch
- Tablas con scroll horizontal
- Sidebar oculto en admin (futura mejora: menú móvil)

---

## 🎯 Casos de Uso

### Empresas de Servicios
- Landing page profesional
- Captura de leads vía formulario
- Gestión centralizada de prospectos
- Seguimiento de estado de contactos

### Consultorías
- Mostrar servicios y expertise
- Testimonios de clientes
- Newsletter para marketing
- Panel para equipo de ventas

### Startups
- Presencia web profesional inmediata
- Backend funcional sin framework pesado
- Fácil de personalizar y extender
- Hosting económico (PHP compartido)

---

## 🔮 Extensiones Futuras

### Posibles mejoras:
- [ ] Editor WYSIWYG para contenido
- [ ] Upload de imágenes para testimonios
- [ ] Sistema de roles (admin, editor, viewer)
- [ ] Dashboard con gráficas (Chart.js)
- [ ] Exportar contactos a CSV/Excel
- [ ] Envío automático de emails
- [ ] Integración con CRM
- [ ] Multi-idioma
- [ ] Blog/Noticias
- [ ] Portafolio de proyectos

---

**TechVision Solutions** - Sistema completo, no solo diseño. Listo para producción con datos de ejemplo incluidos.
