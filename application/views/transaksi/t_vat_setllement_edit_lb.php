<link href="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>PIUTANG SKPDKB LB</span>
        </li>
    </ul>
</div>

<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">                    
                    <span class="caption-subject font-blue bold uppercase"> PIUTANG SKPDKB LB
                    </span>
                </div>
            </div>
            <!-- CONTENT  value="2015-09-01" -->
            <div class="form-body">
                <div class="row col-md-offset-4">     
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="s_keyword" id="s_keyword">                 
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="toTampil()">Cari</button>
                </div> 
                <div class="space-4"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <div id="gbox_grid-table" class="ui-jqgrid">
                            <div id="gview_grid-table" class="ui-jqgrid-view table-responsive" role="grid">
                                <table id="grid-table"></table>
                                <div id="grid-pager"></div>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="space-4"></div>
<!-- Content  -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">                    
                    <span class="caption-subject font-blue bold uppercase"> INFORMASI SKPDKB LB
                    </span>
                </div>
            </div>
            <!-- CONTENT   -->
            <div class="form-body">

                <div class="row">   
                	<label class="control-label col-md-3">No Order</label>  
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="order_no" id="order_no" readonly>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" class="form-control" name="p_rqst_type_id" id="p_rqst_type_id" readonly>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group" style="display: none">
                            <input type="text" class="form-control required" name="no_kohir" id="no_kohir" readonly>
                            <button class="btn btn-primary" type="button">Generate Code</button>
                        </div>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                	<label class="control-label col-md-3">Nama WP</label>  
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="wp_name" id="wp_name" readonly>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                	<label class="control-label col-md-3">Alamat WP</label>  
                    <div class="col-md-4">
                        <textarea rows="4" class="form-control"   name="wp_address_name" id="wp_address_name" readonly></textarea>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Jenis Pajak</label>  
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="jenis_pajak" id="jenis_pajak" readonly>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">NPWPD</label>  
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="npwd" id="npwd" readonly>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" class="form-control" name="t_cust_account_id" id="t_cust_account_id" readonly>
                        <input type="hidden" class="form-control" name="p_vat_type_id" id="p_vat_type_id" readonly>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Periode Tahun</label>  
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="hidden" class="form-control required" maxlength="8" name="p_year_period_id" id="p_year_period_id" readonly>
                            <input type="text" class="form-control required" name="year_code" id="year_code" readonly>
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" id="btn-lov-year">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Periode</label>  
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="hidden" class="form-control required" maxlength="8" name="p_finance_period_id" id="p_finance_period_id" readonly>
                            <input type="text" class="form-control required" name="finance_period_code" id="finance_period_code" readonly>
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" id="btn-lov-period">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-3">Masa Pajak</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control datepicker1 required" name="start_period" id="start_period" required >  
                    </div>
                    <label class="control-label col-md-1">s/d</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control datepicker1 required" name="end_period" id="end_period" required >
                    </div>
                </div>  

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Total Transaksi</label>  
                    <div class="col-md-3">
                        <input type="text" class="form-control required priceformat" name="total_trans_amount" id="total_trans_amount" required>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" class="form-control" name="t_vat_setllement_id" id="t_vat_setllement_id" readonly>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Total Pajak</label>  
                    <div class="col-md-3">
                        <input type="text" class="form-control required priceformat" name="total_vat_amount" id="total_vat_amount" required>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" class="form-control" name="t_customer_order_id" id="t_customer_order_id" readonly>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Total Penalti</label>  
                    <div class="col-md-3">
                        <input type="text" class="form-control required priceformat" name="total_penalty_amount" id="total_penalty_amount" required>
                    </div>
                </div>
                
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-3">Tanggal jatuh tempo</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control datepicker1 required" name="due_date_2" id="due_date_2" required > 
                    </div>
                </div>  

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Dasar Pengenaan</label>  
                    <div class="col-md-3 col-md-offset-3">
                        <input type="text" class="form-control required priceformat" name="debt_vat_amt" id="debt_vat_amt" required>
                    </div>
                </div> 

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Kompensasi kelebihan dari tahun sebelumnya</label>  
                    <div class="col-md-3 col-md-offset-3">
                        <input type="text" class="form-control required priceformat" name="cr_adjustment" id="cr_adjustment" required>
                    </div>
                </div> 

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Setoran yang dilakukan</label>  
                    <div class="col-md-3">
                        <input type="text" class="form-control required priceformat" name="cr_payment" id="cr_payment" required>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Lain-lain</label>  
                    <div class="col-md-3">
                        <input type="text" class="form-control required priceformat" name="cr_others" id="cr_others" required>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">STP (Pokok)</label>  
                    <div class="col-md-3">
                        <input type="text" class="form-control required priceformat" name="cr_stp" id="cr_stp" required>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Bunga (Pasal 65 ayat(2))</label>  
                    <div class="col-md-3 col-md-offset-3">
                        <input type="text" class="form-control required priceformat" name="db_interest_charge_2" id="db_interest_charge_2" required>
                    </div>
                </div> 

                <div class="space-2"></div>
                <div class="row">   
                    <label class="control-label col-md-3">Kenaikan (Pasal 65 ayat (3))</label>  
                    <div class="col-md-3 col-md-offset-3">
                        <input type="text" class="form-control required priceformat" name="db_increasing_charge_2" id="db_increasing_charge_2" required>
                    </div>
                </div> 

                <div class="space-4"></div>
                <div class="row">
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="button" id="btn-tambahLov" onclick="showLOVskpdkblb()">Tambah</button>
                    </div>
                    <div class="col-md-3 col-md-offset-4" >
                        <button class="btn btn-primary" type="button" id="btn-cetak">CETAK DATA TERPILIH</button>
                    </div> 
                    <div class="col-md-3" style="display: none">
                        <button class="btn btn-primary" type="button" id="btn-insert">Simpan</button>
                    </div> 
                    <div class="col-md-3" style="display: none">
                        <button class="btn btn-primary" type="button" id="btn-update">Simpan</button>
                    </div>  
                    <div class="col-md-3" style="display: none">
                        <button class="btn btn-primary" type="button" id="btn-submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('lov/lov_t_vat_setllement_manual_skpdkb_lb'); ?>
<?php $this->load->view('lov/lov_year_period'); ?>
<?php $this->load->view('lov/lov_finance_period'); ?>
<script type="text/javascript">
	//tanggal 
    $('.datepicker1').datetimepicker({
        format: 'YYYY-MM-DD',
        // defaultDate: new Date()
    });

    $(".priceformat").number( true, 0 , '.',','); /* price number format */
    $(".priceformat").css("text-align", "right");

	function showLOVskpdkblb(id, code) {
	    modal_lov_skpdkblb_show();
	}


    $('#btn-lov-year').on('click',function(){
        modal_year_period_show('p_year_period_id','year_code')
    });


    $('#btn-lov-period').on('click',function(){
        modal_finance_period_show('p_finance_period_id','finance_period_code',$('#p_year_period_id').val())
    });

    $('#btn-cetak').on('click',function(){
        var t_vat_setllement_id        = $('#t_vat_setllement_id').val();

        if(t_vat_setllement_id == "" ){
            swal ( "Oopss" ,  "Harus Terisi Salah Satu!" ,  "error" );
             return;
        }else{
            var url = "<?php echo base_url(); ?>"+"cetak_formulir_skpdkb_lb_pdf/pageCetak?";

            url += "t_vat_setllement_id=" + t_vat_setllement_id;

            openInNewTab(url);
            
        }
    });

    function openInNewTab(url) {
      window.open(url, '_blank', 'location=yes,height=570,width=820,scrollbars=yes,status=yes');
    }


    function toTampil(){
        $.ajax({
                url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/find_ws"; ?>',
                type: "POST",
                dataType: "json",
                data: {
                },
                success: function (data) {
                    console.log(data);
                    //swal({title: "Error!", text: data.message, html: true, type: "error"});
                    
                },
                error: function (xhr, status, error) {
                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                }
            });
    }

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_edit_lb_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_setllement_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                
                {label: 'NPWPD',name: 'npwd',width: 150, align: "left",editable: false},
                
                {label: 'Periode',name: 'finance_period_code',width: 200, align: "left",editable: false},

                {label: 'No. Order',name: 'order_no',width: 200, align: "left",editable: false},
                {label: 'Total Transaksi',name: 'total_trans_amount',width: 200,align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},

                {label: 'Total Pajak ',name: 'total_vat_amount',width: 200, align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},

                // Kebutuhan untuk form
                {label: 'wp_name',name: 'wp_name',width: 200, align: "left",hidden:true},
                {label: 'p_rqst_type_id',name: 'p_rqst_type_id',width: 200, align: "left",hidden:true},
                {label: 'no_kohir',name: 'no_kohir',width: 200, align: "left",hidden:true},
                {label: 'wp_address_name',name: 'wp_address_name',width: 200, align: "left",hidden:true},
                {label: 'jenis_pajak',name: 'jenis_pajak',width: 200, align: "left",hidden:true},
                {label: 't_cust_account_id',name: 't_cust_account_id',width: 200, align: "left",hidden:true},
                {label: 'year_code',name: 'year_code',width: 200, align: "left",hidden:true},
                {label: 'p_vat_type_id',name: 'p_vat_type_id',width: 200, align: "left",hidden:true},
                {label: 'p_year_period_id',name: 'p_year_period_id',width: 200, align: "left",hidden:true},
                {label: 'p_finance_period_id',name: 'p_finance_period_id',width: 200, align: "left",hidden:true},
                {label: 'start_period',name: 'start_period',width: 200, align: "left",hidden:true},
                {label: 'end_period',name: 'end_period',width: 200, align: "left",hidden:true},
                {label: 'total_trans_amount',name: 'total_trans_amount',width: 200, align: "left",hidden:true},
                {label: 'total_vat_amount',name: 'total_vat_amount',width: 200, align: "left",hidden:true},
                {label: 't_customer_order_id',name: 't_customer_order_id',width: 200, align: "left",hidden:true},
                {label: 'total_penalty_amount',name: 'total_penalty_amount',width: 200, align: "left",hidden:true},
                {label: 'due_date_2',name: 'due_date_2',width: 200, align: "left",hidden:true},
                {label: 'debt_vat_amt',name: 'debt_vat_amt',width: 200, align: "left",hidden:true},
                {label: 'cr_adjustment',name: 'cr_adjustment',width: 200, align: "left",hidden:true},
                {label: 'cr_payment',name: 'cr_payment',width: 200, align: "left",hidden:true},
                {label: 'cr_others',name: 'cr_others',width: 200, align: "left",hidden:true},
                {label: 'cr_stp',name: 'cr_stp',width: 200, align: "left",hidden:true},
                {label: 'db_interest_charge_2',name: 'db_interest_charge_2',width: 200, align: "left",hidden:true},
                {label: 'db_increasing_charge_2',name: 'db_increasing_charge_2',width: 200, align: "left",hidden:true}

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
                setform(rowid);
                

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
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."data_master.t_customer_create_uname_controller/read"; ?>',
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
                
                editData : {
                    t_customer_id: function() {
                        return <?php echo $this->input->post('t_customer_id'); ?>;
                    }
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

    function responsive_jqgrid(grid_selector, pager_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }

    function setform(rowid){
        var order_no = $('#grid-table').jqGrid('getCell', rowid, 'order_no');
        var p_rqst_type_id = $('#grid-table').jqGrid('getCell', rowid, 'p_rqst_type_id');
        var no_kohir = $('#grid-table').jqGrid('getCell', rowid, 'no_kohir');
        var wp_name = $('#grid-table').jqGrid('getCell', rowid, 'wp_name');
        var wp_address_name = $('#grid-table').jqGrid('getCell', rowid, 'wp_address_name');

        var jenis_pajak = $('#grid-table').jqGrid('getCell', rowid, 'jenis_pajak');
        var npwd = $('#grid-table').jqGrid('getCell', rowid, 'npwd');
        var t_cust_account_id = $('#grid-table').jqGrid('getCell', rowid, 't_cust_account_id');
        var p_vat_type_id = $('#grid-table').jqGrid('getCell', rowid, 'p_vat_type_id');
        var year_code = $('#grid-table').jqGrid('getCell', rowid, 'year_code');

        var p_year_period_id = $('#grid-table').jqGrid('getCell', rowid, 'p_year_period_id');
        var finance_period_code = $('#grid-table').jqGrid('getCell', rowid, 'finance_period_code');
        var p_finance_period_id = $('#grid-table').jqGrid('getCell', rowid, 'p_finance_period_id');
        var start_period = $('#grid-table').jqGrid('getCell', rowid, 'start_period');
        var end_period = $('#grid-table').jqGrid('getCell', rowid, 'end_period');
        var total_trans_amount = $('#grid-table').jqGrid('getCell', rowid, 'total_trans_amount');

        var t_vat_setllement_id = $('#grid-table').jqGrid('getCell', rowid, 't_vat_setllement_id');
        var total_vat_amount = $('#grid-table').jqGrid('getCell', rowid, 'total_vat_amount');
        var t_customer_order_id = $('#grid-table').jqGrid('getCell', rowid, 't_customer_order_id');
        var total_penalty_amount = $('#grid-table').jqGrid('getCell', rowid, 'total_penalty_amount');
        var due_date_2 = $('#grid-table').jqGrid('getCell', rowid, 'due_date_2');

        var debt_vat_amt = $('#grid-table').jqGrid('getCell', rowid, 'debt_vat_amt');
        var cr_adjustment = $('#grid-table').jqGrid('getCell', rowid, 'cr_adjustment');
        var cr_payment = $('#grid-table').jqGrid('getCell', rowid, 'cr_payment');
        var cr_others = $('#grid-table').jqGrid('getCell', rowid, 'cr_others');
        var cr_stp = $('#grid-table').jqGrid('getCell', rowid, 'cr_stp');
        var db_interest_charge_2 = $('#grid-table').jqGrid('getCell', rowid, 'db_interest_charge_2');
        var db_increasing_charge_2 = $('#grid-table').jqGrid('getCell', rowid, 'db_increasing_charge_2');

        $('#order_no').val(order_no);
        $('#p_rqst_type_id').val(p_rqst_type_id);
        $('#no_kohir').val(no_kohir);
        $('#wp_name').val(wp_name);
        $('#wp_address_name').val(wp_address_name);


        $('#jenis_pajak').val(jenis_pajak);
        $('#npwd').val(npwd);
        $('#t_cust_account_id').val(t_cust_account_id);
        $('#p_vat_type_id').val(p_vat_type_id);
        $('#year_code').val(year_code);

        $('#p_year_period_id').val(p_year_period_id);
        $('#finance_period_code').val(finance_period_code);
        $('#p_finance_period_id').val(p_finance_period_id);
        $('#start_period').val(start_period);
        $('#end_period').val(end_period);
        $('#total_trans_amount').val(total_trans_amount);

        $('#t_vat_setllement_id').val(t_vat_setllement_id);
        $('#total_vat_amount').val(total_vat_amount);
        $('#t_customer_order_id').val(t_customer_order_id);
        $('#total_penalty_amount').val(total_penalty_amount);
        $('#due_date_2').val(due_date_2);

        $('#debt_vat_amt').val(debt_vat_amt);
        $('#cr_adjustment').val(cr_adjustment);
        $('#cr_payment').val(cr_payment);
        $('#cr_others').val(cr_others);
        $('#cr_stp').val(cr_stp);
        $('#db_interest_charge_2').val(db_interest_charge_2);
        $('#db_increasing_charge_2').val(db_increasing_charge_2);
    }

</script>