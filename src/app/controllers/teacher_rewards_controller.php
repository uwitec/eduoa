<?php
class TeacherRewardsController extends AppController {

	var $name = 'TeacherRewards';
	var $helpers = array('Html', 'Form','Javascript' );

	function index() {
		$this->TeacherReward->recursive = 0;
		$this->set('teacherRewards', $this->TeacherReward->findAll());
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