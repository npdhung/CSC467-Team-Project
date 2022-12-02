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
    <h2>Quote Tracking - Unfinalize Quote</h2>
    <nav>
        <ul>
            <li><a href="main.php">Main Page</a></li>
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
        
        echo "<br>";
        echo "<h3>Associate Unfinalize Quote.</h3>";
        $assoc_id = $_SESSION["assoc_id"];
        $first = $_SESSION["assoc_first"];
        $last = $_SESSION["assoc_last"];
        echo "<h4>Plan Repair Services Portal welcomes Associate $first $last
          </h4>";
        
        echo "<form action=\"quote_unfinalizing.php\" method = GET>";
        
        echo "<label for='Name'>Select Quote ID to Unfinalize: </label>";
        echo "<select id='Name' name='quf_id'>";
        $res = $pdo_local->query("SELECT Id FROM Quotes 
            WHERE Status = 'finalized'
            AND AssociateId = $assoc_id");
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
              $quf_id = $fet["Id"];
              echo "<option value=".$quf_id.">".$quf_id."</option>";
        }
        echo "</select>";
        echo " <input type='submit' value='Unfinalize this Quote'> </form>";
        echo "(Only quotes with finalized status are available to Unfinalized)";
        
        $assoc_id = $_SESSION["assoc_id"];
        $pdo_local = new PDO($local_dbname, $lc_user, $lc_pass);
        
        // Unfinalize the quote
        if (isset($_GET["quf_id"]))
        {
            $_SESSION["quote_id"] = $_GET["quf_id"];
            $qid = $_SESSION["quote_id"];
            
            // Update status and total price
            $res = $pdo_local->exec("UPDATE Quotes
                SET Status = 'in-process'
                WHERE Id = $qid;");
            $res = $pdo_local->exec("UPDATE Quotes
                SET TotalPrice = NULL
                WHERE Id = $qid;");
            
            echo "<h4>Quote $qid status change to finalized and totalprice is reset.</h4>";
            echo "<h4>The quote will be able to be modified.</h4>";
        }
        
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
