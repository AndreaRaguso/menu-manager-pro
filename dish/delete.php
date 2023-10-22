<?php

$dishsString = file_get_contents('dishes.json');
$dishesDecoded = json_decode($dishesString, true);

$deldish = [
    'name' => $_POST['dish']['name'],
    'price' => $_POST['dish']['price'],
    'ingredients' => $_POST['dish']['ingredients'],
];

foreach ($dishesDecoded as $key => $value) {
    if (in_array($deldish['name'] , $value)) {
        unset($dishesDecoded[$key]);
    }
}

$dishesEncoded = json_encode($dishesDecoded);

file_put_contents('dishes.json', $dishesEncoded);

$response = [
    'success' => true,
    'message' => 'Ok',
    'code' => 200
];

header('Content-Type: application/json');

echo json_encode($response);
