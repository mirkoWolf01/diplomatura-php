<?php
header("Content-Type: application/json; charset=utf-8");

$fields = ["nombre", "apellido", "mail", "tipoDeContacto", "asunto", "descripcion"];
$formValues = [];

$formValues["tel"] = trim((string)($_POST["tel"] ?? ""));
$formValues["date"] = date("c");

$invalidFields = [];

foreach ($fields as $field) {
    $value = trim((string)($_POST[$field] ?? ""));

    if ($value === ""){
        $invalidFields[] = $field;
        continue;
    }
    
    $formValues[$field] = $value;
}

if(!empty($invalidFields)){
    http_response_code(422);
    $formatedIF = implode(", ", $invalidFields);
    echo json_encode(["error" => "Falta completar los siguientes campos obligatorios: $formatedIF"], JSON_UNESCAPED_UNICODE);
    exit;
}
    

if (!filter_var($formValues["mail"], FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(["error" => "El mail ingresado no es valido"], JSON_UNESCAPED_UNICODE);
    exit;
}

$savePath = __DIR__ . "/saves.json";
$savedValues = [];


if (file_exists($savePath)) {
    $contenido = file_get_contents($savePath);
    $savedValues = json_decode($contenido, true);
    
    if (!is_array($savedValues)) {
        $savedValues = [];
    }
}


$savedValues[] = $formValues;

$success = file_put_contents(
    $savePath,
    json_encode($savedValues, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL,
    LOCK_EX
);

if ($success === false) {
    http_response_code(500);
    echo json_encode(["error" => "Error inesperado al guardar los valores"], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode(["success" => true, "msg" => "Consulta guardada correctamente."], JSON_UNESCAPED_UNICODE);