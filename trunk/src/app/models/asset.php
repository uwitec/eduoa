<?php
class Asset extends AppModel {

	var $name = 'Asset';

	var $belongsTo = array(
			'AssetType' =>
				array('className' => 'AssetType',
						'foreignKey' => 'asset_type_id',
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

			'AssetStatus' =>
				array('className' => 'AssetStatus',
						'foreignKey' => 'asset_status_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'AssetInMethod' =>
				array('className' => 'AssetInMethod',
						'foreignKey' => 'asset_in_method_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>