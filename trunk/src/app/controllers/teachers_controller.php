<?php
class TeachersController extends AppController {

	var $name = 'Teachers';
	var $components = array('Acl','AjaxValid','Pagination');//Make sure you include this, it makes the magic work.
	var $helpers = array('Html', 'Form' ,'Javascript','Pagination');
	var $uses = array('Teacher', 'Member', 'User', 'Role');

	function index($keyword = null, $page=1) {
		$this->Teacher->recursive = 0;

		$criteria = " ";
		if($keyword == null){
			$keyword = $this->data['Teacher']['keyword'];
		}		
		if($keyword != null){
			$criteria = " Teacher.teacher_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'index/'.$keyword));
		
		$data = $this->Teacher->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('teachers',$data);
	}

	function list_by_department($department_id = null) {
		$this->Teacher->recursive = 0;
		$this->set('teachers', $this->Teacher->findAllByDepartmentId($department_id));
	}

	function public_index($keyword = null, $page=1) {
		$this->Teacher->recursive = 0;

		$criteria = " ";
		if($keyword == null){
			$keyword = $this->data['Teacher']['keyword'];
		}		
		if($keyword != null){
			$criteria = " Teacher.teacher_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'public_index/'.$keyword));
		
		$data = $this->Teacher->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('teachers',$data);
	}

	function teaching($keyword = null, $page=1) {
		$criteria = " ";
		if($keyword == null){
			$keyword = $this->data['Teacher']['keyword'];
		}		
		if($keyword != null){
			$criteria = " Teacher.teacher_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'teaching/'.$keyword));
		
		$data = $this->Teacher->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('teachers',$data);
	}



	function teaching_edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Teacher');
				$this->redirect('/teachers/teaching');
			}
			$this->data = $this->Teacher->read(null, $id);
			$this->set('banjis', $this->Teacher->Banji->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Banji.id',
							$valuePath = '{n}.Banji.class_name')
			);
			if (empty($this->data['Banji'])) { $this->data['Banji'] = null; }
			$this->set('selectedBanjis', $this->_selectedArray($this->data['Banji']));
			$this->set('courses', $this->Teacher->Course->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Course.id',
							$valuePath = '{n}.Course.course_name')
			);
			if (empty($this->data['Course'])) { $this->data['Course'] = null; }
			$this->set('selectedCourses', $this->_selectedArray($this->data['Course']));

		} else {
			$this->cleanUpFields();
			if ($this->Teacher->save($this->data)) {
				$this->Session->setFlash('任教信息保存成功！');
				$this->redirect('/teachers/teaching');
			} else {
				$this->Session->setFlash('Please correct errors below.');

				$this->set('banjis', $this->Teacher->Banji->generateList(
								$conditions = null,
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Banji.id',
								$valuePath = '{n}.Banji.class_name')
				);
				if (empty($this->data['Banji'])) { $this->data['Banji'] = null; }
				$this->set('selectedBanjis', $this->_selectedArray($this->data['Banji']));
				$this->set('courses', $this->Teacher->Course->generateList(
								$conditions = null,
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Course.id',
								$valuePath = '{n}.Course.course_name')
				);
				if (empty($this->data['Course'])) { $this->data['Course'] = null; }
				$this->set('selectedCourses', $this->_selectedArray($this->data['Course']));

			}
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher.');
			$this->redirect('/teachers/index');
		}
		$this->set('teacher', $this->Teacher->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('banjis', $this->Teacher->Banji->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Banji.id',
							$valuePath = '{n}.Banji.class_name')
			);
			$this->set('selectedBanjis', null);
			$this->set('courses', $this->Teacher->Course->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Course.id',
							$valuePath = '{n}.Course.course_name')
			);
			$this->set('selectedCourses', null);
			$this->set('users', $this->Teacher->User->generateList());
			$this->set('people', 
						$this->Teacher->Person->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Person.id',
							$valuePath = '{n}.Person.people_name')
			);

			$this->set('degrees', 
						$this->Teacher->Degree->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Degree.id',
							$valuePath = '{n}.Degree.degree_name')
			);

			$this->set('roles', 
						$this->Role->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Role.id',
							$valuePath = '{n}.Role.role_name')
			);


			$this->set('departments', 
						$this->Teacher->Department->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Department.id',
							$valuePath = '{n}.Department.department_name')
			);
			$this->set('files', $this->Teacher->File->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();

			//首先判断登录名是否重复
			if($this->Member->findByUsername($this->data['Member']['username'])){
        		$this->Session->setFlash('新增教师的系统登录名重复,请重新录入!');
				$this->set('banjis', $this->Teacher->Banji->generateList(
								$conditions = null,
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Banji.id',
								$valuePath = '{n}.Banji.class_name')
				);
				$this->set('selectedBanjis', null);
				$this->set('courses', $this->Teacher->Course->generateList(
								$conditions = null,
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Course.id',
								$valuePath = '{n}.Course.course_name')
				);
				$this->set('selectedCourses', null);
				$this->set('users', $this->Teacher->User->generateList());
				$this->set('people', 
							$this->Teacher->Person->generateList(
								$conditions = null,
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Person.id',
								$valuePath = '{n}.Person.people_name')
				);
				$this->set('degrees', 
							$this->Teacher->Degree->generateList(
								$conditions = null,
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Degree.id',
								$valuePath = '{n}.Degree.degree_name')
				);
				$this->set('departments', 
							$this->Teacher->Department->generateList(
								$conditions = null,
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Department.id',
								$valuePath = '{n}.Department.department_name')
				);
        	}else{
				//首先保存Member表
				$this->Member->create();
				$data1['Member']['username'] = $this->data['Member']['username'];
				$data1['Member']['password'] = $this->data['Member']['password'];
				$data1['Member']['email'] = $this->data['Teacher']['email'];
				$this->Member->save($data1);

				//其次保存User表
				$user_id = $this->Member->getLastInsertID();
				$this->User->create();
				$data['User']['id'] = $user_id;
				$data['User']['login_name'] = $this->data['Member']['username'];
				$data['User']['password'] = $this->data['Member']['password'];
				$data['User']['user_name'] = $this->data['Teacher']['teacher_name'];
				$data['User']['email'] = $this->data['Teacher']['email'];
				$this->User->save($data);

				//最后保存Tearcher表
				$this->data['Tearcher']['user_id'] = $user_id;
				$this->Teacher->save($this->data);
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Teacher');
				$this->redirect('/teachers/index');
			}
			$this->data = $this->Teacher->read(null, $id);
			$this->set('banjis', $this->Teacher->Banji->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Banji.id',
							$valuePath = '{n}.Banji.class_name')
			);
			$this->set('courses', $this->Teacher->Course->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Course.id',
							$valuePath = '{n}.Course.course_name')
			);
			$this->set('people', 
						$this->Teacher->Person->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Person.id',
							$valuePath = '{n}.Person.people_name')
			);
			$this->set('degrees', 
						$this->Teacher->Degree->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Degree.id',
							$valuePath = '{n}.Degree.degree_name')
			);
			$this->set('roles', 
						$this->Role->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Role.id',
							$valuePath = '{n}.Role.role_name')
			);
			$this->set('departments', 
						$this->Teacher->Department->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Department.id',
							$valuePath = '{n}.Department.department_name')
			);

		} else {
			$this->cleanUpFields();
			if ($this->Teacher->save($this->data)) {
				$this->Session->setFlash('教职工信息修改成功！');
				$this->redirect('/teachers/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('banjis', $this->Teacher->Banji->generateList());
				if (empty($this->data['Banji']['Banji'])) { $this->data['Banji']['Banji'] = null; }
				$this->set('selectedBanjis', $this->data['Banji']['Banji']);
				$this->set('courses', $this->Teacher->Course->generateList());
				if (empty($this->data['Course']['Course'])) { $this->data['Course']['Course'] = null; }
				$this->set('selectedCourses', $this->data['Course']['Course']);
				$this->set('users', $this->Teacher->User->generateList());
				$this->set('people', $this->Teacher->Person->generateList());
				$this->set('degrees', $this->Teacher->Degree->generateList());
				$this->set('departments', $this->Teacher->Department->generateList());
				$this->set('files', $this->Teacher->File->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Teacher');
			$this->redirect('/teachers/index');
		}
		if ($this->Teacher->del($id)) {
			$this->Session->setFlash('教职工删除成功！');
			$this->redirect('/teachers/index');
		}
	}

	function password($keyword = null, $page=1) {
		$this->Teacher->recursive = 0;

		$criteria = " ";
		if($keyword == null){
			$keyword = $this->data['Teacher']['keyword'];
		}		
		if($keyword != null){
			$criteria = " Teacher.teacher_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'password/'.$keyword));
		
		$data = $this->Teacher->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('teachers',$data);
	}


	function initpassword($id = null, $pwd = null){

		$this->layout = 'ajax';
		if($pwd == null){
			$pwd = md5('888888');
		}else{
			$pwd = md5($pwd);
		}

		$sql = "update members set password = '$pwd' where id = $id ";
		$this->Teacher->execute($sql);
	}

}
?>