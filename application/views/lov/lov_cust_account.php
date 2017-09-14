<div id="modal_cust_account" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title"> Data NPWD</span>
                </div>
            </div>
            <input type="hidden" id="modal_lov_t_cust_account_id_val" value="" />
            <input type="hidden" id="modal_lov_t_cust_account_npwd_val" value="" />
            <input type="hidden" id="modal_lov_name_val" value="" />
            <input type="hidden" id="modal_lov_vat_type_id_val" value="" />
            <input type="hidden" id="modal_lov_vat_code_val" value="" />
            <input type="hidden" id="modal_lov_dtl_id_val" value="" />
            <input type="hidden" id="modal_lov_dtl_code_val" value="" />

            <!-- modal body -->
            <div class="modal-body">
                <div>
                  <button type="button" class="btn btn-sm btn-success" id="modal_cust_account_btn_blank">
                    <span class="fa fa-pencil-square-o bigger-110" aria-hidden="true"></span> BLANK
                  </button>
                </div>
                <table id="modal_cust_account_grid_selection" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                     <th data-column-id="t_cust_account_id" data-sortable="false" data-visible="false">ID Status</th>
                     <th data-column-id="p_vat_type_id" data-sortable="false" data-visible="false">ID Status</th>
                     <th data-column-id="p_vat_type_dtl_id" data-sortable="false" data-visible="false">ID Status</th>
                     <th data-column-id="t_cust_account_id" data-sortable="false" data-visible="false">ID Status</th>
                     <th data-header-align="center" data-align="center" data-formatter="opt-edit" data-sortable="false" data-width="75">Options</th>
                     <th data-column-id="npwd">NPWPD</th>
                     <th data-column-id="company_brand">Merk Dagang</th>
                      <th data-column-id="vat_code">Jenis Pajak</th>
                      <th data-column-id="brand_address">Alamat</th>
                      <th data-column-id="vat_dtl" data-sortable="false" data-visible="false">ID Status</th>
                  </tr>
                </thead>
                </table>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-danger btn-sm radius-4" data-dismiss="modal">
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
    $(function($) {
        $("#modal_cust_account_btn_blank").on('click', function() {
            $("#"+ $("#modal_lov_t_cust_account_id_val").val()).val("");
            $("#"+ $("#modal_lov_t_cust_account_npwd_val").val()).val("");
            $("#"+ $("#modal_lov_name_val").val()).val("");
            $("#"+ $("#modal_lov_vat_type_id_val").val()).val("");
            $("#"+ $("#modal_lov_vat_code_val").val()).val("");
            $("#"+ $("#modal_lov_dtl_id_val").val()).val("");
            $("#"+ $("#modal_lov_dtl_code_val").val()).val("");
            $("#modal_cust_account").modal("toggle");
        });
    });

    function modal_cust_account_show(the_id_field, the_code_field, name, id_vat, vat_code, id_dtl, vat_dtl) {
        modal_cust_account_set_field_value(the_id_field, the_code_field, name, id_vat, vat_code, id_dtl, vat_dtl);
        $("#modal_cust_account").modal({backdrop: 'static'});
        modal_cust_account_prepare_table();
    }


    function modal_cust_account_set_field_value(the_id_field, the_code_field, name, id_vat, vat_code, id_dtl, vat_dtl) {
         $("#modal_lov_t_cust_account_id_val").val(the_id_field);
         $("#modal_lov_t_cust_account_npwd_val").val(the_code_field);
         $("#modal_lov_name_val").val(name);
         $("#modal_lov_vat_type_id_val").val(id_vat);
         $("#modal_lov_vat_code_val").val(vat_code);
         $("#modal_lov_dtl_id_val").val(id_dtl);
         $("#modal_lov_dtl_code_val").val(vat_dtl);
    }

    function modal_cust_account_set_value(the_id_val, the_code_val, name, id_vat, vat_code, id_dtl, vat_dtl) {
        $("#"+ $("#modal_lov_t_cust_account_id_val").val()).val(the_id_val);
        $("#"+ $("#modal_lov_t_cust_account_npwd_val").val()).val(the_code_val);
        $("#"+ $("#modal_lov_name_val").val()).val(name);
        $("#"+ $("#modal_lov_vat_type_id_val").val()).val(id_vat);
        $("#"+ $("#modal_lov_vat_code_val").val()).val(vat_code);
        $("#"+ $("#modal_lov_dtl_id_val").val()).val(id_dtl);
        $("#"+ $("#modal_lov_dtl_code_val").val()).val(vat_dtl);
        $("#modal_cust_account").modal("toggle");

        $("#"+ $("#modal_lov_t_cust_account_id_val").val()).change();
        $("#"+ $("#modal_lov_t_cust_account_npwd_val").val()).change();
        $("#"+ $("#modal_lov_name_val").val()).change();
        $("#"+ $("#modal_lov_vat_type_id_val").val()).change();
        $("#"+ $("#modal_lov_vat_code_val").val()).change();
        $("#"+ $("#modal_lov_dtl_id_val").val()).change();
        $("#"+ $("#modal_lov_dtl_code_val").val()).change();
    }

    function modal_cust_account_prepare_table() {
        $("#modal_cust_account_grid_selection").bootgrid({
             formatters: {
                "opt-edit" : function(col, row) {
                    return '<a href="javascript:;" title="Set Value" onclick="modal_cust_account_set_value(\''+ row.t_cust_account_id +'\', \''+ row.npwd +'\', \''+ row.company_brand +'\', \''+ row.p_vat_type_id +'\', \''+ row.vat_code +'\', \''+ row.p_vat_type_dtl_id +'\', \''+ row.vat_dtl +'\')" class="blue"><i class="fa fa-pencil-square-o bigger-130"></i></a>';
                },
                "status_display" : function(col, row) {
                    return '<i class="'+row.npwd+' bigger-140"></i>';
                }
             },
             rowCount:[5,10],
             ajax: true,
             requestHandler:function(request) {
                if(request.sort) {
                    var sortby = Object.keys(request.sort)[0];
                    request.dir = request.sort[sortby];

                    delete request.sort;
                    request.sort = sortby;
                }
                return request;
             },
             responseHandler:function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
                return response;
             },
             url: '<?php echo WS_BOOTGRID."transaksi.t_cust_account_controller/readLov"; ?>',
             selection: true,
             sorting:true
        });

        $('.bootgrid-header span.glyphicon-search').removeClass('glyphicon-search')
        .html('<i class="fa fa-search"></i>');
    }
</script>