<?php
class ExamResult extends AppModel {

	var $name = 'ExamResult';

	var $belongsTo = array(
			'Student' =>
				array('className' => 'Student',
						'foreignKey' => 'student_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Exam' =>
				array('className' => 'Exam',
						'foreignKey' => 'exam_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Semester' =>
				array('className' => 'Semester',
						'foreignKey' => 'semester_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Course' =>
				array('className' => 'Course',
						'foreignKey' => 'course_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	function findTotal($student_id = null, $semester_id = null, $exam_id = null){
		$conditions = "select sum(score) from exam_results where  student_id = $student_id and semester_id = $semester_id";
		$ret = $this->findBySql($conditions);
		return $ret[0][0]['sum(score)'];
	}

	function findScore($student_id = null, $semester_id = null, $exam_id = null, $course_id = null){
		$conditions = "ExamResult.student_id = $student_id and ExamResult.semester_id = $semester_id and ExamResult.course_id = $course_id";
		return $this->field('score',$conditions);
	}

	function findAverage($semester_id = null, $exam_id = null, $course_id = null){
		$conditions = "select avg(score) from exam_results where semester_id = $semester_id and course_id = $course_id";
		$ret = $this->findBySql($conditions);
		return $ret[0][0]['avg(score)'];
	}

	function findCountFlunk($semester_id = null, $exam_id = null, $course_id = null, $score = null){
		$conditions = "ExamResult.semester_id = $semester_id and ExamResult.course_id = $course_id and score < $score";
		return $this->findCount($conditions);
	}

	function findCountTotal($semester_id = null, $exam_id = null, $score = null){
		if($semester_id == null){
			$conditions = "$score";
		}else{
			$conditions = "ExamResult.semester_id =$semester_id and $score";
		}
		return $this->findCount($conditions);
	}

	function findCountTotalByBanji($banji_id = null, $semester_id = null, $exam_id = null, $score = null){
		if($semester_id == null){
			$conditions = "Student.banji_id = $banji_id and $score";
		}else{
			$conditions = "Student.banji_id = $banji_id and ExamResult.semester_id =$semester_id and $score";
		}
		return $this->findCount($conditions);
	}

	function findCountCourse($semester_id = null, $exam_id = null, $course_id = null,  $score = null){
		if($semester_id == null){
			$conditions = "ExamResult.course_id = $course_id and $score";
		}else{
			$conditions = "ExamResult.course_id = $course_id and ExamResult.semester_id = $semester_id and $score";
		}
		return $this->findCount($conditions);
	}

	function findCountCourseByBanji($banji_id = null, $semester_id = null, $exam_id = null, $course_id = null,  $score = null){
		if($semester_id == null){
			$conditions = "Student.banji_id = $banji_id and ExamResult.course_id = $course_id and $score";
		}else{
			$conditions = "Student.banji_id = $banji_id and ExamResult.course_id = $course_id and ExamResult.semester_id = $semester_id and $score";
		}
		return $this->findCount($conditions);
	}

	function findAllTotal($semester_id = null, $exam_id = null){
		$conditions = "ExamResult.semester_id = $semester_id";
		return $this->findCount($conditions);
	}

	function findAllTotalByBanji($banji_id = null, $semester_id = null, $exam_id = null){
		$conditions = "Student.banji_id = $banji_id and ExamResult.semester_id = $semester_id";
		return $this->findCount($conditions);
	}

	function findFlunkScore($student_id = null, $semester_id = null, $exam_id = null, $course_id = null, $score = null){
		$conditions = "ExamResult.student_id = $student_id and ExamResult.semester_id = $semester_id and ExamResult.course_id = $course_id and ExamResult.score < $score";
		return $this->field('score',$conditions);
	}

	function findAverageByBanji($banji_id = null, $semester_id = null, $exam_id = null){
		$conditions = "select avg(score) from exam_results where semester_id = $semester_id";
		$conditions .= " and exists(select * from students where students.banji_id = $banji_id";
		$conditions .= " and students.id = exam_results.student_id)";
		$ret = $this->findBySql($conditions);
		return $ret[0][0]['avg(score)'];
	}

    //分科不分班平均成绩
	function findAverageByCourse($course_id = null, $semester_id = null, $exam_id = null){
		$conditions = "select avg(score) from exam_results where semester_id = $semester_id and course_id = $course_id";
		$ret = $this->findBySql($conditions);
		return $ret[0][0]['avg(score)'];
	}

	//分科分班平均成绩
	function findAverageByCourseAndBanji($course_id = null, $banji_id = null, $semester_id = null, $exam_id = null){
		$conditions = "select avg(score) from exam_results where semester_id = $semester_id and course_id = $course_id";
		$conditions .= " and exists(select students.id from students where students.banji_id = $banji_id";
		$conditions .= " and students.id = exam_results.student_id)";
		$ret = $this->findBySql($conditions);
		return $ret[0][0]['avg(score)'];
	}
}
?>