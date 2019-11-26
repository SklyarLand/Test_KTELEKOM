<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./index.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet" type="text/css">
    <title>Clients</title>
</head>
<body>
    <main>
        <div id='form'>
            <select id="select-client">
           <?php 
            include('./php/drawClients.php');
           ?>
            </select>
        
            <div class="wrapper">
                <h2>ФИО</h2>
                <div class="grid-container" id='full-name'>
                    <label for="name">Имя *<input type="text" id="name"></label>
                    <label for="surname">Фамилия *<input type="text" id="surname"></label>
                    <label for="patronymic">Отчество *<input type="text" id="patronymic"></label>
                </div>
            </div>
            
            <div class="wrapper">
                <H2>Паспортные данные</H2>
                <div class="grid-container" id='pasport'>
                    <label for="pasportSeries">Серия паспорта *<input type="text" id="pasportSeries"></label>
                    <label for="pasportId">Номер паспорта *<input type="text" id="pasportId"></label>
                    <label for="whereIssued">Кем выдан *<input type="text" id="whereIssued"></label>
                    <label for="whenIssued">Когда выдан *<input type="text" id="whenIssued"></label>
                </div>
            </div>
            
            <div class="wrapper">
                <h2>Контакты</h2>
                <div class="grid-container" id='contacts'>
                    <label for="telephoneNumber">Номер телефона *<input type="text" id="telephoneNumber"></label>
                    <label for="mail">Почта <input type="text" id="mail"></label>
                </div>
            </div>
            
            <div class="wrapper">
                <h2>Адресс</h2>
                <div class="grid-container" id='adress'>
                    <label for="city">Город *<input type="text" id="city"></label>
                    <label for="street">Улица *<input type="text" id="street"></label>
                    <label for="house">Дом *<input type="text" id="house"></label>
                    <label for="apartment">Квартира *<input type="text" id="apartment"></label>
                </div>
            </div>
            <div class="wrapper">
                <div class="buttons-form">
                    <button id='save'>Сохранить</button>
                    <button id='delete' disabled>Удалить</button>
                    <button id='print'>Распечатать</button>
                </div>
            </div>
        </div>
    </main>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./index.js"></script>
</body>
</html>
