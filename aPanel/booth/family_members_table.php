<?php
   $prev=$next=$last=$first='&nbsp;';
   if($page > 1)
   $first = "<i class='fa fa-fast-backward' aria-hidden='true' onclick='ParentPagination(\"1\",\"".$boothid."\",\"".$id."\")'/></i>";
   
   if($page < $totalPages)
   $last = "<i class='fa fa-fast-forward' aria-hidden='true' onclick='ParentPagination(\"$totalPages\",\"".$boothid."\",\"".$id."\")'/><i>";
   if(count($voters_list)>0 && $totalPages > 1){
   if($page > 1){
   $pageNo = $page - 1;
   $prev = " <i class='fa fa-backward' aria-hidden='true'  onclick='ParentPagination(\"".$pageNo."\",\"".$boothid."\",\"".$id."\")'/></i>";
   }       		
   if ($page < $totalPages) {
   $pageNo = $page + 1;
   $next = " <i class='fa fa-forward' aria-hidden='true'  onclick='ParentPagination(\"".$pageNo."\",\"".$boothid."\",\"".$id."\")'/><i>";
   } 
    if($pageNo=='')
     $pageNo=1;
    if($totalPages>1) {
    $pagebox="<td style='padding:0px'><input type='text' name='page' id='page' value='".$page."' onchange='ParentPagination(this.value,\"".$boothid."\",\"".$id."\")' style='border: 1px solid rgb(170, 170, 170); text-align: center;width:30%;height:30px' size='4'> of $totalPages</td>";
    }	
     $table_val = "<table  width='100%' cellpadding='5' cellspacing='0' border='0' style='border:0;'><tr><td align='center' style='border:1; font-size:14px; vertical-align:middle; color:#000; padding:10px;'></td><td align='right' style='padding-bottom:0px'><table align='right' cellpadding='0' cellspacing='1'><tr><td style='padding:0 2px;'>$first</td><td style='padding:0 2px;'> $prev </td>$pagebox<td style='padding:0 2px;'>$next </td><td style='padding:0 2px;'>$last</td></tr></table></td></tr></table>";
   }

   ?>
   <style>
   .table td, .table th {
    padding: 0.30rem;
    /* vertical-align: top; */
    border-top: 1px solid #dee2e6;
}
   </style>
<div id="accordion">
  <h4> Total Family <?php echo count($voters_list); ?> </h4>
  <?php if(count($ListingParentCatListArr)>0) {
        foreach($ListingParentCatListArr as $key=>$val) { 
            
            $qry ="SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE `status`='A' and  booth_id=".$val->booth_id." and slno_inpart=".$val->family_slno.""; 
            $family_headers = dB::mExecuteSql($qry); ?>

    <div class="card">
        <div class="card-header" id="headingOne<?php echo $val->family_slno;?>">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne<?php echo $val->family_slno;?>" aria-expanded="true" aria-controls="collapseOne">
                <?php //echo str_replace('-','',ucwords($family_headers[0]->name)); ?>  <?php echo $family_headers[0]->name_v1;?> (<?php echo $family_headers[0]->age;?>)  Family Members ( <?php echo $val->total_count;?>)
                </button>
            </h5>
        </div>

        <div id="collapseOne<?php echo $val->family_slno;?>" class="collapse" aria-labelledby="headingOne<?php echo $val->family_slno;?>" data-parent="#accordion">
            <div class="card-body">
                <?php  $qry ="SELECT * FROM `".TBL_VOTERS_DETAILS."` WHERE `status`='A' and  booth_id=".$val->booth_id." and family_slno=".$family_headers[0]->slno_inpart." ORDER BY updated_at ASC"; 
                        $family_members = dB::mExecuteSql($qry);
                        foreach($family_members as $key => $value){
                             if($value->slno_inpart != $family_headers[0]->slno_inpart){ ?>
                    <?php echo str_replace('-','',ucwords($value->name));?> - <?php echo $value->name_v1; ?> (<?php echo $value->age;?> ) <br>
                    <!-- <?php // if($value->rln_type == 'F') { ?> Father <?php // } else if($value->rln_type == 'M') { ?> Mother <?php // } else if($value->rln_type == 'H') { ?> Husband <?php // } else if($value->rln_type == 'W') { ?> Wife <?php // } else if($value->rln_type == 'O') { ?> Others <?php // } ?><br> -->
                <?php } } ?>
            </div>
        </div>
    </div>
 
    <?php } } echo $table_val;?>
   </div>


   
<script>	

   function ParentPagination(page,condition,value) { 
      
      paramData = {'act':'viewfamilyMembers','page':page,'booth_id':condition,'paging':'true' }; 
      ajax({
         a:"add_voters",
         b: paramData,
         c:function(){},
         d:function(data){
               $('#updateddata').html(data);
            } 
      });
   }   

</script>

