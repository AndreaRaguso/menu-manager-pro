<?php

$ingredientsString = file_get_contents('ingredients.json');
$ingredientsDecoded = json_decode($ingredientsString, true);


$ingredients = [];

foreach ($ingredientsDecoded as $ingredient) {
    $ingredients[] = [
        'name' => $ingredient['name'],
        'quantity' => $ingredient['quantity'],
        'date' => $ingredient['date'],
        'id' => $ingredient['id'],
    ];
}

$response = [
    'success' => true,
    'message' => 'Ok',
    'code' => 200,
    'ingredients' => $ingredients
];

$jsonResponse = json_encode($response);

header('Content-Type: application/json');

echo $jsonResponse;
