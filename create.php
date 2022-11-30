<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if(isset($_POST['submit'])) {
    $Id = isset($_POST['Id']) && !empty($_POST['Id']) && $_POST['Id'] != 'auto' ? $_POST['Id'] : NULL;
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
    $stmt = $pdo->prepare('INSERT INTO Associates (Id,FirstName, LastName, UserName, Password, Role, StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->execute([$Id,$first,$last,$user,$pass,$role,$st_ad,$city,$state,$zip,$email,$comi]);
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Associate</h2>
    <form action="create.php" method="post">
            <label for="Id">ID</label>
            <input type="text" name="Id" placeholder="26" value="auto" id="Id">
            First Name:<input type = "text" name = "first_Name"  id="first_name">
            Last Name:<input type ="text" name ="last_name"  id="last_name">
            UserName:<input type ="text" name ="user"  id="user" >
            Password:<input type ="text" name ="pass"   id="pass">
            Role:<input type ="text" name ="role"  id="role">
            Street Adress:<input type ="text" name ="street_add"  id="street_add" >
            City:<input type ="text" name ="city"   id="city">
            State:<input type ="text" name ="state"  id="state">
            Zip:<input type ="text" name ="zip"   id="zip">
            Email:<input type ="text" name ="email"  id="email">
            Accumulated Commission:<input type ="text" name ="commission" id="commission"  >
            <input type = "Submit" name = "submit" value = "submit" class="btn"/>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>