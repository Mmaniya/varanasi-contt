<?php
   $prev=$next=$last=$first='&nbsp;';
   if($page > 1)
   $first = "<i class='fa fa-fast-backward' aria-hidden='true' onclick='ShowParentCatListPagination(\"1\",\"".$boothid."\",\"".$id."\")'/></i>";
   
   if($page < $totalPages)
   $last = "<i class='fa fa-fast-forward' aria-hidden='true' onclick='ShowParentCatListPagination(\"$totalPages\",\"".$boothid."\",\"".$id."\")'/><i>";
   if(count($voters_list)>0 && $totalPages > 1){
   if($page > 1){
   $pageNo = $page - 1;
   $prev = " <i class='fa fa-backward' aria-hidden='true'  onclick='ShowParentCatListPagination(\"".$pageNo."\",\"".$boothid."\",\"".$id."\")'/></i>";
   }       		
   if ($page < $totalPages) {
   $pageNo = $page + 1;
   $next = " <i class='fa fa-forward' aria-hidden='true'  onclick='ShowParentCatListPagination(\"".$pageNo."\",\"".$boothid."\",\"".$id."\")'/><i>";
   } 
    if($pageNo=='')
     $pageNo=1;
    if($totalPages>1) {
    $pagebox="<td style='padding:0px'><input type='text' name='page' id='page' value='".$page."' onchange='ShowParentCatListPagination(this.value,\"".$boothid."\",\"".$id."\")' style='border: 1px solid rgb(170, 170, 170); text-align: center;width:30%;height:30px' size='4'> of $totalPages</td>";
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
<table class="table table-hover" style="border: 2px solid #eee;" >
   <thead class="bg-primary text-white">
        <th>Name</th>
        <th>Relation Type</th>
        <th>Relation Name</th>
        <th>Sl.no</th>
   </thead>
   <tbody id="sortable1">
      <?php
         if( count($ListingParentCatListArr)>0) {
         	$i = 1;
         foreach($ListingParentCatListArr as $key=>$value) {
         	?>	
          <tr id="<?php echo $value->id ?>" >
            <td style="font-weight:500;"><?php echo str_replace('-','',ucwords($value->name)); ?><br> <?php echo str_replace('-','',$value->name_v1) ?> (<?php echo $value->age; ?>)</td>
            <td><?php if($value->rln_type == 'F') { ?> Father <?php } else if($value->rln_type == 'M') { ?> Mother <?php } else if($value->rln_type == 'H') { ?> Husband <?php } else if($value->rln_type == 'W') { ?> Wife <?php } else if($value->rln_type == 'O') { ?> Others <?php } ?></td>
            <td style="font-weight:500;"><?php echo str_replace('-','', ucwords(strtolower(str_replace("","-", $value->rln_name)))) ?><br> <?php echo str_replace('-','',$value->rln_name_v1) ?></td>
            <td><?php echo getroll($value->slno_inpart); ?></td>
        </tr>   
      <?php $i++; } 
         } else{ ?>
      <tr>
         <td colspan="5">No results Found
         <td>
      </tr>
      <?php } echo $table_val; ?>
   </tbody>
</table>
<script>	

$( function() {
    $( "#sortable1" ).sortable({
        connectWith: ".connected-sortable",        
    });
    $( "#sortable1" ).disableSelection();
  } );


   function ShowParentCatListPagination(page,condition,value) { 
      
      paramData = {'act':'parentListpagination','page':page,'booth_id':condition }; 
      ajax({
         a:"add_voters",
         b: paramData,
         c:function(){},
         d:function(data){
               $('#displayvoters').html(data);
            } 
      });
   }   

</script>

