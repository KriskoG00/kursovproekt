<?php
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Начало - Животни</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, rgb(91, 153, 201), #D1C4E9);
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .hero-section {
            background: url('https://cdn.pixabay.com/photo/2016/11/18/13/03/cat-1839844_1280.jpg') no-repeat center center / cover;
            color: white;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            position: relative;
        }

        .hero-section h1 {
            font-size: 3rem;
            animation: fadeInDown 1.5s ease-in-out;
        }

        .hero-section p {
            font-size: 1.3rem;
            margin-top: 10px;
            animation: fadeIn 2s ease-in-out;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .card-body {
            background-color: #fff;
            border-radius: 10px;
            padding: 1rem;
        }

        .facts-section {
            padding: 2rem 0;
            background-color: #F0F8FF;
        }

        .facts-section h2 {
            margin-bottom: 1.5rem;
            font-weight: bold;
            color: #FF6347;
            text-align: center;
        }

        .fact-card {
            padding: 1.5rem;
            background: #ffffff;
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .fact-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
        }

        .fact-icon {
            font-size: 3rem;
            color: #FF6347;
            margin-bottom: 1rem;
        }

        .fact-card h5 {
            font-size: 1.3rem;
            font-weight: bold;
            margin-top: 15px;
        }

        .fact-card p {
            font-size: 0.9rem;
            color: #555;
        }

        .blockquote-footer {
            font-size: 1rem;
            font-weight: bold;
            color: rgb(0, 0, 0);
            text-align: right;
            margin-top: 10px;
            border: none;
            background-color: transparent;
            box-shadow: none;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="hero-section">
        <div class="text-center">
            <h1>Добре дошли в света на животните!</h1>
            <p>Намерете най-добрия приятел или научете повече за животните около вас.</p>
        </div>
    </div>

    <div class="container my-4">
        <h2 class="text-center mb-3">Последни новини</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="https://www.pbnovini.com/wp-content/uploads/2024/11/466734104_1110055021120274_7322831039901573836_n.jpg" class="card-img-top" alt="Новина 1">
                    <div class="card-body">
                        <h5 class="card-title">Нова благотворителна кампания</h5>
                        <p class="card-text">Присъединете се към нашата кампания за събиране на средства за бездомни животни! Вашето участие може да промени живота на много животни.</p>
                        <a href="?page=donations" class=" btn btn-primary">Прочети повече</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="https://webnews.bg/uploads/images/25/4225/614225/768x432.jpg?_=1681320601" class="card-img-top" alt="Чудите се как да помогнете на животно">
                    <div class="card-body">
                        <h5 class="card-title">Чудите се как да помогнете на животно?</h5>
                        <p class="card-text">Съществуват много различни начини, чрез които можем да направим разлика и да помогнем на животно. Бъдете част от нашите инициативи, които помагат на бездомни животни да намерят дом и грижи.</p>
                        <a href="?page=FAQ" class="btn btn-primary">Прочети повече</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="https://roditeli.org/wp-content/uploads/2023/01/victor-grabarczyk-N04FIfHhv_k-unsplash-1024x683.jpg" class="card-img-top" alt="Новина 3">
                    <div class="card-body">
                        <h5 class="card-title">Събитие за осиновяване на животни</h5>
                        <p class="card-text">Тук можеш да разгледаш много видове животни, които са при нас и чакат своят нов стопанин. Ако се интересуваш да помогнеш на животно, можеш да натиснеш тук.</p>
                        <a href="?page=animals" class="btn btn-primary">Прочети повече</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="facts-section">
        <div class="container">
            <h2>Интересни факти за животните</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="fact-card">
                        <i class="fa-solid fa-paw fact-icon"></i>
                        <h5>Кучета разбират човешки емоции</h5>
                        <p>Кучетата са в състояние да разпознават и реагират на човешки емоции като щастие, тъга и стрес.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fact-card">
                        <i class="fa-solid fa-cat fact-icon"></i>
                        <h5>Котки могат да видят в тъмното</h5>
                        <p>Котките имат специални очни структури, които им позволяват да виждат при минимална светлина.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fact-card">
                        <i class="fa-solid fa-dove fact-icon"></i>
                        <h5>Папагалите могат да говорят</h5>
                        <p>Някои видове папагали имат невероятната способност да имитират човешки глас и да "говорят".</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <h2 class="text-center mb-4">Популярни животни</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="https://cdn.pixabay.com/photo/2017/09/25/13/12/dog-2785074_1280.jpg" class="card-img-top" alt="Куче">
                    <div class="card-body">
                        <h5 class="card-title">Куче</h5>
                        <p class="card-text">Лоялният и още известен като най-добрият приятел на човека.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="https://cdn.pixabay.com/photo/2018/07/13/10/20/cat-3535404_1280.jpg" class="card-img-top" alt="Котка">
                    <div class="card-body">
                        <h5 class="card-title">Котка</h5>
                        <p class="card-text">Независим и обичан домашен любимец на всички нас.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <img src="https://klinika-kakadu.com/wp-content/uploads/2016/08/korella-krupnym-planom-1200x824.jpg" class="card-img-top" alt="Папагал">
                    <div class="card-body">
                        <h5 class="card-title">Папагал</h5>
                        <p class="card-text">Цветен и интелигентен, способен да имитира звуци и гласове.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <h2 class="text-center mb-4">Какво казват нашите потребители</h2>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <p class="card-text">"Изключително доволни сме от нашето ново куче! Благодарим ви за помощта и за това, че ни свързахте с толкова прекрасен животински приятел!"</p>
                        <footer class="blockquote-footer">Мария Иванова</footer>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <p class="card-text">"Котката, която осинових, беше точно това, което търсех! Обожавам я и не мога да си представя живота без нея!"</p>
                        <footer class="blockquote-footer">Иван Петров</footer>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <p class="card-text">"Прекрасно е, че има такива инициативи за осиновяване на животни. Много съм щастлив с новия си питомец!"</p>
                        <footer class="blockquote-footer">Елена Георгиева</footer>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>