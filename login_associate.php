<html>
    <head>
        <title>Quote System - Group 2B</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <h1>Quote System</h1>
    <h2>Associate Login</h2>
    <nav>
        <ul>
            <li><a href="main.php">Main Page</a></li>
        </ul>
    </nav>
    <hr>
    <?php
    
    $dbname = "mysql:host=courses;dbname=z1924897";
    $user = "z1924897";
    $pass = "1979Jan05";
    try {
        $pdo = new PDO($dbname, $user, $pass);

        echo "
        Try 1 & boley.
        ";

        echo "
        <form action=\"login_associate.php\" method = GET>
        <label for='usrname'>Username</label>
        <input type='text' size='5' id='usrname' name='usrname' required/>
        <label for='psw'>Password</label>
        <input type='password' id='psw' name='psw' required />
        <input type='submit' value='Login'>
        </form>";

        if($_GET != NULL){
          // echo $_GET['usrname']; echo $_GET['psw'];
          // Search database for username and Password

          if ($_GET["usrname"] == '1' && $_GET["psw"] == 'boley') {
            $userId = $_GET["usrname"];
            // $Sid = "MANAGER"; // if usertype =1
            // $res = $pdo->prepare("INSERT INTO SESS VALUES(?,?)");
            // $res->execute(array($userId,$Sid));
            header('location: quote_tracking.php');
          } else echo "Invalid username and/or password. Try again!";
        }

    }
    catch(PDOexception $e) {
        echo "Connection to database failed: " . $e->getMessage();
    }
    ?>
</body>
</html>
