<?php
class AssetsController extends AppController {

	var $name = 'Assets';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Asset->recursive = 0;
		$this->set('assets', $this->Asset->findAll());
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
			$this->set('assetTypes', $this->Asset->AssetType->generateList());
			$this->set('departments', $this->Asset->Department->generateList());
			$this->set('assetStatuses', $this->Asset->AssetStatus->generateList());
			$this->set('assetInMethods', $this->Asset->AssetInMethod->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Asset->save($this->data)) {
				$this->Session->setFlash('The Asset has been saved');
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
			$this->set('assetTypes', $this->Asset->AssetType->generateList());
			$this->set('departments', $this->Asset->Department->generateList());
			$this->set('assetStatuses', $this->Asset->AssetStatus->generateList());
			$this->set('assetInMethods', $this->Asset->AssetInMethod->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Asset->save($this->data)) {
				$this->Session->setFlash('The Asset has been saved');
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
			$this->Session->setFlash('The Asset deleted: id '.$id.'');
			$this->redirect('/assets/index');
		}
	}

}
?>