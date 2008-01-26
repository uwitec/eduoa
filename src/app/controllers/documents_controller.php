<?php
class DocumentsController extends AppController {

	var $name = 'Documents';
	var $helpers = array('Html', 'Form' );

	function index() {
		$id = $this->params['url']['type'];
		$this->Document->recursive = 0;
		$this->set('courses', 
				   $this->Document->Course->generateList(
					 $conditions = null,
					 $order = 'id',
					 $limit = null,
					 $keyPath = '{n}.Course.id',
					 $valuePath = '{n}.Course.course_name')
		);
		if($id) {
			$this->set('documents', $this->Document->findAll('document_type_id = '.$id));
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
			$this->set('documentTypes', 
						$this->Document->DocumentType->generateList(
				         $conditions = null,
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.DocumentType.id',
			             $valuePath = '{n}.DocumentType.type_name')
			);
			$this->set('rates', $this->Document->Rate->generateList());
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
			$this->set('documentTypes', $this->Document->DocumentType->generateList());
			$this->set('rates', $this->Document->Rate->generateList());
			$this->set('courses', $this->Document->Course->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash('保存成功！');
				$this->redirect('/documents/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('documentTypes', $this->Document->DocumentType->generateList());
				$this->set('rates', $this->Document->Rate->generateList());
				$this->set('courses', $this->Document->Course->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Document');
			$this->redirect('/documents/index');
		}
		if ($this->Document->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/documents/index');
		}
	}

}

?>