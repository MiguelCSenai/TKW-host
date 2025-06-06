let nickname = "";
let classe = "";
let reino = "";

let classes = [];
let currentIndex = 0;

const display = document.getElementById("classe-display");
const hiddenInput = document.getElementById("classe");

function updateClasse() {
    if (classes.length === 0) return;
    const current = classes[currentIndex];
    display.textContent = current.nome;
    hiddenInput.value = current.nome;
}

document.getElementById("form-nome").querySelector("form").addEventListener("submit", function(e) {
    e.preventDefault();
    document.getElementById("form-nome").classList.add("hidden");
    document.getElementById("form-classe").classList.remove("hidden");
    nickname = document.getElementById("nickname").value;
});

document.getElementById("form-classe").querySelector("form").addEventListener("submit", function(e) {
    e.preventDefault();
    document.getElementById("form-classe").classList.add("hidden");
    document.getElementById("form-time").classList.remove("hidden");
    classe = document.getElementById("classe").value;
});

function salvar(v) {
    document.getElementById("form-time").classList.add("hidden");
    document.getElementById("form-enviar").classList.remove("hidden");
    reino = v;

    document.getElementById("nickP").value = nickname;
    document.getElementById("classeP").value = classe;
    document.getElementById("reinoP").value = reino;
}

document.getElementById("prev-btn").addEventListener("click", () => {
    if (classes.length === 0) return;
    currentIndex = (currentIndex - 1 + classes.length) % classes.length;
    updateClasse();
});

document.getElementById("next-btn").addEventListener("click", () => {
    if (classes.length === 0) return;
    currentIndex = (currentIndex + 1) % classes.length;
    updateClasse();
});

// Carregar classes do PHP
fetch("../../php/Game/preencherClasses.php")
    .then(response => response.json())
    .then(data => {
        classes = data;
        updateClasse();
    })
    .catch(error => {
        console.error("Erro ao carregar classes:", error);
    });
