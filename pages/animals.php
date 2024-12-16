<?php

$animals = [];

$query = "SELECT * FROM animals WHERE name LIKE :search";
$stmt = $pdo->prepare($query);
$stmt->execute([':search' => "%$search%"]);

while ($row = $stmt->fetch()) {
    $fav_query = "SELECT id FROM favorite_animals_users WHERE user_id = :user_id AND animal_id = :animal_id";
    $fav_stmt = $pdo->prepare($fav_query);
    $fav_params = [
        ':user_id' => $_SESSION['user_id'] ?? 0,
        ':animal_id' => $row['id']
    ];
    $fav_stmt->execute($fav_params);
    $row['is_favorite'] = $fav_stmt->fetch() ? '1' : '0';

    $animals[] = $row;
}

?>

<div class="container">
    <div class="row mt-4 mb-4">
        <form class="col-md-8 offset-md-2" method="GET">
            <div class="input-group">
                <input type="hidden" name="page" value="animals">
                <input type="text" class="form-control" placeholder="Търси животно" name="search" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit">Търсене</button>
            </div>
        </form>
    </div>

    <div class="row mb-4">
        <?php
        if (isset($_COOKIE['last_search'])) {
            echo '<h5 class="text-center text-muted">Последно търсене: ' . htmlspecialchars($_COOKIE['last_search']) . '</h5>';
        }
        ?>
    </div>

    <div class="row gy-4">
        <?php
        if (count($animals) === 0) {
            echo '<h1 class="text-center">Няма намерени животни</h1>';
        } else {
            foreach ($animals as $animal) {
                $fav_btn = $edit_delete = '';
                if (isset($_SESSION['user_name'])) {
                    if ($animal['is_favorite'] == '1') {
                        $fav_btn = '
                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-danger btn-sm remove-animal" data-animal="' . $animal['id'] . '">Премахни от любими</button>
                            </div>
                        ';
                    } else {
                        $fav_btn = '
                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-primary btn-sm add-animal" data-animal="' . $animal['id'] . '">Добави в любими</button>
                            </div>
                        ';
                    }
                }

                if (is_admin()) {
                    $edit_delete = '
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a class="btn btn-warning btn-sm" href="?page=edit_animal&id=' . $animal['id'] . '">Редактирай</a>
                            <form method="POST" action="./handlers/handle_delete_animal.php">
                                <input type="hidden" name="id" value="' . $animal['id'] . '">
                                <button type="submit" class="btn btn-danger btn-sm">Изтрий</button>
                            </form>
                        </div>
                    ';
                }

                $image = isset($animal['image']) && !empty($animal['image']) ? htmlspecialchars($animal['image']) : 'default-image.jpg';

                echo '
    <div class="col-md-4">
        <div class="card shadow-sm border-light">
            ' . $edit_delete . '
            <img src="uploads/' . $image . '" class="card-img-top" alt="' . htmlspecialchars($animal['name']) . '" style="height: 250px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">' . htmlspecialchars($animal['name']) . '</h5>
                <p class="card-text">' . (strlen($animal['description']) > 100 ? substr($animal['description'], 0, 100) . '...' : htmlspecialchars($animal['description'])) . '</p>
                <p class="card-text"><strong>Възраст:</strong> ';
                $age = htmlspecialchars($animal['age']);
                if ($age == 1) {
                    echo $age . ' годинка';
                } elseif ($age > 1 && $age < 5) {
                    echo $age . ' годинки';
                } else {
                    echo $age . ' годинки';
                }
                echo '</p>
                <p class="card-text"><strong>Вид:</strong> ' . htmlspecialchars($animal['type']) . '</p>
                <p class="card-text"><strong>Достъпно за осиновяване:</strong> ' . ($animal['available'] == 1 ? 'Да' : 'Не') . '</p>
            </div>
            ' . $fav_btn . '
        </div>
    </div>
';
            }
        }
        ?>
    </div>
</div>

<style>
    body {

        font-family: 'Arial', sans-serif;
        background-color: rgb(155, 192, 226);
    }

    .container {
        margin-top: 50px;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .input-group input {
        border-radius: 10px;
    }

    .input-group button {
        border-radius: 10px;
    }

    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .card-header {
        background-color: #f8f9fa;
    }

    .card-img-top {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .btn-primary {
        border-radius: 50px;
        transition: background-color 0.3s ease;
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        border-radius: 50px;
        transition: background-color 0.3s ease;
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>