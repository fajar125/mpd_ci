<link href="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<div id="modal_lov_t_vat_setllement_manual_skpdkb_lb" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title">INFORMASI PELAPORAN PAJAK MANUAL SKPDKB</span>
                </div>
            </div>


            <!-- modal body -->
            <div class="modal-body">
                <form role="form" id="form_tambah" name="form_tambah" method="post">
                    <div class="row">   
                        <label class="control-label col-md-2">No Order</label>  
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="order_no" id="order_no" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- modal footer -->
                    <div class="modal-footer no-margin-top">
                        <div class="bootstrap-dialog-footer">

                            <div class="bootstrap-dialog-footer-buttons col-xs-7">                    
                                <br>
                                <button type="button" id="lov-btn-update" onClick="saveData()" id="btn-update" class="btn btn-sm btn-primary">Submit</button>
                                <button type="button" class="btn btn-sm btn-default" id="btn-update-close" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script type="text/javascript">
    function modal_lov_skpdkblb_show() {
        $("#modal_lov_t_vat_setllement_manual_skpdkb_lb").bootgrid("destroy");
        modal_lov_skpdkblb_init();

        $("#modal_lov_t_vat_setllement_manual_skpdkb_lb").modal({backdrop: 'static'});
    }

    function modal_lov_skpdkblb_init(t_cust_account_id) {

        //$('#t_cust_account_id').val(t_cust_account_id);
        //$('#form_submitter_back_summary').val( JSON.stringify(form_submitter_back_summary) );

    }
</script>

