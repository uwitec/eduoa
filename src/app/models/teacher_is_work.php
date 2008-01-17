<?php
class TeacherIsWork extends AppModel {

	var $name = 'TeacherIsWork';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Teacher' =>
				array('className' => 'Teacher',
						'foreignKey' => 'teacher_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>