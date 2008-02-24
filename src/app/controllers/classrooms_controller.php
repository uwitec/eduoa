<?php
class ClassroomsController extends AppController {

	var $name = 'Classrooms';
	var $components = array('Acl','AjaxValid','Pagination');//Make sure you include this, it makes the magic work.
	var $helpers = array('Html', 'Javascript', 'Ajax', 'Form', 'Time','Pagination');

	function index($keyword = null, $page=1) {
		$this->Classroom->recursive = 0;

		$criteria = " ";
		if($keyword == null){
			$keyword = $this->data['Classroom']['keyword'];
		}		
		if($keyword != null){
			$criteria = " Classroom.classroom_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'index/'.$keyword));
		
		$data = $this->Classroom->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('classrooms',$data);
	}


	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Classroom.');
			$this->redirect('/classrooms/index');
		}
		$this->set('classroom', $this->Classroom->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('classroomTypes', 
				       $this->Classroom->ClassroomType->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.ClassroomType.id',
			             $valuePath = '{n}.ClassroomType.type_name')
			);
			$this->set('teachingBuildings', 
				        $this->Classroom->TeachingBuilding->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.TeachingBuilding.id',
			             $valuePath = '{n}.TeachingBuilding.building_name')
		    );
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Classroom->save($this->data)) {
				$this->Session->setFlash('教室信息保存成功！');
				$this->redirect('/classrooms/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('classroomTypes', 
						   $this->Classroom->ClassroomType->generateList(
							 $conditions = null,
							 $order = 'id',
							 $limit = null,
							 $keyPath = '{n}.ClassroomType.id',
							 $valuePath = '{n}.ClassroomType.type_name')
				);
				$this->set('teachingBuildings', 
							$this->Classroom->TeachingBuilding->generateList(
							 $conditions = null,
							 $order = 'id',
							 $limit = null,
							 $keyPath = '{n}.TeachingBuilding.id',
							 $valuePath = '{n}.TeachingBuilding.building_name')
				);
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Classroom');
				$this->redirect('/classrooms/index');
			}
			$this->data = $this->Classroom->read(null, $id);
			$this->set('classroomTypes', 
				       $this->Classroom->ClassroomType->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.ClassroomType.id',
			             $valuePath = '{n}.ClassroomType.type_name')
			);
			$this->set('teachingBuildings', 
				        $this->Classroom->TeachingBuilding->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.TeachingBuilding.id',
			             $valuePath = '{n}.TeachingBuilding.building_name')
		    );
		} else {
			$this->cleanUpFields();
			if ($this->Classroom->save($this->data)) {
				$this->Session->setFlash('教室信息修改成功！');
				$this->redirect('/classrooms/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('classroomTypes', 
						   $this->Classroom->ClassroomType->generateList(
							 $conditions = null,
							 $order = 'id',
							 $limit = null,
							 $keyPath = '{n}.ClassroomType.id',
							 $valuePath = '{n}.ClassroomType.type_name')
				);
				$this->set('teachingBuildings', 
							$this->Classroom->TeachingBuilding->generateList(
							 $conditions = null,
							 $order = 'id',
							 $limit = null,
							 $keyPath = '{n}.TeachingBuilding.id',
							 $valuePath = '{n}.TeachingBuilding.building_name')
				);
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Classroom');
			$this->redirect('/classrooms/index');
		}
		if ($this->Classroom->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/classrooms/index');
		}
	}

	function vlist($keyword = null, $page=1) {
		$this->Classroom->recursive = 0;

		$criteria = " ";
		if($keyword == null){
			$keyword = $this->data['Classroom']['keyword'];
		}		
		if($keyword != null){
			$criteria = " Classroom.classroom_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'vlist/'.$keyword));
		
		$data = $this->Classroom->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('classrooms',$data);
	}

}
?>