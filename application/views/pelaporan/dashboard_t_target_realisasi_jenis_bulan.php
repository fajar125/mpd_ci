<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Sistem Manajemen Pajak Daerah</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <?php $this->load->view('template/scripts');?>
        <?php $this->load->view('template/styles');?>
        <!-- for electron.io shakes -->
        <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    </head>

   <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md page-header-fixed page-sidebar-fixed">

<!-- breadcrumb -->

<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="tabbable">
            <ul class="nav nav-tabs">
               <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-1">
                        <i class="blue"></i>
                        <strong> Target VS Realisasi </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-2">
                        <i class="blue"></i>
                        <strong> Per Bidang Pajak </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-3">
                        <i class="blue"></i>
                        <strong> Per Jenis Pajak </strong>
                    </a>
                </li>
                <li class="active">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-4">
                        <i class="blue"></i>
                        <strong> Bulanan Per Jenis Pajak </strong>
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
            <div class="row">
                <div class="col-xs-12">
                   <table id="grid-table-detail"></table>
                   <div id="grid-pager-detail"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12" style="display: none;">
                   <table id="grid-table-tmp"></table>
                   <div id="grid-pager-tmp"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var urlJS = "<?php echo base_url(); ?>assets/js/highcharts.js";

    if (!isScriptAlreadyIncluded(urlJS)){
      // DOM: Create the script element
        var jsElm = document.createElement("script");
        // set the type attribute
        jsElm.type = "application/javascript";
        // make the script element load file
        jsElm.src = urlJS;
        // finally insert the element to the body element in order to load the script
        document.body.appendChild(jsElm);
    }

    function isScriptAlreadyIncluded(src){
        var scripts = document.getElementsByTagName("script");
        for(var i = 0; i < scripts.length; i++) 
           if(scripts[i].getAttribute('src') == src) return true;
        return false;
    }
</script>


<script>
$("#tab-1").on("click", function(event) {
    event.stopPropagation();
     window.location.href = "<?php echo base_url();?>"+"dashboard_target_vs_realisasi/index?mode=target";
});

$("#tab-3").on("click", function(event) {
    event.stopPropagation();
    var grid = $('#grid-table-tmp');
    
   
    //vcode = grid.jqGrid ('getCell', p_vat_group_id, 'group_code');
    
    //code = grid.jqGrid ('getCell', p_vat_group_id, 'year_code');
     p_finance_period_id = grid.jqGrid ('getGridParam', 'selrow');//pake finenace period
     p_year_period_id = "<?php echo $this->input->get('p_year_period_id'); ?>";
     p_vat_group_id = "<?php echo $this->input->get('p_vat_group_id'); ?>";
     p_vat_type_id = "<?php echo $this->input->get('p_vat_type_id'); ?>";
     

    window.location.href = "<?php echo base_url();?>"+"dashboard_target_vs_realisasi/index?p_year_period_id="+p_year_period_id+"&mode=jenis"+"&p_vat_group_id="+p_vat_group_id;
});         

$("#tab-2").on("click", function(event) {

    event.stopPropagation();
    var grid = $('#grid-table');
    p_finance_period_id = grid.jqGrid ('getGridParam', 'selrow');
    code = "<?php echo $this->input->get('code'); ?>";
    p_year_period_id = "<?php echo $this->input->get('p_year_period_id'); ?>";

    window.location.href = "<?php echo base_url();?>"+"dashboard_target_vs_realisasi/index?p_year_period_id="+p_year_period_id+"&code="+code+"&mode=bidang";
});

</script>
<script>

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."pelaporan.t_target_realisasi_controller/readPerBulan"; ?>',
            postData: { 
                p_year_period_id : "<?php echo $this->input->get('p_year_period_id'); ?>",
                p_vat_group_id : <?php echo $this->input->get('p_vat_group_id'); ?>,
                p_vat_type_id : <?php echo $this->input->get('p_vat_type_id'); ?>},
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID Tahun', name: 'p_year_period_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID Bulan', name: 'p_finance_period_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID Type', name: 'p_vat_type_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Bulan',name: 'bulan',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Target',name: 'target_amount',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Pokok',name: 'realisasi_amt',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Denda Pokok',name: 'denda_pokok',width: 200, align: "right",editable: true, formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        rows: 2,
                        cols:50
                    }
                },
                {label: 'Denda Piutang',name: 'denda_piutang',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Piutang',name: 'debt_amt',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        rows: 2,
                        cols:50
                    }
                },
                {label: 'Total',name: 'total',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        rows: 2,
                        cols:50
                    }
                },
                {label: 'Persentase',name: 'persentase',width: 150, align: "right",editable: true,
                    editoptions: {
                        rows: 2,
                        cols:50
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
                var celValue = $('#grid-table').jqGrid('getCell', rowid, 'p_finance_period_id');
                var celCode = $('#grid-table').jqGrid('getCell', rowid, 'bulan');
                var yearId = $('#grid-table').jqGrid('getCell', rowid, 'p_year_period_id');
                var typeId = $('#grid-table').jqGrid('getCell', rowid, 'p_vat_type_id');

                var grid_detail = $("#grid-table-detail");
                if (rowid != null) {
                    grid_detail.jqGrid('setGridParam', {
                        url: '<?php echo WS_JQGRID."pelaporan.t_target_realisasi_controller/readPerBulanDetail"; ?>',
                        postData: {row_id: rowid,
                                    p_finance_period_id: celValue,
                                    p_year_period_id: yearId,
                                    p_vat_type_id: typeId
                                }
                    });
                    var strCaption = 'Daftar Ayat :: ' + celCode;
                    grid_detail.jqGrid('setCaption', strCaption);
                    $("#grid-table-detail").trigger("reloadGrid");
                    $("#detail_placeholder").show();

                    responsive_jqgrid('#grid-table-detail', '#grid-pager-detail');
                }

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
            //memanggil controller jqgrid yang ada di controller readPerBidang
            editurl: '<?php echo WS_JQGRID."pelaporan.t_target_realisasi_controller/readPerBulan"; ?>',
            caption: "Daftar Target VS Realisasi Per Bidang Pajak"

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
                    p_year_period_id: function() {
                        return "<?php echo $this->input->get('p_year_period_id'); ?>";
                    },
                    p_vat_group_id: function() {
                        return <?php echo $this->input->get('p_vat_group_id'); ?>;
                    },
                    p_vat_type_id: function() {
                        return <?php echo $this->input->get('p_vat_type_id'); ?>;
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

    
    $("#grid-table-detail").jqGrid({
        url: '<?php echo WS_JQGRID."pelaporan.t_target_realisasi_controller/readPerBulanDetail"; ?>',
        datatype: "json",
        postData: { 
                csrf_tibs_token : "<?php echo $this->security->get_csrf_hash(); ?>", //ngaruh ga?
                p_year_period_id : "<?php echo $this->input->get('p_year_period_id'); ?>",
                p_finance_period_id : "<?php echo $this->input->get('p_finance_period_id'); ?>",
                p_vat_type_id : "<?php echo $this->input->get('p_vat_type_id'); ?>"},
        mtype: "POST",
        colModel: [
                {label: 'ID Tahun', name: 'p_year_period_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID Bulan', name: 'p_finance_period_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID Type', name: 'p_vat_type_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Ayat',name: 'ayat',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Target',name: 'target_amount',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Pokok',name: 'realisasi_amt',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Piutang',name: 'debt_amt',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        rows: 2,
                        cols:50
                    }
                },
                {label: 'Total',name: 'total',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        rows: 2,
                        cols:50
                    }
                },
                {label: 'Persentase',name: 'persentase',width: 150, align: "right",editable: true,
                    editoptions: {
                        rows: 2,
                        cols:50
                    }
                }

        ],
        height: '100%',
        width:500,
        autowidth: true,
        viewrecords: true,
        rowNum: 10,
        rowList: [10,20,50],
        rownumbers: true, // show row numbers
        rownumWidth: 35, // the width of the row numbers columns
        altRows: true,
        shrinkToFit: true,
        onSelectRow: function (rowid) {
            /*do something when selected*/

        },
        sortorder:'',
        pager: '#grid-pager-detail',
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
        editurl: '<?php echo WS_JQGRID."pelaporan.t_target_realisasi_controller/readPerBulanDetail"; ?>',
        caption: "Daftar Ayat"

    });

    $('#grid-table-detail').jqGrid('navGrid', '#grid-pager-detail',
        {   //navbar options
            edit: false,
            editicon: 'fa fa-pencil blue bigger-110',
            add: false,
            addicon: 'fa fa-plus-circle purple bigger-110',
            del: false,
            delicon: 'fa fa-trash-o red bigger-110',
            search: true,
            searchicon: 'fa fa-search orange bigger-110',
            refresh: true,
            afterRefresh: function () {
                // some code here
            },

            refreshicon: 'fa fa-refresh green bigger-110',
            view: false,
            viewicon: 'fa fa-search-plus grey bigger-110'
        },

        {
            editData: {
                role_id: function() {
                    var selRowId =  $("#grid-table").jqGrid ('getGridParam', 'selrow');
                    var role_id = $("#grid-table").jqGrid('getCell', selRowId, 'p_finance_period_id');
                    return role_id;
                }
            },
            // options for the Edit Dialog
            serializeEditData: serializeJSON,
            closeAfterEdit: true,
            closeOnEscape:true,
            recreateForm: true,
            viewPagerButtons: true,
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
                var response = $.parseJSON(response.responseText);
                if(response.success == false) {
                    return [false,response.message,response.responseText];
                }
                return [true,"",response.responseText];
            }

        },
        {
            //new record form
            serializeEditData: serializeJSON,
            closeAfterAdd: true,
            clearAfterAdd : true,
            closeOnEscape:true,
            recreateForm: true,
            width: 'auto',
            errorTextFormat: function (data) {
                return 'Error: ' + data.responseText
            },
            viewPagerButtons: false,
            beforeShowForm: function (e, form) {
                var form = $(e[0]);
                style_edit_form(form);
            },
            afterShowForm: function(form) {
                form.closest('.ui-jqdialog').center();
            },
            afterSubmit:function(response,postdata) {
                var response = $.parseJSON(response.responseText);
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
                var response = $.parseJSON(response.responseText);
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


    $("#grid-table-tmp").jqGrid({
        url: '<?php echo WS_JQGRID."pelaporan.t_target_realisasi_controller/readPerBulanTmp"; ?>',
        datatype: "json",
        postData: { 
                csrf_tibs_token : "<?php echo $this->security->get_csrf_hash(); ?>", //ngaruh ga?
                p_year_period_id : <?php echo $this->input->get('p_year_period_id'); ?>,
                t_revenue_target_id : <?php echo $this->input->get('t_revenue_target_id'); ?>},
        mtype: "POST",
        colModel: [
                {label: 'ID Tahun', name: 'p_year_period_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID Bulan', name: 'p_finance_period_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID Type', name: 't_revenue_target_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID Type', name: 'p_vat_group_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
               
                {label: 'Target',name: 'target_amount',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Pokok',name: 'realisasi_amt',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                {label: 'Piutang',name: 'debt_amt',width: 200, align: "right",editable: true,
                    formatter: 'number', formatoptions: { decimalPlaces: 2 },
                    editoptions: {
                        rows: 2,
                        cols:50
                    }
                }

        ],
        height: '100%',
        width:500,
        autowidth: true,
        viewrecords: true,
        rowNum: 10,
        rowList: [10,20,50],
        rownumbers: true, // show row numbers
        rownumWidth: 35, // the width of the row numbers columns
        altRows: true,
        shrinkToFit: true,
        onSelectRow: function (rowid) {
            /*do something when selected*/

        }
    });



    function responsive_jqgrid(grid_selector, pager_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );

    }

</script>


</body>
</html>