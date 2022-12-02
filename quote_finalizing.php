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
    <h2>Quote Finalizing</h2>
    <nav>
        <ul>
            <li><a href="main.php">Main Page</a></li>
            <li><a href="quote_tracking.php">Quote Tracking</a></li>
            <li><a href="quote_unfinalizing.php">Unfinalize Quote</a></li>
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
        $assoc_id = $_SESSION["assoc_id"];
        $first = $_SESSION["assoc_first"];
        $last = $_SESSION["assoc_last"];
        echo "<h4>Plan Repair Services Portal welcomes Associate $first $last
          </h4>";
        
        echo "<form action=\"quote_finalizing.php\" method = GET>";
        
        echo "<label for='Name'>Select Quote ID to Process: </label>";
        echo "<select id='Name' name='qfid'>";
        $res = $pdo_local->query("SELECT Id, Status FROM Quotes 
            WHERE Status = 'in-process'
            AND AssociateId = $assoc_id");
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
              $name = $fet["Status"];
              $qid = $fet["Id"];
              echo "<option value=".$qid.">".$qid."</option>";
        }
        echo "</select>";
        echo " <input type='submit' value='Select'> </form>";
        echo "(Can only start Finalizing Quotes that are in-progress status)";
        
        if (isset($_GET["qfid"]))
            $_SESSION["quote_id"] = $_GET["qfid"];
        $qid = $_SESSION["quote_id"];
        // Only show the submit part the first time
            echo "<br>";
            $first = $_SESSION["assoc_first"];
            $last = $_SESSION["assoc_last"];
            echo "<h4>Input information to start finalizing quote</h4>";
            echo "<form action=\"quote_finalizing.php\" method = GET>";
            echo "Contact Email: <input type='email' name='email'> <br>";
            echo "Note: <input type='text' name='note'> <br>";
            echo "Discount percent(%): <input type='number' name='dis_pct'> <br>";
            echo "Discount amount($): <input type='number' name='dis_amt'> <br>";
            echo "<input type='submit' value='Submit'> <br></form>";
            if (isset($_GET["email"])) {
                $email = $_GET["email"];
                $note = $_GET["note"];
                $dis_pct = $_GET["dis_pct"];
                $dis_amt = $_GET["dis_amt"];
                
                // Update email & discount for the quote
                $res = $pdo_local->exec("UPDATE Quotes
                    SET ContactCust = '$email'
                    WHERE Id = $qid;");
                $res = $pdo_local->exec("UPDATE Quotes
                    SET DiscountPercentage = $dis_pct
                    WHERE Id = $qid;");
                $res = $pdo_local->exec("UPDATE Quotes
                    SET DiscountAmount = $dis_amt
                    WHERE Id = $qid;");
                
                // Insert new note to QuoteNotes table
                $res = $pdo_local->exec("INSERT INTO QuoteNotes
                    (QuoteId, Note)
                    VALUES ($qid, '$note');");
                
                // Generate summary
                $res = $pdo_local->query("SELECT Quantity, ItemPrice FROM LineItems
                    WHERE QuoteId = $qid");
                $sub_total = 0;
                while($fet = $res->fetch(PDO::FETCH_ASSOC)){
                    $qty = $fet["Quantity"];
                    $item_price = $fet["ItemPrice"];
                    $sub_total += $qty * $item_price;
                }
                $dis_1 = ($sub_total * $dis_pct) / 100;
                $total = $sub_total - $dis_1 - $dis_amt;
                echo "<h4>Quote Summary</h4>";
                echo "Contact email: $email<br>";
                echo "Subtotal: $sub_total<br>";
                echo "Discount 1: $dis_1<br>";
                echo "Discount 2: $dis_amt<br>";
                echo "Total price: $total<br>";

                $_SESSION["total_price"] = $total;

                // Finalize the quote
                if (isset($_GET["qfn_id"]))
                {
                    $_SESSION["quote_id"] = $_GET["qfn_id"];
                    $qid = $_SESSION["quote_id"];
                    
                    // Update status and total price
                    $res = $pdo_local->exec("UPDATE Quotes
                        SET Status = 'finalized'
                        WHERE Id = $qid;");
                    $res = $pdo_local->exec("UPDATE Quotes
                        SET TotalPrice = $total
                        WHERE Id = $qid;");
                    echo "Quote $qid status change to finalized,";
                    echo "and the totalprice is updated in the database";
                }
                
                echo "<form action=\"quote_finalizing_end.php\" method = GET>";
                echo "<label for='Name'>Quote ID: </label>";
                echo "<select id='Name' name='qfn_id'>";
                echo "<option value=".$qid.">".$qid."</option>";
                echo "</select>";
                echo " <input type='submit' value='Finalize this Quote'> </form>";
                
                echo "<br><br>";
            }
        // List current quotes
        $assoc_id = $_SESSION["assoc_id"];
        $res = $pdo_local->query("SELECT QuoteId, CustomerId, ItemNumber, 
        ItemDescription, Quantity, ItemPrice 
            FROM LineItems, Quotes 
            WHERE LineItems.QuoteId = Quotes.Id 
            AND Quotes.AssociateId = $assoc_id
            AND QuoteId = $qid");
        
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
            
        
        // Show QuoteNotes table
        echo "<h4>List of Quote Status for Associate $first $last:</h4>";
        
        $assoc_id = $_SESSION["assoc_id"];
        $pdo_local = new PDO($local_dbname, $lc_user, $lc_pass);
        
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