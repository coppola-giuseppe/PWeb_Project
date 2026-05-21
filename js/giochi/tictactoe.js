document.addEventListener("DOMContentLoaded", init);

function init(){

    let scelta = document.querySelectorAll(".sceltaPlayer");

    scelta.forEach(e => {
        e.addEventListener("click", start);
    });

    let reset = document.getElementById("reset");
    reset.addEventListener("click", resetGame);
}

//resetto le varie scelte e i vari div modificati
function resetGame(){
    vittoria = "";
    mosse_fatte = 0;
    player = [];
    cpu = [];
    mosse_disponibili = ["g1", "g2", "g3", "g4", "g5", "g6", "g7", "g8", "g9"];
    div = document.getElementById("esito");
    div.textContent = "";
    div.hidden = false;
    esito = "";

    let scelta = document.getElementById("scelta");
    scelta.hidden = false;

    let griglia = document.getElementById("griglia");
    griglia.hidden = true;

    let caselle = document.querySelectorAll(".grid");
    caselle.forEach((e) => {
        e.textContent = "";
        e.style.color = "black";
    });
}

//mostra la griglia di gioco
function start(e){

    turno = e.currentTarget.id;
    
    let scelta = document.getElementById("scelta");
    scelta.hidden = true;

    let griglia = document.getElementById("griglia");
    griglia.hidden = false;

    let player = document.querySelector("#msg p");

    let strong = document.createElement("strong");
    strong.textContent = e.currentTarget.id;
    strong.style.color = "green";
    player.textContent = "Sei il giocatore ";
    player.append(strong);
    play();
}

//funzione che gestisce gli stati del gioco
function play(){
    let caselle = document.querySelectorAll(".grid");

    caselle.forEach((e)=>{
        e.addEventListener("click", check);
    });
}

function stop(){
    let caselle = document.querySelectorAll(".grid");

    caselle.forEach((e)=>{
        e.removeEventListener("click", check);
    });
}


let vittoria = "";
let turno;
let mosse_fatte = 0;
let player = [];
let cpu = [];
let mosse_disponibili = ["g1", "g2", "g3", "g4", "g5", "g6", "g7", "g8", "g9"];
const seq_vittoria = [
    ["g1", "g2", "g3"],
    ["g4", "g5", "g6"],
    ["g7", "g8", "g9"],
    ["g1", "g4", "g7"],
    ["g2", "g5", "g8"],
    ["g3", "g6", "g9"],
    ["g1", "g5", "g9"],
    ["g3", "g5", "g7"]
];

let esito = false;

//funzione che controlla se la mossa del giocatore è valida, controlla se ha vinto e in caso negativo passa la mossa alla CPU
function check(e){
    let giocata = e.currentTarget.id;
    
    if(document.getElementById(giocata).textContent == ""){
        document.getElementById(giocata).textContent = turno;
        player.push(giocata);
        player.sort();
        mosse_disponibili.splice(mosse_disponibili.indexOf(giocata), 1);
        mosse_fatte++;

        if(checkVittoriaPlayer() == true){
            vittoria = turno;
            esito = "vittoria";
            stampaEsito();
            updateGames();
            stop();
        }
        else{
            if(mosse_fatte == 9){
                esito = "pareggio";
                stampaEsito();
                updateGames();
                stop();
            }
            else
                mossaCPU();
        } 
    }
}

//funzione che alterna i turni
function cambioTurno(){
    if(turno == "X")
        turno = "O";
    else
        turno = "X";
}

//funzione che fa fare una mossa a caso tra le disponibili e controlla se la CPU ha vinto
function mossaCPU(){
    let scelta = Math.floor(Math.random() * mosse_disponibili.length);
    let mossa = mosse_disponibili[scelta];

    cambioTurno();

    if(document.getElementById(mossa).textContent == ""){
        document.getElementById(mossa).textContent = turno;
        cpu.push(mossa);
        cpu.sort();
        mosse_disponibili.splice(mosse_disponibili.indexOf(mossa), 1);
        mosse_fatte++;

        if(checkVittoriaCPU() == true){
            vittoria = turno;
            esito = "sconfitta";
            stampaEsito();
            updateGames();
            stop();
        }
        else
            cambioTurno();
    }
}

// controlla se il giocatore ha vinto, ovvero ha una sequenza tra quelle vincenti in seq_vittoria
function checkVittoriaPlayer(){
    for(let i = 0; i < 8; ++i){
        if(
            player.includes(seq_vittoria[i][0]) &&
            player.includes(seq_vittoria[i][1]) &&
            player.includes(seq_vittoria[i][2]) 
        )  {
            document.getElementById(seq_vittoria[i][0]).style.color = "green";
            document.getElementById(seq_vittoria[i][1]).style.color = "green";
            document.getElementById(seq_vittoria[i][2]).style.color = "green";
            return true;
        }
    }
    return false;
}

// controlla se la CPU ha vinto, ovvero ha una sequenza tra quelle vincenti in seq_vittoria
function checkVittoriaCPU(){
    for(let i = 0; i < 8; ++i){
        if(
            cpu.includes(seq_vittoria[i][0]) &&
            cpu.includes(seq_vittoria[i][1]) &&
            cpu.includes(seq_vittoria[i][2]) 
        )  {
            document.getElementById(seq_vittoria[i][0]).style.color = "red";
            document.getElementById(seq_vittoria[i][1]).style.color = "red";
            document.getElementById(seq_vittoria[i][2]).style.color = "red";
            return true;
        }
    }
    return false;
}

//stampo l'esito della partita a schermo
function stampaEsito(){
    let div = document.getElementById("esito");
    div.hidden = false;

    switch (esito) {
        case "vittoria":
                div.textContent = "HAI VINTO!";
                div.style.color = "green";
        break;

        case "sconfitta":
            div.textContent = "HAI PERSO!";
            div.style.color = "red";
        break;

        case "pareggio":
            div.textContent = "PAREGGIO!";
            div.style.color = "blue";
        break;
    }
}


async function updateGames(){
    const username = document.querySelector("#user strong").textContent;
    let form = new FormData();
    form.append("utente", username);
    form.append("gioco", "Tic Tac Toe");
    form.append("result", esito);

    let params={
        "method": "POST",
        "body": form
    };

    let update = await fetch("../../php/requests/games.php", params);
}