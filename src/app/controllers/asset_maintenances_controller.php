<?php
class AssetMaintenancesController extends AppController {

	var $name = 'AssetMaintenances';
	var $components = array('Acl','AjaxValid','Pagination');//Make sure you include this, it makes the magic work.
	var $helpers = array('Html', 'Form' ,'Javascript','Pagination');

	function index($keyword = null, $page=1) {
		$this->AssetMaintenance->recursive = 0;

		$criteria = " Asset.asset_type_id <> 99999 ";
		if($keyword == null){
			$keyword = $this->data['AssetMaintenance']['keyword'];
		}		
		if($keyword != null){
			$criteria .= " and Asset.asset_name like '%$keyword%' ";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'index/'.$keyword));
		
		$data = $this->AssetMaintenance->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('assetMaintenances',$data);
	}



	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset Maintenance.');
			$this->redirect('/asset_maintenances/index');
		}
		$this->set('assetMaintenance', $this->AssetMaintenance->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('assets', 
						$this->AssetMaintenance->Asset->generateList(
							$conditions = 'asset_type_id <> 99999',
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Asset.id',
							$valuePath = '{n}.Asset.asset_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->data['AssetMaintenance']['send_date'] > $this->data['AssetMaintenance']['maintenance_date']) {
				$this->Session->setFlash('资产维修日期不能大于送修日期！');
				$this->set('assets', 
							$this->AssetMaintenance->Asset->generateList(
								$conditions = 'asset_type_id <> 99999',
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Asset.id',
								$valuePath = '{n}.Asset.asset_name')
				);
			}else {
				if ($this->AssetMaintenance->save($this->data)) {
					$this->Session->setFlash('资产维修保存成功！');
					$this->redirect('/asset_maintenances/index');
				} else {
					$this->Session->setFlash('Please correct errors below.');
					$this->set('assets', $this->AssetMaintenance->Asset->generateList());
				}
			}

		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Asset Maintenance');
				$this->redirect('/asset_maintenances/index');
			}
			$this->data = $this->AssetMaintenance->read(null, $id);
			$this->set('assets', 
						$this->AssetMaintenance->Asset->generateList(
							$conditions = 'asset_type_id <> 99999',
							$order = 'id',
							$limit = null,
							$KeyPath = '{n}.Asset.id',
							$valuePath = '{n}.Asset.asset_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->data['AssetMaintenance']['send_date'] > $this->data['AssetMaintenance']['maintenance_date']) {
				$this->Session->setFlash('资产维修日期不能大于送修日期！');
				$this->set('assets', 
							$this->AssetMaintenance->Asset->generateList(
								$conditions = 'asset_type_id <> 99999',
								$order = 'id',
								$limit = null,
								$KeyPath = '{n}.Asset.id',
								$valuePath = '{n}.Asset.asset_name')
				);
			}else {
				if ($this->AssetMaintenance->save($this->data)) {
					$this->Session->setFlash('资产维修保存成功！');
					$this->redirect('/asset_maintenances/index');
				} else {
					$this->Session->setFlash('Please correct errors below.');
					$this->set('assets', $this->AssetMaintenance->Asset->generateList());
				}
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Asset Maintenance');
			$this->redirect('/asset_maintenances/index');
		}
		if ($this->AssetMaintenance->del($id)) {
			$this->Session->setFlash('删除成功！');
			$this->redirect('/asset_maintenances/index');
		}
	}

}
?>