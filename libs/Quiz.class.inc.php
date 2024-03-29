<?php
/**
 * Created by PhpStorm.
 * User: nevoband
 * Date: 6/20/14
 * Time: 10:17 AM
 */


class Quiz {

    const ACTIVE=1, DELETED=0;

    private $quizId;
    private $quizName;
    private $quizDescription;
    private $quizStatus;
    private $quizPassScore;
    private $certificate_msg;
    private $website;
    private $db;


    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function __destruct()
    {

    }

    /**Load quiz from database into this object
     * @param $quizId
     */
    public function LoadQuiz($quizId)
    {
        $sql = "SELECT * FROM quiz WHERE quiz_id=:quiz_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(":quiz_id"=>$quizId));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $this->quizName = $result['quiz_text'];
        $this->quizDescription = $result['quiz_desc'];
        $this->quizId = $result['quiz_id'];
        $this->quizPassScore = $result['passing_score'];
	$this->certificate_msg = $result['quiz_certificate_msg'];
	$this->website = $result['website'];
	$this->quizStatus = $result['status'];
    }

    /**Create a new quiz in database and load it into this object
     * @param $quizName
     * @param $quizDescription
     * @param $website
     */
    public function CreateQuiz($quizName, $quizDescription,$website)
    {
        echo $quizName." ".$quizDescription;
        $sql = "INSERT INTO quiz (quiz_text, quiz_desc,status,passing_score,website) ";
	$sql .= "VALUES(:quiz_text, :quiz_desc,:status,:passing_score,:website)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':quiz_text'=>$quizName, ':quiz_desc'=>$quizDescription,':status'=>Quiz::ACTIVE,':passing_score'=>DEFAULT_PASS_SCORE,':website'=>$website));
        $this->quizId = $this->db->lastInsertId();
        $this->quizName = $quizName;
        $this->quizDescription = $quizDescription;
	$this->website = $website;
	$this->quizStatus = Quiz::ACTIVE;
    }

    /**
     * Update quiz from setters
     */
    public function UpdateQuiz()
    {
        $sql = "UPDATE quiz SET quiz_text=:quiz_text, quiz_desc=:quiz_desc, status=:status, passing_score=:passing_score, quiz_certificate_msg=:certificate_msg, website=:website ";
	$sql .= "WHERE quiz_id=:quiz_id LIMIT 1";
	try {
        	$query = $this->db->prepare($sql);
	        $parameters =array(':quiz_text'=>$this->quizName,
			':quiz_desc'=>$this->quizDescription,
			':status'=>$this->quizStatus, 
			':quiz_id'=>$this->quizId,
			':passing_score'=>$this->quizPassScore,
			':certificate_msg'=>$this->certificate_msg,
			':website'=>$this->website
			);
		echo "<br>";
		$query->execute($parameters);

		if ($query->rowCount()) {
			return true;
		}
	}
	catch (PDOException $e) {
		echo $e->getMessage();
	}
	return false;
    }

    /**Load question give question order number
     * @param $questionNum
     * @return Question
     */
    public function LoadQuestion($questionNum)
    {
        $question = new Question($this->db);
        $question->LoadQuestion($questionNum);

        return $question;
    }

    /**Load question given question id
     * @param $questionId
     * @return Question
     */
    public function LoadQuestionById($questionId)
    {
        $question = new Question($this->db);
        $question->LoadQuestion($questionId);

        return $question;
    }

    /**List quizzes given the status
     * @param int $status
     * @return array
     */
    public function ListQuizzes($status = Quiz::ACTIVE)
    {
        $sql = "SELECT * FROM quiz WHERE status=:status";
        $query = $this->db->prepare($sql);
        $query->execute(array(':status'=>$status));
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    /**List all quizzes
     * @return array
     */
    public function ListAllQuizzes()
    {
        $sql = "SELECT * FROM quiz";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    /**get the first question of the quiz
     * @return Question
     */
    public function GetFirstQuestion()
    {
        $firstQuestion = new Question($this->db);
        $sql = "SELECT question_id FROM question WHERE quiz_id=:quiz_id AND status=:status ORDER BY order_num ASC LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(':quiz_id'=>$this->quizId,':status'=>Question::ACTIVE));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $firstQuestion->LoadQuestion($result['question_id']);

        return $firstQuestion;
    }

    /**List quiz questions
     * @param int $status
     * @return array
     */
    public function ListQuestions($status=Question::ACTIVE)
    {
        $sql = "SELECT * FROM question WHERE quiz_id=:quiz_id AND status=:status ORDER BY order_num ASC";
        $query = $this->db->prepare($sql);
        $query->execute(array(':quiz_id'=>$this->quizId,':status'=>$status));
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    /**Get the number of questions in the quiz
     * @return mixed
     */
    public function QuestionCount()
    {
        $sql = "SELECT count(*) as num_questions FROM question WHERE quiz_id=:quiz_id AND status=:status";
        $query = $this->db->prepare($sql);
        $query->execute(array(':quiz_id'=>$this->quizId,':status'=>Question::ACTIVE));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['num_questions'];
    }

    //Getters and Setters
    /**
     * @param mixed $quizName
     */
    public function setQuizName($quizName)
    {
        $this->quizName = $quizName;
    }

    /**
     * @return mixed
     */
    public function getQuizName()
    {
        return $this->quizName;
    }

    /**
     * @param mixed $quizId
     */
    public function setQuizId($quizId)
    {
        $this->quizId = $quizId;
    }

    /**
     * @return mixed
     */
    public function getQuizId()
    {
        return $this->quizId;
    }

    /**
     * @param mixed $quizDescription
     */
    public function setQuizDescription($quizDescription)
    {
        $this->quizDescription = $quizDescription;
    }

    /**
     * @return mixed
     */
    public function getQuizDescription()
    {
        return $this->quizDescription;
    }

    /**
     * @param mixed $quizStatus
     */
    public function setQuizStatus($quizStatus)
    {
        $this->quizStatus = $quizStatus;
    }

    /**
     * @return mixed
     */
    public function getQuizStatus()
    {
        return $this->quizStatus;
    }

    /**
     * @param mixed $quizPassScore
     */
    public function setQuizPassScore($quizPassScore)
    {
        $this->quizPassScore = $quizPassScore;
    }

    /**
     * @return mixed
     */
    public function getQuizPassScore()
    {
        return $this->quizPassScore;
    }

	public function setCertificateMsg($certificate_msg) {

		$this->certificate_msg = $this->certificate_msg;
	}

	public function getCertificateMsg() { 
		if ($this->certificate_msg != "") {
			return $this->certificate_msg;
		}
		return false;

	}

	public function setWebsite($website) {
		$this->website = $website;

	}
	public function getWebsite() {
		if ($this->website != "") {
			return $this->website;
		}
		return false;
		
	}
}
