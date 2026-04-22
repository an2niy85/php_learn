<?php
$name = $_POST['username'] ?? 'Guest';
$secret = $_POST['secret'] ?? '';

echo "Hello, $name!<br>";
echo "Your secret word is: " . str_repeat('*', strlen($secret));
