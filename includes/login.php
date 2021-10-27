<?php
/**
 * includes/login.php
 * Show a login prompt
 */
//Build GET url so when we submit the login form we will go to the original destination
$getUrl = "";
foreach($_GET as $name => $value)
{
    if($name!='logout')
    {
    	$getUrl .= $name."=".$value."&";
    }
}
$quiz = new Quiz($sqlDataBase);
$quizzesList = $quiz->ListQuizzes();
$quiz_html = "";
foreach ($quizzesList as $selectedQuiz) {
	if ($selectedQuiz['status'] && $selectedQuiz['website'] != "") {
		$quiz_html .= "<tr>";
		$quiz_html .= "<td><strong>" . $selectedQuiz['quiz_text'] . "</strong></td>";
		$quiz_html .= "<td><a class='btn btn-primary' href='" . $selectedQuiz['website'] . "'>Click Here</a></td>";
		$quiz_html .= "</tr>";


	}

}
?>
<div class='row'>
<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
<div class='panel panel-primary'>
	<div class='panel-heading'>
		<h3>IGB Training Materials</h3>
	</div>
	<div class='panel-body'>
		<table class='table'>
			<?php echo $quiz_html; ?>
		</table>
	</div>
</div>
</div>
<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3>IGB Online Safety Exam Login</h3>
    </div>
    <div class="panel-body">
			<form method="post" action="index.php?<?php echo $getUrl; ?>" name="login">
                <div class="form-group">
			<label>Netid:</label>
			<div class='input-group'>
				<input class="form-control" type="text" name="username" value="<?php if (isset($_POST['username'])) { echo $_POST['username']; } ?>" autofocus tabindex='1' autocapitalize='off'>
				<div class='input-group-addon'>
					<i class='fas fa-user'></i>
				</div>
			</div>
                 </div>
                <div class="form-group">
			<label>IGB Password:</label>
			<div class='input-group'>
				<input class="form-control" type="password" name="password" tabindex='2'>
				<div class='input-group-addon'>
					<i class='fas fa-lock'></i>
				</div>
			</div>
                </div>
				<input type="submit" value="Login" name="logon" alt="submit" class="btn btn-lg btn-primary" >
			</form>
        </div>
    </div>

<?php 
if($authenticate->getLogonError())
{
    echo "<div class=\"alert alert-danger\" role=\"alert\">";
    echo "<b>".$authenticate->getLogonError()."</b> <br>Please try again please.";
    echo "</div>";
}

if (defined('PASSWORD_RESET_URL') && PASSWORD_RESET_URL !== "") {
	echo "<div class='text-center'><a href='" . PASSWORD_RESET_URL . "'>Reset Password</a></div>";
	echo "<hr>";

}


?>
</div>
</row>
