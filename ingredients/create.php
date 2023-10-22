<?php

$ingredientsString = file_get_contents('ingredients.json');
$ingredientsDecoded = json_decode($ingredientsString, true);

// Trova l'ID massimo attualmente presente tra gli ingredienti
$maxId = 0;
foreach ($ingredientsDecoded as $ingredient) {
    if ($ingredient['id'] > $maxId) {
        $maxId = $ingredient['id'];
    }
}

// Genera un nuovo ID autoincremento
$newId = $maxId + 1;

$newingredient = [
    'id' => $newId,
    'name' => $_POST['ingredient']['name'],
    'quantity' => $_POST['ingredient']['quantity'],
    'date' => $_POST['ingredient']['date'],
];

$ingredientsDecoded[] = $newingredient;

$ingredientsEncoded = json_encode($ingredientsDecoded);

file_put_contents('ingredients.json', $ingredientsEncoded);

$response = [
    'success' => true,
    'message' => 'Ok',
    'code' => 200
];

header('Content-Type: application/json');

echo json_encode($response);
