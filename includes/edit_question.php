<?php 

$quiz = new Quiz($sqlDataBase);
$question = new Question($sqlDataBase);
$answer = new Answer($sqlDataBase);

$editAnswer = false;
$answerText = "";

if(isset($_GET['question_id']))
{
    $question->LoadQuestion($_GET['question_id']);
    $quiz->LoadQuiz($question->getQuizId());
}

if(isset($_GET['answer_id']))
{
    $answer->LoadAnswer($_GET['answer_id']);
}

if(isset($_GET['answer_action']))
{
    if($_GET['answer_action']=='del')
    {
        $answer->setAnswerStatus(Answer::DELETED);
        $answer->UpdateAnswer();
    }
    if($_GET['answer_action']=='edit')
    {
        $answerText = $answer->getAnswerText();
        $editAnswer = true;
    }
}

if(isset($_POST['update_question']))
{
    $question->setQuestionText($_POST['question_text']);
    $question->setQuestionPoints($_POST['question_points']);
    $question->UpdateQuestion();
    $question->QuestionOrder($_POST['question_order']);

    $correctAnswerArr = $_POST['correct_answer'];
    $correctAnswerIdArr = array();

    foreach($correctAnswerArr as $id=>$correctAnswerId)
    {
        $correctAnswerIdArr[] = $correctAnswerId;
    }

    $question->SetCorrectAnswers($correctAnswerIdArr);

    if(isset($_FILES['question_image']))
    {
        if(is_uploaded_file($_FILES['question_image']['tmp_name']))
        {
            move_uploaded_file($_FILES['question_image']['tmp_name'],UPLOAD_DIR.$question->getQuestionId().".jpg");
        }
    }
}

if(isset($_POST['edit_answer']))
{
    $answer->LoadAnswer($_POST['edit_answer_id']);
    $answer->setAnswerText($_POST['answer_text']);
    $answer->SetAnswerOrder($_POST['answer_order']);
    $answer->UpdateAnswer();
}

if(isset($_POST['add_answer']))
{
    $answer = new Answer($sqlDataBase);
    $answer->CreateAnswer($_POST['answer_text'],0,$question->getQuestionId());
}

if(isset($_POST['delete_image']))
{
    unlink(UPLOAD_DIR.$question->getQuestionId().".jpg");
}

$answersList = $question->GetAnswers();


echo "<div class=\"panel panel-primary\">";
echo "<div class=\"panel-heading\"><h3>".$quiz->getQuizName()."</h3></div>";
echo "<div class=\"panel-body\">";
echo "<a href=\"index.php?p=edit_quiz&quiz_id=".$question->getQuizId()."\"><< Back</a><br><br>";
echo "<b>Question:</b><br />";

?>
<form method="post" enctype="multipart/form-data" action="index.php?p=edit_question&question_id=<?php echo $question->getQuestionId(); ?>">
<?php 
echo "<textarea rows=\"5\" cols=\"50\" style=\"font-size:14px; color:black;  border:1px solid black; background-color:#dbeaf5;\" name=\"question_text\">".$question->getQuestionText()."</textarea><br>";
echo "Question Order Number: ";
echo "<select name=\"question_order\">";

$questionsCount = $quiz->QuestionCount();
for($order=0; $order<=$questionsCount; $order++)
{
    echo "<option value=".$order;
    if($order == $question->getQuestionOrder())
    {
        echo " selected";
    }
    echo ">".$order."</option>";
}
echo "</select><br>";
echo "Question Points: ";
echo "<input type=\"text\" name=\"question_points\" value=\"".$question->getQuestionPoints()."\" size=5>";
?>
<br /><br>
<b>Add Answer:</b><br>
<?php
echo "<textarea rows=\"5\" cols=\"50\" style=\"font-size:14px; color:black;  border:1px solid black; background-color:#dbeaf5;\" name=\"answer_text\">".$answerText."</textarea>";
echo "<input type=\"hidden\" value=".$answer->getAnswerId()." name=\"edit_answer_id\"><br>";
echo "Answer Order Number: ";
echo "<select name=\"answer_order\">";

$answersCount = $question->GetAnswersCount();
for($order=0; $order<=$answersCount; $order++)
{
    echo "<option value=".$order;
    if($order == $answer->getAnswerOrder())
    {
        echo " selected";
    }
    echo ">".$order."</option>";
}
echo "</select>";
?>
    <br>
   <?php

   if($editAnswer)
   {
       echo "<input type=\"submit\" value=\"Edit Answer\" name=\"edit_answer\" class=\"btn btn-primary\"";
   }
   else
   {
        echo "<input type=\"submit\" value=\"Add Answer\" name=\"add_answer\" class=\"btn btn-primary\">";
   }
?>
<br><br><br>
<b>Answer Choices:</b><br>
<table class="table">
    <tr>
        <th>Option</th>
        <th>Order</th>
        <th>Correct</th>
        <th>Answer</th>
    </tr>
	<?php
    foreach($answersList as $id=>$answerInfo)
    {
        echo "<tr><td align=\"center\"><a href=\"index.php?p=edit_question&question_id=".$question->getQuestionId()."&answer_id=".$answerInfo['answer_id']."&answer_action=edit\">Edit</a> |
        <a href=\"index.php?p=edit_question&question_id=".$question->getQuestionId()."&answer_id=".$answerInfo['answer_id']."&answer_action=del\">Delete</a></td>
        <td align=\"center\"><b>".$answerInfo['order_num'].") </b></td>
        <td align=\"center\"><input type=\"checkbox\" name=\"correct_answer[]\" value=".$answerInfo['answer_id']." ".($answerInfo['correct_answer']?"checked":"")."></td>
        <td align=\"left\"><b>".$answerInfo['answer_text']."</b></td></tr>";
	}
	?>

</table>
<br />
<b>Question Image:</b><br>

<br />
<?php
if(file_exists(UPLOAD_DIR.$question->getQuestionId().".jpg"))
{
    echo "<img src=\"".UPLOAD_DIR.$question->getQuestionId().".jpg\"><br>";
    echo "<input type=\"submit\" value=\"Delete Image\" name=\"delete_image\" class=\"btn btn-primary\">";
}
else{
    echo "<input type=\"file\" name=\"question_image\" class=\"btn btn-warning\">";
}
?>
<br /><br />
<table >
	<tr>
		<td><input type="submit" value="Update Question" name="update_question" class="btn btn-primary"></td>
	</tr>
</table>

</form>
</div>
</div>