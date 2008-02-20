<?php
class AssetStatusesController extends AppController {

	var $name = 'AssetStatuses';
	var $helpers = array('Html', 'Form','Javascript' );

	function index() {
		$this->AssetStatus->recursive = 0;
		$this->set('assetStatuses', $this->AssetStatus->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset Status.');
			$this->redirect('/asset_statuses/index');
		}
		$this->set('assetStatus', $this->AssetStatus->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->AssetStatus->save($this->data)) {
				$this->Session->setFlash('资产状态保存成功！');
				$this->redirect('/asset_statuses/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Asset Status');
				$this->redirect('/asset_statuses/index');
			}
			$this->data = $this->AssetStatus->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->AssetStatus->save($this->data)) {
				$this->Session->setFlash('资产状态修改成功！');
				$this->redirect('/asset_statuses/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset Status');
			$this->redirect('/asset_statuses/index');
		}
		if ($this->AssetStatus->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/asset_statuses/index');
		}
	}

}
?>