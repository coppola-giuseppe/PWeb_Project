document.addEventListener("DOMContentLoaded", init);

function init(){
    let submit = document.getElementById("submit");
    let risposta_da_dare;
    let fase = 0; // variabile che impedisce di inviare dati modificando l'html della pagina
    submit.addEventListener("click", async (e)=>{
        e.preventDefault();
        if(fase == 0){
            let formRaw = document.getElementById("user_mail");
            
            let form = new FormData(formRaw);
            form.append("action", "checkCredentials");
            let params={
                "method" : "POST",
                "body" : form
            };
            
            let checkInput = await fetch("../php/requests/recover_verify.php", params);
            let verify = await checkInput.text();
            let esito = JSON.parse(verify);
            let checkDiv = document.getElementById("check_answer");
            let domanda = document.getElementById("domanda");
            let EsitoInvio = document.getElementById("EsitoInvio1");
            if(esito["ok"]){
                fase = 1;
                checkDiv.hidden = false;
                domanda.textContent = esito["domanda"];
                submit.hidden = true;
                EsitoInvio.hidden = true;
            }
            else{
                if(esito["errorCode"] == 2002)
                EsitoInvio.textContent = "Connessione al database non riuscita, riprova più tardi.";
                else
                    EsitoInvio.textContent = esito["errorMsg"];
                checkDiv.hidden = true;
                submit.hidden = false;
                EsitoInvio.hidden = false;
                console.log(esito["errorMsg"] + ":" + esito["errorCode"]);
            }
        }

    });

    let verifica = document.getElementById("verify");
    verifica.addEventListener("click", async (e)=>{
        e.preventDefault();
        if(fase == 1){
            let formRaw = document.getElementById("answer");
            let form = new FormData(formRaw);
            form.set("action", "verifyAnswer");
            let params={
                "method" : "POST",
                "body" : form
            };
            let checkAnswer = await fetch("../php/requests/recover_verify.php", params);
            let verify = await checkAnswer.text();
            let esito = JSON.parse(verify);
            let checkDiv = document.getElementById("check_answer");
            let EsitoInvio = document.getElementById("EsitoInvio2");
            if(esito["ok"]){
                fase = 2;
                verifica.hidden = true;
                checkDiv.hidden = true;
                EsitoInvio.hidden = true;
                document.getElementById("updatePass").hidden = false;
            }
            else{
                if(esito["errorCode"] == 2002)
                    EsitoInvio.textContent = "Connessione al database non riuscita, riprova più tardi.";
                else
                    EsitoInvio.textContent = esito["errorMsg"];
                EsitoInvio.hidden = false;
                checkDiv.hidden = false;
                document.getElementById("updatePass").hidden = true;
                console.log(esito["errorMsg"] + ":" + esito["errorCode"]);
            }
        }
    });

    let update = document.getElementById("updateBtn");
    update.addEventListener("click", async (e)=>{
        e.preventDefault();
        if(fase == 2){
            let formRaw = document.getElementById("update");
            let form = new FormData(formRaw);
            form.set("action", "updatePass");
            let params={
                "method" : "POST",
                "body" : form
            };
            let updatePass = await fetch("../php/requests/recover_verify.php", params);
            let verify = await updatePass.text();
            let esito = JSON.parse(verify);
            let EsitoInvio = document.getElementById("EsitoInvio3");

            if(esito["ok"]){
                EsitoInvio.hidden = false;
                console.log("Password aggiornata con successo! Attenti mentre verrai reindirizzato alla pagina principale.");
                
                EsitoInvio.textContent = "Password aggiornata con successo! \r\n";
                EsitoInvio.textContent += "Attenti mentre verrai reindirizzato alla pagina principale.";
                EsitoInvio.style.fontSize = "large";
                update.hidden = true;
                fase = 0;
                EsitoInvio.style.color = "green";
                setTimeout(() => {
                    window.location.replace("../index.php");
                }, 5000);
            }
            else{
                if(esito["errorCode"] == 2002)
                    EsitoInvio.textContent = "Connessione al database non riuscita, riprova più tardi.";
                else
                    if(esito["errorCode"] == 10){
                        EsitoInvio.textContent = "";
                        let passChecks = ["Avere almeno 8 caratteri", "Avere almeno una lettera maiuscola", 
                        "vere almeno una lettera minuscola", "Avere almeno un numero", 
                        `Avere almeno un carattere speciale tra`,  `!"#$%&'()*+,-./:;<=>?@[\]^_}{|~ `, 
                        "Non contenere spazi"];
                        let h4 = document.createElement("h4");
                        h4.textContent = "La password rispettare queste condizioni:";
                        EsitoInvio.append(h4);
                        let ul = document.createElement("ul");
                        for(let i = 0; i < 7; ++i){
                            let li = document.createElement("li");
                            li.textContent = passChecks[i];
                            if(i == 5)
                                li.style.listStyle = "none";
                            ul.append(li);
                        }
                        EsitoInvio.append(ul);
                    }
                    else{
                        EsitoInvio.textContent = esito["errorMsg"];
                    }
                    
                EsitoInvio.hidden = false;
                console.log(esito["errorMsg"] + ":" + esito["errorCode"]);

            }

        }
    });


    //pulsante per mostrare la password
    let showPass = document.getElementById("showPass");
    showPass.addEventListener("click", (evt) =>{

        let pass = document.querySelectorAll("#form_update .pass");

        pass.forEach(e => {
            if(e.getAttribute("type") == "password"){
                e.setAttribute("type", "text");
                evt.currentTarget.src = "../img/eye_slash.png";
                evt.currentTarget.title = "Nascondi password";
            }
            else{
                e.setAttribute("type", "password");
                evt.currentTarget.src = "../img/eye.png";
                evt.currentTarget.title = "Mostra password";
            }
        });

    });
}

