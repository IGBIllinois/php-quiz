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

<title><?php echo settings::get_title(); ?></title>
</head>

<body>
<nav class="navbar navbar-default">
	<div class='container-fluid'>
		<div class='navbar-header'>
	        	<a class='navbar-brand' href='#'><?php echo settings::get_title(); ?></a>
		</div>

<?php
if($isAuthenticated) {

	echo "<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navbarCollapse'>";
	echo "<span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span>";
	echo "</button>";
	echo "<div id='navbarCollapse' class='collapse navbar-collapse'>";
	echo "<ul class='nav navbar-nav navbar-right'>";
	
	if($authenticate->getAuthenticatedUser()->getUserRole()== User::ROLE_ADMIN || $authenticate->getAuthenticatedUser()->getUserRole()== User::ROLE_MODERATOR)
	{
		echo "<li><a href='index.php?p=about'>About</a></li>";
		echo "<li><a href='index.php?p=admin'>Admin</a></li>";
        }
	echo "<li><a href='index.php?logout=true'>Logout</a></li>";
	echo "</ul></div>";	
}
?>
	</div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
