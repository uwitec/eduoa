<?php
class EmailsController extends AppController {

	var $name = 'Emails';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Email->recursive = 0;
		$this->set('emails', $this->Email->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Email.');
			$this->redirect('/emails/index');
		}
		$this->set('email', $this->Email->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('emailBoxes', $this->Email->EmailBox->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Email->save($this->data)) {
				$this->Session->setFlash('新增邮件成功！');
				$this->redirect('/emails/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('emailBoxes', $this->Email->EmailBox->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Email');
				$this->redirect('/emails/index');
			}
			$this->data = $this->Email->read(null, $id);
			$this->set('emailBoxes', $this->Email->EmailBox->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Email->save($this->data)) {
				$this->Session->setFlash('邮件保存成功！');
				$this->redirect('/emails/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('emailBoxes', $this->Email->EmailBox->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Email');
			$this->redirect('/emails/index');
		}
		if ($this->Email->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/emails/index');
		}
	}

}
?>