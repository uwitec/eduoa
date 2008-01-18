<?php
class StudentParticularChangesController extends AppController {

	var $name = 'StudentParticularChanges';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->StudentParticularChange->recursive = 0;
		$this->set('studentParticularChanges', $this->StudentParticularChange->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student Particular Change.');
			$this->redirect('/student_particular_changes/index');
		}
		$this->set('studentParticularChange', $this->StudentParticularChange->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('students', $this->StudentParticularChange->Student->generateList());
			$this->set('oldClasses', $this->StudentParticularChange->OldClass->generateList());
			$this->set('newClasses', $this->StudentParticularChange->NewClass->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->StudentParticularChange->save($this->data)) {
				$this->Session->setFlash('The Student Particular Change has been saved');
				$this->redirect('/student_particular_changes/index');
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