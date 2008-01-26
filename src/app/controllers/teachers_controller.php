<?php
class TeachersController extends AppController {

	var $name = 'Teachers';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Teacher->recursive = 0;
		$this->set('teachers', $this->Teacher->findAll());
	}

	function public_index() {
		$this->Teacher->recursive = 0;
		$this->set('teachers', $this->Teacher->findAll());
	}

	function teaching() {
		$this->set('teachers', $this->Teacher->findAll());
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
			if ($this->Teacher->save($this->data)) {
				$this->Session->setFlash('教职工信息新增成功！');
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

			$this->set('files', $this->Teacher->File->generateList());
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

}
?>