# Guía de Instalación - TechVision Solutions

## Requisitos del Sistema

### Software Requerido
- **PHP**: 7.4 o superior
- **MySQL**: 5.7 o superior (o MariaDB 10.2+)
- **Servidor Web**: Apache 2.4+ o Nginx
- **Extensiones PHP**:
  - PDO
  - pdo_mysql
  - mbstring
  - json

### Verificar Requisitos

```bash
# Verificar versión de PHP
php -v

# Verificar extensiones PHP
php -m | grep -E 'pdo|mysql|mbstring|json'

# Verificar MySQL
mysql --version
```

## Instalación Paso a Paso

### 1. Preparar Archivos

```bash
# Clonar o descargar el proyecto
cd /var/www/html/

# O en Windows con XAMPP
cd C:\xampp\htdocs\

# Copiar archivos del proyecto
cp -r techvision-project/* ./
```

### 2. Configurar Base de Datos

#### Opción A: Línea de Comandos

```bash
# Conectar a MySQL
mysql -u root -p

# Crear base de datos
CREATE DATABASE techvision_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Importar estructura y datos
USE techvision_db;
SOURCE database.sql;

# Verificar tablas
SHOW TABLES;

# Salir
EXIT;
```

#### Opción B: phpMyAdmin

1. Abrir phpMyAdmin (http://localhost/phpmyadmin)
2. Click en "Nueva" para crear base de datos
3. Nombre: `techvision_db`
4. Cotejamiento: `utf8mb4_unicode_ci`
5. Click en "Importar"
6. Seleccionar archivo `database.sql`
7. Click en "Continuar"

### 3. Configurar Credenciales

Editar `config/database.php`:

```php
private $host = 'localhost';
private $db_name = 'techvision_db';
private $username = 'root';        // Tu usuario MySQL
private $password = '';            // Tu contraseña MySQL
```

### 4. Configurar Permisos (Linux/Mac)

```bash
# Dar permisos de escritura
sudo chmod -R 755 /var/www/html/techvision
sudo chown -R www-data:www-data /var/www/html/techvision

# Crear directorio de logs
mkdir logs
chmod 777 logs
```

### 5. Configurar Servidor Web

#### Apache (.htaccess ya incluido)

Verificar que mod_rewrite esté habilitado:

```bash
# Ubuntu/Debian
sudo a2enmod rewrite
sudo systemctl restart apache2

# CentOS/RHEL
# Editar /etc/httpd/conf/httpd.conf
# Cambiar AllowOverride None a AllowOverride All
sudo systemctl restart httpd
```

#### Nginx (Configuración Opcional)

Crear archivo `/etc/nginx/sites-available/techvision`:

```nginx
server {
    listen 80;
    server_name techvision.local;
    root /var/www/html/techvision;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

```bash
sudo ln -s /etc/nginx/sites-available/techvision /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### 6. Configurar Virtual Host (Opcional)

#### Apache

Editar `/etc/hosts`:
```
127.0.0.1    techvision.local
```

Crear VirtualHost:
```apache
<VirtualHost *:80>
    ServerName techvision.local
    DocumentRoot /var/www/html/techvision
    
    <Directory /var/www/html/techvision>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/techvision_error.log
    CustomLog ${APACHE_LOG_DIR}/techvision_access.log combined
</VirtualHost>
```

### 7. Verificar Instalación

1. **Sitio Público**: http://localhost/ o http://techvision.local/
2. **Panel Admin**: http://localhost/admin/

#### Credenciales de Admin
```
Usuario: admin
Contraseña: admin123
```

### 8. Probar Funcionalidad

- [ ] La página principal carga correctamente
- [ ] Las estadísticas se muestran
- [ ] Los servicios se cargan desde BD
- [ ] El formulario de contacto funciona
- [ ] Se puede acceder al panel admin
- [ ] El login funciona correctamente
- [ ] Los contactos se guardan en BD

## Instalación con XAMPP (Windows)

### 1. Instalar XAMPP
- Descargar desde https://www.apachefriends.org/
- Instalar en `C:\xampp`

### 2. Copiar Archivos
```
C:\xampp\htdocs\techvision\
```

### 3. Iniciar Servicios
- Abrir XAMPP Control Panel
- Start Apache
- Start MySQL

### 4. Crear Base de Datos
- Abrir http://localhost/phpmyadmin
- Seguir pasos de phpMyAdmin arriba

### 5. Acceder
- http://localhost/techvision/

## Instalación con Docker (Avanzado)

```yaml
# docker-compose.yml
version: '3.8'

services:
  web:
    image: php:7.4-apache
    ports:
      - "80:80"
    volumes:
      - ./:/var/www/html/
    depends_on:
      - db

  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: techvision_db
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

```bash
docker-compose up -d
docker-compose exec web bash
# Dentro del contenedor:
mysql -h db -u root -p techvision_db < database.sql
```

## Solución de Problemas

### Error: "Connection refused"
```bash
# Verificar que MySQL esté corriendo
sudo systemctl status mysql

# Iniciar MySQL
sudo systemctl start mysql
```

### Error: "Access denied for user"
- Verificar credenciales en `config/database.php`
- Verificar permisos del usuario MySQL

### Error 500
- Revisar logs de PHP: `/var/log/apache2/error.log`
- Verificar permisos de archivos
- Habilitar display_errors en `config.example.php`

### Formulario no funciona
- Verificar que JavaScript esté habilitado
- Abrir consola del navegador (F12)
- Verificar rutas de API

### No se puede iniciar sesión
- Verificar que existe el usuario admin en la BD
- Regenerar password:
```sql
UPDATE admin_users 
SET password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' 
WHERE username = 'admin';
```

## Seguridad Post-Instalación

### Cambiar Contraseña de Admin

```php
// Generar nuevo hash
<?php
echo password_hash('tu_nueva_contraseña', PASSWORD_BCRYPT);
?>
```

```sql
UPDATE admin_users 
SET password = 'nuevo_hash_aqui' 
WHERE username = 'admin';
```

### Deshabilitar Debug

En `config/database.php` o `config.example.php`:
```php
define('ENABLE_DEBUG', false);
ini_set('display_errors', 0);
```

### Configurar Backups

```bash
# Backup manual
mysqldump -u root -p techvision_db > backup_$(date +%Y%m%d).sql

# Backup automático (crontab)
0 2 * * * mysqldump -u root -pPASSWORD techvision_db > /backups/db_$(date +\%Y\%m\%d).sql
```

## Siguiente Pasos

1. Cambiar credenciales de administrador
2. Personalizar contenido del sitio
3. Configurar respaldo automático
4. Configurar SSL/HTTPS (Let's Encrypt)
5. Optimizar para producción

## Soporte

Para problemas o preguntas:
- Revisar logs en `logs/error.log`
- Verificar configuración PHP: `php -i`
- Revisar documentación en README_PHP.md

---

¡Instalación completada! Tu sitio debería estar funcionando correctamente.
