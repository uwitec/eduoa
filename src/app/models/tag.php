<?php
class Tag extends AppModel {

	var $name = 'Tag';
	var $validate = array(
		'id' => VALID_NUMBER,
		'name' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Post' =>
				array('className' => 'Post',
						'joinTable' => 'posts_tags',
						'foreignKey' => 'tag_id',
						'associationForeignKey' => 'post_id',
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