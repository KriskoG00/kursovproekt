<?php
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добави Животно</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 30px;
            width: 60%;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container h3 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            padding: 15px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.25);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            padding: 12px 20px;
            font-size: 18px;
            width: 100%;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .form-control-file {
            padding: 0.75rem;
        }

        .back-btn {
            text-align: center;
            margin-top: 30px;
        }

        .back-btn a {
            color: #007bff;
            font-size: 16px;
            text-decoration: none;
            font-weight: 500;
        }

        .back-btn a:hover {
            text-decoration: underline;
        }

        .btn-success:focus {
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <form method="POST" action="./handlers/handle_add_animal.php" enctype="multipart/form-data">
                <h3>Добави Животно</h3>

                <div class="mb-3">
                    <label for="name" class="form-label">Име на животното:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Въведете името на животното" required>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Възраст:</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="Въведете възрастта на животното" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Вид на животното:</label>
                    <input type="text" class="form-control" id="type" name="type" placeholder="Въведете вида на животното" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Въведете описание на животното" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Снимка на животното:</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label for="available" class="form-label">Достъпно ли е за осиновяване?</label>
                    <select class="form-control" id="available" name="available" required>
                        <option value="1">Да</option>
                        <option value="0">Не</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Добави</button>
            </form>

            <div class="back-btn">
                <a href="index.php?page=animals">Обратно към животните</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>

</html>