<?php
class AssetOutsController extends AppController {

	var $name = 'AssetOuts';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->AssetOut->recursive = 0;
		$this->set('assetOuts', $this->AssetOut->findAll());
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
			$this->set('assets', $this->AssetOut->Asset->generateList());
			$this->set('departments', $this->AssetOut->Department->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->AssetOut->save($this->data)) {
				$this->Session->setFlash('The Asset Out has been saved');
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
			$this->set('assets', $this->AssetOut->Asset->generateList());
			$this->set('departments', $this->AssetOut->Department->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->AssetOut->save($this->data)) {
				$this->Session->setFlash('The AssetOut has been saved');
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
			$this->Session->setFlash('The Asset Out deleted: id '.$id.'');
			$this->redirect('/asset_outs/index');
		}
	}

}
?>