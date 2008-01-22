<?php
class ExamResult extends AppModel {

	var $name = 'ExamResult';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
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

}
?>