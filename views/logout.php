<?php
session_start();

// Функція для виходу з акаунту
function logout() {
    session_unset(); // Очищення всіх змінних сесії
    session_destroy(); // Знищення сесії
    header("Location: index.php"); // Перенаправлення на головну сторінку
    exit();
}

// Викликати функцію виходу
logout();
?>
