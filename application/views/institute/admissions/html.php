<?php
$courses = $this->db->get_where("tbl_institute_admission",["institute_id"=>$this->session->userdata("institute_id"),"student_id"=>$student_id])->result(); 
$ees = $this->db->get_where("tbl_entrance_exams",["student_id"=>$student_id])->result();
?>
<table class="table table-bordered" id="printTable">
    <tbody>
	    <tr>
			<td colspan="3" style="text-align:center;font-weight: bold;">Basic Details</td>
		</tr>
        <tr>
	        <td style="font-weight: bold;">Name</td>
            <td><?php echo $student->student_name; ?></td>
            <td rowspan="4" align="right"><img src="<?php if($student->image_std!=''){ echo base_url().$student->image_std; }else{echo base_url().'assets/images/user1.png';}?>" width="200" height="200"><br><img src="<?php if($student->signature_std!=''){ echo base_url().$student->signature_std; }else{echo base_url().'assets/images/signature.png';}?>"  width="200" height="50"></td>
		</tr>
        <tr>
	        <td style="font-weight: bold;">Email</td>
            <td><?php echo $student->email;?></td>
		</tr>	
        <tr>
	        <td style="font-weight: bold;">phone</td>
            <td><?php echo $student->phone; ?></td>
		</tr>
        <tr>
	        <td style="font-weight: bold;">Address</td>
            <td><?php echo $student->address;?></td>
		</tr>

		<? if((trim($student->ssc_board) != "") && (trim($student->ssc_school) != "")){ ?>
		
		<tr>
			<td colspan="3" style="text-align:center;font-weight: bold;">SSC</td>
		</tr>
        <tr>
			<td style="font-weight: bold;">Name of the Board</td>
			<td colspan="2"><?php echo $student->ssc_board;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">School Name</td>
			<td colspan="2"><?php echo $student->ssc_school;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">School Address</td>
			<td colspan="2"><?php echo $student->ssc_address;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">School District</td>
			<td colspan="2"><?php echo $student->ssc_district;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">School State</td>
			<td colspan="2"><?php echo $student->ssc_state;?></td>
		</tr>
		
		<tr>
			<td style="font-weight: bold;">Hall Ticket Number</td>
			<td colspan="2"><?php echo $student->ssc_hallticket;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Total Marks</td>
			<td colspan="2"><?php echo $student->ssc_totalmarks;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Total Marks Secured</td>
			<td colspan="2"><?php echo $student->ssc_markssecured;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Percentage</td>
			<td colspan="2"><?php echo $student->ssc_percentage;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Year of passing</td>
			<td colspan="2"><?php echo $student->ssc_yearpassing;?></td>
		</tr>

		<? } ?>	
		<? if((trim($student->inter_board) != "") && (trim($student->inter_college) != "")){ ?>						
		<tr>
			<td colspan="3" style="text-align:center;font-weight: bold;">Intermidiate</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Name of the Board</td>
			<td colspan="2"><?php echo $student->inter_board;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">College Name</td>
			<td colspan="2"><?php echo $student->inter_college;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Course Name</td>
			<td colspan="2"><?php echo $student->inter_course;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Group Name</td>
			<td colspan="2"><?php echo $student->inter_group;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">College Address</td>
			<td colspan="2"><?php echo $student->inter_address;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">College District</td>
			<td colspan="2"><?php echo $student->inter_district;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">College State</td>
			<td colspan="2"><?php echo $student->inter_state;?></td>
		</tr>
		
		<tr>
			<td style="font-weight: bold;">Hall Ticket Number</td>
			<td colspan="2"><?php echo $student->inter_hallticket;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Total Marks</td>
			<td colspan="2"><?php echo $student->inter_totalmarks;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Total Marks Secured</td>
			<td colspan="2"><?php echo $student->inter_markssecured;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Percentage</td>
			<td colspan="2"><?php echo $student->inter_percentage;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Group Marks</td>
			<td colspan="2"><?php echo $student->inter_groupmarks;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Year of passing</td>
			<td colspan="2"><?php echo $student->inter_yearpassing;?></td>
		</tr>
		<? } ?>
		<? if((trim($student->degree_college) != "") && (trim($student->degree_auniversity) != "")){ ?>						

		<tr>
			<td colspan="3" style="text-align:center;font-weight: bold;">Degree/Graduation</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">College Name</td>
			<td colspan="2"><?php echo $student->degree_college;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Affiliated University</td>
			<td colspan="2"><?php echo $student->degree_auniversity;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Course</td>
			<td colspan="2"><?php echo $student->degree_group;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Specialisation</td>
			<td colspan="2"><?php echo $student->degree_address;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">College Address</td>
			<td colspan="2"><?php echo $student->degree_address;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">College District</td>
			<td colspan="2"><?php echo $student->degree_district;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">College State</td>
			<td colspan="2"><?php echo $student->degree_state;?></td>
		</tr>
		
		<tr>
			<td style="font-weight: bold;">Hall Ticket Number</td>
			<td colspan="2"><?php echo $student->degree_hallticket;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Total Marks</td>
			<td colspan="2"><?php echo $student->degree_totalmarks;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Total Marks Secured</td>
			<td colspan="2"><?php echo $student->degree_markssecured;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Percentage</td>
			<td colspan="2"><?php echo $student->degree_percentage;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Group Marks</td>
			<td colspan="2"><?php echo $student->degree_groupmarks;?></td>
		</tr>
		<tr>
			<td style="font-weight: bold;">Year of passing</td>
			<td colspan="2"><?php echo $student->degree_yearpassing;?></td>
		</tr>
		<? } ?>							

		<tr>
			<td colspan="3" style="text-align:center;font-weight: bold;">Additional Details</td>
		</tr>
        <tr>
	        <td style="font-weight: bold;">Person with Disability</td>
            <td colspan="2"><?php echo $student->person_disability_check_std; ?></td>
		</tr>
        <tr>
	        <td style="font-weight: bold;">Type of disability</td>
            <td colspan="2"><?php echo $student->disability_name_std;?></td>
		</tr>	
        <!-- <tr>
	        <td style="font-weight: bold;">Photo</td>
            <td>
				<?php if(file_exists($student->image_std)){ ?>
					<img src="<?php echo base_url().$student->image_std; ?>"  style="width: 80%;">
				<?php }else{ ?>
					<p>Image not found!..</p>
				<?php } ?>
			</td>
		</tr>
        <tr>
	        <td style="font-weight: bold;">Signature</td>
            <td>
			<?php if(file_exists($student->signature_std)){ ?>
				<img src="<?php echo base_url().$student->signature_std; ?>"  style="width: 80%;">
			<?php }else{ ?>
				<p>Signature not found!..</p>
			<?php } ?>
			</td>
		</tr> -->

		<? if(count($ees) > 0){ ?>
			<tr>
				<td colspan="3" style="text-align:center;font-weight: bold;">Entrance Exam Details</td>
			</tr>
			<tr>
				<td colspan="3">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Entrance Exam Name</th>
									<th>Year of Appeared</th>
									<th>Hall Ticket Number</th>
									<th>Maximum Marks</th>
									<th>Marks Secured</th>
									<th>Rank Obtained / All India Rank</th>
								</tr>	
							</thead>
							<tbody>
								<? foreach($ees as $es){ ?>	
									<tr>
										<td><?php echo $es->exam_name;?></td>
										<td><?php echo $es->year_appeared;?></td>
										<td><?php echo $es->hallticket;?></td>
										<td><?php echo $es->max_marks;?></td>
										<td><?php echo $es->secured_marks;?></td>
										<td><?php echo $es->rank;?></td>

									</tr>
								<? } ?>		
							</tbody>	
						</table>
					</div>
				</td>
			</tr>				
			<?php
			}
		if(count($courses)>0){
		?>
		<tr>
			<td colspan="3" style="text-align: center;font-weight: bold;">Applied Courses</td>
		</tr>
		<tr>
			<td colspan="3">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr> 
								<th>S.no</th>
									<th>Merit Scholarship</th>
									<th>Applied Date</th>
								<th>Course Name</th>
								<th>Specialization</th>
								<th>Duration</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if($courses){
								$key=1;
								foreach($courses as $row):
									$cdetails = $this->institute_model->get_course_details($row->course_id);
								?>
						   <tr>
								<td><?php echo $key;?></td>
								<td><?php echo ucfirst($row->scholaryn);?></td>
								<td><?php echo date('d-m-Y', strtotime($row->created_date)) ;?></td>
								<td><?php echo $cdetails->course_name;?></td>
								<td style="white-space: break-spaces;"><?php echo $cdetails->specialization;?></td>
								<td><?php echo $cdetails->course_duration;?></td>  
							</tr>
							<?php $key++; endforeach;}?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
		<?php
		}
		?>
   		<tr>
   			<td colspan="3">
   				<h4 align="center">Student Certificates</h4>                   	

				<div class="row">

					<? foreach ($studentdocs as $cert) { ?>

						<div class="col-md-6">

							<img alt="<?php echo $cert->doc_filename;?>" src="<?php echo base_url();?>uploads/students/certificates/<?php echo $cert->student_id;?>/<?php echo $cert->doc_filename;?>" style="padding: 5px;border: 1px solid black;width: 100%;"><br>
							<span style="text-align: center">Name: <?php echo $cert->doc_name;?></span>

						</div>

					<? } ?>				

				</div>
   			</td>
   		</tr>
    </tbody>
</table>