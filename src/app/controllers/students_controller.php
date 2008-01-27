<?php
class StudentsController extends AppController {

	var $name = 'Students';
	var $helpers = array('Html', 'Form' );

	function index($id = null) {
		$this->Student->recursive = 0;
		if($id){
			$this->set('students', $this->Student->findAll('banji.id = '.$id));
			$this->set('banji_id',$id);
		}else{
			$this->set('students', $this->Student->findAll());
			$this->set('banji_id',null);
		}
	}

	function index_change($id = null) {
		$this->Student->recursive = 0;
		if($id){
			$this->set('students', $this->Student->findAll('Banji.id = '.$id));
			$this->set('banji_id',$id);
		}else{
			$this->set('students', $this->Student->findAll());
			$this->set('banji_id',null);
		}
	}

   function index_grow_files($id = null) {
		$this->Student->recursive = 0;
		$banji = $this->params['url']['banji'];
		if($banji){
			$this->set('students', $this->Student->findAll('Banji.id = '.$banji));
			$this->set('banji_id',$id);
		}else{
			$this->set('students', $this->Student->findAll());
			$this->set('banji_id',null);
		}
   }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student.');
			$this->redirect('/students/index');
		}
		$this->set('student', $this->Student->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('banjis', 
					   $this->Student->Banji->generateList(
						 $conditions = null,
						 $order = 'id',
						 $limit = null,
						 $keyPath = '{n}.Banji.id',
						 $valuePath = '{n}.Banji.class_name')
			);
			$this->set('people', 
					   $this->Student->Person->generateList(
						 $conditions = null,
						 $order = 'id',
						 $limit = null,
						 $keyPath = '{n}.Person.id',
						 $valuePath = '{n}.Person.people_name')
			);
			$this->set('files', $this->Student->File->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Student->save($this->data)) {
				$this->Session->setFlash('学生信息新增成功！');
				$this->redirect('/students/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('banjis', $this->Student->Banji->generateList());
				$this->set('people', $this->Student->Person->generateList());
				$this->set('files', $this->Student->File->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Student');
				$this->redirect('/students/index');
			}
			$this->data = $this->Student->read(null, $id);
			$this->set('banjis', 
					   $this->Student->Banji->generateList(
						 $conditions = null,
						 $order = 'id',
						 $limit = null,
						 $keyPath = '{n}.Banji.id',
						 $valuePath = '{n}.Banji.class_name')
			);
			$this->set('people', 
					   $this->Student->Person->generateList(
						 $conditions = null,
						 $order = 'id',
						 $limit = null,
						 $keyPath = '{n}.Person.id',
						 $valuePath = '{n}.Person.people_name')
			);
			$this->set('files', $this->Student->File->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Student->save($this->data)) {
				$this->Session->setFlash('学生信息保存成功！');
				$this->redirect('/students/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('banjis', $this->Student->Banji->generateList());
				$this->set('people', $this->Student->Person->generateList());
				$this->set('files', $this->Student->File->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Student');
			$this->redirect('/students/index');
		}
		if ($this->Student->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/students/index');
		}
	}

	function slist($id = null) {
		$this->Student->recursive = 0;
		if($id == null) {
			$this->set('students', $this->Student->findAll());			
		}else {
			$criteria = "Student.id = $id";
			$this->set('students', $this->Student->findAll($criteria));
		}

	}

	function password($id = null) {
		$this->Student->recursive = 0;
		if($id){
			$this->set('students', $this->Student->findAll('banji.id = '.$id));
			$this->set('banji_id',$id);
		}else{
			$this->set('students', $this->Student->findAll());
			$this->set('banji_id',null);
		}
	}

	//修改密码还有点bug
	function edit_password($id = null) {
		$this->set('student', $this->Student->read(null, $id));
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Student');
				$this->redirect('/students/password');
			}
			$this->data = $this->Student->read(null, $id);
		} else {
			$this->cleanUpFields();
			$old_password = md5($this->data['Student']['old']);
			$password = md5($this->data['Student']['new']);
			$sql = "update students set password = '$password' where id = " .$id;
			$this->Student->execute($sql);
			$this->Session->setFlash('口令修改成功！');	
			$this->redirect('/students/password');
		}

	}   

}
?>