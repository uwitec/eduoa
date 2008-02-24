<?php
class TeacherRewardsController extends AppController {

	var $name = 'TeacherRewards';
	var $components = array('Acl','AjaxValid','Pagination');//Make sure you include this, it makes the magic work.
	var $helpers = array('Html', 'Form' ,'Javascript','Pagination');

	function index($keyword = null, $page=1) {
		//$this->TeacherIsWork->recursive = 0;
		$criteria = " ";
		if($keyword == null){
			$keyword = $this->data['TeacherReward']['keyword'];
		}		
		if($keyword != null){
			$criteria = " Teacher.teacher_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'index/'.$keyword));
		
		$data = $this->TeacherReward->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('teacherRewards',$data);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Reward.');
			$this->redirect('/teacher_rewards/index');
		}
		$this->set('teacherReward', $this->TeacherReward->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('teachers', 
						$this->TeacherReward->Teacher->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Teacher.id',
							$valuePath = '{n}.Teacher.teacher_name')
			);

			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->TeacherReward->save($this->data)) {
				$this->Session->setFlash('教职工奖惩信息新增成功！');
				$this->redirect('/teacher_rewards/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TeacherReward->Teacher->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Teacher Reward');
				$this->redirect('/teacher_rewards/index');
			}
			$this->data = $this->TeacherReward->read(null, $id);
			$this->set('teachers', 
						$this->TeacherReward->Teacher->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Teacher.id',
							$valuePath = '{n}.Teacher.teacher_name')
			);
		} else {
			$this->cleanUpFields();
			if ($this->TeacherReward->save($this->data)) {
				$this->Session->setFlash('教职工奖惩信息保存成功！');
				$this->redirect('/teacher_rewards/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TeacherReward->Teacher->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Reward');
			$this->redirect('/teacher_rewards/index');
		}
		if ($this->TeacherReward->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/teacher_rewards/index');
		}
	}

}
?>