<?php
$tests = [
    'localhost' => 3306,
    '127.0.0.1' => 3306,
    'localhost' => 3307,
    '127.0.0.1' => 3307,
];

echo "Проверяем подключение к MySQL с разными адресами:<br><br>";

foreach ($tests as $host => $port) {
    $conn = @new mysqli($host, 'root', '', 'test_db', $port);

    if (!$conn->connect_error) {
        echo "✅ РАБОТАЕТ! Хост: $host, порт: $port<br>";
        $conn->close();
    } else {
        echo "❌ Не работает: $host:$port → " . $conn->connect_error . "<br>";
    }
}

// Дополнительно: показываем, что говорит PHP
echo "<br><br>Значение переменной окружения COMPUTERNAME: " . getenv('COMPUTERNAME');
