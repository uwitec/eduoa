<?php
class TeacherRewardsController extends AppController {

	var $name = 'TeacherRewards';
	var $helpers = array('Html', 'Form' );

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
			$this->set('teachers', $this->TeacherReward->Teacher->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->TeacherReward->save($this->data)) {
				$this->Session->setFlash('The Teacher Reward has been saved');
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
			$this->set('teachers', $this->TeacherReward->Teacher->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->TeacherReward->save($this->data)) {
				$this->Session->setFlash('The TeacherReward has been saved');
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
			$this->Session->setFlash('The Teacher Reward deleted: id '.$id.'');
			$this->redirect('/teacher_rewards/index');
		}
	}

}
?>