<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pelaporan Pajak</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-1">
                        <i class="blue"></i>
                        <strong> Pelaporan Pajak </strong>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content no-border">
            <div class="row">
                <div class="col-xs-12">
                   <table id="grid-table"></table>
                   <div id="grid-pager"></div>
                </div>
            </div>
            <hr>
            <div class="col-xs-12">  
                <div class="row">
                    <label class="control-label col-md-3">No. Order</label>
                    <div class="col-md-5">
                        <input id="order_no" readonly type="text" class="FormElement form-control ">
                    </div>  
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">No. Bayar</label>
                    <div class="col-md-5">
                        <input id="payment_key" readonly type="text" class="FormElement form-control ">
                    </div>  
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Jenis Pajak</label>
                    <div class="col-md-5">
                        <input id="jenis_pajak" readonly type="text" class="FormElement form-control ">
                    </div>
                </div>  
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">NPWPD</label>
                    <div class="col-md-5">
                        <input id="npwd" readonly type="text" class="FormElement form-control ">
                    </div>  
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Nama Merk Dagang</label>
                    <div class="col-md-5">
                        <input id="company_brand" readonly type="text" class="FormElement form-control ">
                    </div>  
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Alamat</label>
                    <div class="col-md-9">
                        <input id="brand_address_name" readonly type="text" class="FormElement form-control ">
                    </div>  
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Periode</label>
                    <div class="col-md-5">
                        <input id="finance_period_code" readonly type="text" class="FormElement form-control ">
                    </div>  
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Masa Pajak</label>
                    <div class="col-md-3">
                        <input id="start_date_txt" readonly type="text" class="FormElement form-control ">
                    </div>  
                    <div class="col-md-3">
                        <input id="end_date_txt" readonly type="text" class="FormElement form-control ">
                    </div>
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Total Transaksi</label>
                    <div class="col-md-5">
                        <input style="text-align: right;" id="total_trans_amount" readonly type="text" class="FormElement form-control ">
                    </div>  
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Total Pajak</label>
                    <div class="col-md-5">
                        <input style="text-align: right;" id="total_vat_amount" readonly type="text" class="FormElement form-control ">
                    </div> 
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Tanggal Jatuh Tempo</label>
                    <div class="col-md-5">
                        <input id="due_date" readonly type="text" class="FormElement form-control ">
                    </div> 
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Denda</label>
                    <div class="col-md-5">
                        <input style="text-align: right;" id="total_penalty_amount" readonly type="text" class="FormElement form-control ">
                    </div> 
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Dasar Pengenaan</label>
                    <div class="col-md-5">
                        <input style="text-align: right;" id="debt_vat_amt" readonly type="text" class="FormElement form-control ">
                    </div> 
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Bunga (Pasal 65 ayat(2)) </label>
                    <div class="col-md-5">
                        <input style="text-align: right;" id="db_interest_charge" readonly type="text" class="FormElement form-control ">
                    </div> 
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3">Kenaikan (Pasal 65 ayat (3)) </label>
                    <div class="col-md-5">
                        <input style="text-align: right;" id="db_increasing_charge" readonly type="text" class="FormElement form-control ">
                    </div>    
                </div>

                <div class="space-2"></div>

                <div class="row">
                    <label class="control-label col-md-3"></label>
                    <div class="col-md-5" align="right">
                        <a class="btn btn-danger btn-xs" href="#" onclick="print_no_bayar();"><i class="fa fa-print"></i>Print No. Bayar</a>

                        <button class="btn btn-success btn-xs" type="button" id="btn-close" onclick="tutup()">Tutup</button>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#total_trans_amount").number(true,2,'.',',');
    $("#total_vat_amount").number(true,2,'.',',');
    $("#total_penalty_amount").number(true,2,'.',',');

    $("#debt_vat_amt").number(true,2,'.',',');
    $("#db_interest_charge").number(true,2,'.',',');
    $("#db_increasing_charge").number(true,2,'.',',');
</script>
<script>

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_otobuk_v2_controller/getData"; ?>',
            postData: { 
                CURR_DOC_ID : <?php echo $this->input->post('CURR_DOC_ID'); ?>
            },
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_setllement_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID Jenis Pajak', name: 'p_vat_type_id', width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'NPWPD',name: 'npwd',width: 150, align: "left",editable: true},
                {label: 'Periode',name: 'finance_period_code',width: 150, align: "left",editable: true},
                {label: 'No. Order',name: 'order_no',width: 100, align: "left",editable: true},
                {label: 'Total Transaksi',name: 'total_trans_amount',width: 150, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        size: 30,
                        maxlength:32
                    }
                },
                {label: 'Total Pajak',name: 'total_vat_amount',width: 150, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {name: 'Cetak SPTPD/SKPDKB/SKPDN',width: 200, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['t_vat_setllement_id'];
                        var p_vat_type_id = rowObject['p_vat_type_id'];
                        var url = '<?php echo base_url(); ?>'+'cetak_sptpd_hotel_pdf/pageCetak?t_vat_setllement_id='+val;
                        
                        if(p_vat_type_id==2) {
                            url = '<?php echo base_url(); ?>'+'cetak_sptpd_restoran_pdf/pageCetak?t_vat_setllement_id='+val;
                        }
                        if(p_vat_type_id==3) {
                            url = '<?php echo base_url(); ?>'+'cetak_sptpd_hiburan_pdf/pageCetak?t_vat_setllement_id='+val;
                        }
                        if(p_vat_type_id==4) {
                            url = '<?php echo base_url(); ?>'+'cetak_sptpd_parkir_pdf/pageCetak?t_vat_setllement_id='+val;
                        }
                        if(p_vat_type_id==5) {
                            url = '<?php echo base_url(); ?>'+'cetak_sptpd_restoran_pdf/pageCetak?t_vat_setllement_id='+val;
                        }
                        
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="PopupCenter(\''+url+'\',\'SPTPD\',500,500);"><i class="fa fa-print"></i>Print</a>';

                    }
                },
                {name: 'Cetak STPD',width: 200, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var val = rowObject['t_vat_setllement_id'];
                        var url = '<?php echo base_url(); ?>'+'cetak_formulir_stpd_pdf/pageCetak?t_vat_setllement_id='+val;
                        return '<a class="btn btn-danger btn-xs" href="#" onclick="PopupCenter(\''+url+'\',\'SKPDKB Jabatan\',500,500);"><i class="fa fa-print"></i>Print</a>';

                    }
                }


                
            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: 10,
            rowList: [10,20,50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            onSelectRow: function (rowid) {
                /*do something when selected*/
                var celValue = $('#grid-table').jqGrid('getCell', rowid, 't_vat_setllement_id'); 
                reloadDetail(celValue);
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
            //memanggil controller jqgrid yang ada di controller read
            caption: "Pelaporan Pajak"

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

    function reloadDetail(t_vat_setllement_id) {
        var var_url = "<?php echo WS_JQGRID . "transaksi.t_vat_setllement_ro_otobuk_v2_controller/getDetail/?"; ?>";
        var_url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        var_url += "&t_vat_setllement_id=" + t_vat_setllement_id;
        
        $.getJSON(var_url, function( items ) {
            $('#order_no').val(items.rows.order_no);
            $('#payment_key').val(items.rows.payment_key);
            $('#npwd').val(items.rows.npwd);
            $('#jenis_pajak').val(items.rows.jenis_pajak);
            $('#company_brand').val(items.rows.company_brand);
            $('#brand_address_name').val(items.rows.brand_address_name+" "+items.rows.brand_address_no);

            $('#finance_period_code').val(items.rows.finance_period_code);
            $('#start_date_txt').val(items.rows.start_date_txt);
            $('#end_date_txt').val(items.rows.end_date_txt);
            $('#total_trans_amount').val(items.rows.total_trans_amount);
            $('#total_vat_amount').val(items.rows.total_vat_amount);

            $('#due_date').val(items.rows.due_date);
            $('#total_penalty_amount').val(items.rows.total_penalty_amount);
            $('#debt_vat_amt').val(items.rows.debt_vat_amt);
            $('#db_interest_charge').val(items.rows.db_interest_charge);
            $('#db_increasing_charge').val(items.rows.db_increasing_charge);
        })

    }

    function print_no_bayar() {

        var val = $('#payment_key').val();
        var url = '<?php echo base_url(); ?>'+'cetak_no_bayar/pageCetak?no_bayar='+val;
        PopupCenter(url,'SKPDKB Nihil',500,500);
    }

    function tutup() {
        loadContentWithParams("transaksi.t_vat_setllement_manual_v2", {});
    }
    

</script>