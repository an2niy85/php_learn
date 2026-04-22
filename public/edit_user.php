<?php
$host = 'MySQL-8.4';
$user = 'root';
$password = '';      // Для OpenServer
$database = 'test_db';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if (!$user) {
    die("Пользователь не найден");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Редактирование пользователя</title>
</head>

<body>
    <h2>Редактировать пользователя</h2>
    <form action="update_user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <p>
            <label>Имя:</label><br>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        </p>
        <p>
            <label>Email:</label><br>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        </p>
        <p>
            <label>Возраст:</label><br>
            <input type="number" name="age" value="<?php echo $user['age']; ?>">
        </p>
        <button type="submit">Сохранить</button>
        <a href="db_test.php">Отмена</a>
    </form>
</body>

</html>

<?php $conn->close(); ?>