<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM Associates ORDER BY Id');
$stmt->execute();
$associates = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_ass = $pdo->query('SELECT COUNT(*) FROM Associates')->fetchColumn();

?>
<?=template_header('Read')?>
<div class="content read">
	<h2>Associates</h2>
    <div class="top">
	    <a href="create.php" >Create Associate</a>
    </div>
	<table>
        <thead>
            <tr>
                <td>Id</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>UserID</td>
                <td>Password</td>
                <td>Accumulated Commission</td>
                <td>Address</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($associates as $associate): ?>
            <tr>
                <td><?=$associate['Id']?></td>
                <td><?=$associate['FirstName']?></td>
                <td><?=$associate['LastName']?></td>
                <td><?=$associate['UserName']?></td>
                <td><?=$associate['Password']?></td>
                <td><?="$".$associate['AccumulatedCommission']?></td>
                <td><?=$associate['StreetAddress']. $associate['City']. ', ' .$associate['State']. " " .$associate['Zip']?></td>
                <td class="actions">
                    <a href="update.php?Id=<?=$associate['Id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?Id=<?=$associate['Id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	
</div>

<?=template_footer()?>