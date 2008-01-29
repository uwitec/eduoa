<?php
class StudentsController extends AppController {

	var $name = 'Students';
	var $helpers = array('Html', 'Form', 'Javascript', 'Csv');

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

   function import() {
	   if (empty($this->data)) {
		$this->set('banjis', 
			   $this->Student->Banji->generateList(
			     $conditions = null,
			     $order = 'id',
				 $limit = null,
				 $keyPath = '{n}.Banji.id',
				 $valuePath = '{n}.Banji.class_name')
		);
	  }else{
		  if (isset($this->params['form']['Filedata'])) {
			  $fname = $this->params['form']['Filedata']['name'];
			  if(copy($this->params['form']['Filedata']['tmp_name'],$fname)){
				  $handle=fopen("$fname","r");
				  $count = 0;
				  $banji_id = $this->data['Student']['banji_id'];

				  while($data=fgetcsv($handle,10000,",")){
					  if(!$this->Student->findByStudentNo($data[0]) && $this->data['Student']['exists'] == 1){
						  $is_do = true;
					  }else{
						  $is_do = false;
					  }
					  if($count >0 && $is_do){
						  $data[4]=='男'?$data[4]='1':$data[4]='0';
						  $data[5]=='汉族'?$data[5]='1':$data[5]='0';

						  $sql = "insert into students (banji_id,student_no,student_name,birthday,sex,people_id,native_place,total_score,political_feature,physical_condition,cert_number,graduate_the_college,foreign_language,enter_the_way,origin,address,zip,telphone,email,enter_date,remark,student_phone,father_name,father_unit,father_phone,mother_name,mother_unit,mother_phone)";

						  $sql .= " values ('$banji_id','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]','$data[26]')";
						  $sql = iconv("gb2312","UTF-8",$sql);
						  $this->Student->execute($sql);
					  }
					  $count++;
				  }
				  $this->Session->setFlash('导入学生档案成功！');
				  $this->redirect('/students/');
				  exit();
			  }else{
				$this->set('banjis', 
					   $this->Student->Banji->generateList(
						 $conditions = null,
						 $order = 'id',
						 $limit = null,
						 $keyPath = '{n}.Banji.id',
						 $valuePath = '{n}.Banji.class_name')
				);
				$this->Session->setFlash('上传文件失败！');	
				$this->redirect('/students/import');
				exit();
			  }
		  }
	  }
   }


  function initpassword($id = null, $pwd = null){
  	$this->layout = 'ajax';
  	if($pwd == null){
  		$pwd = md5('888888');
  	}else{
  		$pwd = md5($pwd);
  	}
  	
  	$sql = "update students set password = '$pwd' where id = $id";
  	$this->Student->execute($sql);
  
  }


   function download() {
	$this->layout = 'ajax';
   }

}
?>