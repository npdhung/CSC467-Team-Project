<html>
    <head>
        <title>Quote System - Group 2B</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <h1>Quote System</h1>
    <h2>Admin Login</h2>
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
        Try 3 & agath123.
        ";

        echo "
        <form action=\"login_admin.php\" method = GET>
        <label for='usrname'>Username</label>
        <input type='text' size='5' id='usrname' name='usrname' required/>
        <label for='psw'>Password</label>
        <input type='password' id='psw' name='psw' required />
        <input type='submit' value='Login'>
        </form>";

        if($_GET != NULL){
          // echo $_GET['usrname']; echo $_GET['psw'];
          // Search database for username and Password

          if ($_GET["usrname"] == '3' && $_GET["psw"] == 'agath123') {
            $userId = $_GET["usrname"];
            // $Sid = "CUSTOMER"; // if usertype =2
            // $res = $pdo->prepare("INSERT INTO SESS VALUES(?,?)");
            // $res->execute(array($userId,$Sid));
            header('location: home.php');
          } else echo "Invalid username and/or password. Try again!";
        }

    }
    catch(PDOexception $e) {
        echo "Connection to database failed: " . $e->getMessage();
    }
    ?>
</body>
</html>
