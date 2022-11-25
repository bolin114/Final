const lengthSlider = document.querySelector(".pass-length input"),
options = document.querySelectorAll(".option input"),
copyIcon = document.querySelector(".input-box span"),
passwordInput = document.querySelector(".input-box input"),
passIndicator = document.querySelector(".pass-indicator"),
generateBtn = document.querySelector(".generate-btn");

const characters = { // objeto de letras, números y símbolos
    lowercase: "abcdefghijklmnopqrstuvwxyz",
    uppercase: "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
    numbers: "0123456789",
    symbols: "^!$%&|[](){}:;.,*+-#@<>~"
}

const generatePassword = () => {
    let staticPassword = "",
    randomPassword = "",
    excludeDuplicate = false,
    passLength = lengthSlider.value;

    options.forEach(option => { // recorriendo la casilla de verificación de cada opción
        if(option.checked) { // si la casilla de verificación está marcada
            // si la identificación de la casilla de verificación no es exduplicar y espacios
            if(option.id !== "exc-duplicate" && option.id !== "spaces") {
                // agregando un valor clave particular del objeto de carácter a staticPassword
                staticPassword += characters[option.id];
            } else if(option.id === "spaces") { // si la identificación de la casilla de verificación es espacios
                staticPassword += `  ${staticPassword}  `; // agregando espacio al principio y al final de staticPassword
            } else { // de lo contrario, pase el valor verdadero a excluir Duplicar
                excludeDuplicate = true;
            }
        }
    });

    for (let i = 0; i < passLength; i++) {
        // getting random character from the static password
        let randomChar = staticPassword[Math.floor(Math.random() * staticPassword.length)];
        if(excludeDuplicate) { // Si excludeDuplicate es verdadero.
            // si randomPassword no contiene el carácter aleatorio actual o randomChar es igual
            // al espacio " " luego agregue un carácter aleatorio a randomPassword; de lo contrario, disminuya i en -1
            !randomPassword.includes(randomChar) || randomChar == " " ? randomPassword += randomChar : i--;
        } else { // de lo contrario, agregue un carácter aleatorio a randomPassword
            randomPassword += randomChar;
        }
    }
    passwordInput.value = randomPassword; // pasando contraseña aleatoria a valor de entrada de contraseña
}

const upadatePassIndicator = () => {
    // si el valor de lengthSlider es inferior a 8, pase "débil" como ID de passIndicator; de lo contrario, si lengthSlider
    // el valor es menor que 16, luego pase "medio" como id, de lo contrario pase "fuerte" como id
    passIndicator.id = lengthSlider.value <= 8 ? "weak" : lengthSlider.value <= 16 ? "medium" : "strong";
}

const updateSlider = () => {
    // pasar el valor del control deslizante como texto de contador
    document.querySelector(".pass-length span").innerText = lengthSlider.value;
    generatePassword();
    upadatePassIndicator();
}
updateSlider();

const copyPassword = () => {
    navigator.clipboard.writeText(passwordInput.value); // copia de contraseña aleatoria
    copyIcon.innerText = "check"; // cambiar el icono de copia para marcar
    copyIcon.style.color = "#4285F4";
    setTimeout(() => { // después de 1500 ms, cambiando el icono de marca de nuevo a copiar
        copyIcon.innerText = "copy_all";
        copyIcon.style.color = "#707070";
    }, 1500);
}

copyIcon.addEventListener("click", copyPassword);
lengthSlider.addEventListener("input", updateSlider);
generateBtn.addEventListener("click", generatePassword);