document.addEventListener("DOMContentLoaded", init);


function init(){
    dati();
    let changePass = document.getElementById("password");
    changePass.addEventListener("click", change);
    let confirmChange = document.getElementById("confirmChange");
    confirmChange.addEventListener("click", sendReq);

    let showpass1 = document.getElementById("showPass1");
    let showpass2 = document.getElementById("showPass2");

    showpass1.addEventListener("click", showPass);
    showpass2.addEventListener("click", showPass);
    
}

function showPass(evt){

    let input = evt.currentTarget.id;
    let passInput;
    switch (input) {
        case "showPass1":
                passInput = document.getElementById("oldPass");
                if(passInput.getAttribute("type") == "password"){
                    passInput.setAttribute("type", "text");
                    evt.currentTarget.src = "../img/eye_slash.png";
                    evt.currentTarget.title = "Nascondi password";
                }
                else{
                    passInput.setAttribute("type", "password");
                    evt.currentTarget.src = "../img/eye.png";
                    evt.currentTarget.title = "Mostra password";
                }

            break;
    
            case "showPass2":
                passInput = document.querySelectorAll(".confirm");
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
            break;
    }
}

//mostro il menù di cambio password
function change(){
    let dati = document.getElementById("dati");
    dati.style.display = "none";

    let updateForm = document.getElementById("passChange");
    updateForm.style.display = "grid";
}


//mando la richiesta e a seconda dell'esito mando un messaggio a video e coloro eventuali cambi in cui è presente l'errore
async function sendReq(e){
    e.preventDefault();

    let formRaw = document.getElementById("formPass");
    let form = new FormData(formRaw);

    let params = {
        method : "POST",
        body : form,
    };

    let fetch1 = await fetch("../php/requests/pass_change.php", params);
    let fetch2 = await fetch1.text();
    let esito = JSON.parse(fetch2);
    let divEsito = document.getElementById("esito");
    let btn = document.getElementById("confirmChange");
    if(esito["ok"]){
        btn.style.visibility = "hidden";
        btn.disabled = true;
        divEsito.textContent = "Password aggiornata con successo!";
        divEsito.style.color = "green";
        document.getElementById("oldPass").classList.remove("error");
        document.getElementById("newPass1").classList.remove("error");
        document.getElementById("newPass2").classList.remove("error");
        document.getElementById("passConditions").hidden = true;
        setTimeout(() => {
            location.reload();
        }, 3000);
    }
    else{
        switch (esito["error"]) {
            case 0: //Campi vuoti
                divEsito.textContent = esito["msg"];
                document.getElementById("oldPass").classList.add("error");
                document.getElementById("newPass1").classList.add("error");
                document.getElementById("newPass2").classList.add("error");
                document.getElementById("passConditions").hidden = true;
                divEsito.style.color = "red";
            break;

            case 1: //Vecchia password sbagliata
                divEsito.textContent = esito["msg"];
                document.getElementById("oldPass").classList.add("error");
                document.getElementById("newPass1").classList.remove("error");
                document.getElementById("newPass2").classList.remove("error");
                document.getElementById("passConditions").hidden = true;
                divEsito.style.color = "red";
                
            break;

            case 2: // Password nel formato sbagliato
                document.getElementById("passConditions").hidden = false;
                divEsito.textContent = "";
                document.getElementById("oldPass").classList.remove("error");
                document.getElementById("newPass1").classList.add("error");
                document.getElementById("newPass2").classList.add("error");
                divEsito.style.color = "red";
            
            break;

            case 3: //Password non corrispondono
                divEsito.textContent = esito["msg"];
                document.getElementById("oldPass").classList.remove("error");
                document.getElementById("newPass1").classList.add("error");
                document.getElementById("newPass2").classList.add("error");
                document.getElementById("passConditions").hidden = true;
                divEsito.style.color = "red";
            
            break;
        }
    }
}



//recupera fino alle ultime 10 partite nel database
async function dati(){
    let params={
        "method": "POST",
        "body": ""
    };
    let fetch1 = await fetch("../php/requests/dati.php", params);
    let fetch2 = await fetch1.text();
    let result = JSON.parse(fetch2);
    document.getElementById("username").textContent = result["user"];
    document.getElementById("email").textContent = result["email"];

    let last10games = document.getElementById("games");

    let partite = result["partite"];

    let i = 0;
    let vuoto = document.getElementById("vuoto");
    if(partite[i] != null){
        last10games.hidden = false;
        vuoto.hidden = true;
        while(partite[i] != null){
            let tr = document.createElement("tr");

            for(let j = 0; j < 3; ++j){
                let td = document.createElement("td");
                td.textContent = partite[i][j];
                tr.append(td);
            }
            last10games.append(tr);
            i++;
        }
    }
    else{
        last10games.hidden = true;
        vuoto.hidden = false;
    }


}