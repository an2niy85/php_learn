<?php
echo "=== ПРЯМОЙ ТЕСТ ===<br><br>";

// Проверяем класс mysqli
if (class_exists('mysqli')) {
    echo "✅ класс mysqli существует<br>";

    // Пробуем подключиться напрямую
    $host = 'MySQL-8.4';
    $user = 'root';
    $pass = '';
    $db = 'test_db';
    //$port = 3306;

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        echo "❌ Ошибка подключения: " . $conn->connect_error . "<br>";

        // Пробуем альтернативные хосты
        echo "<br>Пробуем localhost:3306...<br>";
        $conn2 = new mysqli('localhost', $user, $pass, $db, 3306);
        if ($conn2->connect_error) {
            echo "❌ localhost: " . $conn2->connect_error;
        } else {
            echo "✅ Подключено к localhost!";
            $conn2->close();
        }
    } else {
        echo "✅ Подключено к MySQL-8.4!";
        echo "<br>Версия: " . $conn->server_info;
        $conn->close();
    }
} else {
    echo "❌ класс mysqli НЕ существует<br>";
    echo "Расширение mysqli не загружено!<br>";

    // Список загруженных расширений
    echo "<br>Загруженные расширения:<br>";
    foreach (get_loaded_extensions() as $ext) {
        echo "- $ext<br>";
    }
}
