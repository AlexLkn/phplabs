<?php
session_start();

// Функція для перевірки, чи користувач авторизований
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Функція для виходу з акаунту
function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

// Визначимо параметр action з URL (якщо він є)
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Включимо потрібний файл header
require_once 'layout/header.php';

// Обробка параметру action
switch ($action) {
    case 'about':
        // Включимо сторінку about з папки views
        require_once 'views/about.php';
        break;
    case 'registration':
        // Включимо сторінку registration з папки views
        require_once 'views/registration.php';
        break;
    case 'registration_successful':
        // Включимо сторінку registration_successful з папки views
        require_once 'views/registration_successful.php';
        break;
    case 'login':
        // Включимо сторінку login з папки views
        require_once 'views/login.php';
        break;
    case 'login_successful':
        // Включимо сторінку registration_successful з папки views
        require_once 'views/login_successful.php';
        break;
    case 'settings':
        // Включимо сторінку settings з папки views
        require_once 'views/settings.php';
        break;
    case 'logout':
        // Викликаємо функцію logout при виході
        logout();
        break;
    // Додайте інші можливі варіанти action тут
    default:
        // За замовчуванням включимо головну сторінку main з папки views
        require_once 'views/main.php';
        break;
}

// Включимо файл footer
require_once 'layout/footer.php';
?>
