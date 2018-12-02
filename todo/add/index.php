<?php

include("../../../tuongndphp/config.php");

$id=$_GET['id'];

	if ($id != 0){	
	db();
    global $link;	 
	 $query  = "SELECT * FROM tuongnd_todo WHERE id='$id'";
	 $result = mysqli_query($link, $query);	           
	    if(mysqli_num_rows($result) >= 1){
	        while($row = mysqli_fetch_array($result)){
	            $work_name=$row["work_name"];	
				$start_date=$row["start_date"];	
				$end_date=$row["end_date"];	
				$status=$row["status"];
			}
		}
	}
	else{
		$action="add";		
	}
	  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

 	
</head>
   
<body>
	 
   </script>

<div class="content">
<form method="POST" action="#"  name="frmPost" id="frmPost" class="form-horizontal">
    <div class="form-group " >
		<label class="col-lg-4 control-label"><?php echo 'Work Name'?> <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<input type="text" class="form-control" id="work_name" name="work_name" 
		value="<?php if($id > 0){ echo $work_name ;} ?>" required="required"  placeholder="<?php echo 'Input Work Name'?>"   >
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-4 control-label"><?php echo 'Start Date'?> <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<input type="text" class="form-control" id="start_date" name="start_date" 
		value="<?php if($id > 0){ echo  date("Y-m-d", strtotime($start_date));} ?>" required="required"  placeholder="<?php echo 'Input Start Date'?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-4 control-label"><?php echo 'End Date'?> <span class="text-danger">*</span> </label>
		<div class="col-lg-8">
			<input type="text" class="form-control" id="end_date" name="end_date" 
		value="<?php if($id > 0){ echo date("Y-m-d", strtotime($end_date));} ?>" required="required"  placeholder="<?php echo 'Input End Date'?>"   >
		</div>
	</div>


	<div class="form-group">
		<label class="col-lg-4 control-label"><?php echo 'Status'?> <span class="text-danger">*</span> </label>
		<div class="col-lg-8">					
			<?php if($id == 0) {?>	
				 <select   id="status" name="status" class="mdb-select md-form" >
				  <option value="" disabled selected>Choose status</option>			  
				  <option value="0">Doing</option>
				  <option value="1">Planing</option>
				  <option value="2">Complete</option>
				</select> 
			<?php }else { ?>
			<select  id="status" name="status" class="mdb-select md-form">
				<?php
					//$arr_status=array("Doing","Planing","Complete");
					$arr_status=array();
					$arr_status[0]="Doing";
					$arr_status[1]="Planing";
					$arr_status[2]="Complete";

					$arrlength=count($arr_status);
						for ($i = 0; $i < $arrlength; $i++){							
					?> 

                 <option value="<?php echo $i?>" <?php 
                 if ($i==$status) {echo "selected";}?>
                 >
                 	<?php echo $arr_status[$i]?>
                 		
                 	</option>
                <?php
						}							
					?>
			</select>
			<?php
						}							
					?>
		</div>
	</div>
	 <input type="hidden" name="action" value="<?php echo $action?>">	
	 <input type="hidden" name="id" value="<?php echo $id?>">	
     
    <button type="submit" name="submit" value="submit" class="btn btn-primary" ><?php echo ' Save '?></button>
                
</form>
</div>
</body>

</html>
