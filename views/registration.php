<?php
include("db_connection.php");

// Function to save users to the database
function saveUsersToDB($conn, $username, $hashedPassword, $email, $language) {
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, language) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $hashedPassword, $email, $language);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) && isset($_POST["email"]) && isset($_POST["language"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];
        $email = $_POST["email"];
        $language = $_POST["language"];

        // Validate username using a regular expression
        $loginPattern = "/^[a-zA-Zа-яА-Я0-9_-]{4,}$/";
        if (!preg_match($loginPattern, $username)) {
            echo "Помилка: Неправильний формат логіну.";
        } else {
            // Load users from the database
            $userExists = false;
            $result = $conn->query("SELECT * FROM users WHERE username = '$username'");
            
            if ($result && $result->num_rows > 0) {
                $userExists = true;
            }

            if (!$userExists) {
                // Validate password using a regular expression
                $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{7,}$/";
                if (!preg_match($passwordPattern, $password)) {
                    echo "Помилка: Пароль повинен містити щонайменше 7 символів, включаючи великі та малі літери та цифри.";
                } else {
                    if ($password !== $confirmPassword) {
                        echo "Помилка: Пароль та підтвердження пароля не співпадають.";
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                        saveUsersToDB($conn, $username, $hashedPassword, $email, $language);
                        echo "Реєстрація успішна! Ви будете перенаправлені на сторінку реєстрації.";
                        header("refresh:3;url=index.php?action=registration_successful"); // Redirect after 3 seconds
                        exit;
                    }
                }
            } else {
                echo "Помилка: користувач з таким ім'ям вже існує.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Реєстрація та вхід в акаунт</title>
    <link rel="stylesheet" href="css/registration.css">
</head>
<body>

<h1>Реєстрація</h1>
<form method="post" action="index.php?action=registration">
    <input type="hidden" name="action" value="register">
    <label for="username">Ім'я користувача:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required><br>
    <label for="confirm_password">Повторіть пароль:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>
    <label for="email">Електронна пошта:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="language">Виберіть мову:</label>
    <select id="language" name="language" required>
        <option value="" disabled selected>Оберіть мову</option>
        <?php
        // Read languages from the file
        $languages = file("languages.txt", FILE_IGNORE_NEW_LINES);
        
        // Output list items
        foreach ($languages as $language) {
            list($code, $name) = explode(' ', $language, 2);
            echo '<option value="' . $code . '">' . $name . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="Зареєструватися">
    <p>Якщо ви вже маєте акаунт, то <a href="index.php?action=login">натисніть тут, щоб увійти</a>.</p>
</form>


</body>
</html>
