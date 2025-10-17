# 🚀 Quick Start - TechVision Solutions

Guía rápida para tener el sistema funcionando en 5 minutos.

## ⚡ Instalación Express

### Paso 1: Verificar Requisitos
```bash
php -v        # PHP 7.4+
mysql --version    # MySQL 5.7+
```

### Paso 2: Crear Base de Datos
```bash
# Opción A: Línea de comandos
mysql -u root -p < database.sql

# Opción B: Usar phpMyAdmin
# 1. Abrir http://localhost/phpmyadmin
# 2. Nueva base de datos: techvision_db
# 3. Importar archivo: database.sql
```

### Paso 3: Configurar Credenciales
Editar `config/database.php`:
```php
private $host = 'localhost';
private $db_name = 'techvision_db';
private $username = 'root';          // Tu usuario MySQL
private $password = '';              // Tu contraseña MySQL
```

### Paso 4: ¡Listo!
```
✅ Sitio público: http://localhost/
✅ Panel admin: http://localhost/admin/
   Usuario: admin
   Password: admin123
```

## 📋 Checklist de Instalación

- [ ] PHP 7.4+ instalado
- [ ] MySQL corriendo
- [ ] Base de datos creada (techvision_db)
- [ ] Tablas importadas (database.sql)
- [ ] Credenciales configuradas (config/database.php)
- [ ] Apache/Nginx corriendo
- [ ] Sitio accesible en navegador

## 🎯 Primeros Pasos

### 1. Probar el Sitio Público
1. Abrir http://localhost/
2. Verificar que las estadísticas se carguen
3. Ver los 6 servicios
4. Llenar el formulario de contacto
5. Enviar mensaje (debería aparecer "¡Mensaje Enviado!")

### 2. Acceder al Admin
1. Ir a http://localhost/admin/
2. Login con: admin / admin123
3. Ver dashboard con estadísticas
4. Revisar el mensaje enviado en paso 1

### 3. Gestionar Contenido
```
📊 Dashboard        → Vista general
📧 Contactos        → Ver mensajes recibidos
📰 Newsletter       → Gestionar suscriptores
⭐ Testimonios      → Gestionar reseñas
📈 Estadísticas     → Editar números del hero
```

## 🧪 Prueba Rápida

### Test del Formulario de Contacto
```javascript
// Abrir consola del navegador (F12) en index.php
// Llenar formulario manualmente y enviar
// Deberías ver en Network:
// ✓ POST api/contact.php → 200 OK
// ✓ Response: {"success":true,"message":"..."}
```

### Test del Admin
```sql
-- Verificar usuario admin existe
SELECT * FROM admin_users WHERE username = 'admin';

-- Ver mensajes de contacto
SELECT * FROM contacts ORDER BY created_at DESC;
```

## 🔧 Solución Rápida de Problemas

### ❌ "Connection refused"
```bash
# Verificar MySQL
sudo systemctl status mysql
sudo systemctl start mysql
```

### ❌ "Access denied"
```php
// Verificar config/database.php
private $username = 'root';     // ¿Es correcto?
private $password = '';         // ¿Tiene contraseña?
```

### ❌ Página en blanco
```php
// Habilitar errores temporalmente
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

### ❌ Formulario no envía
```javascript
// Verificar consola del navegador (F12)
// Revisar que api/contact.php sea accesible
fetch('api/contact.php').then(r => console.log(r));
```

## 📖 Documentación Completa

- **README.md** - Visión general del proyecto
- **README_PHP.md** - Documentación técnica completa
- **INSTALL.md** - Guía detallada de instalación
- **FEATURES.md** - Lista completa de funcionalidades

## 🎨 Personalización Rápida

### Cambiar colores del sitio
```css
/* styles.css - línea ~1 */
:root {
    --primary-color: #DC143C;  /* Tu color aquí */
}
```

### Cambiar logo
```html
<!-- index.php - línea ~18 -->
<div class="logo-icon">TV</div>  <!-- Cambiar "TV" -->
<span class="logo-text">TechVision</span>  <!-- Cambiar nombre -->
```

### Actualizar estadísticas
```
1. Login en /admin/
2. Ir a "Estadísticas"
3. Editar valores
4. Click "Actualizar"
5. Verificar en sitio público
```

## 🌐 Estructura de URLs

```
/                    → Landing page (index.php)
/admin/              → Redirige a login
/admin/login.php     → Login del admin
/admin/index.php     → Dashboard (requiere login)
/admin/contacts.php  → Gestión de contactos
/admin/newsletter.php → Gestión de newsletter
/admin/stats.php     → Editor de estadísticas
/admin/testimonials.php → Gestión de testimonios
/api/contact.php     → API de contacto (POST)
/api/newsletter.php  → API de newsletter (POST)
/api/stats.php       → API de estadísticas (GET)
/setup.php           → Asistente de instalación
```

## 💡 Tips

1. **Cambiar contraseña admin** después de instalar
2. **Deshabilitar display_errors** en producción
3. **Configurar backups** de la base de datos
4. **Revisar logs/** para errores
5. **Usar setup.php** para verificar instalación

## 🚦 Estados del Proyecto

### ✅ Funciona Listo para Usar
- Landing page dinámica
- Formulario de contacto
- Panel de administración
- Sistema de login
- API REST
- Base de datos

### 🔮 Posibles Mejoras Futuras
- Sistema de envío de emails
- Upload de imágenes
- Editor WYSIWYG
- Dashboard con gráficas
- Multi-idioma

## 📞 ¿Necesitas Ayuda?

1. **Verificar setup.php** - http://localhost/setup.php
2. **Revisar logs** - Carpeta logs/error.log
3. **Consultar docs** - INSTALL.md y README_PHP.md
4. **Verificar PHP** - `php -i` para ver configuración

## 🎯 Siguiente Nivel

Una vez que todo funcione:
- [ ] Personalizar contenido
- [ ] Cambiar credenciales
- [ ] Agregar más servicios
- [ ] Subir testimonios reales
- [ ] Configurar dominio
- [ ] SSL/HTTPS
- [ ] Backups automáticos

---

**¡Listo!** En 5 minutos tienes un sistema web completo funcionando.

Para más detalles, ver **INSTALL.md** o **README_PHP.md**.
