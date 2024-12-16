<?php

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    echo '<div class="alert alert-danger" role="alert">Невалиден идентификатор на животното!</div>';
    exit;
}

$query = "SELECT * FROM animals WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$animal = $stmt->fetch();

if (!$animal) {
    echo '<div class="alert alert-danger" role="alert">Животното не е намерено!</div>';
    exit;
}

function safeValue($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редакция на животно</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <form class="border rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_edit_animal.php" enctype="multipart/form-data">
            <h3 class="text-center">Редактирай информация за животно</h3>

            <div class="mb-3">
                <label for="name" class="form-label">Име на животното:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo safeValue($animal['name'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Възраст:</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo safeValue($animal['age'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Вид:</label>
                <input type="text" class="form-control" id="type" name="type" value="<?php echo safeValue($animal['type'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label for="available" class="form-label">Достъпно ли е за осиновяване?</label>
                <select class="form-control" id="available" name="available" required>
                    <option value="1" <?php echo ($animal['available'] == 1) ? 'selected' : ''; ?>>Да</option>
                    <option value="0" <?php echo ($animal['available'] == 0) ? 'selected' : ''; ?>>Не</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ново изображение:</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Текущо изображение:</label>
                <div>
                    <img class="img-fluid rounded" src="uploads/<?php echo safeValue($animal['image'] ?? 'placeholder.png') ?>" alt="<?php echo safeValue($animal['name'] ?? 'Животно') ?>" style="max-height: 200px;">
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo safeValue($animal['id']) ?>">
            <div class="text-center">
                <button type="submit" class="btn btn-success">Запази промените</button>
                <a href="?page=animals" class="btn btn-secondary">Отказ</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>