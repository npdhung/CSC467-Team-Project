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
        </ul>
    </nav>
    <hr>
    <?php
    $dbname = "mysql:host=blitz.cs.niu.edu:3306;dbname=csci467";
    $user = "student";
    $pass = "student";
    
    $local_dbname = "mysql:host=courses;dbname=z1924897";
    $lc_user = "z1924897";
    $lc_pass = "1979Jan05";
    try { // connect to the database
        $pdo = new PDO($dbname, $user, $pass);
        $pdo_local = new PDO($local_dbname, $lc_user, $lc_pass);
        print_r($_SESSION);
        
        echo "<br>";
        echo "<h3>Associate Remove Quote.</h3>";
        $first = $_SESSION["assoc_first"];
        $last = $_SESSION["assoc_last"];
        echo "<h4>Plan Repair Services Portal welcomes Associate $first $last
          </h4>";
        
        echo "<form action=\"quote_tracking_remove.php\" method = GET>";
        
        echo "<label for='Name'>Select Quote ID to Remove: </label>";
        echo "<select id='Name' name='qid'>";
        $res = $pdo_local->query("SELECT Id, Status FROM Quotes 
            WHERE Status = 'in-progress'");
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
              $name = $fet["Status"];
              $qid = $fet["Id"];
              echo "<option value=".$qid.">".$qid."</option>";
        }
        echo "</select>";
        echo " <input type='submit' value='Remove this Quote'> </form>";
        echo "(Associate can only remove Quotes that are in-progress status)";
        
        if (isset($_GET["qid"])) {
            $qid = $_GET["qid"];
            echo $qid;
            // Delete line in Quotes table of local database
            
            $res = $pdo_local->exec("DELETE FROM QuoteNotes
            WHERE QuoteId = $qid;");
            $res = $pdo_local->exec("DELETE FROM LineItems
            WHERE QuoteId = $qid;");
            $res = $pdo_local->exec("DELETE FROM Quotes
            WHERE Id = $qid;");
        }
        
        echo "<h4>List of current quotes for Associate $first $last:</h4>";
        
        $assoc_id = $_SESSION["assoc_id"];
        $pdo_local = new PDO($local_dbname, $lc_user, $lc_pass);
        // ItemNumber -> AssocId
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
