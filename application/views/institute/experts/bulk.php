
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
        <div class="block-header">
               <!--  <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2>Jquery Datatable</h2>
                    </div>            
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Table</li>
                            <li class="breadcrumb-item active">Jquery Datatable</li>
                        </ul>
                    </div>
                </div> -->
            </div>
    <div class="col-md-12">
                    <?php echo $this->session->flashdata('msg');?>
                    <div class="card">
                        <div class="header">
                            <div class="col-lg-9 pull-left">
                                <h2>Bulk Upload</h2>
                            </div>
                            <a href="<?php echo base_url("institute/experts");?>" class="col-lg-1 pull-right"><u>Back</u></a>
                                   
                        </div>
                        <div class="body">
                             <form id="basic-form" action="<?php echo base_url('institute/experts/import')?>" method="POST" enctype="multipart/form-data" novalidate>
                               
                                 <input type="file" name="file" class="dropify form-controll" data-allowed-file-extensions="xls xlsx" required><br>
                               
                                 <button  type="submit" class="btn btn-primary pull-right">Upload</button>
                                 
                            </form>
                        </div>

                       
                    </div>
    </div>
</div>
<script type="text/javascript">
  $('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
});
</script>
