<?php
include("../tuongndphp/config.php");

if(isset($_POST['submit'])){
          db();
          global $link;
          $id = $_POST['id'];
         // echo $id;
          $action = $_POST['action'];
          $work_name = $_POST['work_name'];
          $start_date = $_POST['start_date'];
          $end_date = $_POST['end_date'];
          $status = $_POST['status'];
          $current_date=date("Y-m-d H:i:s");

          if($action =='add'){
              $sql = "INSERT INTO tuongnd_todo(work_name, start_date,end_date,status,create_date,update_date) 
                      VALUES('".$work_name."','".$start_date."','".$end_date."','".$status."','".$current_date."','".$current_date."')";       
              $insertTodo = mysqli_query($link, $sql);
            }
          else{
             $sql="  UPDATE tuongnd_todo 
                SET     work_name='$work_name', 
                        start_date = '$start_date', 
                        end_date = '$end_date', 
                        status='$status',
                        update_date='$current_date'
                WHERE   id = '$id'";
             $updateTodo = mysqli_query($link, $sql);
          }
      }
      function Start_End_Date_of_a_week($week, $year)
        {
            $time = strtotime("1 January $year", time());
            $day = date('w', $time);
            $time += ((7*$week)+1-$day)*24*3600;
            $dates[0] = date('Y-n-j', $time);
            $time += 6*24*3600;
            $dates[1] = date('Y-n-j', $time);
            return $dates;
        }
        function getLastWeekOfYear($year) {
            $date = new DateTime();
            return date('W', strtotime(date('Y-m-d', strtotime($date->setISODate($year, 1, "1")->format('Y-m-d') . "-1day"))));
        }
        
 ?>
<!doctype html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title></title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="../../tuongndphp/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css"> 
        <link href="../../tuongndphp/assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="../../tuongndphp/assets/css/colors.css" rel="stylesheet" type="text/css">        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         

    </head>
    <script type="text/javascript">

     $(document).ready(function () {
         $('#show_date').hide();
         $('#view_week').hide();   
         $('#view_month').hide(); 
         $("#all").click(function()
          {
            // alert('msg');
                          
             $('#frmPost_View').append('<input type="input" name="type_view" hidden value ="'+0+'" />');
             $('#frmPost_View').submit(); 

          });

         $("#date_").click(function()
          {
            $("#show_date").show('slow');
             $('#view_week').hide();     
             $('#view_month').hide();                  
          });

         $("#week").click(function()
          {         
            $("#view_week").show('slow');       
            $('#show_date').hide();   
            $('#view_month').hide();     
          });
          $("#month").click(function()
          {         
            $("#view_month").show('slow');       
            $('#show_date').hide();   
             $('#view_week').hide();   
          });

         $('#sidebar').toggleClass('active').siblings().removeClass('active');
         $('#sidebarCollapse').on('click', function () {
            // $('#sidebar').toggleClass('active');
               $('#sidebar').toggleClass('active').siblings().removeClass('active');
         });
        });
        function confirmdelete(id)
            {
                var r=confirm("Are you sure?")
                if(r==true){
                    return window.open('../../tuongndphp/todo/delete/?id=' + id, '_self');
                }
                else{
                    return false;
                }
            }
        function add_order(id){
            
             $.ajax({
                    url: '../tuongndphp/todo/add',
                    type: 'get',
                    data: {
                        id: id                       
                    },
                    success: function(response){ 
                      //console.log(response);
                   
                      // Add response in Modal body
                                           
                     if(id != 0){
                         var title = "Edit Data";
                     }
                     else{
                        var title = "Add Data";
                     }
                      
                      $('.modal-title').html(title);
                      $('.modal-body').html(response);
                      $('.modal-body-new').html(response);
                      // Display Modal
                      $('#modal_add').modal('show'); 
                      $( "#start_date,#end_date" ).datepicker(
                            {
                              dateFormat: "yy-mm-dd"
                            });

                    }
                  });

        }

      $( function() {
         $( "#start_date_view" ).datepicker(
            {
              dateFormat: "yy-mm-dd"
            });

     } );
      function form_validate(type){
            $('#frmPost_View').append('<input type="input" name="type_view" hidden value ="'+type+'" />');
            $('#frmPost_View').submit(); 

            } 
    </script>
    <body>
 

        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>TuongND</h3>
                    <strong>NT</strong>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="#"  aria-expanded="false">
                            <i class="glyphicon glyphicon-home"></i>
                            Todo List
                        </a>
                        
                    </li>                      
                </ul>

               
            </nav>

            <!-- Page Content Holder -->
          <div class="col-sm-12" >

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span></span>
                            </button>
                        </div>                      
                    </div>
                </nav>
            
           <div class="col-sm-12" style="margin-top: 20px" > 
               
                <label class="radio-inline">
                 <input type="radio" id="all" name="optradio" checked>View All
                </label>
                <label class="radio-inline">
                  <input type="radio" id="date_" name="optradio">View by Date
                </label>
                <label class="radio-inline">
                  <input type="radio" id="week" name="optradio">View by Week
                </label>
                <label class="radio-inline">
                  <input type="radio" id="month"  name="optradio">View by Month
                </label>
             
         </div>
           
      <form method="POST" action="#"  name="frmPost_View" id="frmPost_View"  class="form-horizontal" style="margin-top: 70px; margin-left: 50px" >

            <div id='show_date' class="form-horizontal" style="margin-top: 70px; margin-left: 50px" > 
                  <legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label"><?php echo 'Choose Date'?> <span class="text-danger"></span> </label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" id="start_date_view" name="start_date_view" 
                    value="" required="required"  placeholder="<?php echo 'Input Date'?>"   >
                    </div>
                 </div>                 
                <button onClick="form_validate(1)" type="button" class="btn btn-primary" ><?php echo 'View'?></button>
                </legend>    
            </div>            

            <div id='view_week' class="form-horizontal" style="margin-top: 70px; margin-left: 50px">
                <legend>
                 <div class="form-group">
                <label class="col-lg-2 control-label"><?php echo 'Choose Week'?> <span class="text-danger"></span> </label>
                <div class="col-lg-4">
                <?php  
                        $weekNumber = date("W"); 
                        $year = date('Y');
                        $month = "01";
                        $day = "01";
                        $first_date = $year."-".$month."-".$day;
                        $last_date = date("Y-m-t",strtotime($year . '-12-31'));
                        $first_week = date("W",strtotime($first_date));                     
                        $last_week  = getLastWeekOfYear($year);
                        //echo  $last_week ;
                        ?> <select  id="week_id" name="week_id" class="mdb-select md-form"> <?php
                        for($i=$first_week;$i<=$last_week;$i++)
                        { ?>
                            
                            <option value="<?php echo $i?>" >
                                <?php echo $i ;?>                        
                            </option>
                            
                       <?php } ?>
                        </select>
                         
                    </div>

                    </div>
                    <button onClick="form_validate(2)" type="button" class="btn btn-primary" ><?php echo 'View'?></button>
                     </legend>    
             </div>

             <div id='view_month' class="form-horizontal" style="margin-top: 70px; margin-left: 50px">
                <legend>
                 <div class="form-group">
                <label class="col-lg-2 control-label"><?php echo 'Choose Month'?> <span class="text-danger"></span> </label>
                <div class="col-lg-4">
                <?php  
                        
                        ?> <select  id="month_id" name="month_id" class="mdb-select md-form"> <?php
                        for($i=1;$i<=12;$i++)
                        { ?>
                            
                            <option value="<?php echo $i?>" >
                                <?php echo $i ;?>                        
                            </option>
                            
                       <?php } ?>
                        </select>
                         
                    </div>

                    </div>
                    <button onClick="form_validate(3)" type="button" class="btn btn-primary" ><?php echo 'View'?></button>
                     </legend>    
             </div>
        
        </form>   
             <div class="row">
                <div style="text-align: right; margin-right: 50px;margin-top: 10px;">
                <a  onclick="add_order(0)"   class="btn bg-blue btn-labeled heading-btn"> <b> <i class="icon-add-to-list"></i></b> <span id="cst_name_<?php echo $id ?>"><?php echo 'Add Row'?></span>                            
                                             </a> </div>
            <div class="col-sm-12" style="margin-top: 10px;" >
                <table>
  <tr>
                    <th ><?php echo 'No' ?></th>
                    <th ><?php echo 'Work Name' ?></th>
                    <th ><?php echo 'Start Date' ?></th> 
                    <th ><?php echo 'End Date' ?></th>     
                    <th ><?php echo 'Status' ?></th>     
                    <th class="text-center"><?php echo 'Action' ?></th>
                </tr>
 
    <?php
        

         $condition = "1=1";
             if(isset($_POST['type_view'])){
                $type_view = $_POST['type_view'];
                $start_date_view = $_POST['start_date_view'];    
                $week_id = $_POST['week_id'];   
                $month_id = $_POST['month_id']; 
                $year = date('Y');         
               //echo $start_date_view.'-'. $type_view ;      
                if($type_view == 1){                     
                        $condition = "start_date='".$start_date_view."'OR end_date='".$start_date_view."' ";
                    }
                else if($type_view == 2){         
                        $result = Start_End_Date_of_a_week($week_id,$year);   
                        $start =  $result[0];   
                        $end =  $result[1];      
                        $condition = "start_date='".$start ."' and end_date='".$end ."' ";
                    }
                 else if($type_view == 3){    
                        $start_date=$year.'-'.$month_id;
                        $condition = "DATE_FORMAT(start_date, '%Y-%m')='".$start_date."' OR DATE_FORMAT(end_date, '%Y-%m')='".$start_date."'";
                    }
                else {      
                     $condition ="1=1";
                }                    
            }                        
         
                    db();
                    global $link;

                    $query  = "SELECT t.*,
                    case
                        when t.status = 1 then 'Planning'
                        when t.status = 0 then 'Doing'
                        else 'Complete'
                    end Status
                     FROM tuongnd_todo t WHERE   $condition  ORDER BY update_date DESC";
                    //echo $query;
                    $result = mysqli_query($link, $query);
                    $cnt =1;
                    if(mysqli_num_rows($result) >= 1){
                        while($row = mysqli_fetch_array($result)){
                            $id = $row['id'];
                            $work_name = $row['work_name'];
                            $start_date = $row['start_date'];
                            $end_date = $row['end_date'];
                            $status = $row['Status'];

                            ?>
    <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo $work_name; ?> </td>
                    <td><?php echo date("Y-m-d", strtotime($start_date)); ?> </td>
                    <td><?php echo date("Y-m-d", strtotime($end_date));  ?> </td>
                    <td><?php echo $status; ?> </td>
                    <td style="text-align: center;">
                        <ul class="icons-list">
                            <li><a onclick="add_order(<?php echo $row["id"]?>)" data-popup="tooltip" title="" data-original-title="<?php echo 'Edit'?>"><i class="icon-pencil7"></i></a></li>
                            <li><a href="javascript:confirmdelete(<?php echo $row["id"]?>)" data-popup="tooltip" title="" data-original-title="<?php echo _Delete?>"><i class="icon-trash"></i></a></li>
                            
                        </ul>
                    </td>
                </tr>   
                <?php
                  $cnt++;
                    }
                }

                ?>
 
</table>
            
 </div>
  </div>
</div>
        <!-- jQuery CDN -->
        
         <!-- Bootstrap Js CDN -->
         
    </body>
    <div id="modal_add" class="modal fade" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">title</h6>
            </div>
            <div class="modal-body modal-body-new">
            </div>
            <div class="modal-footer">
                <div class="row">
               
                </div>
            </div>
        </div>                                  
    </div>
    </div>
</html>
