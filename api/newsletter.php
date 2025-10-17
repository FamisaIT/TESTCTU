<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(false, 'Método no permitido');
}

$email = sanitizeInput($_POST['email'] ?? '');
$name = sanitizeInput($_POST['name'] ?? '');

if (empty($email)) {
    sendJsonResponse(false, 'El email es requerido');
}

if (!validateEmail($email)) {
    sendJsonResponse(false, 'El email no es válido');
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT id FROM newsletter_subscribers WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        sendJsonResponse(false, 'Este email ya está suscrito a nuestro newsletter');
    }
    
    $token = generateToken();
    
    $query = "INSERT INTO newsletter_subscribers (email, name, token) 
              VALUES (:email, :name, :token)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':token', $token);
    
    if ($stmt->execute()) {
        sendJsonResponse(true, '¡Gracias por suscribirte a nuestro newsletter!', [
            'subscriber_id' => $db->lastInsertId()
        ]);
    } else {
        sendJsonResponse(false, 'Error al procesar la suscripción. Inténtalo de nuevo.');
    }
    
} catch (PDOException $e) {
    logError("Error en newsletter.php: " . $e->getMessage());
    sendJsonResponse(false, 'Error al procesar tu solicitud. Inténtalo más tarde.');
}
