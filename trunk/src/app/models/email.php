<?php
class Email extends AppModel {

	var $name = 'Email';

	var $belongsTo = array(
			'EmailBox' =>
				array('className' => 'EmailBox',
						'foreignKey' => 'email_box_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	/*
	var $hasMany = array(
			'EmailAttachment' =>
				array('className' => 'EmailAttachment',
						'foreignKey' => 'email_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);
	*/

}
?>