# 📘 Javascript ES6 desde Cero — Guía para Alumnos

> Esta guía acompaña la Clase 3 (Javascript ES6). Está pensada para leerla **antes o después** de la clase, con calma, explicando cada concepto desde cero. Si en clase vas rápido con algo, volvé acá.

---

## 0. ¿Por qué esto importa?

Todo lo que aprendiste hasta ahora (variables, funciones, arrays, `if`, el DOM) sigue siendo exactamente igual. Lo único que cambia hoy es **la forma de escribirlo**: sintaxis más corta, más clara, y con menos lugares donde meter la pata. No es un lenguaje nuevo — es Javascript con herramientas nuevas.

---

## 1. ¿Qué es ES6?

**ECMAScript** es el nombre del estándar que define cómo tiene que funcionar Javascript. Cada tanto sale una versión nueva con funcionalidades agregadas. **ES6** (también llamado ES2015) es una de esas versiones — la que más cambió la forma de escribir Javascript desde que existe el lenguaje.

Todo lo que viene en esta guía es **Javascript de verdad**, no una librería aparte. Corre nativo en cualquier navegador moderno, sin instalar nada.

### ¿Y los transpiladores (Babel)?

Vas a escuchar hablar de **Babel**: es una herramienta que traduce código ES6 a una versión más vieja de Javascript (ES5), para que funcione incluso en navegadores muy antiguos que no entienden la sintaxis nueva. Se usa en proyectos grandes, con un proceso de "build" antes de subir el código a producción.

> 💡 Para esta clase **no hace falta instalar nada**: los navegadores actuales (Chrome, Firefox, Edge) entienden ES6 perfectamente. Babel se retoma con más detalle en una clase futura, junto con Node.js.

---

## 2. Template Strings — armar texto con variables

### El problema de siempre (ES5)

```js
var nombre = "Ana";
var edad = 25;
var texto = "Hola " + nombre + ", tenés " + edad + " años";
```

Concatenar con `+` funciona, pero es fácil perder una comilla o un espacio.

### La solución de ES6

```js
const nombre = "Ana";
const edad = 25;
const texto = `Hola ${nombre}, tenés ${edad} años`;
```

- Se usa el **backtick** (`` ` ``, la tecla que está arriba del `Tab`, a la izquierda del `1`), **no** comillas simples ni dobles.
- Adentro de `${...}` podés poner **cualquier expresión** de Javascript, no sólo el nombre de una variable:
  ```js
  const total = `El total es $${precio * cantidad}`;
  ```

> 🏆 De acá en adelante, para armar texto con datos adentro, usá siempre template strings.

---

## 3. `let` y `const` — reemplazan a `var`

### La diferencia que más importa: el *scope* (alcance)

`var` "vive" en toda la función donde se declaró, aunque esté adentro de un `if` o un `for`. Eso puede generar bugs difíciles de encontrar:

```js
for (var i = 0; i < 3; i++) {
  // ...
}
console.log(i); // 3 -> "se escapó" del for
```

`let` y `const` viven **sólo** dentro de las llaves `{}` donde fueron declaradas:

```js
for (let j = 0; j < 3; j++) {
  // ...
}
console.log(j); // ❌ Error: j no está definida acá afuera
```

### `let` vs `const`

```js
let contador = 0;
contador = 1; // ✅ se puede reasignar

const PI = 3.14;
PI = 4; // ❌ Error: Assignment to constant variable.
```

- **`const`** declara una variable que **no se va a reasignar**. Si intentás cambiarla, Javascript tira error.
- **`let`** declara una variable que **sí puede cambiar** de valor con el tiempo (un contador, un acumulador, algo que se reemplaza).

> ⚠️ **Ojo:** `const` no significa que el **contenido** sea inmutable. Un array o un objeto declarado con `const` puede seguir modificándose por dentro (`arr.push(x)` funciona); lo que no se puede es reasignar la variable entera (`arr = [otroArray]` sí daría error).

> 🏆 **Regla práctica:** usá `const` por defecto, siempre. Cambiá a `let` únicamente cuando **sepas** que vas a reasignar esa variable más adelante. `var` no se usa más en código nuevo.

---

## 4. Valores por defecto en funciones

Antes de ES6, si un parámetro no venía, había que revisarlo a mano:

```js
function saludar(nombre, saludo) {
  if (saludo === undefined) {
    saludo = "Hola";
  }
  return saludo + ", " + nombre + "!";
}
```

Con ES6, el valor por defecto se declara directamente en la firma de la función:

```js
function saludar(nombre, saludo = "Hola") {
  return `${saludo}, ${nombre}!`;
}

saludar("Ana");             // "Hola, Ana!"
saludar("Ana", "Buen día"); // "Buen día, Ana!"
```

> ⚠️ **El detalle que confunde a todos:** el valor por defecto **sólo** entra en acción cuando el argumento es `undefined` (es decir, cuando directamente no se pasó nada). Si le pasás un string vacío (`""`) o un `0`, esos SON el valor — no se reemplazan por el default:
> ```js
> saludar("Ana", "");  // ", Ana!"  <- "" se usó tal cual, no se activó "Hola"
> ```
> Esto importa mucho cuando el dato viene de un `input.value`, porque un campo vacío da `""`, no `undefined`.

---

## 5. Funciones Arrow (`=>`)

Es una forma más corta de escribir funciones.

```js
// ES5
function sumar(a, b) {
  return a + b;
}

// ES6, mismo resultado
const sumar2 = (a, b) => {
  return a + b;
};

// ES6, todavía más corto: sin llaves ni "return"
const sumar3 = (a, b) => a + b;
```

- Si el cuerpo de la función es **una sola expresión**, se puede escribir sin `{}` y sin `return` — el resultado de esa expresión se devuelve automáticamente ("return implícito").
- Si necesitás más de una línea, sí hacen falta las llaves `{}` y el `return` explícito.

### ¿Y el `this`?

En ES5, `this` dentro de una función común depende de **cómo se la llama**, lo cual genera confusión constante. Las arrow functions **no tienen su propio `this`** — usan el del lugar donde están escritas. Por ahora alcanza con saber que existe esta diferencia; se retoma en profundidad cuando se vean Clases.

> 🏆 Se usan mucho como funciones cortas "de un solo uso": adentro de `.map()`, `.filter()`, o como listener de un evento.

---

## 6. Destructuring — sacar datos de un objeto o array

"Destructuring" (desestructuración) es una forma de sacar valores de un objeto o array y ponerlos directamente en variables sueltas.

### Con objetos

```js
const contacto = { nombre: "Ana", telefono: "11-2222-3333" };

// Antes (ES5)
const nombre1 = contacto.nombre;
const telefono1 = contacto.telefono;

// Con destructuring (ES6)
const { nombre, telefono } = contacto;
```

- Los nombres de las variables (`nombre`, `telefono`) tienen que **coincidir exactamente** con los nombres de las propiedades del objeto.

### Con arrays

```js
const colores = ["rojo", "verde", "azul"];
const [primero, segundo] = colores;

console.log(primero); // "rojo"
console.log(segundo); // "verde"
```

- Acá no importa el nombre de la variable, importa la **posición**: la primera variable toma el elemento en el índice 0, la segunda el índice 1, y así.

---

## 7. Rest y Spread — el mismo símbolo (`...`), dos usos opuestos

Este es el punto donde más se confunden. La clave está en **dónde** aparecen los tres puntos.

### Rest — junta valores sueltos en un array (en un parámetro de función)

```js
function contarArgumentos(...valores) {
  return valores.length;
}

contarArgumentos(1, 2, 3, 4); // 4
```

Cuando `...` aparece en el **parámetro** de una función, le dice a Javascript: *"juntá todos los argumentos que reciba esta función en un array"*. Se usa cuando no sabés de antemano cuántos van a llegar.

### Spread — desarma un array o un objeto que ya existe

```js
const a = [1, 2, 3];
const b = [4, 5];
const c = [...a, ...b]; // [1, 2, 3, 4, 5]
```

Acá `...` aparece adentro de un array **ya existente** (`[...]`), y significa lo contrario: *"tomá cada elemento de este array y ponelo suelto acá"*. También funciona con objetos:

```js
const persona = { nombre: "Ana" };
const personaCompleta = { ...persona, edad: 25 }; // { nombre: "Ana", edad: 25 }
```

### Tabla resumen

| | Rest | Spread |
| :--- | :--- | :--- |
| ¿Dónde aparece? | en un parámetro de función | dentro de un array/objeto ya existente |
| ¿Qué hace? | JUNTA valores sueltos en un array | DESARMA un array/objeto en valores sueltos |
| Ejemplo | `function f(...args) {}` | `[...arr, nuevo]` |

> ⚠️ **Un uso muy común de Spread:** "actualizar" un array sin modificar el original — en vez de `arr.push(x)` (que cambia el array existente), se hace `const nuevoArr = [...arr, x]` (que crea uno nuevo). Para poder **reemplazar** la variable con ese array nuevo, tiene que estar declarada con `let`, no con `const`.

---

## 8. Todo junto: un mini ejemplo

Uniendo varios conceptos de esta guía:

```js
const contactos = [
  { nombre: "Ana", telefono: "11-2222-3333" },
  { nombre: "Luis", telefono: "11-4444-5555" },
];

const listarContactos = (lista) =>
  lista
    .map((contacto) => {
      const { nombre, telefono } = contacto; // destructuring
      return `${nombre}: ${telefono}`;        // template string
    })
    .join(", ");                              // arrow function con return implícito

console.log(listarContactos(contactos));
// "Ana: 11-2222-3333, Luis: 11-4444-5555"
```

Leyéndolo en voz alta: *"`listarContactos` es una función arrow que recibe una lista, la recorre con `.map`, saca `nombre` y `telefono` de cada contacto con destructuring, arma un texto con template strings, y junta todo con `.join`"*. Esa es, literalmente, la fórmula que vas a usar en el proyecto de la clase (`material-base-es6/`).

---

## 9. Lo que viene (todavía no, sólo para ubicarse)

La fuente teórica de esta unidad también incluye estos temas, que **no** se dictan en esta clase porque necesitan su propio tiempo:

| Tema | De qué se trata, en una frase |
| :--- | :--- |
| **Promesas** (`Promise`) | Manejar operaciones que tardan (como pedir datos a un servidor) sin bloquear el resto del programa. |
| **`async` / `await`** | Una forma más prolija de escribir código con Promesas, que se lee casi como código normal. |
| **Clases** | Una forma de organizar objetos y su comportamiento, parecida a otros lenguajes orientados a objetos. |
| **`import` / `export`** | Dividir el código en varios archivos y conectarlos entre sí, sin depender de tags `<script>` separados. |
| **Node.js y Babel** | El entorno para correr Javascript fuera del navegador, y la herramienta para traducir ES6 a versiones más viejas. |

No hace falta entenderlos todavía — se van a explicar con sus propios ejemplos en la próxima clase.

---

## 10. Glosario rápido

| Término | Qué es |
| :--- | :--- |
| **ECMAScript / ES6** | el estándar de Javascript / la versión 2015 de ese estándar |
| **transpilador (Babel)** | herramienta que traduce código nuevo a una versión más vieja del lenguaje |
| **template string** | texto entre backticks (`` ` ``) que permite insertar variables con `${...}` |
| **scope (alcance)** | el lugar donde una variable "existe" y se puede usar |
| **arrow function** | forma corta de escribir una función, con `=>` |
| **destructuring** | sacar valores de un objeto (por nombre) o un array (por posición) a variables sueltas |
| **rest** | `...` en un parámetro de función: junta argumentos sueltos en un array |
| **spread** | `...` sobre un array/objeto existente: lo desarma en valores sueltos |

---

## 11. Para practicar

1. Abrí `material-base-es6/pasos/index.html` y resolvé, en orden, los 5 pasos guiados (cada uno tiene su consigna escrita como comentario al principio del archivo).
2. Si algo no anda, `F12` → Console: ahí van a aparecer los errores reales del navegador.
3. Cuando termines, mirá `material-resuelto-es6/script.js` para comparar tu solución con la del profesor (está comentada línea por línea).
