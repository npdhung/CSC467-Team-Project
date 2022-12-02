<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if(isset($_POST['submit'])) {
        $first=$_REQUEST['first_name'];
        $last=$_REQUEST['last_name'];
        $user=$_REQUEST['user'];
        $pass=$_REQUEST['pass'];
        $role=$_REQUEST['role'];
        $st_ad=$_REQUEST['street_add'];
        $city=$_REQUEST['city'];
        $state=$_REQUEST['state'];
        $zip=$_REQUEST['zip'];
        $email=$_REQUEST['email'];
        $comi=$_REQUEST['commission'];
    $stmt = $pdo->prepare('INSERT INTO Associates (FirstName, LastName, UserName, Password, Role, StreetAddress, City, State, Zip, Email, AccumulatedCommission) 
    VALUES(?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->execute(array($first,$last,$user,$pass,$role,$st_ad,$city,$state,$zip,$email,$comi));
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Associate</h2>
    <form action="" method="POST">
            <label for="first_name">First Name:</label>
            <input type = "text" name = "first_name"  id="first_name">
            <label for="last_name">Last Name:</label>
            <input type ="text" name ="last_name"  id="last_name">
            <label for="user">Username:</label>
            <input type ="text" name ="user"  id="user" >
            <label for="pass">Password:</label>
            <input type ="text" name ="pass"   id="pass">
            <label for="role">Role:</label>
            <input type ="text" name ="role"  id="role">
            <label for="street_add">Street Adress:</label>
            <input type ="text" name ="street_add"  id="street_add" >
            <label for="city">City:</label>
            <input type ="text" name ="city"   id="city">
            <label for="state">State:</label>
            <input type ="text" name ="state"  id="state">
            <label for="zip">Zip Code:</label>
            <input type ="text" name ="zip"   id="zip">
            <label for="email">Email:</label>
            <input type ="text" name ="email"  id="email">
            <label for="commission">Accumulated Commission:</label>
            <input type ="text" name ="commission" id="commission"  >
            <input type = "Submit" name = "submit" value = "submit" class="btn"/>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>