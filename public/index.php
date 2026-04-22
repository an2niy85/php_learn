<?php
$city = 'Izhevsk';
$temperature = 2;
echo "<h1>Example 1</h1>";
echo "<p>In the $city $temperature degree now</p>";

$age = 40;
if ($age >= 65) {
    echo "Пенсионер";
} elseif ($age >= 18 && $age < 65) {
    echo "Рабочий возраст";
} else {
    echo "Школьник/студент";
}
echo "<br>";

$product = [
    "title" => "Ноутбук",
    "price" => 50000,
    "in_stock" => "Да"
];
echo "Товар: " . $product["title"] . ", цена: " . $product["price"] . " руб. В наличии: " . $product["in_stock"];
echo "<br>";

$numbers = [10, 25, 7, 42, 18];
$sum = 0;
foreach ($numbers as $number) {
    $sum += $number;
}
echo "Сумма чисел: " . $sum;
