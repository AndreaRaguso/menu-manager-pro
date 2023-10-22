<?php

$dishesString = file_get_contents('dishes.json');
$dishesDecoded = json_decode($dishesString, true);

// Trova l'ID massimo attualmente presente tra gli dishi
$maxId = 0;
foreach ($dishesDecoded as $dish) {
    if ($dish['id'] > $maxId) {
        $maxId = $dish['id'];
    }
}

// Genera un nuovo ID autoincremento
$newId = $maxId + 1;

$newdish = [
    'id' => $newId,
    'name' => $_POST['dish']['name'],
    'price' => $_POST['dish']['price'],
    'ingredients' => $_POST['dish']['ingredients'],
];

$dishesDecoded[] = $newdish;

$dishesEncoded = json_encode($dishesDecoded);

file_put_contents('dishes.json', $dishesEncoded);

$response = [
    'success' => true,
    'message' => 'Ok',
    'code' => 200
];

header('Content-Type: application/json');

echo json_encode($response);
