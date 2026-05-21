document.addEventListener("DOMContentLoaded", init);

let errori = -1;
let newWord = true;
let gameStart = false;
let firstTime = true;
let letterePossibili = "";
let parolaAttuale = "";

function init(){
    let start = document.getElementById("start");
    let reset = document.querySelectorAll(".reset");
    


    // funzione che prepara il gioco e setta a true la variabile gameStart per segnalare l'inizio del gioco
    start.addEventListener("click", async (randomWord)=>{
        randomWord.preventDefault();
        if(newWord){
            
            //incremento la variabile 'errori' perché la uso come indice per la prossima immagine da mostrare
            errori++;
            let img = document.querySelector("#img img");
            let path = "../../img/giochi/impiccato/errore" + errori +".jpg";
            img.id="errore" + errori;
            img.src = path;
            newWord = false;
            document.getElementById("startButton").hidden = true;
            document.getElementById("stopButton").hidden = false;

            let params ={
                "method" : "POST",
            };

            //ottengo una parola a caso tra quelle nel database
            let wordRequest = await fetch("../../php/requests/random_word.php", params);
            let getWord = await wordRequest.text();
            let esito = JSON.parse(getWord);
            if(esito["ok"]){
                parola = esito["parola"];
                console.log(parola);
            }
            else{
                if(esito["errorCode"] == 2002)
                    console.log("Connessione col Database non risucita"); //Connessione col database fallita
                else
                    console.log(esito["errorMsg"]);
            }

            //creo lo spazio da gioco per la parola ottenuta
            let spazioParola = document.getElementById("parola");
            for(let i = 0; i < parola.length; ++i){
                parolaAttuale += "_";
                spazioParola.textContent += "__ ";
            }

            //gameStart = true => la pagina diventa sensibile all'input dell'utente per indovinare la parola
            gameStart = true;
        }
    });


    //funzione di gioco
    document.onkeyup = (e)=>{  
        //controllo che il tasto premuto sia parte delle lettere "italiane" e che il gioco sia iniziato
        if(gameStart && e.key.match(/\b(?![j,k,w,x,y,J,K,W,X,Y])[a-zA-z]\b/)){

            if(errori < 6){
                let keyPressed = e.key;

                if(keyPressed.match(/[A-Z]/)) // porta l'input in lowerCase
                    keyPressed = keyPressed.toLowerCase();
                if(!letterePossibili.includes(keyPressed)){ //controllo se la lettera è stata già inserita
                    document.getElementById("messaggio").hidden = true;
                    document.getElementById("messaggio").textContent = "";

                    //funzione che inizializza la stringa della parte di parola indovinata
                    if(firstTime) {
                        parolaAttuale = parolaAttuale.split("");
                        parola = parola.split("");
                        firstTime = false;
                    }
                    let spazioParola = document.getElementById("parola");

                    //ciclo che aggiorna la parte di parola attualmente indovinata
                    let check = false;
                    let indovinata = true;
                    for(let i = 0; i < parola.length; ++i){
                        if(parola[i] === keyPressed){
                            parolaAttuale[i] = parola[i];
                            check = true;
                        }
                        if(parola[i] != parolaAttuale[i])
                            indovinata = false;
                    }

                    //se "indovinata" rimane true allora la parola è stata indovinata-> mostro messaggio di vittoria
                    if(indovinata){
                        let msg = document.getElementById("messaggio");
                        msg.hidden = false;
                        msg.textContent = "HAI INDOVINATO!!!";
                        risultato = "vittoria";
                        updateGames();

                        document.getElementById("stopButton").hidden = true;
                        document.getElementById("playAgain").hidden = false;

                        let img = document.querySelector("#img img");
                        let path = "../../img/giochi/impiccato/victory.jpg";
                        img.src = path;
                        gameStart = false;
                    }
                    //controllo se la lettera c'è o meno
                    if(check)
                        document.getElementById(keyPressed).style.backgroundColor = "green";
                    else{
                        document.getElementById(keyPressed).style.backgroundColor = "crimson";
                        //se errori = 6 allora il gioco finisce
                        errori++;
                        if(errori == 6){
                            risultato = "sconfitta";
                            updateGames();

                            let word = "";
                            for(let i = 0; i < parola.length; ++i){
                                word += parola[i];
                            }
                            document.getElementById("messaggio").hidden = false;
                            let sconfitta = document.getElementById("messaggio");
                            let strong = document.createElement("strong");
                            strong.textContent = word;
                            strong.style.fontSize = "xx-large";

                            let p1 = document.createElement("p");
                            p1.textContent = "Hai perso :(";
                            p1.style.fontSize = "x-large";
                            p1.style.color = "red";
                            sconfitta.append(p1);

                            let p2 = document.createElement("p");
                            p2.textContent = "La parola era:    ";
                            p2.append(strong);
                            sconfitta.append(p2);

                            
                            document.getElementById("playAgain").hidden = false;
                            document.getElementById("stopButton").hidden = true;
                        }
                        next();
                    }

                    //salvo che la lettera è stata provata
                    letterePossibili += keyPressed;
                    
                    //ciclo che aggiorna a video la parola
                    spazioParola.textContent = "";
                    for(let i = 0; i < parola.length; ++i){
                        if(parolaAttuale[i] == "_"){
                            spazioParola.textContent += "__ ";
                        }
                        else{
                            spazioParola.textContent += parolaAttuale[i] + "  ";
                        }
                    }
                }
                else{ //mostro messaggio che la lettera è stata già inserita
                    document.getElementById("messaggio").hidden = false;
                    document.getElementById("messaggio").textContent = "Lettera già inserita.";
                }   
            }
        }
    };
    
    reset.forEach((e)=>{
        e.addEventListener("click", reset=>{
            // condizioni al reset del gioco, azzero tutto e setto quali campi mostrare e quali no
            document.getElementById("startButton").hidden = false;
            document.getElementById("stopButton").hidden = true;
            document.getElementById("playAgain").hidden = true;
            document.getElementById("messaggio").hidden = true;
            newWord = true;
            gameStart = false;
            firstTime = true;
            parola = "";
            risultato = "";
            letterePossibili = "";
            parolaAttuale = "";
            let spazioParola = document.getElementById("parola");
            spazioParola.textContent = "";
            let btn = document.getElementById("start");
            btn.disabled = false;
            let img = document.querySelector("#img img");
            errori = -1;
            img.setAttribute("src","../../img/giochi/impiccato/start.jpg");
    
            //resetto i colori delle lettere usate in precedenza
            let lettere = document.querySelectorAll("#alfabeto td");
            lettere.forEach((e)=>{
                e.style.backgroundColor = "cyan";
            });
    
        });
    });
}

//funzione che sostituisce l'immagine del gioco per gli errori
function next(){
        let btn = document.getElementById("start");
        if(errori < 7){
            let img = document.querySelector("#img img");
            let path = "../../img/giochi/impiccato/errore" + errori +".jpg";
            img.id="errore" + errori;
            img.src = path;
        }
        else{
            gameStart = false;
        }
}

let risultato = "";

async function updateGames(){
    const username = document.querySelector("#utente strong").textContent;
    let form = new FormData();
    form.append("utente", username);
    form.append("gioco", "Impiccato");
    form.append("result", risultato);

    let params={
        "method": "POST",
        "body": form
    };

    let update = await fetch("../../php/requests/games.php", params);
}