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
    <h2>Quote Tracking</h2>
    <nav>
        <ul>
            <li><a href="main.php">Main Page</a></li>
            <li><a href="quote_tracking_edit.php">Edit Quote</a></li>
        </ul>
    </nav>
    <hr>
    <?php
    $dbname = "mysql:host=blitz.cs.niu.edu:3306;dbname=csci467";
    $user = "student";
    $pass = "student";
    try { // connect to the database
        $pdo = new PDO($dbname, $user, $pass);

        echo "<br>";
        echo "<h3>Associate creates new Quote.</h3>";
        $first = $_SESSION["assoc_first"];
        $last = $_SESSION["assoc_last"];
        echo "<h4>Plan Repair Services Portal welcomes Associate $first $last
          </h4>";
        echo "<h5>Create new quote for Customer:</h5>";
        
        echo "<form action=\"quote_tracking_new.php\" method = GET>";
        echo "<label for='Name'>Select customer: </label>";
        echo "<select id='Name' name='pid'>";
        $res = $pdo->query("SELECT name, id FROM customers");
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
              $name = $fet["name"];
              $pid = $fet["id"];
              echo "<option value=".$pid.">".$name."</option>";
        }
        echo "</select>";
        echo " <input type='submit' value='New Quote'> </form>";
        
        $res = $pdo->query("SELECT COUNT(*) FROM customers");
        $count = $res->fetchColumn();
        echo "$count current customers.";
        echo "<h5>Click on the link above to skip adding new quote and go to
        edit quote.</h5>";
        echo "<h5>List of current quotes for user xxxx:</h5>";
        echo "<br>";
        echo "<h5> quotes found.</h5>";
        echo "<br>";

    }
    catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
    }
    ?>
</body>
</html>
