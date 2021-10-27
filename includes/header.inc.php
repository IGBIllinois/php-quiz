<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

<script type='text/javascript' src='vendor/components/jquery/jquery.min.js'></script>
<script type='text/javascript' src='vendor/twbs/bootstrap/dist/js/bootstrap.min.js'></script>

<link rel="stylesheet" type="text/css" href='vendor/twbs/bootstrap/dist/css/bootstrap.min.css'>
<link rel="stylesheet" type="text/css" href="vendor/fortawesome/font-awesome/css/all.min.css">

<title><?php echo TITLE; ?></title>
</head>

<body>
<nav class="navbar navbar-default">
	<div class='container-fluid'>
		<div class='navbar-header'>
	        	<a class='navbar-brand' href='#'><?php echo TITLE; ?></a>
		</div>
	<div id='navbar' class='navbar-collapse collapse'>
	<ul class='nav navbar-nav navbar-right'>	

<?php
if($isAuthenticated) {
	echo "<li><a href='#'>Version: " . VERSION . "</a></li>";
	if($authenticate->getAuthenticatedUser()->getUserRole()== User::ROLE_ADMIN || $authenticate->getAuthenticatedUser()->getUserRole()== User::ROLE_MODERATOR)
	{
		echo "<li><a href='index.php?p=admin'>Admin</a></li>";
        }
	echo "<li><a href='index.php?logout=true'>Logout</a></li>";
}
?>
	</ul>
	</div>
	</div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
