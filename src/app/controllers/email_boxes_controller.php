<?php
class EmailBoxesController extends AppController {

	var $name = 'EmailBoxes';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->EmailBox->recursive = 0;
		$this->set('emailBoxes', $this->EmailBox->findAll());
	}

	function my() {
		$this->EmailBox->recursive = 0;	
		$this->set('emailBoxes', $this->EmailBox->findAllById($this->Session->read('User.id')));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Email Box.');
			$this->redirect('/email_boxes/index');
		}
		$this->set('emailBox', $this->EmailBox->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('users', $this->EmailBox->User->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->EmailBox->save($this->data)) {
				$this->Session->setFlash('The Email Box has been saved');
				$this->redirect('/email_boxes/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->EmailBox->User->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Email Box');
				$this->redirect('/email_boxes/index');
			}
			$this->data = $this->EmailBox->read(null, $id);
			$this->set('users', $this->EmailBox->User->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->EmailBox->save($this->data)) {
				$this->Session->setFlash('The EmailBox has been saved');
				$this->redirect('/email_boxes/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->EmailBox->User->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Email Box');
			$this->redirect('/email_boxes/index');
		}
		if ($this->EmailBox->del($id)) {
			$this->Session->setFlash('The Email Box deleted: id '.$id.'');
			$this->redirect('/email_boxes/index');
		}
	}

}
?>