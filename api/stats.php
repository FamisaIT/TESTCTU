<?php
require_once '../config/database.php';

header('Content-Type: application/json');

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT stat_key, stat_value, stat_label 
              FROM site_stats 
              WHERE is_active = TRUE 
              ORDER BY display_order ASC";
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    $stats = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'data' => $stats
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener estadísticas'
    ]);
}
