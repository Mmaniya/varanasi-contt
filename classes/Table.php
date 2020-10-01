<? 
class Table {

static function getData($params=array()) {
	
	/**    
	array('tableName'=>'Table Name',
	      'fields'=>'either * or array of fields ',
		  'condition'=>'array in the format 'fieldName'=>'value-typeof field'',
		  'orderby'=>'field name',
		  'sortby'=>'asc or desc',
		  'limit'=>' 0,100' )
	**/
	
	$tableName = $params['tableName'];
	$fields = $params['fields'];
	$condition = $params['condition'];
	$orderby=($params['orderby']!='')?$params['orderby']:'';
	$sortby = ($params['sortby']!='')?$params['sortby']:'';
	$limit = ($params['limit']!='')?$params['limit']:'';
	
	$between = $params['between'];  //exclusively for date 
	
	$betweenDateTime = $params['betweenDateTime'];  //exclusively for date 
	
	if(count($condition)>0) foreach($condition as $K=>$V){ 
	  $tempArr =explode('-',$V);
	   $$K=$V;
	  if(count($tempArr)==2) {
	  $field = $K;
	  $fieldval = $tempArr[0];
	  $fieldType = $tempArr[1];
	  
	  if($fieldType=='INT' || $fieldType=='' || $fieldType=='ENUM' ) $sub_qry[]="`$field`=".$fieldval;
	  if($fieldType=='STRING') $sub_qry[]="`$field` like '%".$fieldval."%'";
	  if($fieldType=='CHAR') $sub_qry[]="`$field` =  '".$fieldval."'";
	  if($fieldType=='DATE') $sub_qry[]="`$field` = '".date('Y-m-d',$fieldval)."'";
	  if($fieldType=='CONDITION') $sub_qry[]="`$field` ".$fieldval;
	  if($fieldType=='IN') $sub_qry[]="`$field` in ( ".$fieldval . ")";
	  if($fieldType=='NOT_IN') $sub_qry[]="`$field` not in ( ".$fieldval . ")";
	   if($fieldType=='DATETIME') $sub_qry[]="`$field` = '".date('Y-m-d H:i:s',$fieldval)."'";
	   
	  }
	}
	
	if(count($between)>0) {
		$sub_qry[] =$between['field']. " BETWEEN '".	date('Y-m-d',$between['from']). "' AND '".date('Y-m-d',$between['to'])."'"; }
		
		if(count($betweenDateTime)>0) {
	  $sub_qry[] =$betweenDateTime['field']. " BETWEEN '".	date('Y-m-d H:i:s',$betweenDateTime['from']). "' AND '".date('Y-m-d H:i:s',$betweenDateTime['to'])."'"; }
		
	if($orderby!='') { 	if($sortby=='') $sortby='ASC'; 	$sort_qry = " order by ".$orderby.' '.$sortby; 	}
	if($limit!='') $limit_qry = 'LIMIT '.$limit;
	if(count($sub_qry)>0) $subqry= " where ".implode(' and ',$sub_qry);

	if(count($fields)==0) $fieldDtls='*'; else $fieldDtls=implode(',',$fields);
	$query="select ".$fieldDtls." from ".$tableName." $subqry $sort_qry $limit_qry";
	if($params['showSql']=='Y') 
	echo $query;
	if($id=='')	return dB::mExecuteSql($query);
	return dB::sExecuteSql($query);
}


   static function insertData($params=array()) {

		$tableName = $params['tableName'];
		$fields = $params['fields'];

		if(count($fields)>0) foreach($fields as $K=>$V){ if($V!='') {
			$$K=$V; 
			$fieldArr[]=$K;} 
		}  
		foreach($fieldArr as $K=>$V) $fieldVal[] = "'".$$V."'";
		$query = "insert into ".$tableName."( ".implode(',',$fieldArr).")  values (".implode(',',$fieldVal).")";		
		$insertId= dB::insertSql($query);		
		if($params['showSql']=='Y') echo $query;
		if($insertId>0)	{ 
			// $logData = $params['logData'];
			// if($logData=='Y') {
			// 	$logParams=array();
			// 	$logParams['fields']['user_id'] = $params['logParams']['user_id'];
			// 	$logParams['fields']['operation'] ='insertion';
			// 	$logParams['fields']['table_name']=$tableName;
			// 	$logParams['fields']['table_row_id']=	$insertId;
			// 	$conditionArr = array('id'=>$insertId.'-INT');
			// 	$rsFields = Table::getData(array('tableName'=>$tableName,'condition'=>$conditionArr));
			// 	$logParams['fields']['after_details']=serialize($rsFields);
			// 	foreach($rsFields as $K=>$V) {
			// 			  $description[] = '<b>'.$K. '</b> has been inserted as <b>'.$V.'</b>';	
			// 	}
			// 	$logParams['fields']['description']=implode('<br/>',$description);
			// 	$logParams['fields']['updated_date']=date('Y-m-d H:i:s',time());
			// 	Table::logData($logParams);
		    // }
		   return "Success::Successfully added::".$insertId;
	 } else {
				$logParams=array();
				$logParams['fields']['user_id'] = $params['logParams']['user_id'];
				$logParams['fields']['operation'] ='error in insertion';
				$logParams['fields']['table_name']=$tableName;
				$logParams['fields']['description']=$query;
				$logParams['fields']['updated_date']=date('Y-m-d H:i:s',time());
				Table::logData($logParams);
	 }
}



  static function updateData($params=array()) {
	$tableName = $params['tableName'];
	$fields = $params['fields'];
    $where = $params['where'];
	$logData = $params['logData'];
	if($logData=='Y') {
	$logParams=array();
	$logParams['fields']['user_id'] = $params['logParams']['user_id'];
	$logParams['fields']['operation'] ='updation';
	}

	if(count($fields)>0) foreach($fields as $K=>$V){ $$K=$V; if($K!='id') $updateFields[]=$K; }
	foreach($updateFields as $K=>$V) $subQry[] = "`".$V."`='".$$V."'";
	$uptFields = implode(',',$subQry);				 
    
	$subQry=array();
	if(count($where)>0) { foreach($where as $K=>$V){ $$K=$V; $whereFields[]=$K; }
	foreach($whereFields as $K=>$V) $subQry[] = "`".$V."`='".$$V."'";
	$whereFields = implode(' AND ',$subQry);	
	}
	
	if(count($where)<=0) $query = "update ".$tableName." set ".$uptFields." where id =$id ";
	else
	$query = "update ".$tableName." set ".$uptFields." where ".$whereFields;
	
	
	
	if($logData=='Y')  { 
		$logParams['fields']['table_name']=$tableName;
		if($id!='') {	$logParams['fields']['table_row_id']=	$id;
		$conditionArr = array('id'=>$id.'-INT');
		} else $conditionArr = $where;
		$rsBeforeFields = Table::getData(array('tableName'=>$tableName,'fields'=>$updateFields,'condition'=>$conditionArr));
		if($id!='') $rsBeforeDetails[0]= $rsBeforeFields;
		$logParams['fields']['before_details']=serialize($rsBeforeDetails);
		
	}
	$affectedRows = dB::updateSql($query);
	
	if($logData=='Y') {
		$rsAfterFields = Table::getData(array('tableName'=>$tableName,'fields'=>$updateFields,'condition'=>$conditionArr));
		if($id!='') $rsAfterDetails[0]= $rsAfterFields;
		$logParams['fields']['after_details']=serialize($rsAfterDetails);
		
		foreach($rsBeforeDetails as $K=>$V) {
			foreach($V as $K1=>$V1) {
			  $rsAfterObj= $rsAfterDetails[$K];
			  if($V1!=$rsAfterObj->$K1)  $description[] = '<b>'.$K1. '</b> has been changed from <b>'.$V1.'</b> to <b>'.$rsAfterObj->$K1.'</b>';	
			}
		}
		
		$logParams['fields']['description']=implode('<br/>',$description);
		$logParams['fields']['updated_date']=date('Y-m-d H:i:s',time());
		Table::logData($logParams);
		
	}

	
	if($params['showSql']=='Y') echo $query;
	if($affectedRows>0)	return "Success::Successfully updated::".$id;
	else return "Success::".$affectedRows." rows affected::".$id;
}

  static function deleteData($params=array()) { 
	$tableName = $params['tableName'];
    $where = $params['where'];
	if(count($where)>0) foreach($where as $K=>$V){ $$K=$V; $whereFields[]=$K; }
	foreach($whereFields as $K=>$V) $subQry[] = "`".$V."`='".$$V."'";
	$whereFields = implode(' AND ',$subQry);	
	$query = "DELETE FROM ".$tableName." where ".$whereFields;
	if($params['showSql']=='Y') echo $query;
	return dB::deleteSql($query);
}

static function logData($params=array()) { 
	$params['tableName'] = TBL_BJP_LOG;
	$params['showSql'] = 'N';
	Table::insertData($params);
}

}
?>