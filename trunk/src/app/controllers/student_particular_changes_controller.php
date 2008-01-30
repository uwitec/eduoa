<?php
class StudentParticularChangesController extends AppController {

	var $name = 'StudentParticularChanges';
	var $helpers = array('Html', 'Form' );

	function index($id = null) {
		$this->StudentParticularChange->recursive = 0;
		if(empty($id)) {
			$this->set('studentParticularChanges', $this->StudentParticularChange->findAll());
		}else {
			$this->set('studentParticularChanges', $this->StudentParticularChange->findAll(' student_id = '.$id));
		}
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student Particular Change.');
			$this->redirect('/student_particular_changes/index');
		}
		$this->set('studentParticularChange', $this->StudentParticularChange->read(null, $id));
	}

	function add($id = null) {
		if (empty($this->data)) {
			$this->data = $this->StudentParticularChange->Student->read(null,$id);
			$this->set('student', $this->data);
			$this->set('oldClasses', 
						$this->StudentParticularChange->OldClass->generateList(
				         $conditions = ' Banji.id = '.$this->data['Banji']['id'],
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Banji.id',
			             $valuePath = '{n}.Banji.class_name')
			);
			$this->set('newClasses', 
						$this->StudentParticularChange->Banji->generateList(
				         $conditions = ' Banji.id <> '.$this->data['Banji']['id'],
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Banji.id',
			             $valuePath = '{n}.Banji.class_name')
			);

			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->StudentParticularChange->save($this->data)) {
				$this->Session->setFlash('调班操作成功！');

				$strSQL =	" update students set banji_id = ".$this->data['StudentParticularChange']['new_banji_id']." where id =".$this->data['StudentParticularChange']['student_id'] ;
				$this->StudentParticularChange->execute($strSQL);

				$this->redirect('/student_particular_changes/index/'.$this->data['StudentParticularChange']['student_id']);
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->StudentParticularChange->Student->generateList());
				$this->set('oldClasses', $this->StudentParticularChange->OldClass->generateList());
				$this->set('newClasses', $this->StudentParticularChange->NewClass->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Student Particular Change');
				$this->redirect('/student_particular_changes/index');
			}
			$this->data = $this->StudentParticularChange->read(null, $id);
			$this->set('students', $this->StudentParticularChange->Student->generateList());
			$this->set('oldClasses', $this->StudentParticularChange->OldClass->generateList());
			$this->set('newClasses', $this->StudentParticularChange->NewClass->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->StudentParticularChange->save($this->data)) {
				$this->Session->setFlash('The StudentParticularChange has been saved');
				$this->redirect('/student_particular_changes/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->StudentParticularChange->Student->generateList());
				$this->set('oldClasses', $this->StudentParticularChange->OldClass->generateList());
				$this->set('newClasses', $this->StudentParticularChange->NewClass->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student Particular Change');
			$this->redirect('/student_particular_changes/index');
		}
		if ($this->StudentParticularChange->del($id)) {
			$this->Session->setFlash('The Student Particular Change deleted: id '.$id.'');
			$this->redirect('/student_particular_changes/index');
		}
	}

}
?>