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
}
?>