<?php
header("Content-Type: application/json; charset=utf-8");

$camposObligatorios = ["nombre", "apellido", "email", "tipoContacto", "asunto", "descripcion"];
$consulta = [];

foreach ($camposObligatorios as $campo) {
    $valor = trim((string)($_POST[$campo] ?? ""));

    if ($valor === "") {
        http_response_code(422);
        echo json_encode(["error" => "El campo '$campo' es obligatorio."], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $consulta[$campo] = $valor;
}

$consulta["telefono"] = trim((string)($_POST["telefono"] ?? ""));
$consulta["fecha"] = date("c");

if (!filter_var($consulta["email"], FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(["error" => "El email no es valido."], JSON_UNESCAPED_UNICODE);
    exit;
}

$archivo = __DIR__ . "/consultas.json";
$consultas = [];

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $consultas = json_decode($contenido, true);

    if (!is_array($consultas)) {
        $consultas = [];
    }
}

$consultas[] = $consulta;
$guardado = file_put_contents(
    $archivo,
    json_encode($consultas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL,
    LOCK_EX
);

if ($guardado === false) {
    http_response_code(500);
    echo json_encode(["error" => "No se pudo guardar la consulta."], JSON_UNESCAPED_UNICODE);
    exit;
}

$archivoMensaje = __DIR__ . "/../mensaje.json";
$mensaje = json_decode(file_get_contents($archivoMensaje), true);

if (!is_array($mensaje) || !isset($mensaje["titulo"], $mensaje["mensaje"])) {
    http_response_code(500);
    echo json_encode(["error" => "La consulta se guardo, pero no se pudo cargar mensaje.json."], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
