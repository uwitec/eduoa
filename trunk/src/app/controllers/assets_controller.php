<?php
class AssetsController extends AppController {

	var $name = 'Assets';
	var $helpers = array('Html', 'Form','Javascript' );

	function index() {
		$this->Asset->recursive = 0;
		$this->set('assets', $this->Asset->findAll('asset_type_id <> 99999'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset.');
			$this->redirect('/assets/index');
		}
		$this->set('asset', $this->Asset->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('assetTypes', 
						$this->Asset->AssetType->generateList(
							$conditions = 'id <> 99999',
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.AssetType.id',
							$valuePath = '{n}.AssetType.type_name')
			);
			$this->set('departments', 
						$this->Asset->Department->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Department.id',
							$valuePath = '{n}.Department.department_name')
			);
			$this->set('assetStatuses', 
						$this->Asset->AssetStatus->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.AssetStatus.id',
							$valuePath = '{n}.AssetStatus.status_name')
			);
			$this->set('assetInMethods', 
						$this->Asset->AssetInMethod->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.AssetInMethod.id',
							$valuePath = '{n}.AssetInMethod.method_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Asset->save($this->data)) {
				$this->Session->setFlash('资产保存成功！');
				$this->redirect('/assets/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('assetTypes', $this->Asset->AssetType->generateList());
				$this->set('departments', $this->Asset->Department->generateList());
				$this->set('assetStatuses', $this->Asset->AssetStatus->generateList());
				$this->set('assetInMethods', $this->Asset->AssetInMethod->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Asset');
				$this->redirect('/assets/index');
			}
			$this->data = $this->Asset->read(null, $id);
			$this->set('assetTypes', 
						$this->Asset->AssetType->generateList(
							$conditions = 'id <> 99999',
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.AssetType.id',
							$valuePath = '{n}.AssetType.type_name')
			);
			$this->set('departments', 
						$this->Asset->Department->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Department.id',
							$valuePath = '{n}.Department.department_name')
			);
			$this->set('assetStatuses', 
						$this->Asset->AssetStatus->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.AssetStatus.id',
							$valuePath = '{n}.AssetStatus.status_name')
			);
			$this->set('assetInMethods', 
						$this->Asset->AssetInMethod->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.AssetInMethod.id',
							$valuePath = '{n}.AssetInMethod.method_name')
			);
		} else {
			$this->cleanUpFields();
			if ($this->Asset->save($this->data)) {
				$this->Session->setFlash('资产保存成功！');
				$this->redirect('/assets/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('assetTypes', $this->Asset->AssetType->generateList());
				$this->set('departments', $this->Asset->Department->generateList());
				$this->set('assetStatuses', $this->Asset->AssetStatus->generateList());
				$this->set('assetInMethods', $this->Asset->AssetInMethod->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset');
			$this->redirect('/assets/index');
		}
		if ($this->Asset->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/assets/index');
		}
	}

	//书籍管理处理

	function book_index() {
		$this->Asset->recursive = 0;
		$this->set('assets', $this->Asset->findAll('asset_type_id = 99999'));
	}

	function book_add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			$this->data['Asset']['asset_type_id'] = 99999;
			if ($this->Asset->save($this->data)) {
				$this->Session->setFlash('书籍保存成功！');
				$this->redirect('/assets/book_index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function book_edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Asset');
				$this->redirect('/assets/index');
			}
			$this->data = $this->Asset->read(null, $id);
		} else {
			$this->cleanUpFields();
			$this->data['Asset']['asset_type_id'] = 99999;
			if ($this->Asset->save($this->data)) {
				$this->Session->setFlash('书籍保存成功！');
				$this->redirect('/assets/book_index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function book_view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset.');
			$this->redirect('/assets/book_index');
		}
		$this->set('asset', $this->Asset->read(null, $id));
	}

	function book_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset');
			$this->redirect('/assets/book_index');
		}
		if ($this->Asset->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/assets/book_index');
		}
	}

	function book_in_out() {
		$this->Asset->recursive = 0;
		$this->set('assets', $this->Asset->findAll('asset_type_id = 99999'));
	}

	function book_search() {
		$this->Asset->recursive = 0;
		$this->set('assets', $this->Asset->findAll('asset_type_id = 99999'));
	}


}
?>