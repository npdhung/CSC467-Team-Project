<?php
function pdo_connect_mysql() {
	$dbname = "mysql:host=courses;dbname=z1924897";
	$user = "z1924897";
	$pass = "1979Jan05";
    try {
    	return new PDO($dbname, $user, $pass);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style_admin.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Adminstration </h1>
			<a href="home.php"><i class="fas fa-home"></i>Home</a>
    		<a href="read.php"><i class="fas fa-address-book"></i>Associates</a>
			<a href="read2.php"><i class="fas fa-table"></i>Quotes</a>
			<a href="main.php"><i class="fas fa-arrow-right"></i>Exit</a>

    	</div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>