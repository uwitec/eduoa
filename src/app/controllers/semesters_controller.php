<?php
class SemestersController extends AppController {

	var $name = 'Semesters';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Semester->recursive = 0;
		$this->set('semesters', $this->Semester->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Semester.');
			$this->redirect('/semesters/index');
		}
		$this->set('semester', $this->Semester->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('semesterTypes', $this->Semester->SemesterType->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Semester->save($this->data)) {
				$this->Session->setFlash('The Semester has been saved');
				$this->redirect('/semesters/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('semesterTypes', $this->Semester->SemesterType->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Semester');
				$this->redirect('/semesters/index');
			}
			$this->data = $this->Semester->read(null, $id);
			$this->set('semesterTypes', $this->Semester->SemesterType->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Semester->save($this->data)) {
				$this->Session->setFlash('The Semester has been saved');
				$this->redirect('/semesters/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('semesterTypes', $this->Semester->SemesterType->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Semester');
			$this->redirect('/semesters/index');
		}
		if ($this->Semester->del($id)) {
			$this->Session->setFlash('The Semester deleted: id '.$id.'');
			$this->redirect('/semesters/index');
		}
	}

}
?>