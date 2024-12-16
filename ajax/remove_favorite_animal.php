<?php

require_once('../db.php');

$response = [
    'success' => true,
    'data' => [],
    'error' => ''
];

$animal_id = intval($_POST['animal_id'] ?? 0);

if ($animal_id <= 0) {
    $response['success'] = false;
    $response['error'] = 'Невалидно животно.';
} else {
    $user_id = $_SESSION['user_id'];

    $query = "DELETE FROM favorite_animals_users WHERE user_id = :user_id AND animal_id = :animal_id";
    $stmt = $pdo->prepare($query);
    $params = [
        ':user_id' => $user_id,
        ':animal_id' => $animal_id
    ];

    if (!$stmt->execute($params)) {
        $response['success'] = false;
        $response['error'] = 'Грешка при премахване от любими.';
    }
}

echo json_encode($response);
exit;
