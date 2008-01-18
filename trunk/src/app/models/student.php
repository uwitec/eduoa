<?php
class Student extends AppModel {

	var $name = 'Student';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Banji' =>
				array('className' => 'Banji',
						'foreignKey' => 'banji_id',
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