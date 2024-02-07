<?php declare(strict_types=1);
echo <<<EOT
<!DOCTYPE html>
<html lang="de">  
<head>
    <meta charset="UTF-8" />
    <title>Übung</title>
</head>
<body>
    <h1>Bäcker</h1>

    <h2>Pizza 1</h2>
    <article id="pizza1_article">
        <h3>Margherita</h3>

        <form id="cook_form1" action="https://echo.fbi.h-da.de/" method="post" accept-charset="UTF-8">
            <label for="ordered_radiob1">bestellt</label>
            <input type="radio" id="ordered_radiob1" name="margherita_radio" value="ordered" checked>
            <label for="prep_radiob1">im Ofen</label>
            <input type="radio" id="prep_radiob1" name="margherita_radio" value="prep">
            <label for="ready_radiob1">fertig</label>
            <input type="radio" id="ready_radiob1" name="margherita_radio" value="ready">

            <input type="submit" value="Aktualisieren" />
        </form>
    </article>

    <h2>Pizza 2</h2>
    <article id="pizza2_article">
        <h3>Salami</h3>

        <form id="cook_form2" action="https://echo.fbi.h-da.de/" method="post" accept-charset="UTF-8">
            <label for="ordered_radiob2">bestellt</label>
            <input type="radio" id="ordered_radiob2" name="salami_radio" value="ordered">
            <label for="prep_radiob2">im Ofen</label>
            <input type="radio" id="prep_radiob2" name="salami_radio" value="prep" checked>
            <label for="ready_radiob2">fertig</label>
            <input type="radio" id="ready_radiob2" name="salami_radio" value="ready">

            <input type="submit" value="Aktualisieren" />
        </form>
    </article>

    <h2>Pizza 3</h2>
    <article id="pizza3_article">
        <h3>Hawaii</h3>

        <form id="cook_form3" action="https://echo.fbi.h-da.de/" method="post" accept-charset="UTF-8">
            <label for="ordered_radiob3">bestellt</label>
            <input type="radio" id="ordered_radiob3" name="hawaii_radio" value="oredered">
            <label for="prep_radiob3">im Ofen</label>
            <input type="radio" id="prep_radiob3" name="hawaii_radio" value="prep">
            <label for="ready_radiob3">fertig</label>
            <input type="radio" id="ready_radiob3" name="hawaii_radio" value="fertig" checked>

            <input type="submit" value="Aktualisieren" />
        </form>
    </article>

</body>
</html>
EOT;
?>
