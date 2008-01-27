<?php
class DocumentsController extends AppController {

	var $name = 'Documents';
	var $helpers = array('Html', 'Form' );

	function index() {
		$id = $this->params['url']['type'];
		//$this->Document->recursive = 0;
		$this->set('courses', 
				   $this->Document->Course->generateList(
					 $conditions = null,
					 $order = 'id',
					 $limit = null,
					 $keyPath = '{n}.Course.id',
					 $valuePath = '{n}.Course.course_name')
		);
		if($id) {
			$this->set('documents', $this->Document->findAll('document_type_id = '.$id. ' and is_commons is null order by created desc'));
		}else {
			$this->set('documents', $this->Document->findAll());
		}
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Document.');
			$this->redirect('/documents/index');
		}
		$this->set('document', $this->Document->read(null, $id));
	}

	function add($id = null) {
		if (empty($this->data)) {
			$this->set('banjis', 
						$this->Document->Banji->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Banji.id',
			             $valuePath = '{n}.Banji.class_name')
			);
			$this->set('selectedBanjis', null);
			$this->set('documentTypes', 
						$this->Document->DocumentType->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.DocumentType.id',
			             $valuePath = '{n}.DocumentType.type_name')
			);
			$this->set('rates', 
						$this->Document->Rate->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Rate.id',
			             $valuePath = '{n}.Rate.rate_name')
			);
			$this->set('courses', 
				       $this->Document->Course->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Course.id',
			             $valuePath = '{n}.Course.course_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash('新增成功！');
				$this->redirect('/documents/index/?type='.$this->data['Document']['document_type_id']);
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('banjis', $this->Document->Banji->generateList());
				if (empty($this->data['Banji']['Banji'])) { $this->data['Banji']['Banji'] = null; }
				$this->set('selectedBanjis', $this->data['Banji']['Banji']);
				$this->set('documentTypes', $this->Document->DocumentType->generateList());
				$this->set('rates', $this->Document->Rate->generateList());
				$this->set('courses', $this->Document->Course->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Document');
				$this->redirect('/documents/index');
			}
			$this->data = $this->Document->read(null, $id);
			$this->set('banjis', 
						$this->Document->Banji->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Banji.id',
			             $valuePath = '{n}.Banji.class_name')
			);
			if (empty($this->data['Banji'])) { $this->data['Banji'] = null; }
			$this->set('selectedBanjis', $this->_selectedArray($this->data['Banji']));
			$this->set('documentTypes', $this->Document->DocumentType->generateList());
			$this->set('rates', 
						$this->Document->Rate->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Rate.id',
			             $valuePath = '{n}.Rate.rate_name')
			);
			$this->set('courses', 
				       $this->Document->Course->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Course.id',
			             $valuePath = '{n}.Course.course_name')
			);
		} else {
			$this->cleanUpFields();
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash('保存成功！');
				$this->redirect('/documents/index/?type='.$this->data['Document']['document_type_id']);
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('banjis', $this->Document->Banji->generateList());
				if (empty($this->data['Banji']['Banji'])) { $this->data['Banji']['Banji'] = null; }
				$this->set('selectedBanjis', $this->data['Banji']['Banji']);
				$this->set('documentTypes', $this->Document->DocumentType->generateList());
				$this->set('rates', $this->Document->Rate->generateList());
				$this->set('courses', $this->Document->Course->generateList());
			}
		}
	}

	function delete($id = null,$type = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Document');
			$this->redirect('/documents/index');
		}
		if ($this->Document->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/documents/index/?type='.$type);
		}
	}

	function all_index() {
		$id = $this->params['url']['type'];
		$this->Document->recursive = 0;
		if($id) {
			$this->set('documents', $this->Document->findAll('document_type_id = '.$id. ' and is_commons=1 order by created desc'));
		}else {
			$this->set('documents', $this->Document->findAll());
		}
		
	}

	function all_add($id = null) {
		if (empty($this->data)) {
			$this->set('documentTypes', 
						$this->Document->DocumentType->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.DocumentType.id',
			             $valuePath = '{n}.DocumentType.type_name')
			);
			$this->set('rates', 
						$this->Document->Rate->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Rate.id',
			             $valuePath = '{n}.Rate.rate_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			$this->data['Document']['is_commons'] = 1;
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash('新增成功！');
				$this->redirect('/documents/all_index/?type='.$this->data['Document']['document_type_id']);
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('documentTypes', $this->Document->DocumentType->generateList());
				$this->set('rates', $this->Document->Rate->generateList());
				$this->set('courses', $this->Document->Course->generateList());
			}
		}
	}

	function all_view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Document.');
			$this->redirect('/documents/all_index');
		}
		$this->set('document', $this->Document->read(null, $id));
	}

	function all_edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Document');
				$this->redirect('/documents/all_index');
			}
			$this->data = $this->Document->read(null, $id);
			$this->set('documentTypes', $this->Document->DocumentType->generateList());
			$this->set('rates', 
						$this->Document->Rate->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Rate.id',
			             $valuePath = '{n}.Rate.rate_name')
			);
		} else {
			$this->cleanUpFields();
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash('保存成功！');
				$this->redirect('/documents/all_index/?type='.$this->data['Document']['document_type_id']);
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('documentTypes', $this->Document->DocumentType->generateList());
				$this->set('rates', $this->Document->Rate->generateList());
				$this->set('courses', $this->Document->Course->generateList());
			}
		}
	}

	function all_delete($id = null,$type = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Document');
			$this->redirect('/documents/all_index');
		}
		if ($this->Document->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/documents/all_index/?type='.$type);
		}
	}

}

?>