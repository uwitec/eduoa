<?php
class AssetOutsController extends AppController {

	var $name = 'AssetOuts';
	var $components = array('Acl','AjaxValid','Pagination');//Make sure you include this, it makes the magic work.
	var $helpers = array('Html', 'Form' ,'Javascript','Pagination');

	function index($keyword = null, $page=1) {
		$this->AssetOut->recursive = 0;

		$criteria = " Asset.asset_type_id <> 99999 ";
		if($keyword == null){
			$keyword = $this->data['AssetOut']['keyword'];
		}		
		if($keyword != null){
			$criteria .= " and Asset.asset_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'index/'.$keyword));
		
		$data = $this->AssetOut->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('assetOuts',$data);
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
							$conditions = 'Asset.asset_type_id <> 99999',
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
							$conditions = 'Asset.asset_type_id <> 99999',
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

	//图书
	function book_index() {
		$this->AssetOut->recursive = 0;
		$this->set('assetOuts', $this->AssetOut->findAll('Asset.asset_type_id = 99999'));
	}

	function book_add() {
		if (empty($this->data)) {
			$this->set('assets', 
						$this->AssetOut->Asset->generateList(
							$conditions = 'Asset.asset_type_id = 99999',
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
				$this->Session->setFlash('书籍借出保存成功！');
				$this->redirect('/asset_outs/book_index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('assets', $this->AssetOut->Asset->generateList());
				$this->set('departments', $this->AssetOut->Department->generateList());
			}
		}
	}

	function book_edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Asset Out');
				$this->redirect('/asset_outs/book_index');
			}
			$this->data = $this->AssetOut->read(null, $id);
			$this->set('assets', 
						$this->AssetOut->Asset->generateList(
							$conditions = 'Asset.asset_type_id = 99999',
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
				$this->Session->setFlash('书籍借出保存成功！');
				$this->redirect('/asset_outs/book_index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('assets', $this->AssetOut->Asset->generateList());
				$this->set('departments', $this->AssetOut->Department->generateList());
			}
		}
	}

	function book_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset Out');
			$this->redirect('/asset_outs/book_index');
		}
		if ($this->AssetOut->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/asset_outs/book_index');
		}
	}

}
?>