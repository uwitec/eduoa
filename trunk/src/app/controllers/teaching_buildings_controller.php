<?php
class TeachingBuildingsController extends AppController {

	var $name = 'TeachingBuildings';
	var $helpers = array('Html', 'Form','Csv','Javascript' );

	function index() {
		$this->TeachingBuilding->recursive = 0;
		$this->set('teachingBuildings', $this->TeachingBuilding->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teaching Building.');
			$this->redirect('/teaching_buildings/index');
		}
		$this->set('teachingBuilding', $this->TeachingBuilding->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->TeachingBuilding->save($this->data)) {
				$this->Session->setFlash('教学楼信息保存成功！');
				$this->redirect('/teaching_buildings/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Teaching Building');
				$this->redirect('/teaching_buildings/index');
			}
			$this->data = $this->TeachingBuilding->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->TeachingBuilding->save($this->data)) {
				$this->Session->setFlash('教学楼信息修改成功！');
				$this->redirect('/teaching_buildings/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teaching Building');
			$this->redirect('/teaching_buildings/index');
		}
		if ($this->TeachingBuilding->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/teaching_buildings/index');
		}
	}

	function csv() {
		$this->TeachingBuilding->recursive = 0;
		$this->set('teachingBuildings', $this->TeachingBuilding->findAll());
	}

}
?>