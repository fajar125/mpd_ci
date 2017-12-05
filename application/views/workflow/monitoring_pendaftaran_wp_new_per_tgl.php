<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Workflow</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Monitoring Pendaftaran WP Per Tanggal</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">

  		<div class="portlet light bordered" >
  			<div class="portlet-title">
  				<div class="caption">
  					<i class=" icon-info font-blue"></i>
  					<span class="caption-subject font-blue bold uppercase"> Filter Monitoring Pendaftaran WP Per Tanggal
  					</span>
  				</div>
  			</div>
  			<form role="form">
  				  <div class="row">
            <div class="col-md-9">

              <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Jenis Pajak </label>
                <div class="col-sm-5">
                   <select class="form-control" id="p_vat_type_id" name="p_vat_type_id"></select>
                </div>
                
              </div>  
              <br>

              <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Start Date </label>
                <div class="col-sm-5">
                   <input class="form-control datepicker" type="text" id="start_date" name="start_date" />
                </div>
                
              </div>  
              <br>

              <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> End Date </label>
                <div class="col-sm-5">
                   <input class="form-control datepicker" type="text" id="end_date" name="end_date" />
                </div>
                  
              </div>  
              <br>
              
              <div class="form-group">
                  <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Status Proses </label>
                  <div class="col-sm-5">
                     <select class="form-control" id="status" name="status">
                       <option value="0">SEMUA</option>
                       <option value="2">PROSES</option>
                       <option value="3">SELESAI</option>
                     </select>
                  </div>
                  <a id="findFilter" class="fm-button ui-state-default ui-corner-all fm-button-icon-right ui-reset btn btn-sm btn-info">
                      <span class="ace-icon fa fa-search"></span> Find</a>
              </div>
            </div>
              
            </div>  
  			</form>
  		</div>

    </div>

    <!-- isi -->
    <div id="tab-content"></div>

<script type="text/javascript">

  /*init workflow*/
    $.ajax({
        type: 'POST',
        datatype: "json",
        url: '<?php echo WS_JQGRID."workflow.wf_controller/p_vat_type_list"; ?>',
        timeout: 10000,
        success: function(data) {
            var response = JSON.parse(data);
            $("#p_vat_type_id").html( response.opt_status );
        }
    });

    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        // defaultDate: new Date()
    });

  $(document).ready(function(){

        $('#findFilter').click(function(){

            $.ajax({
                url: '<?php echo site_url('transaksi/processMonitoringPendWPNewTgl');?>',                
                data: {
                    p_vat_type_id : $('#p_vat_type_id').val(),
                    start_date : $('#start_date').val(),
                    end_date : $('#end_date').val(),
                    status : $('#status').val()
                  },
                type: 'POST',
                success: function (data) {
                    $('#tab-content').html(data);
                }
            });

        });
    });
</script>