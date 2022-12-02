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
    <h2>Quote Processing</h2>
    <nav>
        <ul>
            <li><a href="main.php">Main Page</a></li>
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
        echo "<h3>Select Quote that is ready to be processed.</h3>";
        
        echo "<form action=\"quote_processing.php\" method = GET>";
        
        echo "<label for='Name'>Select Quote ID to Process: </label>";
        echo "<select id='Name' name='qpr_id'>";
        $res = $pdo_local->query("SELECT Id FROM Quotes 
            WHERE Status = 'sanctioned'");
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
              $qpr_id = $fet["Id"];
              echo "<option value=".$qpr_id.">".$qpr_id."</option>";
        }
        echo "</select>";
        echo " <input type='submit' value='Select this Quote'> </form>";
        echo "(Only quotes with sanctioned status are available to be Processed)";
        
        $pdo_local = new PDO($local_dbname, $lc_user, $lc_pass);
        
        // Unfinalize the quote
        if (isset($_GET["qpr_id"]))
        {
            $_SESSION["quote_id"] = $_GET["qpr_id"];
            $qid = $_SESSION["quote_id"];
            
            // Update status and total price
            $res = $pdo_local->exec("UPDATE Quotes
                SET Status = 'processed'
                WHERE Id = $qid;");
            
            // Calculate $comm and find $assoc_id
            // Get totalprice
            $res = $pdo_local->query("SELECT TotalPrice FROM Quotes
                    WHERE Id = $qid");
            while($fet = $res->fetch(PDO::FETCH_ASSOC)){
                $total = $fet["TotalPrice"];
            }
            $comm = $total * 0.03;
            
            // Get assoc_id and previous commission
            $res = $pdo_local->query("SELECT AssociateId FROM Quotes
                    WHERE Id = $qid");
            while($fet = $res->fetch(PDO::FETCH_ASSOC)){
                $assoc_id = $fet["AssociateId"];
            }
            $res = $pdo_local->query("SELECT FirstName, LastName, 
                AccumulatedCommission 
                FROM Associates
                WHERE Id = $assoc_id");
            while($fet = $res->fetch(PDO::FETCH_ASSOC)){
                $first = $fet["FirstName"];
                $last = $fet["LastName"];
                $prev_comm = $fet["AccumulatedCommission"];
            }

            $comm += $prev_comm;

            $res = $pdo_local->exec("UPDATE Associates
                SET AccumulatedCommission = $comm
                WHERE Id = $assoc_id;");
            
            
            echo "<h4>Quote $qid status change to processed,";
            echo " and commission (3%) is added to the Associate $first $last.</h4>";
        }
        
        echo "<h4>List of quote status:</h4>";

        // Print Quote status table
        $res = $pdo_local->query("SELECT Id, Status, TotalPrice, AssociateId
            FROM Quotes");
        echo "<table border=0 cellpadding=5 align=center>";
        echo "<tr><th>Quote ID</th><th>Status</th><th>TotalPrice</th><th>Associate ID</th>
            </tr>";
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
            echo"<tr>";
            $quote_id = $fet["Id"];
            $status = $fet["Status"];
            $total = $fet["TotalPrice"];
            $assoc_id = $fet["AssociateId"];
            echo "
            <td>$quote_id</td>
            <td>$status</td>
            <td>$total</td>
            <td>$assoc_id</td>";
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