<?php
class ClassroomTypesController extends AppController {

	var $name = 'ClassroomTypes';
	var $helpers = array('Html', 'Form','Javascript' );

	function index() {
		$this->ClassroomType->recursive = 0;
		$this->set('classroomTypes', $this->ClassroomType->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Classroom Type.');
			$this->redirect('/classroom_types/index');
		}
		$this->set('classroomType', $this->ClassroomType->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
        	if($this->ClassroomType->findByTypeName($this->data['ClassroomType']['type_name'])){
        		$this->ClassroomType->invalidate('type_name');
        		$this->set('type_name_error', '已经存在！');
        	}else{
				$this->cleanUpFields();
				if ($this->ClassroomType->save($this->data)) {
					$this->Session->setFlash('教室类型保存成功！');
					$this->redirect('/classroom_types/index');
				} else {
					$this->Session->setFlash('Please correct errors below.');
				}
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Classroom Type');
				$this->redirect('/classroom_types/index');
			}
			$this->data = $this->ClassroomType->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->ClassroomType->save($this->data)) {
				$this->Session->setFlash('教室类型修改成功！');
				$this->redirect('/classroom_types/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Classroom Type');
			$this->redirect('/classroom_types/index');
		}
		if ($this->ClassroomType->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/classroom_types/index');
		}
	}

}
?>