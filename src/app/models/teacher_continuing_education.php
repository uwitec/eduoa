<?php
class TeacherContinuingEducation extends AppModel {

	var $name = 'TeacherContinuingEducation';

	var $belongsTo = array(
			'Teacher' =>
				array('className' => 'Teacher',
						'foreignKey' => 'teacher_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>