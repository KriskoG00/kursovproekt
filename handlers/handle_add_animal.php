<?php

require_once('../functions.php');
require_once('../db.php');


$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$type = $_POST['type'] ?? '';
$description = $_POST['description'] ?? '';
$available = $_POST['available'] ?? 0;

if (empty($name) || empty($age) || empty($type) || empty($description)) {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = "Моля попълнете всички полета!";
    header('Location: ../index.php?page=add_animal');
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
        header('Location: ../index.php?page=add_animal');
        exit;
    } else {
        $img_uploaded = true;
    }
}

$query = "
    INSERT INTO animals (name, age, type, description, image, available)
    VALUES (:name, :age, :type, :description, :image, :available)
";

$stmt = $pdo->prepare($query);
$params = [
    ':name' => $name,
    ':age' => $age,
    ':type' => $type,
    ':description' => $description,
    ':available' => $available
];

if ($img_uploaded) {
    $params[':image'] = $new_file_name;
}

if ($stmt->execute($params)) {
    $_SESSION['flash']['message']['type'] = 'success';
    $_SESSION['flash']['message']['text'] = "Животното беше добавено успешно!";
} else {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = "Възникна грешка при добавянето на животното!";
}

header('Location: ../index.php?page=animals');
exit;
