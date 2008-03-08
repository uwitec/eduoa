<?php
class EmailBox extends AppModel {

	var $name = 'EmailBox';

	var $belongsTo = array(
			'User' =>
				array('className' => 'User',
						'foreignKey' => 'user_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	function findSendCount($from_id = null){
		$conditions = "select count(*) from emails ";
		if($from_id <> 1) {
			$conditions .= " where  from_id = ".$from_id;
		}		
		$ret = $this->findBySql($conditions);
		return $ret[0][0]['count(*)'];
	}

	function findReceiveCount($to_id = null){
		$conditions = "select count(*) from emails ";
		if($to_id <> 1) {
			$conditions .= " where  to_id = ".$to_id;
		}	
		$ret = $this->findBySql($conditions);
		return $ret[0][0]['count(*)'];	
	}

}
?>