<?php
class EmailBoxesController extends AppController {

	var $name = 'EmailBoxes';
	var $helpers = array('Html', 'Form', 'Javascript' );
	var $uses = array('EmailBox','Email');

	function index() {
		$this->my();
	}

	function my() {
		$this->EmailBox->recursive = 0;	
		$this->set('emailBoxes', $this->EmailBox->findAllByUserId($this->Session->read('User.id')));
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
			$this->render();
		} else {
			$this->cleanUpFields();
			$this->data['EmailBox']['user_id'] = $this->Session->read('User.id');
			if ($this->EmailBox->save($this->data)) {
				$this->Session->setFlash('邮件箱保存成功!');
				$this->redirect('/email_boxes/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
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
		} else {
			$this->cleanUpFields();
			if ($this->EmailBox->save($this->data)) {
				$this->Session->setFlash('邮件箱保存成功!');
				$this->redirect('/email_boxes/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Email Box');
			$this->redirect('/email_boxes/index');
		}
		if ($this->EmailBox->del($id)) {
			$this->Session->setFlash('邮箱删除成功!');
			$this->redirect('/email_boxes/index');
		}
	}

}
?>