<?php
class Teacher extends AppModel {

	var $name = 'Teacher';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' =>
				array('className' => 'User',
						'foreignKey' => 'user_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Person' =>
				array('className' => 'Person',
						'foreignKey' => 'people_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Degree' =>
				array('className' => 'Degree',
						'foreignKey' => 'degree_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Department' =>
				array('className' => 'Department',
						'foreignKey' => 'department_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'File' =>
				array('className' => 'File',
						'foreignKey' => 'file_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>