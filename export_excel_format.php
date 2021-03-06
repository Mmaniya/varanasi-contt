<?php  
require "includes.php";



	if(!empty($_REQUEST['booth_id'])){
		$subQry[]= " booth_id = ".$_REQUEST['booth_id']."";
	}

	if(count($subQry)>0) {
	$subQuery = " WHERE ".implode(' AND ',$subQry).""; 
	}   

	$votersList ="SELECT * FROM `".TBL_VOTERS_DETAILS."` ".$subQuery."  ORDER BY slno_inpart ASC "; 
    $rsDtls = dB::mExecuteSql($votersList);	 
    
    $qry ="select id, count(*) as total,
    sum(case when gender = 'M' then 1 else 0 end) total_male,
    sum(case when gender = 'F' then 1 else 0 end) total_female,
    sum(case when gender = 'T' then 1 else 0 end) total_others
    from ".TBL_VOTERS_DETAILS.$subQuery; 
    $resultData =   dB::sExecuteSql($qry);  

  
     $acName = str_replace(" ",'_',$rsDtls[0]->ac_name);
     $acName = str_replace(".",'',$acName);


     $filename = $rsDtls[0]->part_no."_".$acName.".xls";	
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\""); 
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
.t01 tr:nth-child(even) {
  background-color: #eee;
}
.t01 tr:nth-child(odd) {
 background-color: #fff;
}
.t01 th {
  background-color: black;
  color: white;
}
.first_child{
    background-color: #D3D3D3; font-weight:700;
} </style>
<thead>
<tr>

<table class="t01">
    <thead>
        <tr style="background-color: yellow; font-weight:900;">
            <td>ELECTORAL ROLL</td>
        </tr>      
    </thead>
</table>
<br>
<table class="t01">
    <tbody>
        <tr>
            <td class="first_child">Electoral Roll Name</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child" >Polling Station Name</td>
            <td><?php echo $rsDtls[0]->ps_name;?></td>
            <td><?php echo $rsDtls[0]->ps_name_v1;?></td>
        </tr>
        <tr>
            <td class="first_child" >Polling Station Address</td>
            <td><?php echo $rsDtls[0]->ps_name;?></td>
            <td><?php echo $rsDtls[0]->ps_name_v1;?></td>
        </tr>
        <tr>
            <td class="first_child"> Reservation Status</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Main Town/Village</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Ward Name</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Police Station Name</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Tahsil</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">District</td>
            <td><?php echo $rsDtls[0]->dist_name;?></td>
            <td><?php echo $rsDtls[0]->dist_name_v1;?></td>
        </tr>
        <tr>
            <td class="first_child">Post Office</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Pincode</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Section Count</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Sections</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Polling Station No</td>
            <td><?php echo $rsDtls[0]->ps_no;?></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Total Voters</td>
            <td><?php echo $resultData->total;?></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Male Voters</td>
            <td><?php echo $resultData->total_male;?></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Female Voters</td>
            <td><?php echo $resultData->total_female;?></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Other Voters</td>
            <td><?php echo $resultData->total_others;?></td>
            <td></td>
        </tr>
        <tr>
            <td class="first_child">Electoral Roll Publish Date</td>
            <td> Sat Jan 23 2021<?php // echo $rsDtls[0]->last_update;?></td>
            <td></td>
        </tr>
    </tbody>
</table>

<br>
<table class="t01">
    <thead>
        <tr>
            <td class="first_child">Sl No(Within Electoral Roll)</td>
            <td class="first_child">State Code</td>
            <td class="first_child">State Name</td>
            <td class="first_child">Loksabha Code</td>
            <td class="first_child">Loksabha Name</td>
            <td class="first_child">Vidhansabha Code(AC No)</td>
            <td class="first_child">Vidhansabha Name</td>
            <td class="first_child">District Code</td>
            <td class="first_child">Disrict Name</td>
            <td class="first_child">Mandal Code</td>
            <td class="first_child">Mandal Name</td>
            <td class="first_child">Sector Code</td>
            <td class="first_child">Sector Name</td>
            <td class="first_child">EPIC No</td>
            <td class="first_child">मतदाता का नाम/ Voter Name</td>
            <td class="first_child">पिता/पति का नाम Father/Husbands Name</td>
            <td class="first_child">Relation Type</td>
            <td class="first_child">मकान संख्या		/ House No.</td>
            <td class="first_child">आयु/ Age</td>
            <td class="first_child">लिंग /Gender</td>
            <td class="first_child">Part No</td>
            <td class="first_child">Section No</td>
            <td class="first_child">अनुभाग का नाम/ Section Name </td>
            <td class="first_child">मतदान स्थल का नाम / Name of Polling Booth</td>
            <td class="first_child">मतदान स्थल का पता / Address of Polling Booth</td>
            <td class="first_child">Panna Pramukh(if available)</td>
            <td class="first_child">Is NRI Voter</td>
            <td class="first_child">Passport No(Only for NRI Voter)</td>
        </tr>
    </thead>
    <tbody>      
        <?php 
            if(count($rsDtls)>0) {
		        foreach($rsDtls as $key=>$val) { ?>
                  <tr>
                    <td><?php echo $val->slno_inpart;?></td>
                    <td><?php echo $val->st_code;?></td>
                    <td><?php echo $val->st_name;?></td>
                    <td><?php echo $val->pc_no;?></td>
                    <td><?php echo $val->pc_name.' / '.$val->pc_name_v1;?></td>
                    <td><?php echo $val->ac_no;?></td>
                    <td><?php echo $val->ac_name.' / '.$val->ac_name_v1;?></td>
                    <td><?php echo $val->dist_no;?></td>
                    <td><?php echo $val->dist_name.' / '.$val->dist_name_v1;?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $val->epic_no;?></td>
                    <td><?php echo str_replace('-','',ucwords($val->name)).' / '. $val->name_v1; ?></td>
                    <td><?php echo $val->rln_name,' / '.$val->rln_name_v1;?></td>
                    <td><?php echo $val->rln_type;?></td>
                    <td><?php echo $val->address;?></td>
                    <td><?php echo $val->age;?></td>
                    <td><?php echo $val->gender;?></td>
                    <td><?php echo $val->part_no;?></td>
                    <td><?php echo $val->section_no;?></td>
                    <td></td>
                    <td><?php echo $val->ps_name. ' / '.$val->ps_name_v1;?></td>
                    <td><?php echo $val->ps_name. ' / '.$val->ps_name_v1;?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
               <?php  }
            }
		   ?>
    </tbody>

</table>

