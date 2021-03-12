
<style>
    td.details-control {
    background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }

	img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}

</style>

<div id="main-content">
        <div class="container-fluid">
            
            <div class="row">

										<? foreach ($brouchers as $row) { 
											$thumb = ($row->thumbnail != "") ? $row->thumbnail : 'assets/images/pdf.png';
										?>

											<div class="col-lg-3 col-sm-12" style="margin-bottom:20px">
												
                                               
											   <div class="card">
													<div class="card-body">
													    
														<img class="img-thumbnail"  style="opacity: inherit;padding: 5px;width:100%;height: 145px; position:relative" src="<? echo base_url().$thumb ?>">
														
														<p style="font-weight:bold;text-align:center"><? echo $row->institute_name; ?></p>
															<p style="text-align:center"><? echo $row->broucher_name ?></p>
															<a  target="_blank" style="margin-left: 30px;text-align:center;border-radius: 15px;color: white" class="btn btn-secondary btn-sm" href="<? echo base_url('assets/images/brochure/').$row->broucher ?>"><i class="fa fa-eye"></i>View</a>
															<a style="text-align:center;border-radius: 15px;color: white" class="btn btn-info btn-sm" href="<? echo base_url('assets/images/brochure/').$row->broucher ?>" download><i class="fa fa-download"></i> Download</a>
															<!-- <a style="margin-left:70px;text-align:center;border-radius: 15px;color: white" class="btn btn-info btn-sm" href="<? echo base_url('assets/images/brochure/').$row->broucher ?>" download><i class="fa fa-download"></i> Download</a> -->
													</div>
												</div>
											   
											</div>

										<? } ?>

									</div>

            
        </div>
    </div>
