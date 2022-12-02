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
    
    // Get the credentials to connect to local server or hopper
    include 'local_cred.php';

    try { // connect to the database
        $pdo_local = new PDO($local_dbname, $lc_user, $lc_pass);
                
        // Finalize the quote
        if (isset($_GET["qfn_id"]))
        {
            $total = $_SESSION["total_price"];
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
            echo " and the total price is updated in the database.";
        }
    }
    catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
    }
    ?>
</body>
</html>