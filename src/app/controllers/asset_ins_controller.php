<?php
class AssetInsController extends AppController {

	var $name = 'AssetIns';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->AssetIn->recursive = 0;
		$this->set('assetIns', $this->AssetIn->findAll('asset_type_id <> 99999'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset In.');
			$this->redirect('/asset_ins/index');
		}
		$this->set('assetIn', $this->AssetIn->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('assets', 
						$this->AssetIn->Asset->generateList(
							$conditions = 'asset_type_id <> 99999',
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Asset.id',
							$valuePath = '{n}.Asset.asset_name')
			);
			$this->set('departments', 
						$this->AssetIn->Department->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Department.id',
							$valuePath = '{n}.Department.department_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->AssetIn->save($this->data)) {
				$this->Session->setFlash('资产归还保存成功！');
				$this->redirect('/asset_ins/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('assets', $this->AssetIn->Asset->generateList());
				$this->set('departments', $this->AssetIn->Department->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Asset In');
				$this->redirect('/asset_ins/index');
			}
			$this->data = $this->AssetIn->read(null, $id);
			$this->set('assets', 
						$this->AssetIn->Asset->generateList(
							$conditions = 'asset_type_id <> 99999',
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Asset.id',
							$valuePath = '{n}.Asset.asset_name')
			);
			$this->set('departments', 
						$this->AssetIn->Department->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Department.id',
							$valuePath = '{n}.Department.department_name')
			);
		} else {
			$this->cleanUpFields();
			if ($this->AssetIn->save($this->data)) {
				$this->Session->setFlash('资产归还保存成功！');
				$this->redirect('/asset_ins/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('assets', $this->AssetIn->Asset->generateList());
				$this->set('departments', $this->AssetIn->Department->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset In');
			$this->redirect('/asset_ins/index');
		}
		if ($this->AssetIn->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/asset_ins/index');
		}
	}

}
?>