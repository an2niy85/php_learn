<?php
echo "Версия PHP: " . phpversion() . "<br>";
echo "mysqli доступен: " . (extension_loaded('mysqli') ? 'Да' : 'Нет') . "<br>";
echo "Функция mysqli_connect существует: " . (function_exists('mysqli_connect') ? 'Да' : 'Нет') . "<br>";
echo "Класс mysqli существует: " . (class_exists('mysqli') ? 'Да' : 'Нет') . "<br>";
