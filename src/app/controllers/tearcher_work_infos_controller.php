<?php
class TearcherWorkInfosController extends AppController {

	var $name = 'TearcherWorkInfos';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->TearcherWorkInfo->recursive = 0;
		$this->set('tearcherWorkInfos', $this->TearcherWorkInfo->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Tearcher Work Info.');
			$this->redirect('/tearcher_work_infos/index');
		}
		$this->set('tearcherWorkInfo', $this->TearcherWorkInfo->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('teachers', $this->TearcherWorkInfo->Teacher->generateList());
			$this->set('banjis', $this->TearcherWorkInfo->Banji->generateList());
			$this->set('courses', $this->TearcherWorkInfo->Course->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->TearcherWorkInfo->save($this->data)) {
				$this->Session->setFlash('The Tearcher Work Info has been saved');
				$this->redirect('/tearcher_work_infos/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TearcherWorkInfo->Teacher->generateList());
				$this->set('banjis', $this->TearcherWorkInfo->Banji->generateList());
				$this->set('courses', $this->TearcherWorkInfo->Course->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Tearcher Work Info');
				$this->redirect('/tearcher_work_infos/index');
			}
			$this->data = $this->TearcherWorkInfo->read(null, $id);
			$this->set('teachers', $this->TearcherWorkInfo->Teacher->generateList());
			$this->set('banjis', $this->TearcherWorkInfo->Banji->generateList());
			$this->set('courses', $this->TearcherWorkInfo->Course->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->TearcherWorkInfo->save($this->data)) {
				$this->Session->setFlash('The TearcherWorkInfo has been saved');
				$this->redirect('/tearcher_work_infos/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('teachers', $this->TearcherWorkInfo->Teacher->generateList());
				$this->set('banjis', $this->TearcherWorkInfo->Banji->generateList());
				$this->set('courses', $this->TearcherWorkInfo->Course->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Tearcher Work Info');
			$this->redirect('/tearcher_work_infos/index');
		}
		if ($this->TearcherWorkInfo->del($id)) {
			$this->Session->setFlash('The Tearcher Work Info deleted: id '.$id.'');
			$this->redirect('/tearcher_work_infos/index');
		}
	}

}
?>