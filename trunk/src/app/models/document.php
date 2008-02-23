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

	function afterSave(){
		if ($document_id = $this->getLastInsertID()){

			if($this->data['Document']['is_sms'] == 1) {
				$strSQL = "
							insert into phs_submit(
													sSchoolCode,
													nNeddReport,
													nPriority,
													sServerID,
													nMsgFormat,
													sFeeType,
													sFeeCode,
													sFixedFee,
													sSendTime,
													sChargeTermID,
													sDestTermID,
													sReplyPath,
													nMsgLength,
													cMsgCont,
													nMsgType,
													sInsertTime,
													sError,
													sState,
													sDoor
												)
										select 				
											(SELECT bank_no FROM units limit 1 ),
											0,
											0,
											'950000',
											'15',
											'00',
											'000000',
											'000000',
											documents.sms_date,
											students.father_phone,
											students.father_phone,
											students.father_phone,
											length(documents.title),
											documents.title,
											0,
											now(),
											0,
											0,
											'T02' 
							";
				if($this->data['Document']['is_commons'] == 1){
					$strSQL .= " FROM 
											students,documents
										WHERE 
											students.father_phone is not null and documents.id = ".$document_id;
				}else {
					$strSQL .= " FROM 
											students,documents,doc_class_receiving_logs
										WHERE 
											students.father_phone is not null 
											AND students.banji_id = doc_class_receiving_logs.banji_id
											AND documents.id = doc_class_receiving_logs.document_id
											AND documents.id = ".$document_id;			
				}

				$this->execute($strSQL);
			}


		}
	}

}
?>