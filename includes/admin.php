<?php
/**
 * includes/admin.php
 * List administration options
 */
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3>Admin Options</h3></div>
<div class="panel-body">

<a href="index.php?p=users_results" class="navigation"><b>Users Quiz Results</b></a><br><br>

<?php 
if ($authenticate->getAuthenticatedUser()->getUserRole() == User::ROLE_ADMIN) {
	echo "<a href='index.php?p=quizzes' class='navigation'><b>Edit Quiz</b></a><br><br>";
	echo "<a href='index.php?p=permission' class='navigation'><b>User Permissions</b></a>";
}
?>


