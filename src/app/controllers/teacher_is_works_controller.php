<?php
class TeacherIsWorksController extends AppController {

	var $name = 'TeacherIsWorks';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->TeacherIsWork->recursive = 0;
		$this->set('teacherIsWorks', $this->TeacherIsWork->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Is Work.');
			$this->redirect('/teacher_is_works/index');
		}
		$this->set('teacherIsWork', $this->TeacherIsWork->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('teachers', $this->TeacherIsWork->Teacher->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->TeacherIsWork->save($this->data)) {
				$this->Session->setFlash('The Teacher Is Work has been saved');
				$this->redirect('/teacher_is_works/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TeacherIsWork->Teacher->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Teacher Is Work');
				$this->redirect('/teacher_is_works/index');
			}
			$this->data = $this->TeacherIsWork->read(null, $id);
			$this->set('teachers', $this->TeacherIsWork->Teacher->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->TeacherIsWork->save($this->data)) {
				$this->Session->setFlash('The TeacherIsWork has been saved');
				$this->redirect('/teacher_is_works/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TeacherIsWork->Teacher->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Is Work');
			$this->redirect('/teacher_is_works/index');
		}
		if ($this->TeacherIsWork->del($id)) {
			$this->Session->setFlash('The Teacher Is Work deleted: id '.$id.'');
			$this->redirect('/teacher_is_works/index');
		}
	}

}
?>