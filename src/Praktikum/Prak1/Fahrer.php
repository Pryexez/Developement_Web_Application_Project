<?php declare(strict_types=1);

echo <<<EOT
<!DOCTYPE html>
<html lang="de">  
<head>
    <meta charset="UTF-8" />
    <title>Fahrer</title>
</head>
<body>
<section>
    <h1>Offene Bestellungen</h1>
    <article>
        <h2>Bestellung 1</h2>

        <p>Schulz, Kasinostr. 5 13.50€</p>
        <p>Magerita, Salami, Tonno</p>
        <form id = "driver_form1" action="https://echo.fbi.h-da.de/" method="post" accept-charset="UTF-8">
            
            <label for = "input1_finished">Fertig</label>
            <input type = "radio" name = "order_1" value = "ready" id = "input1_finished" checked = "checked">
            <label for = "input1_driving">Unterwegs</label>
            <input type = "radio" name = "order_1" value = "driving" id = "input1_driving">
            <label for = "input1_delivered">Geliefert</label>
            <input type = "radio" name = "order_1" value = "delivered" id = "input1_delivered">

            <input type="submit" value="Aktualisieren" />   
        </form>
        </article>
        <article>
            <h2>Bestellung 2</h2>
    
            <p>Müller, Rheinstr. 11 10.00€</p>
            <p>Salami, Prosciutto</p>
            <form id = "driver_form2" action="https://echo.fbi.h-da.de/" method="post" accept-charset="UTF-8">
                
                <label for = "input2_finished">Fertig</label>
                <input type = "radio" name = "order_2" value = "ready" id = "input2_finished" checked = "checked">
                <label for = "input2_driving">Unterwegs</label>
                <input type = "radio" name = "order_2" value = "driving" id = "input2_driving">
                <label for = "input2_delivered">Geliefert</label>
                <input type = "radio" name = "order_2" value = "delivered" id = "input2_delivered">
    
                <input type="submit" value="Aktualisieren" />    
            </form>
    


    </article>
    </section>

</body>
</html>
EOT;
?>