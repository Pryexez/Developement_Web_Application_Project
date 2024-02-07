
const addPizza = (value) => {
    "use strict";
    const pizzaPrice = parseFloat(value.dataset.preis);
    const pizzaName = value.title;
    const billingPrice = document.getElementById("billing_price");
    const newPrice = parseFloat(billingPrice.firstChild.nodeValue) + pizzaPrice;
    const shoppingCart = document.getElementById("pizza_select");

    const newOption = document.createElement("option");
    newOption.setAttribute("data-price", pizzaPrice.toFixed(2));


    newOption.setAttribute("value", value.dataset.article_id);

       
    const newTextNode = document.createTextNode(pizzaName);

    newOption.appendChild(newTextNode);
    shoppingCart.appendChild(newOption);
    billingPrice.firstChild.nodeValue = newPrice.toFixed(2);

    enableBestellbutton();

}

const deleteAll = () => {
    "use strict";
    const billingPrice = document.getElementById("billing_price");
    const shoppingCart = document.getElementById("pizza_select");
    const firstChild = shoppingCart.children;

    for (let i = firstChild.length -1; i >= 0; i--) {
        shoppingCart.removeChild(firstChild[i]);
    }

    billingPrice.firstChild.nodeValue = "0";

    disableBestellbutton();
}

const deleteSingle = () => {
    "use strict";
    const billingPrice = document.getElementById("billing_price");
    const shoppingCart = document.getElementById("pizza_select");
    const children = shoppingCart.options;

    let price = parseFloat(billingPrice.firstChild.nodeValue);

    for (let i = 0; i < children.length; i++) {
        if (children[i].selected) {
            price -= children[i].dataset.price;
            shoppingCart.removeChild(children[i]);
        }
    }

    billingPrice.firstChild.nodeValue = price.toFixed(2);

    if(children.length == 0){
        disableBestellbutton();
    }
}

const selectShoppingCart = () => {
    "use strict";
    const shoppingCart = document.getElementById("pizza_select");
    const children = shoppingCart.children;

    for (let i = children.length -1; i >= 0; i--) {
        children[i].selected = true;
    }
}

const enableBestellbutton = () =>{
    "use strict";
    const button = document.getElementById("bestellbutton");
    button.disabled = false;
}

const disableBestellbutton = () =>{
    "use strict";
    const button = document.getElementById("bestellbutton");
    button.disabled = true;
}