<?php
class ModulesController extends AppController {

	var $name = 'Modules';
	var $helpers = array('Html', 'Form', 'Javascript');

	function index() {
		$this->Module->recursive = 0;
		$this->set('modules', $this->Module->findAll());
	}

	function left() {
		$this->Module->recursive = 0;
		$this->set('modules', $this->Module->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Module.');
			$this->redirect('/modules/index');
		}
		$this->set('module', $this->Module->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('roles', $this->Module->Role->generateList());
			$this->set('selectedRoles', null);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Module->save($this->data)) {
				$this->Session->setFlash('The Module has been saved');
				$this->redirect('/modules/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('roles', $this->Module->Role->generateList());
				if (empty($this->data['Role']['Role'])) { $this->data['Role']['Role'] = null; }
				$this->set('selectedRoles', $this->data['Role']['Role']);
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Module');
			}
			$this->data = $this->Module->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Module->save($this->data)) {
				$this->Session->setFlash('系统菜单修改成功!');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Module');
			$this->redirect('/modules/index');
		}
		if ($this->Module->del($id)) {
			$this->Session->setFlash('The Module deleted: id '.$id.'');
			$this->redirect('/modules/index');
		}
	}

}
?>