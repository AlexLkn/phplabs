<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/Group.ico" type="image/x-icon">
    <title>Zone</title>
  </head>
  <body>
  <header class="header">
        <div class="header__container container">
            <a href="#" class="header__logo"><img src="img/Logo.svg" alt="logo" /></a>
            <nav class="header__nav">
                <ul class="header__list">
                    <li><a class="header__item" href="index.php">Головна</a></li>
                    <li><a class="header__item" href="#">Про церкву</a></li>
                    <li><a class="header__item" href="#">Підтримка</a></li>
                    <li><a class="header__item" href="#">Служіння</a></li>
                    <li><a class="header__item" href="#">Медіа</a></li>
                </ul>
                <?php
                    // Перевірка, чи користувач авторизований
                    if (isUserLoggedIn()) {
                        include("dropdown_loggedin.php");
                    } else {
                        include("dropdown_guest.php");
                    }
                ?>
            </nav>
        </div>
    </header>