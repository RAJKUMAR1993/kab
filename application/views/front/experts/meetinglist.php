<? $this->load->view("front/includes/header");?>

<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/counselor.jpg"   alt="" class="img-fluid">
</div>
<section class="our-webcoderskull ">
  <div class="container">
  <h1>Scheduled Meeting List</h1><br/>
  
  
  <div class="row cv">
  

 
 <div class="col-md-12 ">
   <h2><? echo $expert_details[0]->expert_name; ?></h2>

  <?php if($meetings){
       
                                        ?>
 <div class="table-responsive-sm box1">
<table class="table" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<th class="th-course-color first-table"> Date</th>
<th class="th-duration-color"> Time</th>
<th class="th-fee-structure-color"> Session</th>
<th class="th-fee-structure-color"> Student Name</th>
</tr>
<?  $key=1;
        foreach($meetings as $row){ ?>
<tr>
<td><?php echo date("d-m-Y",strtotime($row->exp_std_date));?></td>
<td><?php echo $row->exp_std_time;?></td>
<td><?php echo $row->exp_std_duration;?></td>
<td><?php echo $row->student_name;?></td>
</tr>
<? } ?>
</tbody>
</table></div> 

<hr/>

 <? }  ?>
 
 </div>
 
 
 
  </div>
  
  
  
  </div>
</section>


<? $this->load->view("front/includes/footer");?>