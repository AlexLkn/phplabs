<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Запит до бази даних для отримання користувача за логіном
        $query = "SELECT user_id, username, password, email, language, admin FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // Авторизація пройшла успішно
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['language'] = $user['language'];
            $_SESSION['admin'] = $user['admin'];

            header("Location: index.php"); // Перенаправте на головну сторінку
            exit();
        } else {
            // Невірний логін або пароль
            echo '<p style="color: red;">Невірний логін або пароль</p>';
        }
    } else {
        // Відсутні дані логіну або паролю
        echo '<p style="color: red;">Будь ласка, введіть логін та пароль</p>';
    }
}
?>

<form method="POST" action="index.php?action=login">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>
