<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(false, 'Método no permitido');
}

$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$company = sanitizeInput($_POST['company'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');

$errors = [];

if (empty($name)) {
    $errors[] = 'El nombre es requerido';
}

if (empty($email)) {
    $errors[] = 'El email es requerido';
} elseif (!validateEmail($email)) {
    $errors[] = 'El email no es válido';
}

if (empty($message)) {
    $errors[] = 'El mensaje es requerido';
}

if (!empty($errors)) {
    sendJsonResponse(false, implode(', ', $errors));
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "INSERT INTO contacts (name, email, phone, company, message) 
              VALUES (:name, :email, :phone, :company, :message)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':company', $company);
    $stmt->bindParam(':message', $message);
    
    if ($stmt->execute()) {
        sendJsonResponse(true, '¡Gracias por contactarnos! Te responderemos pronto.', [
            'contact_id' => $db->lastInsertId()
        ]);
    } else {
        sendJsonResponse(false, 'Error al enviar el mensaje. Inténtalo de nuevo.');
    }
    
} catch (PDOException $e) {
    logError("Error en contact.php: " . $e->getMessage());
    sendJsonResponse(false, 'Error al procesar tu solicitud. Inténtalo más tarde.');
}
