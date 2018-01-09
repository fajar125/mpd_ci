<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Periode Bulanan</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-1">
                        <i class="blue"></i>
                        <strong> TAHUN </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-2">
                        <i class="blue"></i>
                        <strong> TARGET PAJAK </strong>
                    </a>
                </li>
                <li class="active">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-3">
                        <i class="blue"></i>
                        <strong> POTENSI BULANAN </strong>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content no-border">
            <div class="row">
                <div class="col-md-12">
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$("#tab-1").on("click", function(event) {
    event.stopPropagation();
    loadContentWithParams("transaksi.t_year_period_target",{});
});

$("#tab-2").on("click", function(event) {
    event.stopPropagation();
    loadContentWithParams("transaksi.t_revenue_target", { //model yang ketiga
        p_year_period_id : <?php echo $this->input->post('p_year_period_id');?>,
        year_code : <?php echo $this->input->post('year_code');?>
    });
});
</script>

<?php $this->load->view('lov/lov_finance_period'); ?>
<?php $this->load->view('lov/lov_vat_type_dtl'); ?>

<script>

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_revenue_target_dtl_controller/crud"; ?>',
            datatype: "json",
            postData: {t_revenue_target_id : <?php echo $this->input->post('t_revenue_target_id');?>},
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_revenue_target_dtl_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Kode',name: 'target_code',width: 150, align: "left", editable: true, editrules: {required: true}},
                {label: 'Periode',name: 'periode',width: 150, align: "left",editable: false},
                {label: 'Periode',
                    name: 'p_finance_period_id',
                    width: 220,
                    sortable: true,
                    editable: true,
                    hidden: true,
                    editrules: {edithidden: true, required:true},
                    edittype: 'custom',
                    editoptions: {
                        "custom_element":function( value  , options) {
                            var elm = $('<span></span>');

                            // give the editor time to initialize
                            setTimeout( function() {
                                elm.append('<input id="form_finance_id" type="text" style="display:none;" >'+
                                        '<input id="form_finance_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Periode" required=true>'+
                                        '<button class="btn btn-success" type="button" onclick="showLOVPeriod(\'form_finance_id\',\'form_finance_code\')">'+
                                        '   <span class="fa fa-search bigger-110"></span>'+
                                        '</button>');
                                $("#form_finance_id").val(value);
                                elm.parent().removeClass('jqgrid-required');
                            }, 100);

                            return elm;
                        },
                        "custom_value":function( element, oper, gridval) {

                            if(oper === 'get') {
                                return $("#form_finance_id").val();
                            } else if( oper === 'set') {
                                $("#form_finance_id").val(gridval);
                                var gridId = this.id;
                                // give the editor time to set display
                                setTimeout(function(){
                                    var selectedRowId = $("#"+gridId).jqGrid ('getGridParam', 'selrow');
                                    if(selectedRowId != null) {
                                        var code_display = $("#"+gridId).jqGrid('getCell', selectedRowId, 'periode');
                                        $("#form_finance_code").val( code_display );
                                    }
                                },100);
                            }
                        }
                    }
                },
                {label: 'Detail Jenis Pajak',name: 'vat_code',width: 150, align: "left",editable: false},
                {label: 'Detail Jenis Pajak',
                    name: 'p_vat_type_dtl_id',
                    width: 220,
                    sortable: true,
                    editable: true,
                    hidden: true,
                    editrules: {edithidden: true, required:true},
                    edittype: 'custom',
                    editoptions: {
                        "custom_element":function( value  , options) {
                            var elm = $('<span></span>');

                            // give the editor time to initialize
                            setTimeout( function() {
                                elm.append('<input id="form_vat_type_dtl_id" type="text" style="display:none;" >'+
                                        '<input id="form_vat_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Detail Jenis Pajak" required=true>'+
                                        '<button class="btn btn-success" type="button" onclick="showLOVVatType(\'form_vat_type_dtl_id\',\'form_vat_code\')">'+
                                        '   <span class="fa fa-search bigger-110"></span>'+
                                        '</button>');
                                $("#form_vat_type_dtl_id").val(value);
                                elm.parent().removeClass('jqgrid-required');
                            }, 100);

                            return elm;
                        },
                        "custom_value":function( element, oper, gridval) {

                            if(oper === 'get') {
                                return $("#form_vat_type_dtl_id").val();
                            } else if( oper === 'set') {
                                $("#form_vat_type_dtl_id").val(gridval);
                                var gridId = this.id;
                                // give the editor time to set display
                                setTimeout(function(){
                                    var selectedRowId = $("#"+gridId).jqGrid ('getGridParam', 'selrow');
                                    if(selectedRowId != null) {
                                        var code_display = $("#"+gridId).jqGrid('getCell', selectedRowId, 'vat_code');
                                        $("#form_vat_code").val( code_display );
                                    }
                                },100);
                            }
                        }
                    }
                },
                {label: 'Jumlah',name: 'target_amt',width: 200, align: "left", editable: true,editrules: {required: true},
                    editoptions:{
                        dataInit: function(element) {
                            $(element).keypress(function(e){
                                 if (e.which != 8 && e.which != 0 && (e.which < 44 || e.which > 57)) {
                                    return false;
                                 }
                            });
                        }
                    },
                    formatter:'currency', formatoptions: {prefix:"", decimalSeparator:",", thousandsSeparator:'.', decimalPlaces: 2}
                },
                {label: 'Deskripsi',name: 'description',width: 200, align: "left",editable: true,
                    edittype:'textarea',
                    editoptions: {
                        rows: 3,
                        cols:30
                    }
                },
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

            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."transaksi.t_revenue_target_dtl_controller/crud"; ?>',
            caption: "Daftar Periode Bulanan || Target Pajak : "+'<?php echo $this->input->post('rev_target_code');?>'

        });

        jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
            {   //navbar options
                edit: true,
                editicon: 'fa fa-pencil blue bigger-120',
                add: true,
                addicon: 'fa fa-plus-circle purple bigger-120',
                del: true,
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
                    t_revenue_target_id: function() {
                        return <?php echo $this->input->post('t_revenue_target_id'); ?>;
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
                    setTimeout(function() {
                        clearInputVatType();
                        clearInputPeriod();
                    },100);
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
                    clearInputVatType();
                    clearInputPeriod();

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

<script type="text/javascript">

    function showLOVVatType(id,code){
        var parent = <?php echo $this->input->post('p_vat_type_id');?>;

        if (parent == 0 || parent == '' || parent == undefined || parent == false) {
            swal('Peringatan', 'Tidak ada Pajak', 'error');
            return;
        } else{
            modal_lov_vat_dtl_show(id, code, parent);
        }
    }

    function showLOVPeriod(id, code){
        var parent = <?php echo $this->input->post('p_year_period_id');?>;

        if (parent == 0 || parent == '' || parent == undefined || parent == false) {
            swal('Peringatan', 'Tidak ada Tahun', 'error');
            return;
        } else{
            modal_finance_period_show(id, code, parent);
        }
        
    }

    function clearInputVatType() {
        $('#form_vat_type_dtl_id').val('');
        $('#form_vat_code').val('');
    }
    function clearInputPeriod() {
        $('#form_finance_id').val('');
        $('#form_finance_code').val('');
    }
</script>