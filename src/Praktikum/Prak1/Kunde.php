<?php declare(strict_types=1);
echo <<<EOT
<!DOCTYPE html>
<html lang="de">  
<head>
    <meta charset="UTF-8" />
    <title>Übung</title>
</head>
<body>
    <h1>Kunde</h1>
    <p>Magherita: bestellt</p>
    <p>Salami: im Ofen</p>
    <form id = "order" action="http://localhost/Praktikum/Prak1/bestellung.php" method="GET" accept-charset="UTF-8">
        <input type="submit" value="Neue Bestellung" />
    </form>
</body>
</html>
EOT;

?>
