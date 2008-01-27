<?php
class AssetOutsController extends AppController {

	var $name = 'AssetOuts';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->AssetOut->recursive = 0;
		$this->set('assetOuts', $this->AssetOut->findAll('asset_type_id <> 99999'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset Out.');
			$this->redirect('/asset_outs/index');
		}
		$this->set('assetOut', $this->AssetOut->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('assets', 
						$this->AssetOut->Asset->generateList(
							$conditions = 'asset_type_id <> 99999',
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Asset.id',
							$valuePath = '{n}.Asset.asset_name')
			);
			$this->set('departments', 
						$this->AssetOut->Department->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Department.id',
							$valuePath = '{n}.Department.department_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->AssetOut->save($this->data)) {
				$this->Session->setFlash('资产借出保存成功！');
				$this->redirect('/asset_outs/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('assets', $this->AssetOut->Asset->generateList());
				$this->set('departments', $this->AssetOut->Department->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Asset Out');
				$this->redirect('/asset_outs/index');
			}
			$this->data = $this->AssetOut->read(null, $id);
			$this->set('assets', 
						$this->AssetOut->Asset->generateList(
							$conditions = 'asset_type_id <> 99999',
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Asset.id',
							$valuePath = '{n}.Asset.asset_name')
			);
			$this->set('departments', 
						$this->AssetOut->Department->generateList(
							$conditions = null,
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Department.id',
							$valuePath = '{n}.Department.department_name')
			);

		} else {
			$this->cleanUpFields();
			if ($this->AssetOut->save($this->data)) {
				$this->Session->setFlash('资产借出保存成功！');
				$this->redirect('/asset_outs/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('assets', $this->AssetOut->Asset->generateList());
				$this->set('departments', $this->AssetOut->Department->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset Out');
			$this->redirect('/asset_outs/index');
		}
		if ($this->AssetOut->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/asset_outs/index');
		}
	}

}
?>