<?php
class StudentGrowFilesController extends AppController {

	var $name = 'StudentGrowFiles';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->StudentGrowFile->recursive = 0;
		$this->set('studentGrowFiles', $this->StudentGrowFile->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student Grow File.');
			$this->redirect('/student_grow_files/index');
		}
		$this->set('studentGrowFile', $this->StudentGrowFile->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('students', $this->StudentGrowFile->Student->generateList());
			$this->set('semesters', $this->StudentGrowFile->Semester->generateList());
			$this->set('growFileTypes', $this->StudentGrowFile->GrowFileType->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->StudentGrowFile->save($this->data)) {
				$this->Session->setFlash('The Student Grow File has been saved');
				$this->redirect('/student_grow_files/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->StudentGrowFile->Student->generateList());
				$this->set('semesters', $this->StudentGrowFile->Semester->generateList());
				$this->set('growFileTypes', $this->StudentGrowFile->GrowFileType->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Student Grow File');
				$this->redirect('/student_grow_files/index');
			}
			$this->data = $this->StudentGrowFile->read(null, $id);
			$this->set('students', $this->StudentGrowFile->Student->generateList());
			$this->set('semesters', $this->StudentGrowFile->Semester->generateList());
			$this->set('growFileTypes', $this->StudentGrowFile->GrowFileType->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->StudentGrowFile->save($this->data)) {
				$this->Session->setFlash('The StudentGrowFile has been saved');
				$this->redirect('/student_grow_files/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->StudentGrowFile->Student->generateList());
				$this->set('semesters', $this->StudentGrowFile->Semester->generateList());
				$this->set('growFileTypes', $this->StudentGrowFile->GrowFileType->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student Grow File');
			$this->redirect('/student_grow_files/index');
		}
		if ($this->StudentGrowFile->del($id)) {
			$this->Session->setFlash('The Student Grow File deleted: id '.$id.'');
			$this->redirect('/student_grow_files/index');
		}
	}

}
?>