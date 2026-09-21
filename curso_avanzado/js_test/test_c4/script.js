"use strict";

document.addEventListener("DOMContentLoaded", () =>{

  const bttnLoad = document.querySelector("#bttnLoad");
  const bttnError = document.querySelector("#bttnError");
  const result = document.querySelector("#result");

  const make_request  = (url) => {
    result.textContent = "Cargando..."
    const req = new XMLHttpRequest()

    req.onreadystatechange = () => {
      if(req.readyState == 4){
        if(req.status == 200){
          result.textContent = req.responseText
        }
        else{
          result.textContent = `Error ${req.status}: ${req.statusText}`
        }
      }
    }

    req.open("GET", url, true)
    req.send(null)
  }

  bttnLoad.addEventListener("click", () => make_request("server.php"))
  bttnError.addEventListener("click", () => make_request("null.php"))
})