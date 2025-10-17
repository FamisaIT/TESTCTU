# TechVision Solutions - Aplicación Web PHP/MySQL

Sistema web completo con PHP y MySQL para gestión empresarial.

## 🚀 Características

### Frontend
- Landing page profesional y responsive
- Formulario de contacto funcional con AJAX
- Estadísticas dinámicas desde base de datos
- Servicios administrables
- Diseño moderno con animaciones

### Backend
- **PHP 7.4+** con PDO para seguridad
- **MySQL** con estructura completa
- Panel de administración completo
- API REST para operaciones AJAX
- Sistema de autenticación seguro
- Gestión de contactos, newsletter y testimonios

## 📁 Estructura del Proyecto

```
project/
├── config/
│   └── database.php          # Configuración de base de datos
├── includes/
│   └── functions.php          # Funciones auxiliares
├── api/
│   ├── contact.php            # API de contactos
│   ├── newsletter.php         # API de newsletter
│   └── stats.php              # API de estadísticas
├── admin/
│   ├── index.php              # Dashboard principal
│   ├── login.php              # Login administrativo
│   ├── contacts.php           # Gestión de contactos
│   ├── newsletter.php         # Gestión de suscriptores
│   ├── stats.php              # Gestión de estadísticas
│   ├── testimonials.php       # Gestión de testimonios
│   ├── admin-styles.css       # Estilos del admin
│   └── includes/
│       ├── header.php         # Header común
│       └── sidebar.php        # Sidebar común
├── database.sql               # Script de creación de BD
├── index.php                  # Página principal
├── styles.css                 # Estilos del sitio
└── script.js                  # JavaScript del sitio
```

## 💾 Base de Datos

La aplicación incluye las siguientes tablas:

- **contacts** - Mensajes del formulario de contacto
- **newsletter_subscribers** - Suscriptores del newsletter
- **site_stats** - Estadísticas del sitio (editables)
- **testimonials** - Testimonios de clientes
- **services** - Servicios ofrecidos
- **admin_users** - Usuarios administrativos

## 🔧 Instalación

### Requisitos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Apache/Nginx con mod_rewrite

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone <repository-url>
cd project
```

2. **Configurar la base de datos**
```bash
mysql -u root -p < database.sql
```

3. **Configurar credenciales**
Editar `config/database.php`:
```php
private $host = 'localhost';
private $db_name = 'techvision_db';
private $username = 'root';
private $password = 'tu_password';
```

4. **Configurar permisos**
```bash
chmod 755 -R .
chmod 777 logs/
```

5. **Acceder a la aplicación**
- Sitio público: `http://localhost/`
- Panel admin: `http://localhost/admin/`

### Credenciales de Administrador por Defecto

```
Usuario: admin
Contraseña: admin123
```

**⚠️ IMPORTANTE:** Cambia estas credenciales en producción.

## 🎯 Uso

### Sitio Público
- **Formulario de Contacto**: Los mensajes se guardan automáticamente en la BD
- **Estadísticas**: Se cargan dinámicamente desde MySQL
- **Servicios**: Se muestran desde la BD (administrables)

### Panel de Administración

#### Dashboard
- Vista general de estadísticas
- Mensajes recientes
- Resumen de actividad

#### Gestión de Contactos
- Ver todos los mensajes recibidos
- Marcar como: nuevo, leído, respondido
- Filtrar por estado

#### Newsletter
- Lista de suscriptores
- Estados: activo, inactivo
- Exportar emails

#### Estadísticas del Sitio
- Editar valores mostrados en el hero
- Personalizar etiquetas
- Actualización en tiempo real

#### Testimonios
- Gestionar testimonios de clientes
- Destacar testimonios principales
- Activar/desactivar

## 🔐 Seguridad

- **Prepared Statements**: Prevención de SQL Injection
- **Password Hashing**: Bcrypt para contraseñas
- **Input Sanitization**: Validación y limpieza de datos
- **CSRF Protection**: Sesiones seguras
- **XSS Prevention**: htmlspecialchars en outputs

## 📡 API Endpoints

### POST /api/contact.php
Envía un mensaje de contacto
```json
{
  "name": "Juan Pérez",
  "email": "juan@example.com",
  "phone": "123456789",
  "company": "Mi Empresa",
  "message": "Mensaje de prueba"
}
```

### POST /api/newsletter.php
Suscribe a newsletter
```json
{
  "email": "usuario@example.com",
  "name": "Nombre Opcional"
}
```

### GET /api/stats.php
Obtiene estadísticas del sitio
```json
{
  "success": true,
  "data": [
    {
      "stat_key": "clients",
      "stat_value": "500+",
      "stat_label": "Clientes Satisfechos"
    }
  ]
}
```

## 🎨 Personalización

### Cambiar Colores
Editar variables CSS en `styles.css`:
```css
:root {
    --primary-color: #DC143C;
    --secondary-color: #fff;
}
```

### Agregar Nuevos Servicios
```sql
INSERT INTO services (title, description, icon_svg, display_order) 
VALUES ('Nuevo Servicio', 'Descripción...', '<svg>...</svg>', 7);
```

### Modificar Estadísticas
Usar el panel admin o directamente:
```sql
UPDATE site_stats 
SET stat_value = '600+' 
WHERE stat_key = 'clients';
```

## 📊 Base de Datos - Detalles

### Tabla: contacts
```sql
- id (INT, PK, AUTO_INCREMENT)
- name (VARCHAR 100)
- email (VARCHAR 100)
- phone (VARCHAR 20)
- company (VARCHAR 100)
- message (TEXT)
- status (ENUM: nuevo, leido, respondido)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

### Tabla: admin_users
```sql
- id (INT, PK, AUTO_INCREMENT)
- username (VARCHAR 50, UNIQUE)
- password (VARCHAR 255) - Bcrypt hash
- email (VARCHAR 100, UNIQUE)
- full_name (VARCHAR 100)
- role (ENUM: admin, editor)
- is_active (BOOLEAN)
- last_login (TIMESTAMP)
- created_at (TIMESTAMP)
```

## 🐛 Troubleshooting

### Error de conexión a BD
1. Verificar credenciales en `config/database.php`
2. Verificar que MySQL esté corriendo
3. Verificar que la BD existe: `SHOW DATABASES;`

### Formulario no envía
1. Verificar ruta API en `script.js`
2. Revisar consola del navegador (F12)
3. Verificar logs de PHP

### No puede iniciar sesión
1. Verificar credenciales (admin/admin123)
2. Revisar tabla admin_users
3. Regenerar password si es necesario:
```php
echo password_hash('admin123', PASSWORD_BCRYPT);
```

## 🔄 Actualizaciones Futuras

- [ ] Sistema de roles avanzado
- [ ] Exportación de datos a Excel/CSV
- [ ] Dashboard con gráficas
- [ ] Sistema de notificaciones por email
- [ ] API REST completa con autenticación JWT
- [ ] Integración con servicios de email marketing

## 📝 Licencia

Proyecto de demostración - Uso libre

## 👨‍💻 Desarrollo

Desarrollado como sistema completo de placeholder con funcionalidad real PHP/MySQL.

---

**Nota**: Este es un sistema completamente funcional, no solo un placeholder visual. Incluye toda la lógica backend necesaria para gestión empresarial.
