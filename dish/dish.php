<?php

$dishesString = file_get_contents('./dishes.json');
$dishesDecoded = json_decode($dishesString, true);

$ingredientsString = file_get_contents('../ingredients/ingredients.json');
$ingredientsDecoded = json_decode($ingredientsString, true);

$ingredients = [];

foreach ($ingredientsDecoded as $ingredient) {
    if($ingredient['date'] <= date('Y-m-d')) {
        $ingredients[] = [
            'name' => $ingredient['name'],
            'quantity' => $ingredient['quantity'],
            'date' => $ingredient['date'],
            'id' => $ingredient['id'],
        ];
    }
}

$dishes = [];

foreach ($dishesDecoded as $dish) {
    
    $dishIngredientsIds = array_column($dish['ingredients'], 'id');
    $ingredientsIds = array_column($ingredients, 'id');

    if(count(array_intersect($dishIngredientsIds, $ingredientsIds)) > 0){
        $dishes[] = [
            'name' => $dish['name'],
            'price' => $dish['price'],
            'ingredients' => $dish['ingredients'],
        ];
    }
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
