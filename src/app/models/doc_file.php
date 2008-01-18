<?php
class DocFile extends AppModel {

	var $name = 'DocFile';

	var $belongsTo = array(
			'Document' =>
				array('className' => 'Document',
						'foreignKey' => 'document_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'File' =>
				array('className' => 'File',
						'foreignKey' => 'file_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>