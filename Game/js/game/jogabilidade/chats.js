
let dialogos = [];
let index = 0;

fetch(`../../../resources/chats/${nomeDoDialogo}.json`)
    .then(response => response.json())
    .then(data => {
        dialogos = data;
        mostrarFala();
    });


function mostrarFala() {
    if (index >= dialogos.length) {
        console.log("Fim do diálogo");
        document.querySelector('.transition').style.opacity = 1;
        return;
    }

    const personagem = dialogos[index];
    document.querySelector('.container-personagem img').src = personagem.img;
    document.querySelector('.container-personagem h1').innerText = personagem.nome;
    document.querySelector('.text-box p').innerText = personagem.fala;
}

setTimeout(() => {
    document.querySelector('.transition').style.opacity = 0;
}, 2000);

document.body.addEventListener('click', () => {
    index++;
    mostrarFala();
});

document.addEventListener('keydown', (e) => {
    if (e.code === 'Space') {
        e.preventDefault();
        index++;
        mostrarFala();
    }
});