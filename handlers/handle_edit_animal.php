<?php

require_once('../functions.php');
require_once('../db.php');

$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$type = $_POST['type'] ?? '';
$available = $_POST['available'] ?? '';
$id = intval($_POST['id'] ?? 0);

if (empty($name) || empty($age) || empty($type) || $id <= 0) {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = "Моля попълнете всички полета!";
    header('Location: ../index.php?page=edit_animal&id=' . $id);
    exit;
}

$img_uploaded = false;
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $new_file_name = time() . '_' . $_FILES['image']['name'];
    $upload_dir = '../uploads/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $new_file_name)) {
        $_SESSION['flash']['message']['type'] = 'danger';
        $_SESSION['flash']['message']['text'] = "Възникна грешка при качването на снимката!";
        header('Location: ../index.php?page=edit_animal&id=' . $id);
        exit;
    } else {
        $img_uploaded = true;
    }
}

$query = "";
if ($img_uploaded) {
    $query = "
        UPDATE animals
        SET name = :name, age = :age, type = :type, image = :image, available = :available
        WHERE id = :id
    ";
} else {
    $query = "
        UPDATE animals
        SET name = :name, age = :age, type = :type, available = :available
        WHERE id = :id
    ";
}

$stmt = $pdo->prepare($query);
$params = [
    ':name' => $name,
    ':age' => $age,
    ':type' => $type,
    ':available' => $available,
    ':id' => $id
];

if ($img_uploaded) {
    $params[':image'] = $new_file_name;
}

if ($stmt->execute($params)) {
    $_SESSION['flash']['message']['type'] = 'success';
    $_SESSION['flash']['message']['text'] = "Животното беше редактирано успешно!";
} else {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = "Възникна грешка при редакцията на животното!";
}

header('Location: ../index.php?page=animals&id=' . $id);
exit;
