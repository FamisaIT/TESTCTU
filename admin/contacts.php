<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

requireLogin();

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['action']) && $_GET['action'] == 'update_status' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $status = $_GET['status'] ?? 'leido';
    
    $query = "UPDATE contacts SET status = :status WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    header('Location: contacts.php');
    exit;
}

$contactsQuery = "SELECT * FROM contacts ORDER BY created_at DESC";
$contactsStmt = $db->query($contactsQuery);
$contacts = $contactsStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contactos - TechVision Solutions</title>
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?>
        
        <main class="admin-content">
            <div class="page-header">
                <h1>Gestión de Contactos</h1>
                <p>Total de mensajes: <?php echo count($contacts); ?></p>
            </div>
            
            <div class="content-section">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Empresa</th>
                                <th>Mensaje</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $contact): ?>
                            <tr>
                                <td><?php echo $contact['id']; ?></td>
                                <td><?php echo htmlspecialchars($contact['name']); ?></td>
                                <td><a href="mailto:<?php echo $contact['email']; ?>"><?php echo htmlspecialchars($contact['email']); ?></a></td>
                                <td><?php echo htmlspecialchars($contact['phone'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($contact['company'] ?? '-'); ?></td>
                                <td class="message-cell">
                                    <div class="message-preview">
                                        <?php echo htmlspecialchars($contact['message']); ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-<?php echo $contact['status']; ?>">
                                        <?php echo ucfirst($contact['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo formatDate($contact['created_at']); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <?php if ($contact['status'] == 'nuevo'): ?>
                                        <a href="?action=update_status&id=<?php echo $contact['id']; ?>&status=leido" class="btn btn-sm btn-info">Marcar Leído</a>
                                        <?php endif; ?>
                                        <?php if ($contact['status'] == 'leido'): ?>
                                        <a href="?action=update_status&id=<?php echo $contact['id']; ?>&status=respondido" class="btn btn-sm btn-success">Marcar Respondido</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
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
