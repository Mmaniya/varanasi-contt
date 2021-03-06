
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="../assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../assets/css/custom.css" type="text/css"/>
<link rel="stylesheet" href="../assets/css/loder.css" type="text/css"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"/>

<script type="text/javascript" src="../assets/js/jquery.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- <script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="../assets/js/default.js"></script>	


<?php define('ABSPATH', dirname(__DIR__, 2));
require ABSPATH . "/includes.php";
 ?>
<div id="container" class="container">

<br><br><br><br>
<form action="updateduplicaterecordsql.php" method="post">
<div class="row">
<input type="text" value="" class="form-control col-2"name="voter_id">
<textarea name="raw_data" class="form-control col-2 "></textarea>
</div>
<input type="submit" class="btn btn-success" value="Submit">
</form>
</div>

<!-- 
    if(!empty($this->voterid)){

    $param['is_inserted'] = 'N';
    $param['raw_data'] = input_string($this->voterRawdata);
    $param['updated_by'] =  $this->userid;

    $where= array('voter_id'=>$this->voterid);	
    $result = Table::updateData(array('tableName' => TBL_VOTERS_RAW_DATA, 'fields' => $param, 'where' => $where, 'showSql' => 'N'));
                                                
    }
 -->

