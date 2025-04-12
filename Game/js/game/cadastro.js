document.getElementById('form-nome').querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    document.getElementById('form-nome').classList.add('hidden');
    document.getElementById('form-classe').classList.remove('hidden');
    nickname = document.getElementById('nickname').value;
});

document.getElementById('form-classe').querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    document.getElementById('form-classe').classList.add('hidden');
    document.getElementById('form-time').classList.remove('hidden');
    classe = document.getElementById('classe').value;

});

function salvar(v){

    document.getElementById('form-time').classList.add('hidden');
    document.getElementById('form-enviar').classList.remove('hidden');
    reino = v;

    document.getElementById('nickP').value = nickname;
    document.getElementById('classeP').value = classe;
    document.getElementById('reinoP').value = reino;

}

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