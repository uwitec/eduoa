<?php
class UnitsController extends AppController {

	var $name = 'Units';
	var $helpers = array('Html', 'Form');

	function index() {
		if($this->Unit->findCount() > 0){
			$this->redirect('/units/edit/1');
			die();
		}else{
			$this->redirect('/units/add');
			die();
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Unit.');
			$this->redirect('/units/index');
		}
		$this->set('unit', $this->Unit->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Unit->save($this->data)) {
				$this->Session->setFlash('学校信息保存成功！');
				$this->redirect('/units/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Unit');
				$this->redirect('/units/index');
			}
			$this->data = $this->Unit->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Unit->save($this->data)) {
				$this->Session->setFlash('学校信息修改成功！');
				$this->redirect('/units/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Unit');
			$this->redirect('/units/index');
		}
		if ($this->Unit->del($id)) {
			$this->Session->setFlash('The Unit deleted: id '.$id.'');
			$this->redirect('/units/index');
		}
	}

}
?>