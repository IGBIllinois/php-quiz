<?php
/**
 * includes/quiz_list_admin.php
 * list quizzes available to modify
 */
$quiz = new Quiz($sqlDataBase);

if(isset($_POST['add_quiz']))
{
	foreach ($_POST as $var) {
                $var = trim(rtrim($var));
        }
	$quiz->CreateQuiz($_POST['quiz_name'],$_POST['quiz_desc'],$_POST['website']);
}

if(isset($_GET['quiz_action']))
{
    $quiz->LoadQuiz($_GET['quiz_id']);

    if($_GET['quiz_action']=="del")
    {
        $quiz->setQuizStatus(Quiz::DELETED);
    }
    if($_GET['quiz_action']=="act")
    {
        $quiz->setQuizStatus(Quiz::ACTIVE);
    }

    $quiz->UpdateQuiz();
}
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3>Quizzes List:</h3></div>
<div class="panel-body">
<a href="index.php?p=admin"><< Back</a><br><br>
<form action="index.php?p=quizzes" method="post" class='form-horizontal'>
	<div class='form-group'>
		<label for='quiz_name' class='col-md-2 control-label'>Quiz Name</label>
		<div class='col-md-4'>
			<input type='text' class='form-control' name="quiz_name">
		</div>
	</div>
	<div class='form-group'>
		<label for='quiz_desc' class='col-md-2 control-label'>Quiz Description</label>
		<div class='col-md-4'>
    		<textarea class='form-control' name="quiz_desc" rows="5" cols='74'></textarea>
		</div>
	</div>
	<div class='form-group'>
		<label for='website' class='col-md-2 control-label'>Quiz Material Website</label>
		<div class='col-md-4'>
			<input type='text' class='form-control' name='website' id='website'>
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-6'>
			<input type="submit" value="Add Quiz" name="add_quiz" class="btn btn-primary">
		</div>
	</div>
</form>
                <div class="panel panel-info">
                <div class="panel-heading"><h3>Active Quizzes:</h3></div>
                <div class="panel-body">
				<table class="table">
					<?php
                    $quizzesList = $quiz->ListQuizzes(Quiz::ACTIVE);
					foreach($quizzesList as $id=>$quizInfo)
                    {
						echo "<tr><td width=\"230\"><b>".$quizInfo['quiz_text']."</b></td>";
						echo "<td width=\"100\"><a href=\"index.php?p=edit_quiz&quiz_id=".$quizInfo['quiz_id']."\">Edit</a> | <a href=\"index.php?p=quizzes&quiz_id=".$quizInfo['quiz_id']."&quiz_action=del\">Delete</a></td>";
						echo "</tr>";
					} 
					?>
				</table>
                </div>
                </div>

                <div class="panel panel-info">
                <div class="panel-heading"><h3>Deleted Quizzes:</h3></div>
                <div class="panel-body">
                <table class="table">
                    <?php
                    $quizzesList = $quiz->ListQuizzes(Quiz::DELETED);
                    foreach($quizzesList as $id=>$quizInfo)
                    {
                        echo "<tr><td width=\"230\"><b>".$quizInfo['quiz_text']."<b></td>";
                        echo "<td width=\"100\"><a href=\"index.php?p=edit_quiz&quiz_id=".$quizInfo['quiz_id']."\">Edit</a> | <a href=\"index.php?p=quizzes&quiz_id=".$quizInfo['quiz_id']."&quiz_action=act\">Activate</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                </div>
                </div>
</div>
