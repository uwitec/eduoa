<?php
class TeacherContinuingEducationsController extends AppController {

	var $name = 'TeacherContinuingEducations';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->TeacherContinuingEducation->recursive = 0;
		$this->set('teacherContinuingEducations', $this->TeacherContinuingEducation->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Continuing Education.');
			$this->redirect('/teacher_continuing_educations/index');
		}
		$this->set('teacherContinuingEducation', $this->TeacherContinuingEducation->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('teachers', $this->TeacherContinuingEducation->Teacher->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->TeacherContinuingEducation->save($this->data)) {
				$this->Session->setFlash('The Teacher Continuing Education has been saved');
				$this->redirect('/teacher_continuing_educations/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TeacherContinuingEducation->Teacher->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Teacher Continuing Education');
				$this->redirect('/teacher_continuing_educations/index');
			}
			$this->data = $this->TeacherContinuingEducation->read(null, $id);
			$this->set('teachers', $this->TeacherContinuingEducation->Teacher->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->TeacherContinuingEducation->save($this->data)) {
				$this->Session->setFlash('The TeacherContinuingEducation has been saved');
				$this->redirect('/teacher_continuing_educations/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TeacherContinuingEducation->Teacher->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Continuing Education');
			$this->redirect('/teacher_continuing_educations/index');
		}
		if ($this->TeacherContinuingEducation->del($id)) {
			$this->Session->setFlash('The Teacher Continuing Education deleted: id '.$id.'');
			$this->redirect('/teacher_continuing_educations/index');
		}
	}

}
?>