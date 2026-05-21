document.addEventListener("DOMContentLoaded", init);

//pulsante per mostrare la password
function togglePass(e){ 
    let passInput = document.getElementById("password");
    if(passInput.getAttribute("type") == "password"){
        passInput.setAttribute("type", "text");
        e.currentTarget.src = "./img/eye_slash.png";
        e.currentTarget.title = "Nascondi password";
    }
    else{
        passInput.setAttribute("type", "password");
        e.currentTarget.src = "./img/eye.png";
        e.currentTarget.title = "Mostra password";
    }
}

function init(){
    let btn = document.getElementById("submit");
    let testo = document.getElementById("test");

    let showPass = document.getElementById("showPass");
    showPass.addEventListener("click",togglePass);

    //request per il login
    btn.addEventListener("click", async (e) =>{  
        e.preventDefault();

        let formRAW = document.querySelector("form");
        let form = new FormData(formRAW);
        let params = {
            "method": "POST",
            "body": form,
        };
        console.log((formRAW));
        const php = "./php/requests/login.php";
        let login = await fetch(php, params);
        let login_json = await login.text();
        let esito = JSON.parse(login_json);
        if(esito["accesso"]){
            window.open("./php/homepage.php", "_self");
        }
        else{
            let errore = document.getElementById("esito");
            errore.hidden = false;
            if(esito[errore] === 0)
                errore.textContent = "Controlla di aver inserito tutti i dati.";
            else
                errore.textContent = "Credenziali errate";
        }
    });
}
