<?php
?>

<form class="border rounded p-4 w-50 mx-auto" method="POST" action="./handlers/handle_register.php" id="registerForm">
    <h3 class="text-center mb-4">Регистрация</h3>

    <div class="mb-3">
        <label for="names" class="form-label">Имена</label>
        <input type="text" class="form-control" id="names" name="names" value="<?php echo $flash['data']['names'] ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Имейл</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $flash['data']['email'] ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Парола</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
        <label for="repeat_password" class="form-label">Повтори парола</label>
        <input type="password" class="form-control" id="repeat_password" name="repeat_password" required>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="is_admin" id="user_radio" value="1" checked>
            <label class="form-check-label" for="user_radio">Администратор</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="is_admin" id="admin_radio" value="2">
            <label class="form-check-label" for="admin_radio">Потребител</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mx-auto w-100">Регистрирай се</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const names = document.getElementById('names').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const repeat_password = document.getElementById('repeat_password').value;

        if (password !== repeat_password) {
            Swal.fire({
                title: 'Грешка!',
                text: 'Паролите не съвпадат.',
                icon: 'error',
                confirmButtonText: 'Разбрах'
            });
            return;
        }


        Swal.fire({
            title: 'Успех!',
            text: 'Регистрацията е успешна!',
            icon: 'success',
            confirmButtonText: 'ОК'
        }).then(function() {
            event.target.submit();
        });
    });
</script>

<style>
    body {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        font-family: 'Arial', sans-serif;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #2575fc;
        border-color: #2575fc;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #6a11cb;
        border-color: #6a11cb;
        transition: 0.3s ease;
    }

    .form-check-label {
        font-size: 16px;
    }

    .form-check-input {
        transform: scale(1.2);
    }

    form {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    h3 {
        color: #2575fc;
        font-weight: bold;
    }
</style>