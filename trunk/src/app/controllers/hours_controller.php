<?php
class HoursController extends AppController {

	var $name = 'Hours';
	var $helpers = array('Html', 'Form');
	var $uses = array('Hour','Week');

	function index() {
		$this->Hour->recursive = 0;
		$this->set('hours', $this->Hour->findAll());
		$this->set('weeks', $this->Week->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Hour.');
			$this->redirect('/hours/index');
		}
		$this->set('hour', $this->Hour->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('weeks', $this->Hour->Week->generateList());
			$this->set('selectedWeeks', null);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Hour->save($this->data)) {
				$this->Session->setFlash('The Hour has been saved');
				$this->redirect('/hours/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('weeks', $this->Hour->Week->generateList());
				if (empty($this->data['Week']['Week'])) { $this->data['Week']['Week'] = null; }
				$this->set('selectedWeeks', $this->data['Week']['Week']);
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Hour');
				$this->redirect('/hours/index');
			}
			$this->data = $this->Hour->read(null, $id);
			$this->set('weeks', $this->Hour->Week->generateList());
			if (empty($this->data['Week'])) { $this->data['Week'] = null; }
			$this->set('selectedWeeks', $this->_selectedArray($this->data['Week']));
		} else {
			$this->cleanUpFields();
			if ($this->Hour->save($this->data)) {
				$this->Session->setFlash('The Hour has been saved');
				$this->redirect('/hours/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('weeks', $this->Hour->Week->generateList());
				if (empty($this->data['Week']['Week'])) { $this->data['Week']['Week'] = null; }
				$this->set('selectedWeeks', $this->data['Week']['Week']);
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Hour');
			$this->redirect('/hours/index');
		}
		if ($this->Hour->del($id)) {
			$this->Session->setFlash('The Hour deleted: id '.$id.'');
			$this->redirect('/hours/index');
		}
	}

}
?>