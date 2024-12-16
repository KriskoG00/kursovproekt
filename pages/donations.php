<?php
function handleDonationForm()
{
    $errors = [];
    $successMessage = '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $amount = $_POST['amount'] ?? 0;
    $message = $_POST['message'] ?? '';
    $cardNumber = $_POST['cardNumber'] ?? '';
    $expiryDate = $_POST['expiryDate'] ?? '';
    $cvv = $_POST['cvv'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty(trim($name))) {
            $errors[] = 'Моля, въведете вашето име.';
        }
        if (empty(trim($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Моля, въведете валиден имейл.';
        }
        if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
            $errors[] = 'Моля, въведете валидна сума за дарение.';
        }

        if (empty($errors)) {
            $successMessage = "Благодарим ви за вашето дарение от $amount BGN!";
            $name = $email = $amount = $message = $cardNumber = $expiryDate = $cvv = '';
        }
    }

    return [$errors, $successMessage, $name, $email, $amount, $message, $cardNumber, $expiryDate, $cvv];
}

list($errors, $successMessage, $name, $email, $amount, $message, $cardNumber, $expiryDate, $cvv) = handleDonationForm();
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дарения</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .card-input-wrapper {
            position: relative;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .card-input-wrapper input {
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 6px;
            background-color: #fff;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .card-input-wrapper input:focus {
            outline: none;
            border-color: #007bff;
            background-color: #eaf4ff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .card-input-wrapper input::placeholder {
            color: #888;
        }

        .card-icons {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            display: flex;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .card-icons img {
            width: 100px;
            height: auto;
            transition: opacity 0.3s ease, transform 0.3s ease;

        }

        .card-icons i {
            font-size: 36px;
            color: #007bff;
            opacity: 1;
            transform: scale(1);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .card-input-wrapper.visa .card-icons.visa,
        .card-input-wrapper.mastercard .card-icons.mastercard,
        .card-input-wrapper.amex .card-icons.amex {
            display: block;
            opacity: 100%;
            transform: scale(1);


        }

        .flatpickr-input {
            border-radius: 6px;
            padding: 10px;
            font-size: 16px;
        }

        .flatpickr-calendar {
            z-index: 9999;
            border-radius: 6px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    <header class="bg-dark text-light py-3">
        <div class="container">
            <h1 class="text-center">Подкрепете ни с вашето дарение</h1>
        </div>
    </header>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Защо да дарите?</h2>
                <p>
                    Вашите дарения ще помогнат да се осигурят храна, играчки и ветеринарни грижи за животните в нашия приют.
                    Благодарение на вас, животните получават втора възможност за по-добър живот.
                </p>
                <p>
                    Можете да изберете какво да дарите – пари, храна, одеяла или играчки за животните.
                    Всеки принос е безценен!
                </p>
            </div>
            <div class="col-md-6">
                <h2>Форма за дарение</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Вашето име</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Имейл</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Сума за дарение (BGN)</label>
                        <input type="number" class="form-control" id="amount" name="amount" min="1" value="<?php echo htmlspecialchars($amount); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Вашето съобщение (по желание)</label>
                        <textarea class="form-control" id="message" name="message" rows="3"><?php echo htmlspecialchars($message); ?></textarea>
                    </div>

                    <div class="card-input-wrapper" id="cardNumberWrapper">
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9101 1121" oninput="updateCardType()" required>
                        <div class="card-icons">
                            <i class="fab fa-cc-visa visa-icon" style="display: none;"></i>
                            <i class="fab fa-cc-mastercard mastercard-icon" style="display: none;"></i>
                            <i class="fab fa-cc-amex amex-icon" style="display: none;"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="expiryDate" class="form-label">Дата на изтичане (Д/ММ/ГГ)</label>
                        <input type="text" class="form-control flatpickr" id="expiryDate" name="expiryDate" placeholder="Д/ММ/ГГ" required>
                    </div>

                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="433" maxlength="3" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Дарете</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr(".flatpickr", {
            dateFormat: "d/m/y",
            disableMobile: true
        });

        function updateCardType() {
            const cardNumber = document.getElementById('cardNumber').value.replace(/\D/g, '');
            const wrapper = document.getElementById('cardNumberWrapper');
            const visaIcon = document.querySelector('.visa-icon');
            const mastercardIcon = document.querySelector('.mastercard-icon');
            const amexIcon = document.querySelector('.amex-icon');

            wrapper.classList.remove('visa', 'mastercard', 'amex');

            visaIcon.style.display = 'none';
            mastercardIcon.style.display = 'none';
            amexIcon.style.display = 'none';

            if (/^4/.test(cardNumber)) {
                wrapper.classList.add('visa');
                visaIcon.style.display = 'block';
                console.log("Visa card detected");
            } else if (/^5[1-5]/.test(cardNumber)) {
                wrapper.classList.add('mastercard');
                mastercardIcon.style.display = 'block';
                console.log("MasterCard detected");
            } else if (/^3[47]/.test(cardNumber)) {
                wrapper.classList.add('amex');
                amexIcon.style.display = 'block';
                console.log("American Express card detected");
            }
        }
        document.getElementById('cardNumber').addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '').substring(0, 16);
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || '';
            e.target.value = formattedValue;
        });
        document.getElementById('cardNumber').addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '').substring(0, 16);
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || '';
            e.target.value = formattedValue;
        });
        document.getElementById('cvv').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').substring(0, 3);
        });



        <?php if (!empty($errors)): ?>
            Swal.fire({
                title: 'Има грешки в формата!',
                html: '<?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?>',
                icon: 'error',
                confirmButtonText: 'Разбрах'
            });
        <?php elseif (!empty($successMessage)): ?>
            Swal.fire({
                title: 'Благодарим ви!',
                text: '<?php echo htmlspecialchars($successMessage); ?>',
                icon: 'success',
                confirmButtonText: 'Затвори'
            }).then(() => {
                document.querySelector('form').reset();
            });
        <?php endif; ?>
    </script>

</body>

</html>