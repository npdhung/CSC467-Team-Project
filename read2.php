<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
$dbname = "mysql:host=blitz.cs.niu.edu:3306;dbname=csci467";
$user = "student";
$pass = "student";
$pdo_leg=new PDO($dbname, $user, $pass);
$stmt = $pdo->prepare('SELECT * FROM Associates, Quotes
    WHERE Quotes.AssociateId = Associates.Id');
$stmt->execute();
$quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt=$pdo->prepare('SELECT * FROM Quotes, LineItems WHERE Quotes.Id=LineItems.QuoteID');
$stmt->execute();
$line=$stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt=$pdo_leg->prepare('SELECT * FROM Customers');
$stmt->execute();
$cust=$stmt->fetchAll(PDO::FETCH_ASSOC);
$num_quto = $pdo->query('SELECT COUNT(*) FROM Quotes')->fetchColumn();
?>
<?=template_header('Quotes')?>
<div class="content read">
	<h2>Quotes</h2>
	<table>
        <thead>
            <tr>
                <td>Quote Id</td>
                <td>Status</td>
                <td>Processing Date</td>
                <td>Associate</td>
                <td>Total Amount</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quotes as $quote): ?>
            <tr>
                <td><?=$quote['Id']?></td>
                <td><?=$quote['Status']?></td>
                <td><?=$quote['ProcessingDate']?></td>
                <td><?=$quote['FirstName']. ' ' .$quote['LastName']?></td>
                <td><?="$".$quote['TotalPrice']?></td>
                <td class="actions">
                    <a href="quote_detail_admin.php?Id=<?=$quote['Id']?>" class="edit"><i class="fas -solid fa-eye"></i></a>
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    

</div>
<?=template_footer()?>