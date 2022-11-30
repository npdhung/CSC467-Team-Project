<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['Id'])) {
    $stmt = $pdo->prepare('SELECT * FROM Associates WHERE Id = ?');
    $stmt->execute([$_GET['Id']]);
    $ast = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$ast) {
        exit('Contact doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM Associates WHERE Id = ?');
            $stmt->execute([$_GET['Id']]);
            $msg = 'You have deleted the contact!';
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>\<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Associate #<?=$ast['Id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete this Assosciate #<?=$ast['Id']?>?</p>
    <div class="yesno">
        <a href="delete.php?Id=<?=$ast['Id']?>&confirm=yes">Yes</a>
        <a href="delete.php?Id=<?=$ast['Id']?>&confirm=no">No</a>
    </div>
    <style>
.button2 {
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
    <?php endif; ?>
</div>

<?=template_footer()?>
