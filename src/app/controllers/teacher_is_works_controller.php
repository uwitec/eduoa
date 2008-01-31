<?php
class TeacherIsWorksController extends AppController {

	var $name = 'TeacherIsWorks';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->TeacherIsWork->recursive = 0;
		$this->set('teacherIsWorks', $this->TeacherIsWork->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Is Work.');
			$this->redirect('/teacher_is_works/index');
		}
		$this->set('teacherIsWork', $this->TeacherIsWork->read(null, $id));
	}

	function add($teacher_id = null,$teacher_name = null,$action_name = null) {
		if (empty($this->data)) {
			$this->set('teacher_id',$teacher_id);
			$this->set('teacher_name',$teacher_name);
			$this->set('action_name',$action_name);
			$this->set('teachers', $this->TeacherIsWork->Teacher->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->TeacherIsWork->save($this->data)) {
				$this->Session->setFlash('教职工离职(复职)操作成功！');

				if($action_name == '离职') {
					$sql = "update teachers set is_work = 0 where id = ".$this->data['TeacherIsWork']['teacher_id'];
				}else {
					$sql = "update teachers set is_work = 1 where id = ".$this->data['TeacherIsWork']['teacher_id'];
				}
				$this->TeacherIsWork->execute($sql);

				$this->redirect('/teacher_is_works/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TeacherIsWork->Teacher->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Teacher Is Work');
				$this->redirect('/teacher_is_works/index');
			}
			$this->data = $this->TeacherIsWork->read(null, $id);
			$this->set('teachers', $this->TeacherIsWork->Teacher->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->TeacherIsWork->save($this->data)) {
				$this->Session->setFlash('The TeacherIsWork has been saved');
				$this->redirect('/teacher_is_works/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TeacherIsWork->Teacher->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Is Work');
			$this->redirect('/teacher_is_works/index');
		}
		if ($this->TeacherIsWork->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/teacher_is_works/index');
		}
	}

}
?>