function ativarTransicao() {
    document.getElementById("overlay").classList.add("active");
    document.getElementById("overlayBackground").classList.add("activeBackground");

    // Deixe a alteração de pointerEvents para depois da transição de opacidade
    setTimeout(() => {
        document.getElementById("overlayBackground").style.pointerEvents = "all";

        clicado = false
        
        if (!clicado) {

            clicado = true;

            document.getElementById("overlay").addEventListener("click", function() {
            
                document.getElementById("overlay").classList.add("fadeOut");
                setTimeout(() => {
                    
                    window.location.href = "https://thekingswill.up.railway.app/Wiki/php/Lore/lore.php";
            
                }, 680);
    
    
            });
            
        }
        

    }, 2000);
}

document.getElementById("overlayBackground").addEventListener("click", function() {
    
    document.getElementById("overlay").classList.remove("active");
    document.getElementById("overlayBackground").classList.remove("activeBackground");

    document.getElementById("overlayBackground").style.pointerEvents = "none";
});


function details(id) {
    let arma = document.querySelector(`.arma[onclick='details(${id})']`);
    let descricao = arma.querySelector('.descricao');
    let dano = arma.querySelector('.dano');
    let velocidade = arma.querySelector('.velocidade');
    let alcance = arma.querySelector('.alcance');
    let overlay = document.getElementById("backgroundOverlay");

    if (arma.classList.contains("expandido")) {
        arma.classList.remove("expandido");
        overlay.classList.remove("ativo");
            descricao.classList.remove("ativa");
            dano.style.display = "none";
            velocidade.style.display = "none";
            alcance.style.display = "none";
    } else {
        document.querySelectorAll(".arma.expandido").forEach(item => {
            item.classList.remove("expandido");
            item.querySelector(".descricao").classList.remove("ativa");
        });

        arma.classList.add("expandido");
        descricao.classList.add("ativa");
        dano.style.display = "block";
        velocidade.style.display = "block";
        alcance.style.display = "block";
        overlay.classList.add("ativo");
    }
}

function detailsMonster(id) {
    let monstro = document.querySelector(`.arma[data-id='${id}']`);
    if (!monstro) return;

    let descricao = monstro.querySelector('.descricao');
    let vida = monstro.querySelector('.dano');
    let ataque = monstro.querySelector('.velocidade');
    let agilidade = monstro.querySelector('.alcance');
    let overlay = document.getElementById("backgroundOverlay");

    if (monstro.classList.contains("expandido")) {
        monstro.classList.remove("expandido");
        overlay.classList.remove("ativo");
        vida.style.display = "none";
        ataque.style.display = "none";
        agilidade.style.display = "none";
    } else {
        document.querySelectorAll(".arma.expandido").forEach(item => {
            item.classList.remove("expandido");
            item.querySelector(".dano").style.display = "none";
            item.querySelector(".velocidade").style.display = "none";
            item.querySelector(".alcance").style.display = "none";
        });

        monstro.classList.add("expandido");
        descricao.classList.add("ativa");
        vida.style.display = "block";
        ataque.style.display = "block";
        agilidade.style.display = "block";
        overlay.classList.add("ativo");
    }
}
