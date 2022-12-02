<?php
session_start();
?>
<?php
include 'functions.php';
$id= $_SESSION["assoc_id"];
$first = $_SESSION["assoc_first"];
$last = $_SESSION["assoc_last"];
?>

<?=template_header('Home')?>

<body>
<div class="content">
	<h2>Home</h2>
    <?php
        echo "Welcome to the Admin Page!";
        echo "<br>Currently Logged in:";
        echo "<br><b> Id: $id Name: $first $last";
    ?>
</div>

</body>

<?=template_footer()?>