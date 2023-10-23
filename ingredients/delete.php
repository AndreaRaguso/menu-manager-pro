<?php

$ingredientsString = file_get_contents('ingredients.json');
$ingredientsDecoded = json_decode($ingredientsString, true);

$delingredient = [
    'name' => $_POST['ingredient']['name'],
    'quantity' => $_POST['ingredient']['quantity'],
    'date' => $_POST['ingredient']['date'],
];

foreach ($ingredientsDecoded as $key => $value) {
    if (in_array($delingredient['id'] , $value)) {
        unset($ingredientsDecoded[$key]);
    }
}

$ingredientsEncoded = json_encode($ingredientsDecoded);

file_put_contents('ingredients.json', $ingredientsEncoded);

$response = [
    'success' => true,
    'message' => 'Ok',
    'code' => 200
];

header('Content-Type: application/json');

echo json_encode($response);
