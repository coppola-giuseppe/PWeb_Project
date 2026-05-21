document.addEventListener("DOMContentLoaded", init);

function init(){
    let showPass = document.getElementById("showPass");
    showPass.addEventListener("click",togglePass);

    let btn = document.getElementById("submit");
    btn.addEventListener("click", async (e)=>{
        e.preventDefault();
        let badPass = document.getElementById("passVerify");
                badPass.hidden = true;
        let formRaw = document.querySelector("form");
        let form = new FormData(formRaw);
        let params={
            "method": "POST",
            "body": form
        };
        //invio la richiesta di registrazione al server
        let fetch1 = await fetch("../php/requests/register.php", params);
        let fetch2 = await fetch1.text();
        let esito = JSON.parse(fetch2);
        let p = document.getElementById("esito");
        if(esito["ok"]){

            let btn = document.getElementById("submit");
            btn.hidden = true;

            p.style.color = "green";
            p.textContent ="Registrazione avvenuta con successo! \r\n";
            p.textContent += "Attenti mentre verrai reindirizzato alla pagina principale.";
            setTimeout(() => {
                window.location.replace("../index.php");
            }, 5000);
        }
        else{
            switch (esito["error"]) {
                case 2002:
                    p.textContent = "Connessione al Database non riuscita.";
                    break;
                case 1:
                    p.textContent = "";
                    let badPass = document.getElementById("passVerify");
                    badPass.hidden = false;
                    break;
                default:
                   p.textContent = esito["msg"];
            }
        }
    });
}

//pulsante per mostrare la password
function togglePass(evt){ 
    let passInput = document.querySelectorAll(".password");
    passInput.forEach(e => {
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
}