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
    <h2>Quote Tracking - Add New Quote</h2>
    <nav>
        <ul>
            <li><a href="main.php">Main Page</a></li>
            <li><a href="quote_tracking.php">Quote Tracking</a></li>
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
        if (isset($_GET["cid"])) {
            $_SESSION["cust_id"] = $_GET["cid"];
            // Generate new quote id
            $temp = $_SESSION["last_quote_id"];
            $_SESSION["last_quote_id"] = $temp + 1;
        }
        $id = $_SESSION["cust_id"];
        $res = $pdo->query("SELECT name, street, city, contact FROM customers WHERE id = $id");
        
        print_r($_SESSION);


        $fet = $res->fetch(PDO::FETCH_ASSOC);
        $name = $fet["name"];
        $street = $fet["street"];
        $city = $fet["city"];
        $contact = $fet["contact"];
        
        echo "<br>";
        echo "<h3>New Quote for: $name.</h3>";
        echo "$street<br>$city<br>$contact";
        
        echo "<br><br>";
        echo "<form action=\"quote_tracking_new.php\" method = GET>";
        echo "<label for='Name'>Select part: </label>";
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
        
        echo "<br>";
        echo "<h4>Click on the Quote Tracking link above to go the Quote
        Tracking page to add or edit another quote.</h4>";
        echo "<h4>Quote content for customer $name.</h4>";
        
        $pdo_local = new PDO($local_dbname, $lc_user, $lc_pass);
        // Only run these 3 lines when part_id == quantity == ... = null
        // means first get into page
        // $res = $pdo_local->query("SELECT COUNT(*) FROM Quotes");
        // $new_quote_id = $res->fetchColumn() + 1;
        
        $new_quote_id = $_SESSION["last_quote_id"];
        $res = $pdo_local->query("SELECT ItemNumber, ItemDescription FROM 
          LineItems WHERE QuoteId = $new_quote_id");
        // $res1 = $pdo_local->query("SELECT number, description FROM parts");
        echo "<table border=0 cellpadding=5 align=center>";
        echo "<tr><th>Item</th><th>Quantity</th></tr>";
        while($fet = $res->fetch(PDO::FETCH_ASSOC)){
            echo"<tr>";
            $name = $fet["ItemDescription"];
            $qty = $fet["ItemNumber"];
            echo "
            <td>
                $name
            </td>
            <td>
                $qty
            </td>";
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
