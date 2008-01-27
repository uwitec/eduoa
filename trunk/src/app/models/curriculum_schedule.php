<?php
class CurriculumSchedule extends AppModel {

	var $name = 'CurriculumSchedule';

	var $belongsTo = array(
			'Banji' =>
				array('className' => 'Banji',
						'foreignKey' => 'banji_id',
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

			'Classroom' =>
				array('className' => 'Classroom',
						'foreignKey' => 'classroom_id',
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

			'Teacher' =>
				array('className' => 'Teacher',
						'foreignKey' => 'teacher_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
			
			'Hour' =>
				array('className' => 'Hour',
						'foreignKey' => 'hour_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Week' =>
				array('className' => 'Week',
						'foreignKey' => 'week_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>