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
    try { // connect to the database
        
        $pdo = new PDO($dbname, $user, $pass);
        $id = $_GET["pid"];
        $res = $pdo->query("SELECT name, street, city, contact FROM customers WHERE id = $id");
        
        $fet = $res->fetch(PDO::FETCH_ASSOC);
        $name = $fet["name"];
        $street = $fet["street"];
        $city = $fet["city"];
        $contact = $fet["contact"];
        
        echo "<br>";
        echo "<h3>New Quote for: $name.</h3>";
        echo "$street<br>$city<br>$contact";
        
        echo "<h4>Click on the Quote Tracking link above to go the Quote
        Tracking page to add or edit another quote.</h4>";
        echo "<br>";


    }
    catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
    }
    ?>
</body>
</html>
