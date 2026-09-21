<?php
header("Content-Type: application/xml; charset=utf-8");

$camposObligatorios = ["nombre", "apellido", "email", "tipoContacto", "asunto", "descripcion"];
$consulta = [];

foreach ($camposObligatorios as $campo) {
    $valor = trim((string)($_POST[$campo] ?? ""));

    if ($valor === "") {
        http_response_code(422);
        responderError("El campo '$campo' es obligatorio.");
    }

    $consulta[$campo] = $valor;
}

$consulta["telefono"] = trim((string)($_POST["telefono"] ?? ""));
$consulta["fecha"] = date("c");

if (!filter_var($consulta["email"], FILTER_VALIDATE_EMAIL)) {
    responderError("El email no es valido.");
}

$archivo = __DIR__ . "/consultas.xml";
$documento = new DOMDocument("1.0", "UTF-8");
$documento->formatOutput = true;

if (file_exists($archivo) && $documento->load($archivo)) {
    $raiz = $documento->documentElement;
} else {
    $raiz = $documento->createElement("consultas");
    $documento->appendChild($raiz);
}

$elementoConsulta = $documento->createElement("consulta");

foreach ($consulta as $nombre => $valor) {
    $elemento = $documento->createElement($nombre);
    $elemento->appendChild($documento->createTextNode($valor));
    $elementoConsulta->appendChild($elemento);
}

$raiz->appendChild($elementoConsulta);

if ($documento->save($archivo) === false) {
    responderError("No se pudo guardar la consulta.", 500);
}

$archivoMensaje = __DIR__ . "/../mensaje.json";
$mensaje = json_decode(file_get_contents($archivoMensaje), true);

if (!is_array($mensaje) || !isset($mensaje["titulo"], $mensaje["mensaje"])) {
    responderError("La consulta se guardo, pero no se pudo cargar mensaje.json.", 500);
}

$respuesta = new DOMDocument("1.0", "UTF-8");
$respuesta->formatOutput = true;
$raizRespuesta = $respuesta->createElement("respuesta");
$titulo = $respuesta->createElement("titulo");
$titulo->appendChild($respuesta->createTextNode($mensaje["titulo"]));
$raizRespuesta->appendChild($titulo);
$textoMensaje = $respuesta->createElement("mensaje");
$textoMensaje->appendChild($respuesta->createTextNode($mensaje["mensaje"]));
$raizRespuesta->appendChild($textoMensaje);
$respuesta->appendChild($raizRespuesta);
echo $respuesta->saveXML();

function responderError($mensaje, $codigo = 422) {
    http_response_code($codigo);
    $respuesta = new DOMDocument("1.0", "UTF-8");
    $raiz = $respuesta->createElement("error");
    $raiz->appendChild($respuesta->createElement("mensaje", $mensaje));
    $respuesta->appendChild($raiz);
    echo $respuesta->saveXML();
    exit;
}
