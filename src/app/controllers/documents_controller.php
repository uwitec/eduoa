<?php
class DocumentsController extends AppController {

	var $name = 'Documents';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Document->recursive = 0;
		$this->set('documents', $this->Document->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Document.');
			$this->redirect('/documents/index');
		}
		$this->set('document', $this->Document->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('documentTypes', $this->Document->DocumentType->generateList());
			$this->set('rates', $this->Document->Rate->generateList());
			$this->set('courses', $this->Document->Course->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash('The Document has been saved');
				$this->redirect('/documents/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('documentTypes', $this->Document->DocumentType->generateList());
				$this->set('rates', $this->Document->Rate->generateList());
				$this->set('courses', $this->Document->Course->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Document');
				$this->redirect('/documents/index');
			}
			$this->data = $this->Document->read(null, $id);
			$this->set('documentTypes', $this->Document->DocumentType->generateList());
			$this->set('rates', $this->Document->Rate->generateList());
			$this->set('courses', $this->Document->Course->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash('The Document has been saved');
				$this->redirect('/documents/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('documentTypes', $this->Document->DocumentType->generateList());
				$this->set('rates', $this->Document->Rate->generateList());
				$this->set('courses', $this->Document->Course->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Document');
			$this->redirect('/documents/index');
		}
		if ($this->Document->del($id)) {
			$this->Session->setFlash('The Document deleted: id '.$id.'');
			$this->redirect('/documents/index');
		}
	}

}
?>