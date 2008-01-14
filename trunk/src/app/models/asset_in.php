<?php
class AssetIn extends AppModel {

	var $name = 'AssetIn';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Asset' =>
				array('className' => 'Asset',
						'foreignKey' => 'asset_id',
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

	);

}
?>