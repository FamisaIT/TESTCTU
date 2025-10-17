<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup - TechVision Solutions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        
        .section {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #DC143C;
        }
        
        .section h2 {
            color: #DC143C;
            margin-bottom: 15px;
            font-size: 20px;
        }
        
        .check-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            margin-bottom: 10px;
            background: white;
            border-radius: 5px;
        }
        
        .check-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }
        
        .success {
            background: #4CAF50;
        }
        
        .error {
            background: #f44336;
        }
        
        .warning {
            background: #ff9800;
        }
        
        .info {
            background: #e3f2fd;
            border: 1px solid #2196F3;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .code {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 14px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #DC143C;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            margin-top: 20px;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #B01030;
        }
        
        .btn-secondary {
            background: #2196F3;
        }
        
        .btn-secondary:hover {
            background: #1976D2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 TechVision Solutions - Configuración</h1>
        <p class="subtitle">Verificación del sistema y guía de instalación</p>
        
        <?php
        $checks = [
            'php_version' => version_compare(PHP_VERSION, '7.4.0', '>='),
            'pdo' => extension_loaded('pdo'),
            'pdo_mysql' => extension_loaded('pdo_mysql'),
            'mbstring' => extension_loaded('mbstring'),
            'json' => extension_loaded('json'),
        ];
        
        $db_config_exists = file_exists('config/database.php');
        $db_connected = false;
        
        if ($db_config_exists) {
            try {
                require_once 'config/database.php';
                $database = new Database();
                $db = $database->getConnection();
                $db_connected = ($db !== null);
            } catch (Exception $e) {
                $db_error = $e->getMessage();
            }
        }
        ?>
        
        <div class="section">
            <h2>📋 Requisitos del Sistema</h2>
            
            <div class="check-item">
                <div class="check-icon <?php echo $checks['php_version'] ? 'success' : 'error'; ?>">
                    <?php echo $checks['php_version'] ? '✓' : '✗'; ?>
                </div>
                <span>PHP 7.4 o superior (Actual: <?php echo PHP_VERSION; ?>)</span>
            </div>
            
            <div class="check-item">
                <div class="check-icon <?php echo $checks['pdo'] ? 'success' : 'error'; ?>">
                    <?php echo $checks['pdo'] ? '✓' : '✗'; ?>
                </div>
                <span>Extensión PDO</span>
            </div>
            
            <div class="check-item">
                <div class="check-icon <?php echo $checks['pdo_mysql'] ? 'success' : 'error'; ?>">
                    <?php echo $checks['pdo_mysql'] ? '✓' : '✗'; ?>
                </div>
                <span>Extensión PDO MySQL</span>
            </div>
            
            <div class="check-item">
                <div class="check-icon <?php echo $checks['mbstring'] ? 'success' : 'error'; ?>">
                    <?php echo $checks['mbstring'] ? '✓' : '✗'; ?>
                </div>
                <span>Extensión mbstring</span>
            </div>
            
            <div class="check-item">
                <div class="check-icon <?php echo $checks['json'] ? 'success' : 'error'; ?>">
                    <?php echo $checks['json'] ? '✓' : '✗'; ?>
                </div>
                <span>Extensión JSON</span>
            </div>
        </div>
        
        <div class="section">
            <h2>💾 Base de Datos</h2>
            
            <div class="check-item">
                <div class="check-icon <?php echo $db_config_exists ? 'success' : 'warning'; ?>">
                    <?php echo $db_config_exists ? '✓' : '⚠'; ?>
                </div>
                <span>Archivo de configuración (config/database.php)</span>
            </div>
            
            <div class="check-item">
                <div class="check-icon <?php echo $db_connected ? 'success' : 'error'; ?>">
                    <?php echo $db_connected ? '✓' : '✗'; ?>
                </div>
                <span>Conexión a base de datos</span>
            </div>
            
            <?php if (!$db_connected && isset($db_error)): ?>
            <div class="info" style="background: #ffebee; border-color: #f44336;">
                <strong>Error de conexión:</strong><br>
                <?php echo htmlspecialchars($db_error); ?>
            </div>
            <?php endif; ?>
        </div>
        
        <?php if (!$db_connected): ?>
        <div class="section">
            <h2>🔧 Pasos de Instalación</h2>
            
            <h3 style="margin-top: 20px; color: #333;">1. Crear la Base de Datos</h3>
            <p>Ejecuta el siguiente comando en MySQL:</p>
            <div class="code">mysql -u root -p &lt; database.sql</div>
            
            <p>O importa manualmente en phpMyAdmin el archivo <strong>database.sql</strong></p>
            
            <h3 style="margin-top: 20px; color: #333;">2. Configurar Credenciales</h3>
            <p>Edita el archivo <strong>config/database.php</strong> con tus credenciales de MySQL:</p>
            <div class="code">
private $host = 'localhost';<br>
private $db_name = 'techvision_db';<br>
private $username = 'root';<br>
private $password = 'tu_password';
            </div>
            
            <h3 style="margin-top: 20px; color: #333;">3. Verificar Permisos</h3>
            <p>En Linux/Mac, asegúrate de dar permisos correctos:</p>
            <div class="code">
chmod -R 755 .<br>
mkdir logs<br>
chmod 777 logs
            </div>
        </div>
        
        <div class="info">
            <strong>💡 Documentación completa:</strong><br>
            Revisa <strong>INSTALL.md</strong> para instrucciones detalladas de instalación.
        </div>
        <?php else: ?>
        <div class="section" style="border-left-color: #4CAF50;">
            <h2 style="color: #4CAF50;">✅ Sistema Listo</h2>
            <p>Todos los requisitos están cumplidos y la conexión a la base de datos es correcta.</p>
            
            <div style="margin-top: 20px;">
                <a href="index.php" class="btn">Ver Sitio Web</a>
                <a href="admin/login.php" class="btn btn-secondary">Panel Admin</a>
            </div>
            
            <div class="info" style="margin-top: 20px;">
                <strong>🔐 Credenciales de Admin:</strong><br>
                Usuario: <strong>admin</strong><br>
                Contraseña: <strong>admin123</strong>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="section">
            <h2>📚 Recursos</h2>
            <ul style="margin-left: 20px; line-height: 2;">
                <li><strong>README_PHP.md</strong> - Documentación completa del proyecto</li>
                <li><strong>INSTALL.md</strong> - Guía detallada de instalación</li>
                <li><strong>database.sql</strong> - Script de creación de base de datos</li>
            </ul>
        </div>
    </div>
</body>
</html>
