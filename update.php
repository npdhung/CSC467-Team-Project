<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['Id'])) {
    if(isset($_POST['submit'])) {
        $id = isset($_POST['Id']) ? $_POST['Id'] : NULL;
        $first = isset($_POST['first_Name']) ? $_POST['first_Name'] : '';
        $last = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $user = isset($_POST['user']) ? $_POST['user'] : '';
        $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
        $role = isset($_POST['role']) ? $_POST['role']:'';
        $st_ad = isset($_POST['street_add']) ? $_POST['street_add'] : '';
        $city = isset($_POST['city']) ? $_POST['city'] : '';
        $state = isset($_POST['state']) ? $_POST['state'] : '';
        $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $comi = isset($_POST['commission']) ? $_POST['commission'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE Associates SET FirstName=?, LastName=?, UserName=?, Password=?, Role=?, StreetAddress=?, City=?, State=?, Zip=?, Email=?, AccumulatedCommission=? WHERE Id = ?)');
        $stmt->execute([$first,$last,$user,$pass,$role,$st_ad,$city,$state,$zip,$email,$comi, $_GET['Id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM Associates WHERE Id = ?');
    $stmt->execute([$_GET['Id']]);
    $ast = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$ast) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Associate #<?=$ast['Id']?></h2>
    <form action="update.php?Id=<?=$ast['Id']?>" method="post">
            <label for="Id">ID</label>
            <input type="text" name="Id" placeholder="26" value="<?=$ast['Id']?>" id="Id" >
            First Name:<input type = "text" name = "first_Name" value="<?=$ast['FirstName']?>" id="first_name">
            Last Name:<input type ="text" name ="last_name" value="<?=$ast['LastName']?>" id="last_name">
            UserName:<input type ="text" name ="user" value="<?=$ast['UserName']?>" id="user" >
            Password:<input type ="text" name ="pass"  value="<?=$ast['Password']?>" id="pass">
            Role:<input type ="text" name ="role" value="<?=$ast['Role']?>" id="role">
            Street Adress:<input type ="text" name ="street_add" value="<?=$ast['StreetAddress']?>" id="street_add" >
            City:<input type ="text" name ="city"  value="<?=$ast['City']?>" id="city">
            State:<input type ="text" name ="state" value="<?=$ast['State']?>" id="state">
            Zip:<input type ="text" name ="zip" value="<?=$ast['Zip']?>"  id="zip">
            Email:<input type ="text" name ="email" value="<?=$ast['Email']?>" id="email">
            Accumulated Commission:<input type ="text" name ="commission"value="<?=$ast['AccumulatedCommission']?>" id="commission"  >
            <input type = "Submit" name = "submit" value = "submit" class="btn"/>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>