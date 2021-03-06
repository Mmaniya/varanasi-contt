<?php  
require "includes.php";

$filename = "voterslist.xls";		
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\""); 

	if(!empty($_REQUEST['booth_id'])){
		$subQry[]= " booth_id = ".$_REQUEST['booth_id']."";
	}

	if($_REQUEST['getType'] == 'gender'){			
		$subQry[]= " gender = '".$_REQUEST['filterBy']."'"; 
	}
	if($_REQUEST['getType'] == 'ageGroup'){			
		if($_REQUEST['filterBy'] == 'first_age_group'){
			$subQry[]= " age BETWEEN '18' AND '22'";
		}
		if($_REQUEST['filterBy'] == 'second_age_group'){
			$subQry[]= " age BETWEEN '23' AND '30'";
		}
		if($_REQUEST['filterBy'] == 'third_age_group'){
			$subQry[]= " age BETWEEN '31' AND '40'";
		}
		if($_REQUEST['filterBy'] == 'fourth_age_group'){
			$subQry[]= " age BETWEEN '41' AND '50'";
		}
		if($_REQUEST['filterBy'] == 'fifth_age_group'){
			$subQry[]= " age BETWEEN '51' AND '60' ";
		}
		if($_REQUEST['filterBy'] == 'sixth_age_group'){
			$subQry[]= " age > 60 ";
		}
	}

	if($_REQUEST['getType'] == 'karyakarta'){
		if($_REQUEST['filterBy'] == 'bla'){
			$subQry[]= " is_bla = 'Y'";
		}
		if($_REQUEST['filterBy'] == 'bc'){
			$subQry[]= " is_bc = 'Y'";
		}
   	}


	if($_REQUEST['getType'] == 'address'){
		$subQry[]= " address != ''";
	}

	if(count($subQry)>0) {
	$subQuery = " WHERE ".implode(' AND ',$subQry).""; 
	}   

	$votersList ="SELECT * FROM `".TBL_VOTERS_DETAILS."` ".$subQuery."  ORDER BY slno_inpart ASC "; 
	$rsDtls = dB::mExecuteSql($votersList);	 
?>

<style>
table {
  width:100%;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
#t01 tr:nth-child(even) {
  background-color: #eee;
}
#t01 tr:nth-child(odd) {
 background-color: #fff;
}
#t01 th {
  background-color: black;
  color: white;
}
</style>


<table id="t01">
<thead>
<tr>
<td>id</td>
<td>epic_no</td>
<td>name</td>
<td>gender</td>
<td>age</td>
<td>address</td>
<td>pc_name</td>
<td>st_code</td>
<td>ps_lat_long_1_coordinate</td>
<td>rln_name_v2</td>
<td>rln_name_v1</td>
<td>rln_name_v3</td>
<td>name_v1</td>
<td>ac_name</td>
<td>name_v2</td>
<td>name_v3</td>
<td>ps_lat_long</td>
<td>pc_no</td>
<td>last_update</td>
<td>dist_no</td>
<td>ps_no</td>
<td>ps_name</td>
<td>ps_name_v1</td>
<td>st_name</td>
<td>dist_name</td>
<td>rln_type</td>
<td>pc_name_v1</td>
<td>part_name_v1</td>
<td>ac_name_v1</td>
<td>part_no</td>
<td>dist_name_v1</td>
<td>ps_lat_long_0_coordinate</td>
<td>_version_</td>

<td>section_no</td>
<td>ac_no</td>
<td>slno_inpart</td>
<td>rln_name</td>
<td>part_name</td> 
</tr>
</thead>
<tbody>
<?php 

	
	   if(count($rsDtls)>0) {
		   foreach($rsDtls as $key=>$val) {
		   ?>
		   <tr>
<td><?php echo $val->id;?></td>
<td><?php echo $val->epic_no;?></td>
<td><?php echo str_replace('-','',ucwords($val->name)); ?></td>
<td><?php echo $val->gender;?></td>
<td><?php echo $val->age;?></td>
<td><?php echo $val->address;?></td>
<td><?php echo $val->pc_name;?></td>
<td><?php echo $val->st_code;?></td>
<td><?php echo $val->ps_lat_long_1_coordinate;?></td>
<td><?php echo $val->rln_name_v2;?></td>
<td><?php echo $val->rln_name_v1;?></td>
<td><?php echo $val->rln_name_v3;?></td>
<td><?php echo str_replace('-','',$val->name_v1); ?></td>

<td><?php echo $val->ac_name;?></td>
<td><?php echo $val->name_v2;?></td>
<td><?php echo $val->name_v3;?></td>
<td><?php echo $val->ps_lat_long;?></td>
<td><?php echo $val->pc_no;?></td>
<td><?php echo $val->last_update;?></td>
<td><?php echo $val->dist_no;?></td>
<td><?php echo $val->ps_no;?></td>
<td><?php echo $val->ps_name;?></td>
<td><?php echo $val->ps_name_v1;?></td>
<td><?php echo $val->st_name;?></td>
<td><?php echo $val->dist_name;?></td>
<td><?php echo $val->rln_type;?></td>
<td><?php echo $val->pc_name_v1;?></td>
<td><?php echo $val->part_name_v1;?></td>
<td><?php echo $val->ac_name_v1;?></td>
<td><?php echo $val->part_no;?></td>
<td><?php echo $val->dist_name_v1;?></td>
<td><?php echo $val->ps_lat_long_0_coordinate;?></td>
<td><?php echo $val->_version_;?></td>

<td><?php echo $val->section_no;?></td>
<td><?php echo $val->ac_no;?></td>
<td><?php echo $val->slno_inpart;?></td>
<td><?php echo $val->rln_name;?></td>
<td><?php echo $val->part_name;?></td>   
		  </tr>
		   
		   
		   <?php 
		   
		     }
		   }
		   
		   ?>
		   </tbody>
		   </table>