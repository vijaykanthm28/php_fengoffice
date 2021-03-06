<?php

  /**
  * DimensionMemberAssociations
  *
  * @author Diego Castiglioni <diego.castiglioni@fengoffice.com>
  */
  class DimensionMemberAssociations extends BaseDimensionMemberAssociations {
    
    function getAssociatedDimensions($associated_dimension_id) {

  		$sql = "SELECT DISTINCT (`dimension_id`) FROM `".TABLE_PREFIX."dimension_member_associations` WHERE `associated_dimension_id` = $associated_dimension_id";
  		
  		$result = DB::execute($sql);
    	$rows = $result->fetchAll();
    	$dimension_ids = array();
    	if ($rows){
	    	foreach ($rows as $row){
	    		$dimension_ids[] = (int)$row['dimension_id'];
	    	}
    	}

    	return $dimension_ids ;	
  	}
  	
  	
    function getDimensionsToReload($dimension_id) {

  		$sql = "SELECT DISTINCT(`associated_dimension_id`) FROM `".TABLE_PREFIX."dimension_member_associations` WHERE `dimension_id` = $dimension_id
				UNION SELECT DISTINCT(`dimension_id`) FROM `".TABLE_PREFIX."dimension_member_associations` WHERE `associated_dimension_id` = $dimension_id";
  		
  		$result = DB::execute($sql);
    	$rows = $result->fetchAll();
    	$dIds = array();
    	if ($rows){
	    	foreach ($rows as $row){
	    		$dIds[] = (int)$row['associated_dimension_id'];
	    	}
    	}

    	return $dIds ;	
  	}
  	
  	
    function getAllAssociationIds($dimension_id, $associated_dimension_id) {
		
    	$sql = "SELECT `id` FROM `".TABLE_PREFIX."dimension_member_associations` WHERE `dimension_id` = $dimension_id AND `associated_dimension_id` = $associated_dimension_id
				UNION SELECT `id` FROM `".TABLE_PREFIX."dimension_member_associations` WHERE `dimension_id` = $associated_dimension_id AND `associated_dimension_id` = $dimension_id";
  		
    	$result = DB::execute($sql);
    	$rows = $result->fetchAll();
    	$association_ids = array();
    	if ($rows){
	    	foreach ($rows as $row){
	    		$association_ids[] = (int)$row['id'];
	    	}
    	}

    	return $association_ids;	
  	}
  	
  	
    function getAllAssociations($dimension_id, $associated_dimension_id) {

  		$associations =  self::findAll(array('conditions' => '`dimension_id` = ' . 
								$dimension_id.' AND `associated_dimension_id` = ' . $associated_dimension_id));
		return $associations;
  	}
  	
  	static function getAssociatations($dimension_id, $object_type_id) {
  		return self::findAll(array("conditions" => array("`dimension_id` = ? AND `object_type_id` = ?", $dimension_id, $object_type_id)));
  	}
  	
	static function getRequiredAssociatations($dimension_id, $object_type_id, $only_ids = false) {
  		return self::findAll(array(
  			"conditions" => array("`dimension_id` = ? AND `object_type_id` = ? AND is_required = 1", $dimension_id, $object_type_id),
  			"id" => $only_ids,
  		));
  	}
  
  	
    function existsAssociationBetweenDimensions($dimension_id, $associated_dimension_id){
  		$associations =  self::findOne(array('conditions' => '`dimension_id` = ' . 
								$dimension_id.' AND `associated_dimension_id` = ' . $associated_dimension_id));
			
		if (is_null($associations)) return false;
		else return true;						
  	}
  }

?>