<?php function main()
{?>

   
   <div id="employee_statistics"></div>  
  
   <div class="row ">
      <div class="col-7">
         <div class="card" id="employee_table"></div>
      </div>
      <div class="col-5">
         <div class="z-depth-5 waves-effect" id="employee_form" style="display:none; background-color: rgb(255, 255, 255);"> </div>
      </div>
   </div>
   <div class="row">
      <div class="col-7" id="employee_service"> </div>
      <div class="col-5" id="update_employee_form"> </div>
   </div>


   <script>

 
// $(function () {
//     // category_table('');
//     employee_statistics();
// });

//    function employee_statistics(){    

//        param = { 'act': 'employee_statistics' };
//         ajax({
//             a: 'employee_form',
//             b: $.param(param),
//             c: function () { },
//             d: function (data) {
//                 $('#employee_statistics').html(data);
//             }
//         });
//     }
   </script>
<?php } include '../admin_template.php';?>