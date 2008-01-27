<?php
class AssetTypesController extends AppController {

	var $name = 'AssetTypes';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->AssetType->recursive = 0;
		$this->set('assetTypes', $this->AssetType->findAll('id <> 99999'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset Type.');
			$this->redirect('/asset_types/index');
		}
		$this->set('assetType', $this->AssetType->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->AssetType->save($this->data)) {
				$this->Session->setFlash('资产类型保存成功！');
				$this->redirect('/asset_types/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Asset Type');
				$this->redirect('/asset_types/index');
			}
			$this->data = $this->AssetType->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->AssetType->save($this->data)) {
				$this->Session->setFlash('资产类型修改成功！');
				$this->redirect('/asset_types/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset Type');
			$this->redirect('/asset_types/index');
		}
		if ($this->AssetType->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/asset_types/index');
		}
	}

}
?>