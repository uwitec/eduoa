<?php
class Post extends AppModel {

	var $name = 'Post';
	var $validate = array(
		'id' => VALID_NUMBER,
		'title' => VALID_NOT_EMPTY,
		'body' => VALID_NOT_EMPTY,
		'status' => VALID_NUMBER,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Tag' =>
				array('className' => 'Tag',
						'joinTable' => 'posts_tags',
						'foreignKey' => 'post_id',
						'associationForeignKey' => 'tag_id',
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