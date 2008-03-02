<?php
class TeacherContinuingEducationsController extends AppController {

	var $name = 'TeacherContinuingEducations';
	var $components = array('Acl','AjaxValid','Pagination');//Make sure you include this, it makes the magic work.
	var $helpers = array('Html', 'Form' ,'Javascript','Pagination');

	function index($keyword = null, $page=1) {
		//$this->TeacherIsWork->recursive = 0;
		$criteria = " ";
		if($keyword == null){
			$keyword = $this->data['TeacherContinuingEducation']['keyword'];
		}		
		if($keyword != null){
			$criteria = " Teacher.teacher_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'index/'.$keyword));
		
		$data = $this->TeacherContinuingEducation->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('teacherContinuingEducations',$data);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Continuing Education.');
			$this->redirect('/teacher_continuing_educations/index');
		}
		$this->set('teacherContinuingEducation', $this->TeacherContinuingEducation->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('teachers', 
						$this->TeacherContinuingEducation->Teacher->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Teacher.id',
							$valuePath = '{n}.Teacher.teacher_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->data['TeacherContinuingEducation']['start_date'] > $this->data['TeacherContinuingEducation']['end_date']) {
				$this->Session->setFlash('教育开始日期不能大于结束日期！');
				$this->set('teachers', 
							$this->TeacherContinuingEducation->Teacher->generateList(
								$conditions = null,
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Teacher.id',
								$valuePath = '{n}.Teacher.teacher_name')
				);
			}else {
				if ($this->TeacherContinuingEducation->save($this->data)) {
					$this->Session->setFlash('新增教职工继续教育记录成功！');
					$this->redirect('/teacher_continuing_educations/index');
				} else {
					$this->Session->setFlash('Please correct errors below.');
					$this->set('teachers', $this->TeacherContinuingEducation->Teacher->generateList());
				}
			}

		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Teacher Continuing Education');
				$this->redirect('/teacher_continuing_educations/index');
			}
			$this->data = $this->TeacherContinuingEducation->read(null, $id);
			$this->set('teachers', 
						$this->TeacherContinuingEducation->Teacher->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Teacher.id',
							$valuePath = '{n}.Teacher.teacher_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->data['TeacherContinuingEducation']['start_date'] > $this->data['TeacherContinuingEducation']['end_date']) {
				$this->Session->setFlash('教育开始日期不能大于结束日期！');
				$this->set('teachers', 
							$this->TeacherContinuingEducation->Teacher->generateList(
								$conditions = null,
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Teacher.id',
								$valuePath = '{n}.Teacher.teacher_name')
				);
			}else {
				if ($this->TeacherContinuingEducation->save($this->data)) {
					$this->Session->setFlash('教职工继续教育记录保存成功！');
					$this->redirect('/teacher_continuing_educations/index');
				} else {
					$this->Session->setFlash('Please correct errors below.');
					$this->set('teachers', $this->TeacherContinuingEducation->Teacher->generateList());
				}
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher Continuing Education');
			$this->redirect('/teacher_continuing_educations/index');
		}
		if ($this->TeacherContinuingEducation->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/teacher_continuing_educations/index');
		}
	}

}
?>