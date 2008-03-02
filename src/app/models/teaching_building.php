<?php
class TeachingBuilding extends AppModel {

	var $name = 'TeachingBuilding';

	function getStatus($building_no = null,$building_name = null) {
		$_no = $this->findBySql("select count(*) from teaching_buildings where building_no = '$building_no' or building_name = '$building_name' ");
		$getnum = $_no[0][0]['count(*)'];

		return $getnum;
	}

}
?>