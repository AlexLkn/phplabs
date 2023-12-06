<?php
// Включимо потрібний файл header
require_once 'layout/header.php';

// Перевірка, чи користувач авторизований
if (!isUserLoggedIn()) {
    header("Location: index.php");
    exit;
}

// Обробка змін пароля
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    // Ваш код для зміни пароля тут
    // Зверніть увагу на безпеку та можливості хешування пароля
}

// Обробка завантаження фотографії
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_photo'])) {
    // Ваш код для завантаження фотографії тут
    // Можливо, вам буде потрібно використовувати бібліотеки або розширення для роботи з фото
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Ваші стилі або CSS-файли для сторінки settings тут -->
    <link rel="stylesheet" href="css/settings.css">
</head>
<body>

<h1>Налаштування користувача</h1>

<!-- Форма для зміни пароля -->
<form method="post" action="settings.php">
    <label for="new_password">Новий пароль:</label>
    <input type="password" id="new_password" name="new_password" required><br>
    <label for="confirm_password">Підтвердіть пароль:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>
    <input type="submit" name="change_password" value="Змінити пароль">
</form>

<!-- Форма для завантаження фотографії -->
<form method="post" action="settings.php" enctype="multipart/form-data">
    <label for="photo">Оберіть фотографію:</label>
    <input type="file" id="photo" name="photo" accept="image/*" required><br>
    <input type="submit" name="upload_photo" value="Завантажити фото">
</form>

<!-- Інші налаштування та візуальні елементи тут -->

</body>
</html>

<?php
// Включимо файл footer
require_once 'layout/footer.php';
?>
