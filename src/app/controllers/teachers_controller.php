<?php
class TeachersController extends AppController {

	var $name = 'Teachers';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Teacher->recursive = 0;
		$this->set('teachers', $this->Teacher->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher.');
			$this->redirect('/teachers/index');
		}
		$this->set('teacher', $this->Teacher->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('users', $this->Teacher->User->generateList());
			$this->set('people', $this->Teacher->Person->generateList());
			$this->set('degrees', $this->Teacher->Degree->generateList());
			$this->set('departments', $this->Teacher->Department->generateList());
			$this->set('files', $this->Teacher->File->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Teacher->save($this->data)) {
				$this->Session->setFlash('The Teacher has been saved');
				$this->redirect('/teachers/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->Teacher->User->generateList());
				$this->set('people', $this->Teacher->Person->generateList());
				$this->set('degrees', $this->Teacher->Degree->generateList());
				$this->set('departments', $this->Teacher->Department->generateList());
				$this->set('files', $this->Teacher->File->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Teacher');
				$this->redirect('/teachers/index');
			}
			$this->data = $this->Teacher->read(null, $id);
			$this->set('users', $this->Teacher->User->generateList());
			$this->set('people', $this->Teacher->Person->generateList());
			$this->set('degrees', $this->Teacher->Degree->generateList());
			$this->set('departments', $this->Teacher->Department->generateList());
			$this->set('files', $this->Teacher->File->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Teacher->save($this->data)) {
				$this->Session->setFlash('The Teacher has been saved');
				$this->redirect('/teachers/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->Teacher->User->generateList());
				$this->set('people', $this->Teacher->Person->generateList());
				$this->set('degrees', $this->Teacher->Degree->generateList());
				$this->set('departments', $this->Teacher->Department->generateList());
				$this->set('files', $this->Teacher->File->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher');
			$this->redirect('/teachers/index');
		}
		if ($this->Teacher->del($id)) {
			$this->Session->setFlash('The Teacher deleted: id '.$id.'');
			$this->redirect('/teachers/index');
		}
	}

}
?>