<?php
class ExamResultsController extends AppController {

	var $name = 'ExamResults';
	var $helpers = array('Html', 'Form', 'Javascript', 'Csv');
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
			if (isset($this->params['form']['Filedata'])) {
				$fname = $this->params['form']['Filedata']['name'];
				if(copy($this->params['form']['Filedata']['tmp_name'],$fname)){
					$handle=fopen("$fname","r");
					$count = 0;
					$semester = $this->data['ExamResult']['semester']; //学期
					$banji = $this->data['ExamResult']['banji']; //班级
					$course = $this->data['ExamResult']['course']; //课程


					while($data=fgetcsv($handle,10000,",")){
						if($count >0){
							$sql = "insert into exam_results (student_id,semester_id,course_id,score)";
							$sql .= " values ('$data[0]','$semester', '$course', '$data[3]')";
							$this->ExamResult->execute($sql);
						}
						$count++;
					}
					$this->Session->setFlash('导入学生成绩成功！');
					$this->redirect('/exam_results/import');
					exit();
				}else{
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
					$this->Session->setFlash('上传文件失败！');
					$this->redirect('/students/import');
					exit();
				}
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

	function download($banji_id = null, $banji_name = null, $semester_name = null, $course_name = null) {
		$this->layout = 'ajax_gb';
		$this->set('students', $this->ExamResult->Student->findAllByBanjiId($banji_id));
		$this->set('banji_name', $banji_name);
		$this->set('semester_name', $semester_name);
		$this->set('course_name', $course_name);
	}

	function student(){
		$this->ExamResult->recursive = 1;
		$this->set('students',$this->ExamResult->Student->findAll());
		$this->set('banji','三班');
	}

	function findScore($student_id = null, $exam_id = null, $semester_id = null, $course_id = null){
		$conditions = "student_id=$student_id and semester_id = $semester_id and course_id = $course_id";
		return $this->ExamResult->field('score', $conditions);
    }
}
?>