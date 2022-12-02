<?php
session_start();
?>
<html>
    <head>
        <title>Quote System - Group 2B</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <h1>Quote System</h1>
    <h2>Quote Tracking - Edit Quote</h2>
    <nav>
        <ul>
            <li><a href="main.php">Main Page</a></li>
            <li><a href="quote_tracking.php">Quote Tracking</a></li>
            <li><a href="quote_tracking_edit.php">Edit Quote</a></li>
            <li><a href="quote_tracking_remove.php">Remove Quote</a></li>
            <li><a href="quote_finalizing.php">Finalize Quote</a></li>
        </ul>
    </nav>
    <hr>
    <?php
    $dbname = "mysql:host=blitz.cs.niu.edu:3306;dbname=csci467";
    $user = "student";
    $pass = "student";
    
    // Get the credentials to connect to local server or hopper
    include 'local_cred.php';
    
    try { // connect to the database
        
        $pdo = new PDO($dbname, $user, $pass);
        $pdo_local = new PDO($local_dbname, $lc_user, $lc_pass);

        if (isset($_GET["qedit_id"])) $_SESSION["quote_id"] = $_GET["qedit_id"];
        $quote_id = $_SESSION["quote_id"];

        if (isset($_SESSION["cust_id"])) $id = $_SESSION["cust_id"];
        
        print_r($_SESSION);
        
        // Add new part to quote
        echo "<br><br>";
        echo "<form action=\"quote_tracking_edit_detail.php\" method = GET>";
        echo "<label for='Name'>Select new part: </label>";
        echo "<select id='Name' name='pid'>";
        
        $res = $pdo->query("SELECT number, description FROM parts");
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
            $desc = $fet["description"];
            $part_id = $fet["number"];
            echo "<option value=".$part_id.">".$desc."</option>";
        }
        echo "</select>";
        echo " Quantity: <input type='text' size='2' name='qty' />";
        echo " <input type='submit' value='Add to Quote' />
        </form>";
        echo "(Need to select both part and quantity to add to Quote)";
        
        if (isset($_GET["pid"]) && isset($_GET["qty"])) {
            $part_id = $_GET["pid"];
            $qty = $_GET["qty"];
            
            // Get part information from online database
            $res = $pdo->query("SELECT description, price FROM parts 
            WHERE number = $part_id");
            $fet = $res->fetch(PDO::FETCH_ASSOC);
            $name = $fet["description"];
            $price = $fet["price"];
            
            // Insert new line into LineItems table of local database
            $res = $pdo_local->exec("INSERT INTO LineItems
            VALUES ($quote_id, $part_id, $qty, '$name', $price);");
        }

        // Edit existing item in quote
        echo "<br><br>";
        echo "<form action=\"quote_tracking_edit_detail.php\" method = GET>";
        echo "<label for='Name'>Select existing part: </label>";
        echo "<select id='Name' name='peid'>";

        $res = $pdo_local->query("SELECT ItemNumber, ItemDescription 
            FROM LineItems
            WHERE QuoteId = $quote_id");
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
            $part_id = $fet["ItemNumber"];
            $desc = $fet["ItemDescription"];
            echo "<option value=".$part_id.">".$desc."</option>";
        }
        echo "</select>";
        echo " Quantity: <input type='text' size='2' name='eqty' />";
        echo " <input type='submit' value='Edit this item' />
        </form>";
        echo "(Need to select both part and quantity, set quantity = 0 to remove item)";
        
        if (isset($_GET["peid"]) && isset($_GET["eqty"])) {
            $part_id = $_GET["peid"];
            $qty = $_GET["eqty"];
            
            // Get part information from online database
            $res = $pdo->query("SELECT description, price FROM parts 
            WHERE number = $part_id");
            $fet = $res->fetch(PDO::FETCH_ASSOC);
            $name = $fet["description"];
            $price = $fet["price"];
            
            // Update Items in LineItems table of local database
            If ($qty != 0) // Update
            {
                $res = $pdo_local->exec("UPDATE LineItems
                    SET Quantity = $qty
                    WHERE QuoteId = $quote_id
                    AND ItemNumber = $part_id;");
            }
            else // Remove item
            {
                $res = $pdo_local->exec("DELETE FROM LineItems
                    WHERE ItemNumber = $part_id;");
            }
        }   

        echo "<br>";
        echo "<h4>Click on the Quote Tracking link above to go the Quote
        Tracking page to add or edit another quote.</h4>";
        
        // List current quotes
        $assoc_id = $_SESSION["assoc_id"];
        $res = $pdo_local->query("SELECT QuoteId, CustomerId, ItemNumber, 
          ItemDescription, Quantity, ItemPrice 
            FROM LineItems, Quotes 
            WHERE LineItems.QuoteId = Quotes.Id 
            AND Quotes.AssociateId = $assoc_id
            AND Quotes.Id = $quote_id");
        
        echo "<table border=0 cellpadding=5 align=center>";
        echo "<tr><th>QuoteID</th><th>CustomerID</th><th>Item ID</th>
          <th>Item Description</th><th>Quantity</th><th>Item Price</th></tr>";
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
            echo"<tr>";
            $quote_id = $fet["QuoteId"];
            $cust_id = $fet["CustomerId"];
            $part_id = $fet["ItemNumber"];
            $desc = $fet["ItemDescription"];
            $qty = $fet["Quantity"];
            $price = $fet["ItemPrice"];
            echo "
            <td>$quote_id</td>
            <td>$cust_id</td>
            <td>$part_id</td>
            <td>$desc</td>
            <td>$qty</td>
            <td>$price</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
    }
    ?>
</body>
</html>
