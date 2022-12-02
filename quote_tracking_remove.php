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
    <h2>Quote Tracking - Remove Quote</h2>
    <nav>
        <ul>
            <li><a href="main.php">Main Page</a></li>
            <li><a href="quote_tracking.php">Add New Quote</a></li>
            <li><a href="quote_tracking_edit.php">Edit Quote</a></li>
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
        
        echo "<br>";
        echo "<h3>Associate Remove Quote.</h3>";
        $assoc_id = $_SESSION["assoc_id"];
        $first = $_SESSION["assoc_first"];
        $last = $_SESSION["assoc_last"];
        echo "<h4>Plan Repair Services Portal welcomes Associate $first $last
          </h4>";
        
        echo "<form action=\"quote_tracking_remove.php\" method = GET>";
        
        echo "<label for='Name'>Select Quote ID to Remove: </label>";
        echo "<select id='Name' name='qrm_id'>";
        $res = $pdo_local->query("SELECT Id FROM Quotes 
            WHERE Status = 'in-process'
            AND AssociateId = $assoc_id");
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
              $qrm_id = $fet["Id"];
              echo "<option value=".$qrm_id.">".$qrm_id."</option>";
        }
        echo "</select>";
        echo " <input type='submit' value='Delete this Quote'> </form>";
        echo "(Only quotes with in-progress status are available to remove)";

        echo "<h4>List of non - empty quotes for Associate $first $last:</h4>";
        
        $assoc_id = $_SESSION["assoc_id"];
        $pdo_local = new PDO($local_dbname, $lc_user, $lc_pass);
        
        if (isset($_GET["qrm_id"])) 
        {
            $_SESSION["quote_id"] = $_GET["qrm_id"];
            $quote_id = $_SESSION["quote_id"];

            // Remove the quote
            $res = $pdo_local->exec("DELETE FROM QuoteNotes
                WHERE QuoteId = $quote_id;");
            $res = $pdo_local->exec("DELETE FROM LineItems
                WHERE QuoteId = $quote_id;");
            $res = $pdo_local->exec("DELETE FROM Quotes
                WHERE Id = $quote_id;");
            echo "Quote ID $quote_id is removed from database.";
        }

        echo "<br><br>";
        // List current non-empty quotes
        $assoc_id = $_SESSION["assoc_id"];
        $res = $pdo_local->query("SELECT QuoteId, CustomerId, ItemNumber, 
          ItemDescription, Quantity, ItemPrice 
            FROM LineItems, Quotes 
            WHERE LineItems.QuoteId = Quotes.Id 
            AND Quotes.AssociateId = $assoc_id");
        
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
    
        echo "<h4>List of quote status for Associate $first $last:</h4>";

        // Print Quote status table
        $res = $pdo_local->query("SELECT Id, Status FROM Quotes 
            WHERE AssociateId = $assoc_id");
        echo "<table border=0 cellpadding=5 align=center>";
        echo "<tr><th>Quote ID</th><th>Status</th></tr>";
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
            echo"<tr>";
            $quote_id = $fet["Id"];
            $status = $fet["Status"];
            echo "
            <td>$quote_id</td>
            <td>$status</td>";
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

