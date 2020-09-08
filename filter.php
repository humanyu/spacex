<?php 
$filter='';


if(isset($_REQUEST['launch_year'])){
    if($_REQUEST['launch_year']!=''){
$filter .='&launch_year='.$_REQUEST['launch_year'];
    }
}

if(isset($_REQUEST['launch_success'])){
    if($_REQUEST['launch_success']!=''){
    $filter .='&launch_success='.$_REQUEST['launch_success'];
      } 
    }
    
if(isset($_REQUEST['land_success'])){
    if($_REQUEST['land_success']!=''){
    $filter .='&land_success='.$_REQUEST['land_success'];
     }  
    
    }

    
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.spaceXdata.com/v3/launches?limit=100".$filter);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$output2 = json_decode($output);


?>

<?php if(!empty($output2)){ ?>
<?php  foreach($output2 as $data) {  ?>

<div class="col-md-3" style="padding-bottom:10px;border:5px solid white;height:350px;">
<div class="text-center">
<img  src="<?php echo $data->links->mission_patch_small; ?>" width="180" height="180" >
</div>
<p style="font-size:12px;padding-top:10px"><b><?php echo $data->mission_name; ?> #<?php echo $data->flight_number; ?></b></p>
<p style="font-size:12px;padding-top:10px"><b>Mission Ids:</b> <?php if(!empty($data->mission_id)){ foreach($data->mission_id as $MI){ echo $MI.' '; }} ?></p>
<p style="font-size:12px;"><b>Launch year:</b><?php echo $data->launch_year; ?> </p>
<p style="font-size:12px;"><b>Successful Launch:</b><?php if($data->launch_success==1){ ?>True<?php } else { ?>False <?php } ?> </p>
<p style="font-size:12px;"><b>Successful landing:</b><?php if($data->rocket->first_stage->cores[0]->land_success==1){ ?>True<?php } else { ?>False <?php } ?> </p>

</div>

<?php  } } else { ?>
<h3>No data Found!</h3>
<?php }  ?>

