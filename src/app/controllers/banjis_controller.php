<?php
class BanjisController extends AppController {

	var $name = 'Banjis';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Banji->recursive = 0;
		$this->set('banjis', $this->Banji->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Banji.');
			$this->redirect('/banjis/index');
		}
		$this->set('banji', $this->Banji->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('teachers', $this->Banji->Teacher->generateList());
			$this->set('academicYears', $this->Banji->AcademicYear->generateList());
			$this->set('classrooms', $this->Banji->Classroom->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Banji->save($this->data)) {
				$this->Session->setFlash('The Banji has been saved');
				$this->redirect('/banjis/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->Banji->Teacher->generateList());
				$this->set('academicYears', $this->Banji->AcademicYear->generateList());
				$this->set('classrooms', $this->Banji->Classroom->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Banji');
				$this->redirect('/banjis/index');
			}
			$this->data = $this->Banji->read(null, $id);
			$this->set('teachers', $this->Banji->Teacher->generateList());
			$this->set('academicYears', $this->Banji->AcademicYear->generateList());
			$this->set('classrooms', $this->Banji->Classroom->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Banji->save($this->data)) {
				$this->Session->setFlash('The Banji has been saved');
				$this->redirect('/banjis/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->Banji->Teacher->generateList());
				$this->set('academicYears', $this->Banji->AcademicYear->generateList());
				$this->set('classrooms', $this->Banji->Classroom->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Banji');
			$this->redirect('/banjis/index');
		}
		if ($this->Banji->del($id)) {
			$this->Session->setFlash('The Banji deleted: id '.$id.'');
			$this->redirect('/banjis/index');
		}
	}

	function list_class_by_year(){
		$this->Banji->recursive = 0;
		
		$this->Banji->unbindModel(array('belongsTo' => array('Teacher','AcademicYear','Classroom')));
		$this->set('years', $this->Banji->findAll('group by Banji.entrance_year'));

		$this->Banji->unbindModel(array('belongsTo' => array('Teacher','AcademicYear','Classroom')));
		$this->set('banjis', $this->Banji->findAll('order by Banji.entrance_year desc,Banji.order_list'));

	}

}
?>