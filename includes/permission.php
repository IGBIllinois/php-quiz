<?php
/**
 * Created by PhpStorm.
 * User: nevoband
 * Date: 7/28/14
 * Time: 1:18 PM
 */
$user = new User($sqlDataBase);

$message = "";
if(isset($_POST['submit_admin']) || isset($_POST['submit_moderator'])) {
	$_POST = array_map('trim',$_POST);
	$error = false;
	if ($_POST['username'] == "") {
		$message = "<div class='alert alert-danger'>Please specify a username</div>";
		$error = true;
	}
	elseif (!$ldap->is_ldap_user($_POST['username'])) {
		$message = "<div class='alert alert-danger'>User " . $_POST['username'] . " does not exist in LDAP</div>";
		$error = true;
	}
	if (!$error) {
		$user_id = $user->Exists($_POST['username']);
		if ($user_id) {
			$user->LoadUser($user_id);
		}
		else {
			$user->CreateUser($_POST['username'],$ldap);
		}
		if (isset($_POST['submit_moderator'])) {
			$user->SetRole(User::ROLE_MODERATOR);
			$message = "<div class='alert alert-success'>User " . $_POST['username'] . " succesfully made a Moderator</div>";

		}
		elseif (isset($_POST['submit_admin'])) {
			$user->SetRole(User::ROLE_ADMIN);
			$message = "<div class='alert alert-success'>User " . $_POST['username'] . " succesfully made an Admin</div>";
		}
		unset($_POST);
	}
}


if(isset($_GET['action']) && $_GET['action'] == 'demote')
{
    if(isset($_GET['user_id']))
    {
        $user->LoadUser($_GET['user_id']);
	$user->SetRole(User::ROLE_USER);
	$message = "<div class='alert alert-success'>User successfully removed</div>";
    }
}
?>
<div class="panel panel-primary">
    <div class="panel-heading"><h3>User Permissions</h3></div>
    <div class="panel-body">
    <a href="index.php?p=admin"><< Back</a><br><br>
<form class='form-inline' action="index.php?p=permission" method="post">

    Set user:
    <input class='form-control' name='username' type='text' value='<?php if (isset($_POST['username'])) { echo $_POST['username']; } ?>'>
    <input type="submit" value=" Set Admin " name="submit_admin" class="btn btn-primary">
    <input type="submit" value=" Set Moderator " name="submit_moderator" class="btn btn-primary">
</form>
        <br>
<table class="table">
	<thead>
		<th>User Name</th>
		<th>Role</th>
		<th>Option</th>
	</thead>
    <?php
    $adminList = $user->ListUsers(User::ROLE_ADMIN);
    $modList = $user->ListUsers(User::ROLE_MODERATOR);

    foreach($adminList as $id=>$adminInfo) {
        echo "<tr><td>".$adminInfo['user_name']."</td><td>ADMIN</td><td><a href=\"index.php?p=permission&action=demote&user_id=".$adminInfo['user_id']."\">Demote</a></td></tr>";
    }

    foreach($modList as $id=>$modInfo) {
        echo "<tr><td>".$modInfo['user_name']."</td><td>MODERATOR</td><td><a href=\"index.php?p=permission&action=demote&user_id=".$modInfo['user_id']."\">Demote</a></td></tr>";
    }

    ?>
</table>
</div></div>

<?php if (isset($message)) { echo $message; } ?>
