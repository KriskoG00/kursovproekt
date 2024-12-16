<?php
?>

<form class="login-form border rounded p-4 w-50 mx-auto mt-5 shadow-lg" method="POST" action="./handlers/handle_login.php" id="loginForm">
    <h3 class="text-center mb-4">Вход в системата</h3>

    <div class="mb-3">
        <label for="email" class="form-label">Имейл</label>
        <input type="email" class="form-control custom-input" id="email" name="email" value="<?php echo $_COOKIE['user_email'] ?? '' ?>" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Парола</label>
        <input type="password" class="form-control custom-input" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-login w-100 py-2 btn-hover">Вход</button>
</form>

<style>
    body {
        background-color: #f1f5f8;
        font-family: 'Arial', sans-serif;
    }

    .login-form {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        transition: all 0.3s ease-in-out;
        background: linear-gradient(135deg, #d2f4f5, #dff9e5);
    }

    .login-form:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .form-label {
        font-size: 1.1rem;
        color: #495057;
        font-weight: bold;
    }

    .custom-input {
        border-radius: 10px;
        padding: 0.75rem;
        font-size: 1rem;
        background-color: #f7f7f7;
        border: 1px solid #ccc;
        transition: border 0.3s ease-in-out;
    }

    .custom-input:focus {
        outline: none;
        border: 1px solid #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-login {
        background-color: #4CAF50;
        border-radius: 10px;
        font-size: 1.2rem;
        font-weight: 600;
        transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .btn-login:hover {
        background-color: #388e3c;
        transform: scale(1.05);
    }

    .btn:focus {
        outline: none;
    }

    .btn-hover {
        transition: transform 0.2s ease-in-out;
    }

    .btn-hover:hover {
        transform: scale(1.05);
    }

    .form-control {
        background-color: #f3f3f3;
        border: 1px solid #ced4da;
    }
</style>