let request = new XMLHttpRequest()
const teststring = JSON.parse('{}');//JSON.parse('{"58":["0","Salami"],"59":["0","Vegetaria"],"60":["0","Spinat-H\u00fchnchen"]}');

function requestData(){
    "use strict";

    request.open("GET", "KundenStatus.php");
    request.onreadystatechange = processData;
    request.send(null);

}
function processData(){
    "use strict";
    if(request.readyState === 4){
        if(request.status === 200){
            if(request.responseText != null)
                process(request.responseText)
            else console.error("Dokument ist leer")
        } else console.error("Uebertragung fehlgeschlagen")
    } else;
}

function process(input)
{
    "use strict";
    let jsondata = JSON.parse(input);
    let kundensection = document.getElementById("kundenlist");

     

    let first = kundensection.firstElementChild;
    while(first){
        first.remove();
        first = kundensection.firstElementChild;
    }

    if(isEmpty(jsondata)){
        
        let newArticle = document.createElement("article");
        let emptylist = document.createElement("p");
        let emptyNode = document.createTextNode("Keine Bestellungen vorhanden!");
        


        emptylist.appendChild(emptyNode);
        newArticle.appendChild(emptylist);

        kundensection.appendChild(newArticle);
    }

    else{
        for(var key in jsondata) {

                let newArticle = document.createElement("article");
                let pizzaname = document.createElement("h2");
                let pizzaId = document.createElement("p");
                let pizzastatus = document.createElement("p");
                newArticle.setAttribute("class", "overview_article");

                let pizzanameNode = document.createTextNode(jsondata[key][1]);
                let pizzaidNode = document.createTextNode("Bestell-Artikel-ID: " + key);

                let status = parseInt(jsondata[key][0]); 
                switch(status){
                    case 0: let pizzastatusNode0 = document.createTextNode("In der Warteschlange");
                            pizzastatus.appendChild(pizzastatusNode0);
                            break;
                    case 1: let pizzastatusNode1 = document.createTextNode("Wird Zubereitet");
                            pizzastatus.appendChild(pizzastatusNode1);
                            break; 
                    case 2: let pizzastatusNode2 = document.createTextNode("Bereit zur Lieferung");
                            pizzastatus.appendChild(pizzastatusNode2);
                            break; 
                    case 3: let pizzastatusNode3 = document.createTextNode("Wird geliefert");
                            pizzastatus.appendChild(pizzastatusNode3);
                            break; 
                    case 4: let pizzastatusNode4 = document.createTextNode("Liefervorgang abgeschlossen");
                            pizzastatus.appendChild(pizzastatusNode4);
                            break;                         
                }

                pizzaname.appendChild(pizzanameNode);
                pizzaId.appendChild(pizzaidNode);
                
                newArticle.appendChild(pizzaname);
                newArticle.appendChild(pizzaId);
                newArticle.appendChild(pizzastatus);

            
                kundensection.appendChild(newArticle);
            
            }
        }
        
        
}

function init(){
    "use strict";
    window.setInterval(requestData, 2000);
}

function isEmpty(obj) {
    "use strict";
    return Object.keys(obj).length === 0;
}

function redirect(){
    location.href = "./Bestellung.php";
}