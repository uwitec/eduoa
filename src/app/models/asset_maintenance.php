<?php
class AssetMaintenance extends AppModel {

	var $name = 'AssetMaintenance';

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

	);

}
?>