<?php
class Document extends AppModel {

	var $name = 'Document';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'DocumentType' =>
				array('className' => 'DocumentType',
						'foreignKey' => 'document_type_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Rate' =>
				array('className' => 'Rate',
						'foreignKey' => 'rate_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Course' =>
				array('className' => 'Course',
						'foreignKey' => 'course_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>