<?php
class Banji extends AppModel {

	var $name = 'Banji';

	var $belongsTo = array(
			'Teacher' =>
				array('className' => 'Teacher',
						'foreignKey' => 'teacher_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'AcademicYear' =>
				array('className' => 'AcademicYear',
						'foreignKey' => 'academic_year_id',
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

	);

}
?>