<?php
class Week extends AppModel {

	var $name = 'Week';

	var $hasAndBelongsToMany = array(

			'Hour' =>
				array('className' => 'Hour',
						'joinTable' => 'curriculum_schedules',
						'foreignKey' => 'week_id',
						'associationForeignKey' => 'hour_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'uniq' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);
}
?>