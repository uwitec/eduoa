<?php
class ExamsController extends AppController {

	var $name = 'Exams';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Exam->recursive = 0;
		$this->set('exams', $this->Exam->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Exam.');
			$this->redirect('/exams/index');
		}
		$this->set('exam', $this->Exam->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('semesters', $this->Exam->Semester->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Exam->save($this->data)) {
				$this->Session->setFlash('The Exam has been saved');
				$this->redirect('/exams/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('semesters', $this->Exam->Semester->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Exam');
				$this->redirect('/exams/index');
			}
			$this->data = $this->Exam->read(null, $id);
			$this->set('semesters', $this->Exam->Semester->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Exam->save($this->data)) {
				$this->Session->setFlash('The Exam has been saved');
				$this->redirect('/exams/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('semesters', $this->Exam->Semester->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Exam');
			$this->redirect('/exams/index');
		}
		if ($this->Exam->del($id)) {
			$this->Session->setFlash('The Exam deleted: id '.$id.'');
			$this->redirect('/exams/index');
		}
	}

}
?>