<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

requireLogin();

$database = new Database();
$db = $database->getConnection();

$subscribersQuery = "SELECT * FROM newsletter_subscribers ORDER BY subscribed_at DESC";
$subscribersStmt = $db->query($subscribersQuery);
$subscribers = $subscribersStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter - TechVision Solutions</title>
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?>
        
        <main class="admin-content">
            <div class="page-header">
                <h1>Suscriptores Newsletter</h1>
                <p>Total de suscriptores: <?php echo count($subscribers); ?></p>
            </div>
            
            <div class="content-section">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Fecha de Suscripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subscribers as $subscriber): ?>
                            <tr>
                                <td><?php echo $subscriber['id']; ?></td>
                                <td><a href="mailto:<?php echo $subscriber['email']; ?>"><?php echo htmlspecialchars($subscriber['email']); ?></a></td>
                                <td><?php echo htmlspecialchars($subscriber['name'] ?? '-'); ?></td>
                                <td>
                                    <span class="badge badge-<?php echo $subscriber['status']; ?>">
                                        <?php echo ucfirst($subscriber['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo formatDate($subscriber['subscribed_at']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
