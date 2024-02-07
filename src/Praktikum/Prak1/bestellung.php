<?php declare(strict_types=1);
// keine Einrückung
echo <<<END
<!DOCTYPE html>
<html lang="de">  
<head>
    <meta charset="UTF-8" />
    <title>Übung</title>
</head>
<body>
    <h1 id="bestellung_title"><strong>Bestellung</strong></h1>
     <!--Speisekarte-->
    <section id="speisekarte_section">
        <h2 id="speisekarte_title"><strong>Speisekarte</strong></h2>
        
    
        <article>
            <img id="magherita_img" src="./res/magherita_img.jpg" title = "Magherita Pizza" alt="Magherita Pizza" style="width: 150px; height: 100px;" />
            <h3>Magherita</h3>
            <p>4,00 €</p>
        </article>

        <article>
            <img id="salami_img" src="./res/salami_img.jpg" title = "Salami Pizza" alt="" style="width: 150px; height: 100px;" />
            <h3>Salami</h3>
            <p>4,50 €</p>
        </article>

        <article>
            <img id="hawaii_img" src="./res/hawaii_img.jpg" title = "Hawaii Pizza" alt="" style="width: 150px; height: 100px;" />
            <h3>Hawaii</h3>
            <p>5,50 €</p>
        </article>
    </section>

    <!--Warenkorb-->
    <section id="warenkorb_section">
        <h3 id="warenkorb_title"><strong>Warenkorb</strong></h3>
        <article>
            <h3>Bestellung</h3>
                    <form id = "order_form" action="https://echo.fbi.h-da.de/" method="post" accept-charset="UTF-8">
                        <select name="pizza[]" id="pizza_select" size="8" multiple tabindex="1">
                            <option value="1">Salami</option>
                            <option value="2">Magherita</option>
                            <option value="3">Hawaii</option>
                        </select>

                        <p><span id = "billing_price">14,50</span> €</p>

                        <input name="adresse_input" type="text"  placeholder="Ihre Adresse" required value = "">
                            <input type="reset" value = "Alle Löschen" />
                            <input type="button" value="Auswahl Löschen" />
                            <input type="submit" value="Bestellen" />            
                    </form>
        </article>
    </section>
    
</body>
</html>
END;