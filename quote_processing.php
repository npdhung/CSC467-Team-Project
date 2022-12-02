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

        $local_dbname = "mysql:host=courses;dbname=z1924897";
        $lc_user = "z1924897";
        $lc_pass = "1979Jan05";

        Try
        {
            $pdo = new PDO($dbname, $user, $pass);
        }
        catch
        {
        catch(PDOexception $e) { // handle that exception
        echo "Connection to database failed: " . $e->getMessage();
        }

        echo "<br>";
        echo "<h3>Implement Quote Processing.</h3>";
        echo "<h4>Description...</h4>";
        echo "<br>";
    ?>
</body>
</html>
