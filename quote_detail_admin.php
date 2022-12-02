<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
$dbname = "mysql:host=blitz.cs.niu.edu:3306;dbname=csci467";
$user = "student";
$pass = "student";
$pdo_leg=new PDO($dbname, $user, $pass);
if (isset($_GET['Id'])) {
$QId=$_GET['Id'];
$res = $pdo->prepare('SELECT * FROM Quotes
    WHERE Id=?');
$res->execute([$_GET['Id']]);
while($fet = $res->fetch(PDO::FETCH_ASSOC))
          {
            $CustID = $fet["CustomerId"];
            $odDate=$fet["ProcessingDate"];
            $disc=$fet['DiscountAmount'];
           }
$res=$pdo_leg->prepare('SELECT * FROM customers WHERE id= ?');
$res->execute([$CustID]);
while($fet = $res->fetch(PDO::FETCH_ASSOC))
{
    $CustomerName= $fet['name'];
    $CustomerCity= $fet['city'];
    $CustomerStreet= $fet['street'];
    $CustomerContact= $fet['contact'];
}
//echo "<h3>Order from: $CustomerName</h3>";
$stmt=$pdo->prepare('SELECT * FROM LineItems WHERE QuoteID=?');
$stmt->execute([$_GET['Id']]);
$items=$stmt->fetchAll(PDO::FETCH_ASSOC);
$res=$pdo->prepare('SELECT * FROM QuoteNotes WHERE QuoteID=?');
$res->execute([$_GET['Id']]);
$textNote="";
while($fet = $res->fetch(PDO::FETCH_ASSOC))
{
    $textNote=$fet['Note'];
    $noteNum=$fet['NoteNumber'];

}
}
else {
    exit('No ID specified!');
}
?>
<?=template_header('Quote Details')?>
<div class="content read">
    <h2>Quote Detail For Id# <?=$QId?> </h2>
    <h3>Order from: <?= $CustomerName?></h3>
    <h3>Order Fulfilled: <?= $odDate?></h3>
    <h3>Address:<?= $CustomerStreet?> </h3>
    <h3><?= $CustomerCity?> </h3>
    <h3>Contact Detail: <?=$CustomerContact?></h3>
    <h3 style="color:red;">Secret Notes: <?=$textNote?></h3>
	<table>
        <thead>
            <tr>
                <td>Item Number</td>
                <td>Item Description</td>
                <td>Item Price</td>
                <td>Quantity</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <tr>
                <td><?=$item['ItemNumber']?></td>
                <td><?=$item['ItemDescription']?></td>
                <td><?=$item['ItemPrice']?></td>
                <td><?=$item['Quantity']?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php 
    $subtotal=0.00;
    foreach ($items as $item)
    {
        $subtotal+=(float)($item['ItemPrice']*$item['Quantity']);
    }
    $total=$subtotal- $disc;
    echo "<h4 style='color:red;'>Subtotal(Excluding all discounts): $<b> $subtotal </b></h4><br>";
    echo "<h4 style='color:red;'>Total: $<b> $total </b></h4> <br><br>";
    ?>
    <a href="read2.php" class="edit"><i class="fas -solid fa-arrow-left"></i>Close</a>
</div>
<?=template_footer()?>