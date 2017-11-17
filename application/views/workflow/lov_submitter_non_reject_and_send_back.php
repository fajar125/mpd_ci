<div id="modal_lov_submitter" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> KONFIRMASI PENUTUPAN PEKERJAAN </span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body" style="overflow-y:scroll;height:420px;">
                <form class="form-horizontal" application="form" id="form_submitter">
                    <input type="hidden" id="form_submitter_params">
                    <input type="hidden" id="form_submitter_back_summary">
                    <input type="hidden" id="form_wp_email">
                    <input type="hidden" id="form_wp_username">
                    <input type="hidden" id="form_wp_userpwd">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> Tanggal :</label>
                        <div class="col-sm-3">
                            <input id="form_submitter_date" name="submitter_date" class="col-xs-12 blue" type="text" value="<?php echo date('d-m-Y');?>" style="border:none;font-size:14px;font-weight:bold;padding:0px !important;" readonly="">
                        </div>

                        <label class="col-sm-3 control-label no-padding-right"> Submit Oleh :</label>
                        <div class="col-sm-3">
                            <label class="control-label blue" id="form_submitter_by" style="font-weight:bold;"> <?php echo $this->session->userdata('app_user_name'); ?> </label>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> Pekerjaan Tersedia :</label>
                        <div class="col-sm-9">
                            <label class="control-label blue" id="form_submitter_available_job" style="font-weight:bold;"> </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> Status Dokumen : </label>
                        <div class="col-sm-9">
                            <select id="form_submitter_status_dok_wf" disabled></select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> Pesan Dikirim : </label>
                        <div class="col-sm-9">
                            <textarea id="form_submitter_interactive_message" class="form-control" rows="1" cols="52" placeholder="Ketikkan Pesan Anda Disini..."></textarea>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right font-green"> Pesan Berhasil Dikirim :</label>
                        <div class="col-sm-9">
                            <textarea id="form_submitter_success_message" class="form-control font-green" readonly="readonly" rows="1" cols="52" placeholder="Generated By System"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right font-red"> Pesan Error :</label>
                        <div class="col-sm-9">
                            <textarea id="form_submitter_error_message" class="form-control font-red" readonly="readonly" rows="1" cols="52" placeholder="Generated By System"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right orange"> Pesan Peringatan :</label>
                        <div class="col-sm-9">
                            <textarea id="form_submitter_warning_message" class="form-control orange" readonly="readonly" rows="1" cols="52" placeholder="Generated By System"></textarea>
                        </div>
                    </div>

                </form>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons col-xs-7">
                        <button class="btn btn-primary btn-xs radius-4" id="btn-submitter-submit" data-dismiss="modal">
                            <i class="glyphicon glyphicon-upload"></i>
                            Submit
                        </button>
                    </div>
                    <div class="bootstrap-dialog-footer-buttons col-xs-5">
                        <button class="btn btn-danger btn-xs radius-4" id="btn-submitter-close" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script>


    $(function() {
        /* submit */
        $('#btn-submitter-submit').on('click', function() {
            result = confirm('Apakah Anda yakin menutup pekerjaan ini ?');
            if (result) {
                var submitter_params = $('#form_submitter_params').val();
                var messages = $('#form_submitter_interactive_message').val();

                $.ajax({
                    type: 'POST',
                    datatype: "json",
                    url: '<?php echo WS_JQGRID."workflow.wf_controller/submitter_submit"; ?>',
                    data: { params : submitter_params , interactive_message : messages},
                    timeout: 10000,
                    success: function(data) {
                        var response = JSON.parse(data);
                        if(response.success) {

                            $('#form_submitter_success_message').val( response.return_message );
                            $('#form_submitter_error_message').val( response.error_message );
                            $('#form_submitter_warning_message').val( response.warning );

                            if( response.return_message.trim() == 'BERHASIL') {

                                if($('#form_wp_email').val() != ''){
                                    sendMail();
                                }
                                modal_lov_submitter_back_summary();
                            }

                        }else {
                            swal("", data.message, "warning");
                        }
                    }
                });
            }
            return false;
        });

    });

    function modal_lov_submitter_show(params_submit, params_back_summary) {
        modal_lov_submitter_init(params_submit, params_back_summary, modal_lov_submitter_show_up);
    }

    function modal_lov_submitter_show_up() {
        $("#modal_lov_submitter").modal({backdrop: 'static'});
    }

    function modal_lov_submitter_init(params_submit, params_back_summary, callback) {

        $('#form_submitter_params').val( JSON.stringify(params_submit) );
        $('#form_submitter_back_summary').val( JSON.stringify(params_back_summary) );
        $('#form_submitter_interactive_message').val("");

        if(params_back_summary.WP_EMAIL){
            $('#form_wp_email').val(params_back_summary.WP_EMAIL);
            $('#form_wp_username').val(params_back_summary.WP_NAME);
            $('#form_wp_userpwd').val(params_back_summary.WP_PWD);
        }else{
            $('#form_wp_email').val('');
            $('#form_wp_username').val('');
            $('#form_wp_userpwd').val('');
        }
        /*init pekerjaan tersedia*/
        $.ajax({
            type: 'POST',
            datatype: "json",
            url: '<?php echo WS_JQGRID."workflow.wf_controller/pekerjaan_tersedia"; ?>',
            data: { curr_proc_id : params_submit.CURR_PROC_ID, curr_doc_type_id: params_submit.CURR_DOC_TYPE_ID },
            timeout: 10000,
            success: function(data) {
                var response = JSON.parse(data);
                $("#form_submitter_available_job").html( response.task );
            }
        });


        /*init status dokumen wf*/
        $.ajax({
            type: 'POST',
            datatype: "json",
            url: '<?php echo WS_JQGRID."workflow.wf_controller/status_dokumen_workflow"; ?>',
            timeout: 10000,
            success: function(data) {
                var response = JSON.parse(data);
                $("#form_submitter_status_dok_wf").html( response.opt_status );
            }
        });

        callback();
    }

    function modal_lov_submitter_back_summary() {
        var obj_summary_params = JSON.parse( $('#form_submitter_back_summary').val() );
        var file_name = obj_summary_params.FSUMMARY;
        delete obj_summary_params.FSUMMARY;

        $('#btn-submitter-submit').remove();
        $('#btn-submitter-reject').remove();
        $('#btn-submitter-back').remove();
        $('#btn-submitter-close').remove();

        setTimeout(function(){
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            loadContentWithParams( file_name , obj_summary_params );
        },3000);
    }

    function sendMail(){
         $.ajax({
            url: "<?php echo site_url('sendmail');?>",
            type: "POST",
            dataType: "json",
            data: {
              email : $('#form_wp_email').val(),
              uname : $('#form_wp_username').val(),
              upwd : $('#form_wp_userpwd').val()
            },
            success: function (data) {

            }
        });
    }

</script>