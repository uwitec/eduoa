<?php
class EmailsController extends AppController {

	var $name = 'Emails';
	var $components = array('Acl','AjaxValid','Pagination');//Make sure you include this, it makes the magic work.
	var $helpers = array('Html', 'Form', 'Javascript','Pagination');

	function index($keyword = null, $page=1) {
		$this->Email->recursive = 0;

		$criteria = " ";
		if($keyword == null){
			$keyword = $this->data['Email']['keyword'];
		}		

		if($this->Session->read('User.id') <> 1) {
			$criteria = " Email.to_id = ".$this->Session->read('TeacherID');
		}else {
			$criteria = " ";
		}
		

		if($keyword != null){
			$criteria .= " Email.subject like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'index/'.$keyword));
		
		$data = $this->Email->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('emails',$data);
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
			$users = explode(",", $this->data['Email']['to_id']);
			$count = sizeof($users) - 1;
			for($i=0;$i<$count;$i++){
				$this->data['Email']['from_id'] = $this->Session->read('User.id');
				$this->data['Email']['to_id'] = $users[$i];
				$this->Email->save($this->data);
				$this->Email->create();
			}
			$this->Session->setFlash('新增邮件成功！');
			$this->redirect('/emails/index');
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