<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pajak Manual PBB/Reklame/PAT</span>
        </li>
    </ul> 
</div>
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <input type="hidden" name="t_customer_id" id="t_customer_id">
        <input type="hidden" name="t_cust_account_id" id="t_cust_account_id">
        <div class="tab-content no-border">
            <div class="row">
                <div class="col-md-12">
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
                </div>
            </div>
            <div class="space-4"></div>  
            
        </div>
    </div>
</div>

<script>

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_payment_receipt_skpd_controller/read"; ?>',
            //postData: { t_customer_id : $('#t_customer_id').val() },
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_payment_receipt_skpd_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                
                {label: 'Nomor Terima',name: 'receipt_no',width: 150, align: "left",editable: false},
                

                {label: 'Tanggal Bayar',name: 'payment_date',width: 200, align: "left",editable: false},

                {label: 'Bulan',name: 'finance_period_code',width: 200, align: "left",editable: false},

                {label: 'Nilai Pajak',name: 'payment_vat_amount',width: 200, align: "left",editable: false,formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:'.'}}
            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: 5,
            rowList: [10,20,50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/
                //alert(rowid);

            },
            sortorder:'',
            pager: '#grid-pager',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
                setTimeout(function(){
                      $("#grid-table").setSelection($("#grid-table").getDataIDs()[0],true);
                    },500);

            },
            caption: "Daftar Customer"

        });

        jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
            {   //navbar options
                edit: false,
                editicon: 'fa fa-pencil blue bigger-120',
                add: false,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: false,
                delicon: 'fa fa-trash-o red bigger-120',
                search: true,
                searchicon: 'fa fa-search orange bigger-120',
                refresh: true,
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

    function responsive_jqgrid(grid_selector, pager_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }


</script>

<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="form-body" id="grid-pager">
                
                <div class="row">
                    <label class="control-label col-md-3">Ayat Pajak</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input id="form_vat_type_id" type="text"  style="display:none;">
                            <input id="form_vat_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Ayat Pajak">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVVatType('form_vat_type_id','form_vat_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Tipe Ayat</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input id="form_vat_dtl_id" type="text"  style="display:none;">
                            <input id="form_vat_dtl_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Tipe Ayat">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVTypeDtl('form_vat_dtl_id','form_vat_dtl_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Tanggal Bayar</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" id="payment_date">        
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Nilai Pajak</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" id="payment_vat_amount" style="text-align: right;">        
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row col-md-offset-3">
                    <button class="btn btn-success" type="submit" id="btn-submit" onclick="save()">Simpan</button>
                </div>
            </div>
        </div>
        
        
    </div>
    <?php $this->load->view('lov/lov_vat_type_ppat'); ?>
    <?php $this->load->view('lov/lov_vat_type_dtl'); ?>
    <?php $this->load->view('lov/lov_ayat_class'); ?>
    
</div>

<script type="text/javascript">
    $('#form_vat_type_id').on('change', function() {
        $('#form_vat_dtl_id').val('');
        $('#form_vat_dtl_code').val('');
    });

    $("#payment_vat_amount").number(true,0,'.',',');
</script>


<!-- <script type="text/javascript">
    
    jQuery(function ($) {
        var grid_selector = "#grid-table-piutang";
        jQuery("#grid-table-piutang").jqGrid({
            colModel: [
                {label: 'Periode',name: 'period',width: 150, align: "left"},
                {label: 'Status',name: 'vat_code',width: 150, align: "left"},

            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: -1,
            rowList: [10, 20, 50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            caption: "Informasi Pajak Belum Bayar"
        });
        
    });    
</script> -->

<script> 
    $('#payment_date').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'yyyy-mm-dd',
      todayBtn: 'linked',
      todayHighlight: true
    });
</script>

<script type="text/javascript">

    

    function save(){

        var p_vat_type_dtl_id = $('#form_vat_dtl_id').val();
        var payment_date = $('#payment_date').val();
        var payment_vat_amount = $('#payment_vat_amount').val();   

        if (p_vat_type_dtl_id == "" || p_vat_type_dtl_id == 0 || p_vat_type_dtl_id == false || p_vat_type_dtl_id == undefined ||  p_vat_type_dtl_id == null){
            swal('Informasi',"Tipe Ayat harus diisi",'info');
            return;
        }


        if (payment_vat_amount == "" || payment_vat_amount == 0 || payment_vat_amount == false || payment_vat_amount == undefined ||  payment_vat_amount == null){
            swal('Informasi',"Nilai Pajak harus diisi",'info');
            return;
        }


        var var_url = "<?php echo WS_JQGRID . "transaksi.t_payment_receipt_skpd_controller/insertUpdate/?"; ?>";
        var_url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        var_url += "&p_vat_type_dtl_id=" + p_vat_type_dtl_id;
        var_url += "&payment_date=" + payment_date;
        var_url += "&payment_vat_amount=" + payment_vat_amount;

        //window.location = var_url;
        
        $.getJSON(var_url, function( items ) {        
            swal('Informasi',items.rows.f_insert_jaktap_new,'info');    

            jQuery(function($) {
                var grid_selector = "#grid-table-history";
                //var pager_selector = "#grid-pager-bpps2";

                    jQuery("#grid-table").jqGrid('setGridParam',{
                        url: '<?php echo WS_JQGRID."transaksi.t_payment_receipt_skpd_controller/read"; ?>'

                    });

                    $("#grid-table").jqGrid("setCaption", "Daftar Pajak Manual PAT");
                    $("#grid-table").trigger("reloadGrid");
                });           
        })
        
    }

</script>

<script>
function responsive_jqgrid(grid_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid('setGridWidth', $(".form-body").width());
        //$(pager_selector).jqGrid('setGridWidth', parent_column.width());

    }

function showLOVVatType(id, code) {
    modal_lov_vat_show(id, code);
}
function showLOVTypeDtl(id, code) {
    if ($('#form_vat_type_id').val()=='' || $('#form_vat_type_id').val()==0 ) {
        swal('Informasi','Ayat Pajak Harus Diisi','info');
        return false;
    } else {
        //swal('Informasi', $('#form_year_period_id').val(),'info');

        modal_lov_vat_dtl_show(id, code,$('#form_vat_type_id').val());
    }
    
}
function showLOVClass(id, code, parent) {
    if ($('#form_vat_dtl_id').val()=='' || $('#form_vat_dtl_id').val()==0 ) {
        swal('Informasi','Tipe Pajak Harus Diisi','info');
        return false;
    } else {
        //swal('Informasi', $('#form_year_period_id').val(),'info');

        modal_vat_type_dtl_cls_show(id, code,$('#form_vat_dtl_id').val());
    }
}
    
function openInNewTab(url) {
    // window.open("../report/cetak_rep_lap_harian_bdhr.php?tgl_penerimaan='" + tgl_penerimaan + "'&kabid=T"+ "&kode_bank="+kode_bank, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
  window.open(url, 'No Payment', 'left=0,top=0,width=500,height=500,toolbar=no,scrollbars=yes,resizable=yes');
  // win.focus();
}

</script>
