<?php
class DepartmentsController extends AppController {

	var $name = 'Departments';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Department->recursive = 0;
		$this->set('departments', $this->Department->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Department.');
			$this->redirect('/departments/index');
		}
		$this->set('department', $this->Department->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Department->save($this->data)) {
				$this->Session->setFlash('部门信息保存成功！');
				$this->redirect('/departments/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Department');
				$this->redirect('/departments/index');
			}
			$this->data = $this->Department->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Department->save($this->data)) {
				$this->Session->setFlash('部门信息修改成功！');
				$this->redirect('/departments/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Department');
			$this->redirect('/departments/index');
		}
		if ($this->Department->del($id)) {
			$this->Session->setFlash('The Department deleted: id '.$id.'');
			$this->redirect('/departments/index');
		}
	}

}
?>