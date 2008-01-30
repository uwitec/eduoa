<?php
class StudentParticularChange extends AppModel {

	var $name = 'StudentParticularChange';

	var $belongsTo = array(
			'Student' =>
				array('className' => 'Student',
						'foreignKey' => 'student_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'User' =>
				array('className' => 'User',
						'foreignKey' => 'user_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'OldClass' =>
				array('className' => 'Banji',
						'foreignKey' => 'old_banji_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'NewClass' =>
				array('className' => 'Banji',
						'foreignKey' => 'new_banji_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}

/* 待确认，直接操作controller
function afterSave(){
	if ($id = $this->getLastInsertID()){

			$strSQL =	" 
						update 
							students 
						set 
							banji_id = $this->data['StudentParticularChange']['new_banji_id']
						where
							id = $this->data['StudentParticularChange']['student_id']
						";
			$this->execute($strSQL);

	}
}
*/


?>