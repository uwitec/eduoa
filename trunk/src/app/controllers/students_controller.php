<?php
class StudentsController extends AppController {

	var $name = 'Students';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Student->recursive = 0;
		$this->set('students', $this->Student->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student.');
			$this->redirect('/students/index');
		}
		$this->set('student', $this->Student->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('banjis', $this->Student->Banji->generateList());
			$this->set('people', $this->Student->Person->generateList());
			$this->set('files', $this->Student->File->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Student->save($this->data)) {
				$this->Session->setFlash('The Student has been saved');
				$this->redirect('/students/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('banjis', $this->Student->Banji->generateList());
				$this->set('people', $this->Student->Person->generateList());
				$this->set('files', $this->Student->File->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Student');
				$this->redirect('/students/index');
			}
			$this->data = $this->Student->read(null, $id);
			$this->set('banjis', $this->Student->Banji->generateList());
			$this->set('people', $this->Student->Person->generateList());
			$this->set('files', $this->Student->File->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Student->save($this->data)) {
				$this->Session->setFlash('The Student has been saved');
				$this->redirect('/students/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('banjis', $this->Student->Banji->generateList());
				$this->set('people', $this->Student->Person->generateList());
				$this->set('files', $this->Student->File->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student');
			$this->redirect('/students/index');
		}
		if ($this->Student->del($id)) {
			$this->Session->setFlash('The Student deleted: id '.$id.'');
			$this->redirect('/students/index');
		}
	}

}
?>