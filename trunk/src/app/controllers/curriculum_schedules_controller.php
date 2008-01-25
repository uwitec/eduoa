<?php
class CurriculumSchedulesController extends AppController {

	var $name = 'CurriculumSchedules';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->CurriculumSchedule->recursive = 0;
		$this->set('curriculumSchedules', $this->CurriculumSchedule->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Curriculum Schedule.');
			$this->redirect('/curriculum_schedules/index');
		}
		$this->set('curriculumSchedule', $this->CurriculumSchedule->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('banjis', $this->CurriculumSchedule->Banji->generateList());
			$this->set('semesters', $this->CurriculumSchedule->Semester->generateList());
			$this->set('classrooms', $this->CurriculumSchedule->Classroom->generateList());
			$this->set('courses', $this->CurriculumSchedule->Course->generateList());
			$this->set('teachers', $this->CurriculumSchedule->Teacher->generateList());
			$this->set('hours', $this->CurriculumSchedule->Hour->generateList());
			$this->set('weeks', $this->CurriculumSchedule->Week->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->CurriculumSchedule->save($this->data)) {
				$this->Session->setFlash('The Curriculum Schedule has been saved');
				$this->redirect('/curriculum_schedules/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('banjis', $this->CurriculumSchedule->Banji->generateList());
				$this->set('semesters', $this->CurriculumSchedule->Semester->generateList());
				$this->set('classrooms', $this->CurriculumSchedule->Classroom->generateList());
				$this->set('courses', $this->CurriculumSchedule->Course->generateList());
				$this->set('teachers', $this->CurriculumSchedule->Teacher->generateList());
				$this->set('hours', $this->CurriculumSchedule->Hour->generateList());
				$this->set('weeks', $this->CurriculumSchedule->Week->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Curriculum Schedule');
				$this->redirect('/curriculum_schedules/index');
			}
			$this->data = $this->CurriculumSchedule->read(null, $id);
			$this->set('banjis', $this->CurriculumSchedule->Banji->generateList());
			$this->set('semesters', $this->CurriculumSchedule->Semester->generateList());
			$this->set('classrooms', $this->CurriculumSchedule->Classroom->generateList());
			$this->set('courses', $this->CurriculumSchedule->Course->generateList());
			$this->set('teachers', $this->CurriculumSchedule->Teacher->generateList());
			$this->set('hours', $this->CurriculumSchedule->Hour->generateList());
			$this->set('weeks', $this->CurriculumSchedule->Week->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->CurriculumSchedule->save($this->data)) {
				$this->Session->setFlash('The CurriculumSchedule has been saved');
				$this->redirect('/curriculum_schedules/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('banjis', $this->CurriculumSchedule->Banji->generateList());
				$this->set('semesters', $this->CurriculumSchedule->Semester->generateList());
				$this->set('classrooms', $this->CurriculumSchedule->Classroom->generateList());
				$this->set('courses', $this->CurriculumSchedule->Course->generateList());
				$this->set('teachers', $this->CurriculumSchedule->Teacher->generateList());
				$this->set('hours', $this->CurriculumSchedule->Hour->generateList());
				$this->set('weeks', $this->CurriculumSchedule->Week->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Curriculum Schedule');
			$this->redirect('/curriculum_schedules/index');
		}
		if ($this->CurriculumSchedule->del($id)) {
			$this->Session->setFlash('The Curriculum Schedule deleted: id '.$id.'');
			$this->redirect('/curriculum_schedules/index');
		}
	}

}
?>