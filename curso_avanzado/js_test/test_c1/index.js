console.log("Hola mundo!")

const base = 10

let variable = 1
variable = 2

console.log(variable + base)

const persona = {
    nombre : "Marcelo",
    edad : 42,
    ocupacion : "plomero"
}

console.log(persona.nombre + "  " + persona.edad)

persona.edad = 52

console.log(persona.nombre + "  " + persona.edad)

const frutas = ["banana", "manzana", "pera", "uva"]

for(i in frutas){
    console.log(frutas[i])
}