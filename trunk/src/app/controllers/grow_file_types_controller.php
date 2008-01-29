<?php
class GrowFileTypesController extends AppController {

	var $name = 'GrowFileTypes';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->GrowFileType->recursive = 0;
		$this->set('growFileTypes', $this->GrowFileType->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Grow File Type.');
			$this->redirect('/grow_file_types/index');
		}
		$this->set('growFileType', $this->GrowFileType->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->GrowFileType->save($this->data)) {
				$this->Session->setFlash('The Grow File Type has been saved');
				$this->redirect('/grow_file_types/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Grow File Type');
				$this->redirect('/grow_file_types/index');
			}
			$this->data = $this->GrowFileType->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->GrowFileType->save($this->data)) {
				$this->Session->setFlash('The GrowFileType has been saved');
				$this->redirect('/grow_file_types/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Grow File Type');
			$this->redirect('/grow_file_types/index');
		}
		if ($this->GrowFileType->del($id)) {
			$this->Session->setFlash('The Grow File Type deleted: id '.$id.'');
			$this->redirect('/grow_file_types/index');
		}
	}

}
?>