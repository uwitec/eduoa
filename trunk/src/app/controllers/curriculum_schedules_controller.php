<?php
class CurriculumSchedulesController extends AppController {

	var $name = 'CurriculumSchedules';
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Hour', 'Week', 'CurriculumSchedule');

	function index() {
		$this->CurriculumSchedule->recursive = 0;
		$this->set('hours', $this->Hour->findAll());
		$this->set('weeks', $this->Week->findAll());

		$this->set('classrooms', $this->CurriculumSchedule->Classroom->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Classroom.id',
							$valuePath = '{n}.Classroom.classroom_name')
		);
		$this->set('courses', $this->CurriculumSchedule->Course->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Course.id',
							$valuePath = '{n}.Course.course_name')
		);
		$this->set('teachers', $this->CurriculumSchedule->Teacher->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Teacher.id',
							$valuePath = '{n}.Teacher.teacher_name')
		);

		//$this->set('curriculumSchedules', $this->CurriculumSchedule->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Curriculum Schedule.');
			$this->redirect('/curriculum_schedules/index');
		}
		$this->set('curriculumSchedule', $this->CurriculumSchedule->read(null, $id));
	}

	function add($banji_id = null, 
		         $semester_id = null, 
		         $classroom_id = null, 
		         $course_id = null, 
		         $teacher_id = null, 
		         $hour_id = null, $week_id = null) {

		$this->cleanUpFields();
		$this->data['CurriculumSchedule']['banji_id'] = $banji_id;
		$this->data['CurriculumSchedule']['semester_id'] = $semester_id;
		$this->data['CurriculumSchedule']['classroom_id'] = $classroom_id;
		$this->data['CurriculumSchedule']['course_id'] = $course_id;
		$this->data['CurriculumSchedule']['teacher_id'] = $teacher_id;
		$this->data['CurriculumSchedule']['hour_id'] = $hour_id;
		$this->data['CurriculumSchedule']['week_id'] = $week_id;

		if ($this->CurriculumSchedule->save($this->data)) {
			//$this->Session->setFlash('The Curriculum Schedule has been saved');
			//$this->redirect('/curriculum_schedules/index');
		}

		/*
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
		*/
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

	function delete($banji = null, $semester = null, $hour = null, $week = null) {
		$sql  = "delete from curriculum_schedules";
		$sql .= " where banji_id = $banji and semester_id = $semester and hour_id = $hour and week_id = $week"; 
		
		if ($banji != null) {
			$this->CurriculumSchedule->execute($sql);
		}
	}

	function findFlag($banji = null, $semester = null, $hour = null, $week = null){
		$criteria = "banji_id = $banji and semester_id = $semester and hour_id = $hour and week_id = $week";
		return $this->CurriculumSchedule->find($criteria);
	}

}
?>