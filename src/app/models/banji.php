<?php
class Banji extends AppModel {

	var $name = 'Banji';

	var $belongsTo = array(
			'Teacher' =>
				array('className' => 'Teacher',
						'foreignKey' => 'teacher_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'AcademicYear' =>
				array('className' => 'AcademicYear',
						'foreignKey' => 'academic_year_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Classroom' =>
				array('className' => 'Classroom',
						'foreignKey' => 'classroom_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	var $hasAndBelongsToMany = array(

			'Document' =>
				array('className' => 'Document',
						'joinTable' => 'doc_class_receiving_logs',
						'foreignKey' => 'banji_id',
						'associationForeignKey' => 'document_id',
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

	function findByYear($year = null){
		return $this->findAll("entrance_year = $year order by order_list");
	}

}
?>