<?php
class Semester extends AppModel {

	var $name = 'Semester';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'SemesterType' =>
				array('className' => 'SemesterType',
						'foreignKey' => 'semester_type_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>