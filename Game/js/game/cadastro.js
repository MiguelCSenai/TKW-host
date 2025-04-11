document.getElementById('form-nome').querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    document.getElementById('form-nome').classList.add('hidden');
    document.getElementById('form-classe').classList.remove('hidden');
});

document.getElementById('form-classe').querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    document.getElementById('form-classe').classList.add('hidden');
    document.getElementById('form-time').classList.remove('hidden');
});

const classes = [
    { nome: "Armadilheiro", imagem: "../../resources/img/armadilheiro.png" },
    { nome: "Guerreiro", imagem: "../../resources/img/guerreiro.png" }
];

let currentIndex = 0;

const display = document.getElementById("classe-display");
const img = document.getElementById("classe-img");
const hiddenInput = document.getElementById("classe");

function updateClasse() {
    const current = classes[currentIndex];
    display.textContent = current.nome;
    img.src = current.imagem;
    hiddenInput.value = current.nome;
}

document.getElementById("prev-btn").addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + classes.length) % classes.length;
    updateClasse();
});

document.getElementById("next-btn").addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % classes.length;
    updateClasse();
});

updateClasse();