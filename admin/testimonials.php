<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

requireLogin();

$database = new Database();
$db = $database->getConnection();

$testimonialsQuery = "SELECT * FROM testimonials ORDER BY created_at DESC";
$testimonialsStmt = $db->query($testimonialsQuery);
$testimonials = $testimonialsStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonios - TechVision Solutions</title>
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?>
        
        <main class="admin-content">
            <div class="page-header">
                <h1>Testimonios de Clientes</h1>
                <p>Total de testimonios: <?php echo count($testimonials); ?></p>
            </div>
            
            <div class="content-section">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Cargo</th>
                                <th>Empresa</th>
                                <th>Testimonio</th>
                                <th>Rating</th>
                                <th>Destacado</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($testimonials as $testimonial): ?>
                            <tr>
                                <td><?php echo $testimonial['id']; ?></td>
                                <td><?php echo htmlspecialchars($testimonial['client_name']); ?></td>
                                <td><?php echo htmlspecialchars($testimonial['client_position'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($testimonial['client_company'] ?? '-'); ?></td>
                                <td class="message-cell">
                                    <div class="message-preview">
                                        <?php echo htmlspecialchars($testimonial['testimonial_text']); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="rating">
                                        <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                            ⭐
                                        <?php endfor; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($testimonial['is_featured']): ?>
                                        <span class="badge badge-success">Sí</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">No</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($testimonial['is_active']): ?>
                                        <span class="badge badge-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Inactivo</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo formatDate($testimonial['created_at']); ?></td>
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
