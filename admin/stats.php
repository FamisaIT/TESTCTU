<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

requireLogin();

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stat_key = sanitizeInput($_POST['stat_key']);
    $stat_value = sanitizeInput($_POST['stat_value']);
    $stat_label = sanitizeInput($_POST['stat_label']);
    
    $query = "UPDATE site_stats SET stat_value = :value, stat_label = :label WHERE stat_key = :key";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':value', $stat_value);
    $stmt->bindParam(':label', $stat_label);
    $stmt->bindParam(':key', $stat_key);
    $stmt->execute();
    
    header('Location: stats.php?success=1');
    exit;
}

$statsQuery = "SELECT * FROM site_stats ORDER BY display_order ASC";
$statsStmt = $db->query($statsQuery);
$stats = $statsStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas del Sitio - TechVision Solutions</title>
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?>
        
        <main class="admin-content">
            <div class="page-header">
                <h1>Estadísticas del Sitio</h1>
                <p>Gestiona las estadísticas que se muestran en la página principal</p>
            </div>
            
            <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                ¡Estadísticas actualizadas correctamente!
            </div>
            <?php endif; ?>
            
            <div class="content-section">
                <div class="stats-editor-grid">
                    <?php foreach ($stats as $stat): ?>
                    <div class="stats-editor-card">
                        <form method="POST" action="">
                            <input type="hidden" name="stat_key" value="<?php echo $stat['stat_key']; ?>">
                            
                            <div class="form-group">
                                <label>Clave</label>
                                <input type="text" value="<?php echo htmlspecialchars($stat['stat_key']); ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Valor</label>
                                <input type="text" name="stat_value" value="<?php echo htmlspecialchars($stat['stat_value']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Etiqueta</label>
                                <input type="text" name="stat_label" value="<?php echo htmlspecialchars($stat['stat_label']); ?>" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
