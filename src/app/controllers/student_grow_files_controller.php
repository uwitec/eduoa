<?php
class StudentGrowFilesController extends AppController {

	var $name = 'StudentGrowFiles';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->StudentGrowFile->recursive = 0;
		$this->set('studentGrowFiles', $this->StudentGrowFile->findAll());
	}

	function view($id = null,$type = null) {
		$this->set('student', $this->StudentGrowFile->Student->read(null,$id));
		$this->set('growFileTypes', $this->StudentGrowFile->GrowFileType->findAll());

		if($type!=null){
			$conditions = "StudentGrowFile.student_id = $id and StudentGrowFile.grow_file_type_id = $type";
		}else{
			$conditions = "StudentGrowFile.student_id = $id";
		}

		$this->set('studentGrowFiles', $this->StudentGrowFile->findAll($conditions));
	}

	function add($student_id = null,$type_id = null) {
		if (empty($this->data)) {
			$this->set('students', $this->StudentGrowFile->Student->findById($student_id));
			$this->set('semesters', $this->StudentGrowFile->Semester->generateList());
			$this->set('growFileTypes', $this->StudentGrowFile->GrowFileType->findById($type_id));
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->StudentGrowFile->save($this->data)) {
				$this->Session->setFlash('学生成长档案保存成功！');
				$this->redirect('/students/index_grow_files/?action=edit&banji');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->StudentGrowFile->Student->generateList());
				$this->set('semesters', $this->StudentGrowFile->Semester->generateList());
				$this->set('growFileTypes', $this->StudentGrowFile->GrowFileType->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Student Grow File');
				$this->redirect('/student_grow_files/index');
			}
			$this->data = $this->StudentGrowFile->read(null, $id);
			$this->set('students', $this->StudentGrowFile->Student->generateList());
			$this->set('semesters', $this->StudentGrowFile->Semester->generateList());
			$this->set('growFileTypes', $this->StudentGrowFile->GrowFileType->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->StudentGrowFile->save($this->data)) {
				$this->Session->setFlash('The StudentGrowFile has been saved');
				$this->redirect('/student_grow_files/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('students', $this->StudentGrowFile->Student->generateList());
				$this->set('semesters', $this->StudentGrowFile->Semester->generateList());
				$this->set('growFileTypes', $this->StudentGrowFile->GrowFileType->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student Grow File');
			$this->redirect('/student_grow_files/index');
		}
		if ($this->StudentGrowFile->del($id)) {
			$this->Session->setFlash('The Student Grow File deleted: id '.$id.'');
			$this->redirect('/student_grow_files/index');
		}
	}

}
?>