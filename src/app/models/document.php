<?php
class Document extends AppModel {

	var $name = 'Document';

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

	var $hasAndBelongsToMany = array(

			'Banji' =>
				array('className' => 'Banji',
						'joinTable' => 'doc_class_receiving_logs',
						'foreignKey' => 'document_id',
						'associationForeignKey' => 'banji_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);

}
?>