document.addEventListener("DOMContentLoaded", function() {
    let body = document.querySelector("body")
    let textInput = document.querySelector("#textInput")
    let colorInput = document.querySelector("#colorInput")
    let fontSize = document.querySelector("#fontSize")
    let bgColorTexto = document.querySelector("#bgColorTexto")
    let bgColorFondo = document.querySelector("#bgColorFondo")
    let resultado = document.querySelector("#resultado")
    let reiniciar = document.querySelector("#reiniciar")

    textInput.addEventListener("input", function() {
        resultado.textContent = textInput.value
    })
    colorInput.addEventListener("input", function() {
        resultado.style.color = colorInput.value
    })
    fontSize.addEventListener("input", function(){
        resultado.style.fontSize = `${fontSize.value}px`
    })

    bgColorTexto.addEventListener("input", function(){
        resultado.style.backgroundColor = bgColorTexto.value
    })

    bgColorFondo.addEventListener("input", function(){
        body.style.backgroundColor = bgColorFondo.value
    })

    

    function restart(){
        textInput.value = "Asi se va a ver tu texto";
        colorInput.value = "#000000"
        fontSize.value = "16"
        bgColorTexto.value = "#ffffff"
        bgColorFondo.value = "#ffffff"


        resultado.textContent = ""
        resultado.style.color = ""
        resultado.style.fontSize = "16"
        resultado.style.backgroundColor = ""
        body.style.backgroundColor = ""
    }

    reiniciar.addEventListener("click", restart)
})