document.addEventListener("DOMContentLoaded", init);

function init(){
    let startButton = document.getElementById("startButton");
    startButton.addEventListener("click", scegli);

    let sasso = document.getElementById("sasso");
    let carta = document.getElementById("carta");
    let forbici = document.getElementById("forbici");
    sasso.addEventListener("click", play);
    carta.addEventListener("click", play);
    forbici.addEventListener("click", play);

    let resetButton = document.getElementById("reset");
    resetButton.addEventListener("click", reset);
}

//al reset mostro la scelta della giocata e resetto i vari div cambiati a fine partita
function reset(){
    document.getElementById("scegli").style.display = "grid";
    document.getElementById("gioca").style.display = "none";
    document.getElementById("countdown").textContent = "";
    document.getElementById("esito").textContent = "";
    document.getElementById("esito").style.padding = "0px";
    document.getElementById("reset").hidden = true;
    document.getElementById("img").src = "../../img/giochi/sasso carta forbici/sasso.png";
    document.getElementById("imgCPU").src = "../../img/giochi/sasso carta forbici/sassoCPU.png";
}

//passo alla scelta della giocata
function scegli(){
    document.getElementById("start").style.display = "none";
    document.getElementById("scegli").style.display = "grid";
}

//funzione principale del gioco
let esito;
function play(e){
    let giocata = e.currentTarget.id;
    document.getElementById("scegli").style.display = "none";
    let table = document.getElementById("gioca").style.display = "grid";

    let imgs = document.querySelectorAll("#gioca img");
    imgs.forEach(e => {
        e.classList.add("animazioneScelta");
    });

    let scelte = ["sasso", "carta", "forbici"];
    let giocataCPU = scelte[Math.floor(Math.random() * scelte.length)];

    //controllo l'esito in base alle giocate
    switch (giocata) {
        case "sasso":
            if(giocataCPU === "forbici")
                esito = "vittoria";
            else{
                if(giocataCPU === "sasso")
                    esito = "pareggio";
                else
                    esito = "sconfitta";
            }
            break;

        case "carta":
            if(giocataCPU === "sasso")
                esito = "vittoria";
            else{
                if(giocataCPU === "carta")
                    esito = "pareggio";
                else
                    esito = "sconfitta";
            }
            break;
            
        case "forbici":
            if(giocataCPU === "carta")
                esito = "vittoria";
            else{
                if(giocataCPU === "forbici")
                    esito = "pareggio";
                else
                    esito = "sconfitta";
            }
            break;
    
        default:
            esito = "sconfitta";
            break;
    }
    updateGames();

    //vari timer per creare dinamicita

    let countdown = document.getElementById("countdown");
    countdown.textContent = "...";
    setTimeout(() => {
        countdown.textContent = "SASSO...";
    }, 500);

    setTimeout(() => {
        countdown.textContent = countdown.textContent + "CARTA...";
    }, 2250);

    setTimeout(() => {
        countdown.textContent = countdown.textContent + "FORBICI!";
    }, 3250);

    setTimeout(() => {
        //fermo l'animazione e aggiorno i path delle immagini con le giocate
        imgs.forEach(e => {
            e.classList.remove("animazioneScelta");
        });

        let path = "../../img/giochi/sasso carta forbici/" + giocata + ".png";
        document.getElementById("img").src = path;

        let pathCPU = "../../img/giochi/sasso carta forbici/" + giocataCPU + "CPU.png";
        document.getElementById("imgCPU").src = pathCPU;

        //mostro a schermo l'esito
        let divEsito = document.getElementById("esito");
        divEsito.style.padding = "10px";
        if(esito == "vittoria"){
            divEsito.textContent = "HAI VINTO!";
            divEsito.style.color = "green";
        }
        else{
            if(esito == "pareggio"){
                divEsito.textContent = "PAREGGIO!";
                divEsito.style.color = "blue";
            }
            else{
                divEsito.textContent = "HAI PERSO!";
                divEsito.style.color = "red";
            }
        }
        document.getElementById("reset").hidden = false;
    }, 3500);
}


async function updateGames(){
    const username = document.querySelector("#user strong").textContent;
    let form = new FormData();
    form.append("utente", username);
    form.append("gioco", "Sasso Carta Forbici");
    form.append("result", esito);

    let params={
        "method": "POST",
        "body": form
    };

    let fetch1 = await fetch("../../php/requests/games.php", params);
}