﻿<?php
class Hour extends AppModel {

	var $name = 'Hour';

	var $hasAndBelongsToMany = array(
			'Week' =>
				array('className' => 'Week',
						'joinTable' => 'curriculum_schedules',
						'foreignKey' => '',
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