
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }
</style>

<div id="main-content">
        
    <div class="container-fluid">
            
            <div class="row clearfix">  
			<div class="col-md-6">
				<div class="card">
					<div class="header">
						<h2>Download MYSQL Database</h2>
					</div>
					<div class="body">
						<a href="<?php echo base_url('admin/settings/db_backup');?>" target="_blank">
						  <button type="button" class="btn btn-primary">Download</button>
					  </a>
					</div>

				  <div class="" role="tab">
					<h5 class="mb-0" style="margin-left: 10px">All Database Backups</h5>
				  </div>
				  <div class="card-body">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
					  <thead>
						  <tr> 
							  <th>S.no</th>
							  <th>Backup Date</th>
							  <th>Downlaod</th>
						  </tr>
					  </thead>
					  <tbody>
						  <?php 
						  $databases = $this->db->get_where("tbl_backups",["type"=>"database"])->result();
						  if($databases){
								  $key=1;
								 foreach($databases as $db):
							  ?>
						 <tr>
							  <td><?php echo $key;?></td>
							  <td><?php echo date("d-m-Y H:i:s",strtotime($db->created_date));?></td>
							  <td><a href="<?php echo base_url().$db->source_file;?>" class="btn btn-info btn-sm" style="border-radius: 15px">Download</a></td>
						  </tr>
						  <?php $key++; endforeach;}?>

					  </tbody>

					</table>
				  </div>
				</div>
			</div>


			<div class="col-md-6">
				<div class="card">
					<div class="header">
						<h2>Download Source Code</h2>
					</div>
					<div class="body">
						<a href="<?php echo base_url('admin/backup/backupsource_code');?>" target="_blank">
						  <button type="button" class="btn btn-primary">Download</button>
						</a>
					</div>

				  <div class="" role="tab">
					<h5 class="mb-0" style="margin-left: 10px">All Source Code Backups</h5>
				  </div>
				  <div class="card-body">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable">
					  <thead>
						  <tr> 
							  <th>S.no</th>
							  <th>Backup Date</th>
							  <th>Downlaod</th>
						  </tr>
					  </thead>
					  <tbody>
						  <?php 
						  $databases = $this->db->get_where("tbl_backups",["type"=>"source"])->result();
						  if($databases){
								  $key=1;
								 foreach($databases as $db):
							  ?>
						 <tr>
							  <td><?php echo $key;?></td>
							  <td><?php echo date("d-m-Y H:i:s",strtotime($db->created_date));?></td>
							  <td><a href="<?php echo base_url().$db->source_file;?>" class="btn btn-info btn-sm" style="border-radius: 15px">Download</a></td>
						  </tr>
						  <?php $key++; endforeach;}?>

					  </tbody>

					</table>
				  </div>
				</div>
			</div>
		</div>
	</div>	
</div>

