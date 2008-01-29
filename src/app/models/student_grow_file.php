<?php
class StudentGrowFile extends AppModel {

	var $name = 'StudentGrowFile';

	var $belongsTo = array(
			'Student' =>
				array('className' => 'Student',
						'foreignKey' => 'student_id',
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

			'GrowFileType' =>
				array('className' => 'GrowFileType',
						'foreignKey' => 'grow_file_type_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>