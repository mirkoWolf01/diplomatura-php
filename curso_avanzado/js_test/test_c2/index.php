<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dom</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Personalizar en vivo</h1>

    <div>
        <label for="textInput">Texto:</label>
        <input type="text" id="textInput" placeholder="Escribi aca">
    </div>


    <div>
        <label for="colorInput">Color de letra: </label>
        <input type="color" id="colorInput">
    </div>

    <div>
        <label for="fontSize">Tamaño de letra: </label>
        <input type="number" id="fontSize" min="10" max="80" value = "16">
    </div>

    <div>
        <label for="bgColorTexto">Color de fondo de los textos: </label>
        <input type="color" id="bgColorTexto">
    </div>

    <div>
        <label for="bgColorFondo">Color de fondo del fondo: </label>
        <input type="color" id="bgColorFondo">
    </div>

    <p id="resultado"></p>
    <button type="button" id="reiniciar">Reiniciar</button>

    <script src="index.js"></script>
</body>

</html>