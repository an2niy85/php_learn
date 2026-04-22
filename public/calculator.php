<?php
$num1 = $_GET['num1'] ?? 0;
$num2 = $_GET['num2'] ?? 0;
$operation = $_GET['operation'] ?? 'add';

$num1 = (float)$num1;
$num2 = (float)$num2;

switch ($operation) {
    case 'add':
        $result = $num1 + $num2;
        $operator = '+';
        break;
    case 'subtract':
        $result = $num1 - $num2;
        $operator = '-';
        break;
    case 'multiply':
        $result = $num1 * $num2;
        $operator = '×';
        break;
    case 'divide':
        if ($num2 == 0) {
            echo "Ошибка: деление на ноль невозможно!";
            exit;
        }
        $result = $num1 / $num2;
        $operator = '÷';
        break;
    default:
        echo "Неизвестная операция";
        exit;
}

echo "Результат: $num1 $operator $num2 = $result";
