<?php
class ExamResultsController extends AppController {

	var $name = 'ExamResults';
	var $helpers = array('Html', 'Form' );
	var $uses = array('ExamResult','Banji');

	function index() {
		$this->ExamResult->recursive = 0;
		$this->set('examResults', $this->ExamResult->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Exam Result.');
			$this->redirect('/exam_results/index');
		}
		$this->set('examResult', $this->ExamResult->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('students', $this->ExamResult->Student->generateList());
			$this->set('exams', $this->ExamResult->Exam->generateList());
			$this->set('semesters', $this->ExamResult->Semester->generateList());
			$this->set('courses', $this->ExamResult->Course->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->ExamResult->save($this->data)) {
				$this->Session->setFlash('The Exam Result has been saved');
				$this->redirect('/exam_results/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->ExamResult->Student->generateList());
				$this->set('exams', $this->ExamResult->Exam->generateList());
				$this->set('semesters', $this->ExamResult->Semester->generateList());
				$this->set('courses', $this->ExamResult->Course->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Exam Result');
				$this->redirect('/exam_results/index');
			}
			$this->data = $this->ExamResult->read(null, $id);
			$this->set('students', $this->ExamResult->Student->generateList());
			$this->set('exams', $this->ExamResult->Exam->generateList());
			$this->set('semesters', $this->ExamResult->Semester->generateList());
			$this->set('courses', $this->ExamResult->Course->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->ExamResult->save($this->data)) {
				$this->Session->setFlash('The ExamResult has been saved');
				$this->redirect('/exam_results/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->ExamResult->Student->generateList());
				$this->set('exams', $this->ExamResult->Exam->generateList());
				$this->set('semesters', $this->ExamResult->Semester->generateList());
				$this->set('courses', $this->ExamResult->Course->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Exam Result');
			$this->redirect('/exam_results/index');
		}
		if ($this->ExamResult->del($id)) {
			$this->Session->setFlash('The Exam Result deleted: id '.$id.'');
			$this->redirect('/exam_results/index');
		}
	}

   function import() {
		if (empty($this->data)) {
			$this->set('semesters', $this->ExamResult->Semester->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Semester.id',
							$valuePath = '{n}.Semester.semester_name')
			);
			$this->set('courses', $this->ExamResult->Course->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Course.id',
							$valuePath = '{n}.Course.course_name')
			);
			$this->set('banjis', $this->Banji->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Banji.id',
							$valuePath = '{n}.Banji.class_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->ExamResult->save($this->data)) {
				$this->Session->setFlash('The Exam Result has been saved');
				$this->redirect('/exam_results/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->ExamResult->Student->generateList());
				$this->set('exams', $this->ExamResult->Exam->generateList());
				$this->set('semesters', $this->ExamResult->Semester->generateList());
				$this->set('courses', $this->ExamResult->Course->generateList());
			}
		}
   }

   function change() {
		if (empty($this->data)) {
			$this->set('semesters', $this->ExamResult->Semester->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Semester.id',
							$valuePath = '{n}.Semester.semester_name')
			);
			$this->set('courses', $this->ExamResult->Course->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Course.id',
							$valuePath = '{n}.Course.course_name')
			);
			$this->set('banjis', $this->Banji->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Banji.id',
							$valuePath = '{n}.Banji.class_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->ExamResult->save($this->data)) {
				$this->Session->setFlash('The Exam Result has been saved');
				$this->redirect('/exam_results/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->ExamResult->Student->generateList());
				$this->set('exams', $this->ExamResult->Exam->generateList());
				$this->set('semesters', $this->ExamResult->Semester->generateList());
				$this->set('courses', $this->ExamResult->Course->generateList());
			}
		}
   }

}
?>