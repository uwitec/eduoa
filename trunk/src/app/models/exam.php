<?php
class Exam extends AppModel {

	var $name = 'Exam';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Semester' =>
				array('className' => 'Semester',
						'foreignKey' => 'semester_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>