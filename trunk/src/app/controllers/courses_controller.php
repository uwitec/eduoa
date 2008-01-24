<?php
class CoursesController extends AppController {

	var $name = 'Courses';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Course->recursive = 0;
		$this->set('courses', $this->Course->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Course.');
			$this->redirect('/courses/index');
		}
		$this->set('course', $this->Course->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash('课程新增成功！');
				$this->redirect('/courses/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Course');
				$this->redirect('/courses/index');
			}
			$this->data = $this->Course->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash('课程保存成功！');
				$this->redirect('/courses/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Course');
			$this->redirect('/courses/index');
		}
		if ($this->Course->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/courses/index');
		}
	}

	function vlist() {
		$this->Course->recursive = 0;
		$this->set('courses', $this->Course->findAll());
	}

}
?>