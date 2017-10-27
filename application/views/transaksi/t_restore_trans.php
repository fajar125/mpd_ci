<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Restoring</span>
        </li>
    </ul> 
</div>
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="row">
                    <label class="control-label col-md-2">NPWPD</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input id="npwd" type="text" class="FormElement form-control">
                        </div>
                    </div>
                    <label class="control-label col-md-2">Jenis Pajak</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input id="form_vat_id" type="text" style="display:none;">
                            <input id="kode_ayat" name="kode_ayat" type="text"  style="display:none;">
                            <input id="form_vat_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Jenis Pajak">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVVat_type('form_vat_id','form_vat_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-2">Tanggal Perubahan</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="date_start_laporan" id="date_start_laporan">                 
                        </div>
                    </div>
                    <label class="control-label col-md-2"> s.d. </label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="date_end_laporan" id="date_end_laporan">                 
                        </div>
                    </div>
                </div>
                
                <div class="space-2"></div>
                <div class="row col-md-offset-5">
                    <button class="btn btn-success" type="button" id="btn-search">Cari</button>
                </div>
            </div>
        </div>
        
        
    </div>
    <?php $this->load->view('lov/lov_vat_type'); ?>
    <?php $this->load->view('lov/lov_t_vat_setllement_restore_transaksi'); ?>
    
</div>
<div class="tab-content no-border">
    <div class="row">
        <div class="col-xs-12">
            <div id="gbox_grid-table" class="ui-jqgrid">
                <div id="gview_grid-table" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table-restore"></table>
                </div>
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function ($) {
        var grid_selector = "#grid-table-restore";
        jQuery("#grid-table-restore").jqGrid({
            url: '<?php echo WS_JQGRID . "transaksi.t_restore_trans_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID Vat Setllement', name: 't_vat_setllement_id',width: 5, sorttype: 'number',hidden: true},

                {label: 'NPWPD',name: 'npwd',width: 120, align: "left"},
                {label: 'Periode',name: 'periode_code',width: 150, align: "left"},
                {label: 'Settlement Type',name: 'type_code',width: 150, align: "left"},
                {label: 'Settlement Date',name: 'settlement_date',width: 250, align: "left"},
                {label: 'Execute By',name: 'modified_by',width: 180, align: "left"},
                {label: 'Modification Type',name: 'modification_type',width: 250, align: "left"},
                {label: 'Modification Date',name: 'modification_date',width: 180, align: "left"},
                {label: 'Reason',name: 'alasan',width: 550,align: "left"},
                
                {name: 'Restore',width: 100, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var t_vat_setllement_id = rowObject['t_vat_setllement_id'];
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="showLOVRestore('+t_vat_setllement_id+')">Restore</a>';
                    }
                }
                
            ],
            height: '100%',
            autowidth: false,
            viewrecords: true,
            rowNum: -1,
            rowList: [10, 20, 50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: false,
            multiboxonly: true,
            footerrow: true,
            
            gridComplete: function() {
                
            },
            onSelectRow: function (rowid) {
                /*do something when selected*/
                
            },
            sortorder:'',
            pager: '#grid-pager',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function () {
                          
               
            },
              
            caption: "DAFTAR TRANSAKSI YANG DIHAPUS"
        });

        jQuery('#grid-table-restore').jqGrid('navGrid', '#grid-pager',
            {   //navbar options
                edit: false,
                editicon: 'fa fa-pencil blue bigger-120',
                add: false,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: false,
                delicon: 'fa fa-trash-o red bigger-120',
                search: false,
                searchicon: 'fa fa-search orange bigger-120',
                refresh: false,
                afterRefresh: function () {
                    // some code here
                    jQuery("#detailsPlaceholder").hide();
                },

                refreshicon: 'fa fa-refresh green bigger-120',
                view: false,
                viewicon: 'fa fa-search-plus grey bigger-120'
            },

            {
                // options for the Edit Dialog
                closeAfterEdit: true,
                closeOnEscape:true,
                recreateForm: true,
                serializeEditData: serializeJSON,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                editData : {
                    /*t_cust_account_id: function() {
                        return <?php //echo $this->input->post('t_cust_account_id'); ?>;
                    }*/
                },
                //new record form
                closeAfterAdd: false,
                clearAfterAdd : true,
                closeOnEscape:true,
                recreateForm: true,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                serializeEditData: serializeJSON,
                viewPagerButtons: false,
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }

                    $(".tinfo").html('<div class="ui-state-success">' + response.message + '</div>');
                    var tinfoel = $(".tinfo").show();
                    tinfoel.delay(3000).fadeOut();


                    return [true,"",response.responseText];
                }
            },
            {
                //delete record form
                serializeDelData: serializeJSON,
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                    style_delete_form(form);

                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                onClick: function (e) {
                    //alert(1);
                },
                afterSubmit:function(response,postdata) {
                    var response = jQuery.parseJSON(response.responseText);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }
                    return [true,"",response.responseText];
                }
            },
            {
                //search form
                closeAfterSearch: false,
                recreateForm: true,
                afterShowSearch: function (e) {
                    var form = $(e[0]);
                    style_search_form(form);
                    form.closest('.ui-jqdialog').center();
                },
                afterRedraw: function () {
                    style_search_filters($(this));
                }
            },
            {
                //view record form
                recreateForm: true,
                beforeShowForm: function (e) {
                    var form = $(e[0]);
                }
            }
        );    
       
       
        
    });

</script>

<script> 
    $("#btn-search").on('click', function() {

        //var p_vat_type_id = $('#form_vat_id').val();
        var p_vat_type_id       = $('#form_vat_id').val();
        var date_start_laporan  = $('#date_start_laporan').val();        
        var date_end_laporan    = $('#date_end_laporan').val();
        var npwd                = $('#npwd').val();

        if( date_end_laporan == "" && 
            date_start_laporan == "" && 
            p_vat_type_id == "" && 
            npwd == ""){
            
            swal ( "Oopss" ,  "Kolom Filter Harus Diisi!" ,  "error" );  
                 
        }else{
            jQuery(function($) {
                var grid_selector = "#grid-table-restore";
                //var pager_selector = "#grid-pager-bpps2";

                jQuery("#grid-table-restore").jqGrid('setGridParam',{
                    url: '<?php echo WS_JQGRID."transaksi.t_restore_trans_controller/read"; ?>',
                    postData: {p_vat_type_id: p_vat_type_id,
                                date_start_laporan: date_start_laporan,
                                date_end_laporan: date_end_laporan,
                                npwd: npwd
                            }

                });

                $("#grid-table-restore").jqGrid("setCaption", "DAFTAR TRANSAKSI YANG DIHAPUS");
                $("#grid-table-restore").trigger("reloadGrid");
            });
        }

    });

    $('#date_start_laporan').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'dd-mm-yyyy',
      todayBtn: 'linked',
      todayHighlight: true
    });

    $('#date_end_laporan').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'dd-mm-yyyy',
      todayBtn: 'linked',
      todayHighlight: true
    });

    function showLOVVat_type(id, code) {
        modal_lov_vat_show(id, code);
    }

    function responsive_jqgrid(grid_selector) {
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid('setGridWidth', $(".form-body").width());
        //$(pager_selector).jqGrid('setGridWidth', parent_column.width());

    }

    function showLOVRestore(id) {
        //alert(id);
        var p_vat_type_id       = $('#p_vat_type_id').val();
        var npwd                = $('#npwd').val();
        var date_start_laporan  = $('#date_start_laporan').val();
        var date_end_laporan    = $('#date_end_laporan').val();

        var arr = [id,p_vat_type_id,npwd,date_start_laporan,date_end_laporan];
        modal_restore_show(arr);
    }
</script>