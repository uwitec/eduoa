<?php
class Classroom extends AppModel {

	var $name = 'Classroom';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'ClassroomType' =>
				array('className' => 'ClassroomType',
						'foreignKey' => 'classroom_type_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'TeachingBuilding' =>
				array('className' => 'TeachingBuilding',
						'foreignKey' => 'teaching_building_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>