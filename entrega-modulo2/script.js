"use strict"

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#contactForm")
    const dialog = document.querySelector("#dialog")
    const result = document.querySelector("#result")

    form.addEventListener("submit", (event) =>{
        event.preventDefault();

        dialog.showModal();

        saveFormData("save.php", {
            method: "POST",
            body: new FormData(form)
        });
    });

    const saveFormData = (url, options = {}) => {
        result.textContent = "Enviando...";

        fetch(url, options)
            .then(async (response) => {
                const data = await response.json(); 
                
                if (!response.ok) {
                    throw new Error(data.error || `Error ${response.status}`);
                }
                
                return data;
            })
            .then((data) => {
                result.textContent = data.msg;
                form.reset();
            })
            .catch((error) => {
                result.textContent = error.message;
            });
    }
});