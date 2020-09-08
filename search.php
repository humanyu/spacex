<?php 
$filter='';
$launch='';
$land='';
$year='';

if(isset($_REQUEST['launch_year'])){
$filter .='&launch_year='.$_REQUEST['launch_year'];
$year=$_REQUEST['launch_year'];
}

if(isset($_REQUEST['launch_success'])){
    $filter .='&launch_success='.$_REQUEST['launch_success'];
    $launch=$_REQUEST['launch_success'];   
    }
    
if(isset($_REQUEST['land_success'])){
    $filter .='&land_success='.$_REQUEST['land_success'];
    $land=$_REQUEST['land_success'];   
    
    }




?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
.inactive_h{
    background-color:#cbe79e;margin:2px;
}
.active_h{
    background-color:#7dbe00;margin:2px;
}
</style>
</head>
<body>
   <div class="container" style="background-color:#f8f8f8" >
   <h4 style="font-weight:bold;">SpaceX Launch Program</h4>

   <div class="col-md-12">
   <div class="col-md-3">
   <p><b>Filters</b></p>
   <p class="text-center" style="border-bottom:1px solid black;">Launch years</p>

   <div class="col-md-12 " style="margin-bottom: 30px;cursor:pointer" >
   <?php for($i=2006;$i<=date('Y');$i++){ ?>
   <div class="col-md-5 text-center year <?php if($year==$i){ ?> active_h<?php } else { ?>inactive_h <?php } ?>  " vl="<?php echo $i; ?>" ><?php echo $i; ?></div>
   <?php } ?>
   <input type="hidden" value="<?php echo $year; ?>" id="year">
   </div>


   
   <p class="text-center" style="border-bottom:1px solid black;">Successful Launch</p>

   <div class="col-md-12 " style="margin-bottom: 30px;cursor:pointer">
   <input type="hidden" value="<?php echo $launch; ?>" id="launch">
   <div class="col-md-5 text-center inactive_h launch" vl="true" <?php if($launch=="true"){ ?> active_h<?php } else { ?>inactive_h <?php } ?>  >True</div>
   <div class="col-md-5 text-center inactive_h launch" vl="false" <?php if($launch=="false"){ ?> active_h<?php } else { ?>inactive_h <?php } ?>  >False</div>
   
   
   </div>

   <p class="text-center" style="border-bottom:1px solid black;">Successful Landing</p>

   <div class="col-md-12 " style="cursor:pointer">
   <input type="hidden" value="<?php echo $land; ?>" id="land">
   <div class="col-md-5 text-center inactive_h land" vl="true" <?php if($land=="true"){ ?> active_h<?php } else { ?>inactive_h <?php } ?>>True</div>
   <div class="col-md-5 text-center inactive_h land" vl="false" <?php if($land="false"){ ?> active_h<?php } else { ?>inactive_h <?php } ?>>False</div>

   
   </div>
   </div>
   <div class="col-md-9">
   <div id="load_page_loader" style="display:none;">Loading...</div>
<div class="col-md-12" id="data">




</div>

   </div>
   </div>
   </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
$(document).ready(function(){
    filter();
    $(".year").click(function(){
$(".year").removeClass('active_h');
$(".year").addClass('inactive_h');
$(this).addClass('active_h');
var year=$(this).attr('vl');
$("#year").val(year);
    var q= updateQueryStringParameter(window.location.href,'launch_year',year);
    window.history.pushState({path:q},'',q);
    filter();
    });

    $(".launch").click(function(){
$(".launch").removeClass('active_h');
$(".launch").addClass('inactive_h');
$(this).addClass('active_h');
var launch=$(this).attr('vl');
$("#launch").val(launch);
   var q= updateQueryStringParameter(window.location.href,'launch_success',launch);
    window.history.pushState({path:q},'',q);
    filter();
    });

    $(".land").click(function(){
$(".land").removeClass('active_h');
$(".land").addClass('inactive_h');
$(this).addClass('active_h');
var land=$(this).attr('vl');
$("#land").val(land);
   var q= updateQueryStringParameter(window.location.href,'land_success',land);
    window.history.pushState({path:q},'',q);
    filter();
    });


    function filter(){
$("#load_page_loader").show();
var year=$("#year").val();
var launch=$("#launch").val();
var land=$("#land").val();
 $.ajax({
 type: 'get',
 url: 'filter',
 data: {launch_year:year,launch_success:launch,land_success:land},
 success: function (data) {
$("#data").html(data);
$("#load_page_loader").hide();
 }
 });
    }
});

function updateQueryStringParameter(uri, key, value) {
      var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
      var separator = uri.indexOf('?') !== -1 ? "&" : "?";
      if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
      }
      else {
        return uri + separator + key + "=" + value;
      }
    }
     </script>
</body>
</html>