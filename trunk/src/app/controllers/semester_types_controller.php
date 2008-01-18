<?php
class SemesterTypesController extends AppController {

	var $name = 'SemesterTypes';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->SemesterType->recursive = 0;
		$this->set('semesterTypes', $this->SemesterType->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Semester Type.');
			$this->redirect('/semester_types/index');
		}
		$this->set('semesterType', $this->SemesterType->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->SemesterType->save($this->data)) {
				$this->Session->setFlash('The Semester Type has been saved');
				$this->redirect('/semester_types/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Semester Type');
				$this->redirect('/semester_types/index');
			}
			$this->data = $this->SemesterType->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->SemesterType->save($this->data)) {
				$this->Session->setFlash('The SemesterType has been saved');
				$this->redirect('/semester_types/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Semester Type');
			$this->redirect('/semester_types/index');
		}
		if ($this->SemesterType->del($id)) {
			$this->Session->setFlash('The Semester Type deleted: id '.$id.'');
			$this->redirect('/semester_types/index');
		}
	}

}
?>