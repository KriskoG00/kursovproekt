<?php
function handleContactForm()
{
    $errors = [];
    $successMessage = '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty(trim($name))) {
            $errors[] = 'Моля, въведете вашето име.';
        }
        if (empty(trim($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Моля, въведете валиден имейл.';
        }
        if (empty(trim($message))) {
            $errors[] = 'Моля, въведете съобщение.';
        }

        if (empty($errors)) {
            $successMessage = "Благодарим за вашето съобщение, $name! Ще получите отговор на имейл: $email.";
            $name = $email = $message = '';
        }
    }

    return [$errors, $successMessage, $name, $email, $message];
}

list($errors, $successMessage, $name, $email, $message) = handleContactForm();
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакти</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 800px;
            padding: 2rem;
            background-color: dark;
        }

        h1 {
            font-size: 2.5rem;
            color: black;
        }

        .my-5 {
            margin-top: 5rem;
            margin-bottom: 5rem;
            background-attachment: fixed;
            background-blend-mode: color;
        }

        .form-control,
        .btn-primary {

            border-radius: 25px;
        }

        .mb-3 label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Свържете се с нас</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Имена</label>
                <input type="text" class="form-control" id="name" placeholder="Вашето име" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Имейл</label>
                <input type="email" class="form-control" id="email" placeholder="Вашият имейл" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Съобщение</label>
                <textarea class="form-control" id="message" rows="4" name="message" placeholder="Вашето съобщение" required><?php echo htmlspecialchars($message); ?></textarea>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Изпрати</button>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        <?php if (!empty($errors)): ?>
            Swal.fire({
                title: 'Има грешки в формата!',
                html: '<?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?>',
                icon: 'error',
                confirmButtonText: 'Разбрах'
            });
        <?php elseif (!empty($successMessage)): ?>
            Swal.fire({
                title: 'Успешно изпратено!',
                text: '<?php echo htmlspecialchars($successMessage); ?>',
                icon: 'success',
                confirmButtonText: 'ОК'
            });
        <?php endif; ?>
    </script>
</body>

</html>