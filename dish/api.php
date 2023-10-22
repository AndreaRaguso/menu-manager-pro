<?php

$dishesString = file_get_contents('dishes.json');
$dishesDecoded = json_decode($dishesString, true);


$dishes = [];

foreach ($dishesDecoded as $dish) {
    $dishes[] = [
        'name' => $dish['name'],
        'price' => $dish['price'],
        'ingredients' => $dish['ingredients'],
    ];
}

$response = [
    'success' => true,
    'message' => 'Ok',
    'code' => 200,
    'dishes' => $dishes
];

$jsonResponse = json_encode($response);

header('Content-Type: application/json');

echo $jsonResponse;
