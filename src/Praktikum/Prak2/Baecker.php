<?php declare(strict_types=1);
// UTF-8 marker äöüÄÖÜß€
/**
 * Class PageTemplate for the exercises of the EWA lecture
 * Demonstrates use of PHP including class and OO.
 * Implements Zend coding standards.
 * Generate documentation with Doxygen or phpdoc
 *
 * PHP Version 7.4
 *
 * @file     PageTemplate.php
 * @package  Page Templates
 * @author   Bernhard Kreling, <bernhard.kreling@h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 * @version  3.1
 */

// to do: change name 'PageTemplate' throughout this file
require_once './Page.php';

/**
 * This is a template for top level classes, which represent
 * a complete web page and which are called directly by the user.
 * Usually there will only be a single instance of such a class.
 * The name of the template is supposed
 * to be replaced by the name of the specific HTML page e.g. baker.
 * The order of methods might correspond to the order of thinking
 * during implementation.
 * @author   Bernhard Kreling, <bernhard.kreling@h-da.de>
 * @author   Ralf Hahn, <ralf.hahn@h-da.de>
 */
class Baecker extends Page
{
    private int $max_order_id;
    private int $min_order_id;
    // to do: declare reference variables for members 
    // representing substructures/blocks

    /**
     * Instantiates members (to be defined above).
     * Calls the constructor of the parent i.e. page class.
     * So, the database connection is established.
     * @throws Exception
     */
    protected function __construct()
    {
        parent::__construct();
        $this->max_order_id = 0;
        $this->min_order_id = 0;
        // to do: instantiate members representing substructures/blocks
    }

    /**
     * Cleans up whatever is needed.
     * Calls the destructor of the parent i.e. page class.
     * So, the database connection is closed.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * Fetch all data that is necessary for later output.
     * Data is returned in an array e.g. as associative array.
     * @return array An array containing the requested data.
     * This may be a normal array, an empty array or an associative array.
     */
    protected function getViewData(): array
    {
        // to do: fetch data for this view from the database
        // to do: return array containing data

        $this->getMaxOrderId();
        $this->getMinOrderId();
        $data = array();
        $sql = "select status, name, ordered_article_id, ordering_id from ordered_article, article where ordered_article.article_id = article.article_id;";
        $recordset = $this->_database->query($sql);
        if (!$recordset) throw new Exception("Fehler in Abfrage: " . $this->_database->error);
        while ($record = $recordset->fetch_assoc()) {
            $name = $record["name"];
            $status = $record["status"];
            $id = $record["ordered_article_id"];
            $order_id = $record["ordering_id"];
            $data[$id] = [$name, $status, $order_id];
        }
        $recordset->free();
        return $data;
    }

    protected function getMaxOrderId():void
    {
        $max_order;
        $sql = "SELECT max(ordering_id) as maxorder FROM ordering";
        $record = $this->_database->query ($sql);
        $max_order = $record->fetch_object()->maxorder;
    
        $record->free();
        $this->max_order_id = (int)$max_order;
    }
    
    protected function getMinOrderId():void
    {
        $min_order;
        $sql = "SELECT min(ordering_id) as minorder FROM ordering";
        $record = $this->_database->query ($sql);
        $min_order = $record->fetch_object()->minorder;
    
        $record->free();
        $this->min_order_id = (int)$min_order;
    }

    /**
     * First the required data is fetched and then the HTML is
     * assembled for output. i.e. the header is generated, the content
     * of the page ("view") is inserted and -if available- the content of
     * all views contained is generated.
     * Finally, the footer is added.
     * @return void
     */
    protected function generateView(): void
    {
        $data = $this->getViewData(); //NOSONAR ignore unused $data
        $this->generatePageHeader('Bäcker', "", true); //to do: set optional parameters
        // to do: output view of this page
        echo <<<EOT
<h1>Bäcker</h1>

EOT;
$ordersize = 0;

    for ($n = $this->min_order_id; $n <= $this->max_order_id; $n++)
    { 
        $availabe = false;
        

        foreach ($data as $k => $v) {
            if($v[2] == $n){
                if($v[1] != 3 && $v[1] != 4){
                $availabe = true;
                }
            }
        }
        if($availabe){
        $ordersize++;  
        echo "<fieldset>
        <legend>Bestellung $n</legend>";   

        foreach ($data as $k => $v) {
           if($v[2] == $n){
            if($v[1] != 3 && $v[1] != 4){
            $checked = array("", "", "", "");
            $checked[(int)$v[1]] = "checked";
            echo <<<EOT
    <h2>Pizza $k</h2>
    <article id="$k">
        <h3>$v[0]</h3>

        <form id="cook_form1" action="./Baecker.php" method="post" accept-charset="UTF-8">
            <label for="ordered_radiob1">bestellt</label>
            <input type="radio" id="ordered_radiob1" name="margherita_radio" value="ordered" $checked[0]>
            <label for="prep_radiob1">im Ofen</label>
            <input type="radio" id="prep_radiob1" name="margherita_radio" value="prep" $checked[1]>
            <label for="ready_radiob1">fertig</label>
            <input type="radio" id="ready_radiob1" name="margherita_radio" value="ready" $checked[2]>
            <input type="hidden" name="articleID" value="$k"/>
            <input type="submit" value="Aktualisieren" />
        </form>
    </article>
    
EOT;
            }
        }
    }
    echo "</fieldset>";
    }   
}     

if($ordersize == 0){
    echo "<p>Keine Aufträge verfügbar</p>";
}
        $this->generatePageFooter();
    }

    /**
     * Processes the data that comes via GET or POST.
     * If this page is supposed to do something with submitted
     * data do it here.
     * @return void
     */
    protected function processReceivedData(): void
    {
        parent::processReceivedData();
        // to do: call processReceivedData() for all members
        $location = "Baecker.php";

        if (count($_POST)) {
            //Handle Data
            if (isset ($_POST["margherita_radio"]) &&
                isset($_POST["articleID"])) {

                $id = $_POST["articleID"];
                $status = 0;
                switch ($_POST["margherita_radio"]){
                    case "ordered":
                        $status = 0;
                        break;
                    case "prep":
                        $status = 1;
                        break;
                    case "ready":
                        $status = 2;
                        break;
                    default:
                        throw new Exception("not allowed status");
                }

                $escapedID = $this->_database->real_escape_string($id);

                $sqlInsert = "update ordered_article set status=$status where ordered_article_id=$escapedID";
                $this->_database->query($sqlInsert);
            }

            //Redirect
            header("HTTP/1.1 303 See Other");
            header("Location: " . $location);
            die();
        }
    }

    /**
     * This main-function has the only purpose to create an instance
     * of the class and to get all the things going.
     * I.e. the operations of the class are called to produce
     * the output of the HTML-file.
     * The name "main" is no keyword for php. It is just used to
     * indicate that function as the central starting point.
     * To make it simpler this is a static function. That is you can simply
     * call it without first creating an instance of the class.
     * @return void
     */
    public static function main(): void
    {
        try {
            $page = new Baecker();
            $page->processReceivedData();
            $page->generateView();
        } catch (Exception $e) {
            //header("Content-type: text/plain; charset=UTF-8");
            header("Content-type: text/html; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

// This call is starting the creation of the page. 
// That is input is processed and output is created.
Baecker::main();

// Zend standard does not like closing php-tag!
// PHP doesn't require the closing tag (it is assumed when the file ends). 
// Not specifying the closing ? >  helps to prevent accidents 
// like additional whitespace which will cause session 
// initialization to fail ("headers already sent"). 
//? >