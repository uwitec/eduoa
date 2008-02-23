<?php
class Student extends AppModel {

	var $name = 'Student';

	var $belongsTo = array(
			'Banji' =>
				array('className' => 'Banji',
						'foreignKey' => 'banji_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Person' =>
				array('className' => 'Person',
						'foreignKey' => 'people_id',
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

	function graduate($year = null){
		$sql = "update students set status = 2
		          where exists(
				     select * from banjis 
					   where banjis.id = students.banji_id and banjis.entrance_year = $year)
                    and students.status = 1";
		$this->execute($sql);

		$sql = "update banjis set status = 2 where status = 1 and banjis.entrance_year = $year";
		$this->execute($sql);
	}

}
?>