<?php
class AssetInMethodsController extends AppController {

	var $name = 'AssetInMethods';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->AssetInMethod->recursive = 0;
		$this->set('assetInMethods', $this->AssetInMethod->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset In Method.');
			$this->redirect('/asset_in_methods/index');
		}
		$this->set('assetInMethod', $this->AssetInMethod->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->AssetInMethod->save($this->data)) {
				$this->Session->setFlash('资产增加方式保存成功！');
				$this->redirect('/asset_in_methods/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Asset In Method');
				$this->redirect('/asset_in_methods/index');
			}
			$this->data = $this->AssetInMethod->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->AssetInMethod->save($this->data)) {
				$this->Session->setFlash('资产增加方式修改成功！');
				$this->redirect('/asset_in_methods/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset In Method');
			$this->redirect('/asset_in_methods/index');
		}
		if ($this->AssetInMethod->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/asset_in_methods/index');
		}
	}

}
?>