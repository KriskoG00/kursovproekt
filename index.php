<?php

require_once('functions.php');
require_once('db.php');

$page = $_GET['page'] ?? 'home';
$search = $_GET['search'] ?? '';

if (mb_strlen($search) > 0) {
    setcookie('last_search', $search, time() + 3600, '/', 'localhost', false, false);
}

$flash = [];
if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

$admin_pages = ['add_animal', 'edit_animal'];

if (in_array($page, $admin_pages) && !is_admin()) {
    $_SESSION['flash']['message']['type'] = 'warning';
    $_SESSION['flash']['message']['text'] = "Нямате достъп до тази страница!";

    header('Location: ./index.php?page=home');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Kingdom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <script>
        $(function() {
            $(document).on('click', '.add-animal', function() {
                let btn = $(this);
                let animalId = btn.data('animal');
                $.ajax({
                    url: './ajax/add_favorite_animal.php',
                    method: 'POST',
                    data: {
                        animal_id: animalId
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                title: 'Успех!',
                                text: 'Животното е успешно добавено в любими.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                            let removeBtn = $('<button type="button" class="btn btn-sm btn-danger remove-animal" data-animal="' + animalId + '">Премахни от любими</button>');
                            btn.replaceWith(removeBtn);
                        } else {
                            Swal.fire({
                                title: 'Грешка!',
                                text: 'Възникна грешка: ' + res.error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        Swal.fire({
                            title: 'Грешка!',
                            text: 'Неуспешно добавяне на животното в любими.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $(document).on('click', '.remove-animal', function() {
                let btn = $(this);
                let animalId = btn.data('animal');
                $.ajax({
                    url: './ajax/remove_favorite_animal.php',
                    method: 'POST',
                    data: {
                        animal_id: animalId
                    },
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                title: 'Успех!',
                                text: 'Животното е успешно премахнато от любими.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                            let addBtn = $('<button type="button" class="btn btn-sm btn-primary add-animal" data-animal="' + animalId + '">Добави в любими</button>');
                            btn.replaceWith(addBtn);
                        } else {
                            Swal.fire({
                                title: 'Грешка!',
                                text: 'Възникна грешка: ' + res.error,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        Swal.fire({
                            title: 'Грешка!',
                            text: 'Неуспешно премахване на животното от любими.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>

    <header>
        <nav class="navbar navbar-expand-lg navbar-custom py-3">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold">Животинско Царство</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($page == 'home' ? 'active' : '') ?>" aria-current="page" href="?page=home">Начало</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($page == 'animals' ? 'active' : '') ?>" href="?page=animals">Животни</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($page == 'contact' ? 'active' : '') ?>" href="?page=contacts">Свържи се с нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($page == 'contact' ? 'active' : '') ?>" href="?page=FAQ">Често задавани въпроси</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($page == 'contact' ? 'active' : '') ?>" href="?page=donations">Дарения</a>
                        </li>

                        <?php
                        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                            echo '
                                    <li class="nav-item">
                                        <a class="nav-link ' . ($page == 'add_animal' ? 'active' : '') . '" href="?page=add_animal">Добави животно</a>
                                    </li>
                                ';
                        }
                        ?>
                    </ul>
                    <div class="d-flex align-items-center flex-row gap-4">

                        <?php

                        if (isset($_SESSION['user_name'])) {
                            echo '<span class="text-light me-3">Здравейте, ' . htmlspecialchars($_SESSION['user_name']) . '</span>';
                            echo '
                                    <form method="POST" action="./handlers/handle_logout.php">
                                        <button type="submit" class="btn btn-outline-light">Изход</button>
                                    </form>
                                ';
                        } else {
                            echo '<a href="?page=login" class="btn btn-outline-light">Вход</a>';
                            echo '<a href="?page=register" class="btn btn-outline-light">Регистрация</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container py-4" style="min-height:80vh;">
        <?php
        if (isset($flash['message'])) {
            $icon_values = [
                'success' => 'success',
                'danger' => 'error',
                'warning' => 'warning',
            ];

            echo '
                    <script>
                        Swal.fire({
                            title: "' . $flash['message']['text'] . '",
                            icon: "' . $icon_values[$flash['message']['type']] . '",
                            toast: true,
                            position: "top",
                            showConfirmButton: false,
                            timer: 6000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            },
                            showCloseButton: true,
                        });
                    </script>
                ';
        }

        if (file_exists('./pages/' . $page . '.php')) {
            require_once('./pages/' . $page . '.php');
        } else {
            require_once('./pages/not_found.php');
        }
        ?>
    </main>
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>За нас</h5>
                    <p>Нашата мисия е да свържем хората с техните бъдещи домашни любимци и да подпомагаме грижата за животните в нужда.</p>
                </div>
                <div class="col-md-4">
                    <h5>Контакти</h5>
                    <p><i class="bi bi-envelope"></i> Имейл: support@animalcare.com</p>
                    <p><i class="bi bi-phone"></i> Телефон: +359 123 456 789</p>
                    <p><i class="bi bi-geo-alt"></i> Адрес: ул. "Георги Петров" №12, гр. София</p>
                </div>

                <div class="col-md-4">
                    <h5>Следвайте ни</h5>
                    <a href="#" class="text-light me-2"><i class="bi bi-facebook"></i> Facebook</a><br>
                    <a href="#" class="text-light me-2"><i class="bi bi-instagram"></i> Instagram</a><br>
                    <a href="#" class="text-light me-2"><i class="bi bi-twitter"></i> Twitter</a>
                </div>
            </div>

            <div class="text-center mt-3">
                <p>&copy; 2024 AnimalCare. Всички права запазени.</p>
            </div>
        </div>
    </footer>
    <style>
        .navbar-custom {
            background-color: rgb(49, 162, 170);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #FFFFFF;
        }

        .navbar-custom .nav-link:hover {
            color: #FFDDC1;
        }

        footer {
            background-color: #343a40;
            color: #ffffff;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
        }

        footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        footer h5 {
            border-bottom: 2px solid #ffc107;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        footer i {
            margin-right: 5px;
        }
    </style>
</body>