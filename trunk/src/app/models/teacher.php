<?php
class Teacher extends AppModel {

	var $name = 'Teacher';

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

	var $hasAndBelongsToMany = array(
			'Banji' =>
				array('className' => 'Banji',
						'joinTable' => 'tearcher_work_infos',
						'foreignKey' => 'banji_id',
						'associationForeignKey' => '',
						'conditions' => '',
						'fields' => '',
						'order' => 'Banji.id',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

			'Course' =>
				array('className' => 'Course',
						'joinTable' => 'courses',
						'foreignKey' => 'course_id',
						'associationForeignKey' => '',
						'conditions' => '',
						'fields' => '',
						'order' => 'Course.id',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);

}
?>