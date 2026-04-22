<?php
$name = $_GET['username'] ?? 'Guest';
$age = $_GET['age'] ?? 'unknown';

echo "Hello, $name!<br>";
echo "You are $age years old.<br>";
echo "Data in URL: " . $_SERVER['QUERY_STRING'];
