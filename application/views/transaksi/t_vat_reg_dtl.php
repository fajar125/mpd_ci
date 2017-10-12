<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Regional</span>
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
                        <strong> PERMINTAAN PELANGGAN </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-2">
                        <i class="blue"></i>
                        <strong> FORMULIR PENDAFTARAN </strong>
                    </a>
                </li>
                <li class="active">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-3">
                        <i class="blue"></i>
                        <strong> DATA IZIN DAN POTENSI </strong>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content no-border">
            <div class="row" id="grid-tbl-letter">
                <div class="col-md-12">
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="row" id="grid-tbl-employee">
                <div class="col-md-12">
                    <table id="grid-table1"></table>
                    <div id="grid-pager1"></div>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="row" id="grid-tbl-restaurant">
                <div class="col-md-12">
                    <table id="grid-table2"></table>
                    <div id="grid-pager2"></div>
                </div>
            </div>
            <div class="row" id="grid-tbl-hotel">
                <div class="col-md-12">
                    <table id="grid-table3"></table>
                    <div id="grid-pager3"></div>
                </div>
            </div>
            <div class="row" id="grid-tbl-hiburan">
                <div class="col-md-12">
                    <table id="grid-table4"></table>
                    <div id="grid-pager4"></div>
                </div>
            </div>
            <div class="row" id="grid-tbl-parkir">
                <div class="col-md-12">
                    <table id="grid-table5"></table>
                    <div id="grid-pager5"></div>
                </div>
            </div>
            <div class="row" id="grid-tbl-ppj">
                <div class="col-md-12">
                    <table id="grid-table6"></table>
                    <div id="grid-pager6"></div>
                </div>
            </div>
            <div class="row" id="grid-tbl-ppj-npl">
                <div class="col-md-12">
                    <table id="grid-table7"></table>
                    <div id="grid-pager7"></div>
                </div>
            </div>
            <div class="row" id="grid-tbl-hotel-srvc">
                <div class="col-md-12">
                    <table id="grid-table8"></table>
                    <div id="grid-pager8"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var reqId =<?php echo $_POST['p_rqst_type_id'];?>;
    //alert(reqId);
    $("#grid-tbl-letter").show();
    $("#grid-tbl-employee").show();
    $("#grid-tbl-ppj").hide();
    $("#grid-tbl-ppj-npl").hide();
    $("#grid-tbl-hotel").hide();
    $("#grid-tbl-hiburan").hide();
    $("#grid-tbl-parkir").hide();
    $("#grid-tbl-hotel-srvc").hide();
    $("#grid-tbl-restaurant").hide();

    if (reqId==1){
        $("#grid-tbl-letter").show();
        $("#grid-tbl-employee").show();
        $("#grid-tbl-hotel-srvc").show();
        $("#grid-tbl-hotel").show();
        $("#grid-tbl-parkir").hide();
        $("#grid-tbl-restaurant").hide();
        $("#grid-tbl-hiburan").hide();
        $("#grid-tbl-ppj").hide();
        $("#grid-tbl-ppj-npl").hide();
    }  if (reqId==2){
        $("#grid-tbl-letter").show();
        $("#grid-tbl-employee").show();
        $("#grid-tbl-restaurant").show();
        $("#grid-tbl-hotel").hide();
        $("#grid-tbl-hiburan").hide();
        $("#grid-tbl-parkir").hide();
        $("#grid-tbl-ppj").hide();
        $("#grid-tbl-ppj-npl").hide();
        $("#grid-tbl-hotel-srvc").hide();
    }  if (reqId==3){
        $("#grid-tbl-letter").show();
        $("#grid-tbl-employee").show();
        $("#grid-tbl-hiburan").show();
        $("#grid-tbl-hotel").hide();
        $("#grid-tbl-parkir").hide();
        $("#grid-tbl-ppj").hide();
        $("#grid-tbl-ppj-npl").hide();
        $("#grid-tbl-hotel-srvc").hide();
        $("#grid-tbl-restaurant").hide();      
    }  
    if (reqId==4){
        $("#grid-tbl-letter").show();
        $("#grid-tbl-employee").show();
        $("#grid-tbl-parkir").show();
        $("#grid-tbl-hotel").hide();
        $("#grid-tbl-hiburan").hide();
        $("#grid-tbl-ppj").hide();
        $("#grid-tbl-ppj-npl").hide();
        $("#grid-tbl-hotel-srvc").hide();
        $("#grid-tbl-restaurant").hide();
    }  
    if (reqId==5){
        $("#grid-tbl-letter").show();
        $("#grid-tbl-employee").show();
        $("#grid-tbl-ppj").show();
        $("#grid-tbl-ppj-npl").show();
        $("#grid-tbl-hotel").hide();
        $("#grid-tbl-hiburan").hide();
        $("#grid-tbl-parkir").hide();
        $("#grid-tbl-hotel-srvc").hide();
        $("#grid-tbl-restaurant").hide();
    }
</script>

<script>
$("#tab-1").on("click", function(event) {
    event.stopPropagation();
    loadContentWithParams("transaksi.t_customer_order",{});
});

$("#tab-2").on("click", function(event) {

    event.stopPropagation();
    var grid = $('#grid-table');
    t_customer_order_id = <?php echo $_POST['t_customer_order_id'];?>;
    t_vat_registration_id = <?php echo $_POST['t_vat_registration_id'];?> ;
    p_rqst_type_id = <?php echo $_POST['p_rqst_type_id'];?> ;
    order_no = <?php echo $_POST['order_no'];?> ;
    
    if(t_customer_order_id == null) {
        swal('Informasi','Silahkan pilih salah satu Permintaan Pelanggan','info');
        return false;
    }


    loadContentWithParams("transaksi.t_vat_registration", {
        t_customer_order_id: t_customer_order_id,
        order_no:order_no,
        p_rqst_type_id:p_rqst_type_id,
        t_vat_registration_id:t_vat_registration_id
    });
});

function cetak(){
    var t_customer_order_id = <?php echo $_POST['t_customer_order_id'];?>;
} 




</script>

<script>
    $(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        $("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_controller/crud"; ?>',
            datatype: "json",
            postData:{t_vat_registration_id:<?php echo $this->input->post('t_vat_registration_id'); ?>},
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_license_letter_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'ID', name: 'p_license_type_id', width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Jenis Surat',name: 'license_type_code',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:255,
                        readonly:true
                    },
                    editrules: {required: false}
                },
                {label: 'No. Surat',name: 'license_no',width: 250, align: "left",editable: false},
                {label: 'Berlaku Dari ',name: 'valid_from',width: 150, align: "left",editable: false},
                {label: 'Berlaku Sampai',name: 'valid_to',width: 250, align: "left",editable: false},
                {label: 'Deskripsi',name: 'description',width: 150, align: "left",editable: true, edittype: 'textarea',
                    editoptions: {
                        size: 50,
                        maxlength:255
                    },
                    editrules: {required: false}
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
            //memanggil controller jqgrid yang ada di controller read
            editurl: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_controller/crud"; ?>',
            caption: "Daftar Surat Izin yang Dimiliki"

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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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
    $(function($) {
        var grid_selector = "#grid-table1";
        var pager_selector = "#grid-pager1";

        $("#grid-table1").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_reg_employee_controller/crud"; ?>',
            datatype: "json",
            postData:{t_vat_registration_id:<?php echo $this->input->post('t_vat_registration_id'); ?>},
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_reg_employee_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'Jabatan',name: 'jabatan',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:255,
                        readonly:true
                    },
                    editrules: {required: false}
                },
                {label: 'Jumlah Pegawai',name: 'employee_qty',width: 250, align: "left",editable: false},
                {label: 'Gaji Pegawai ',name: 'employee_salary',width: 150, align: "left",editable: false},
                {label: 'Deskripsi',name: 'description',width: 150, align: "left",editable: true, edittype: 'textarea',
                    editoptions: {
                        size: 50,
                        maxlength:255
                    },
                    editrules: {required: false}
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

            },
            sortorder:'',
            pager: '#grid-pager1',
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
            //memanggil controller jqgrid yang ada di controller read
            editurl: '<?php echo WS_JQGRID."transaksi.t_vat_reg_employee_controller/crud"; ?>',
            caption: "Daftar Potensi Pegawai"

        });

        jQuery('#grid-table1').jqGrid('navGrid', '#grid-pager1',
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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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
    $(function($) {
        var grid_selector = "#grid-table2";
        var pager_selector = "#grid-pager2";

        $("#grid-table2").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_restaurant_controller/crud"; ?>',
            datatype: "json",
            postData:{t_vat_registration_id:<?php echo $this->input->post('t_vat_registration_id'); ?>},
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_reg_dtl_restaurant_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'Jenis Pelayanan',name: 'service_type_desc',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:255,
                        readonly:true
                    },
                    editrules: {required: false}
                },
                {label: 'Jumlah Kursi',name: 'seat_qty',width: 250, align: "left",editable: false},
                {label: 'Jumlah Meja ',name: 'table_qty',width: 150, align: "left",editable: false},
                {label: 'Daya Tampung ',name: 'max_service_qty',width: 150, align: "left",editable: false},
                {label: 'Jumlah pengunjung rata-rata per Bulan',name: 'avg_subscription',width: 150, align: "left",editable: true, edittype: 'textarea',
                    editoptions: {
                        size: 50,
                        maxlength:255
                    },
                    editrules: {required: false}
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

            },
            sortorder:'',
            pager: '#grid-pager2',
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
            //memanggil controller jqgrid yang ada di controller read
            editurl: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_restaurant_controller/crud"; ?>',
            caption: "Daftar Pajak Restoran"

        });

        jQuery('#grid-table2').jqGrid('navGrid', '#grid-pager2',
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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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
    $(function($) {
        var grid_selector = "#grid-table3";
        var pager_selector = "#grid-pager3";

        $("#grid-table3").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_hotel_controller/crud"; ?>',
            datatype: "json",
            postData:{t_vat_registration_id:<?php echo $this->input->post('t_vat_registration_id'); ?>},
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_reg_dtl_hotel_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'Golongan Kamar',name: 'room_type_code',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:255,
                        readonly:true
                    },
                    editrules: {required: false}
                },
                {label: 'Jumlah Kamar',name: 'room_qty',width: 250, align: "left",editable: false},
                {label: 'Okupansi',name: 'service_qty',width: 150, align: "left",editable: false},
                {label: 'Tarif Weekend',name: 'service_charge_wd',width: 150, align: "left",editable: false},
                {label: 'Tarif non Weekend',name: 'service_charge_we',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 50,
                        maxlength:255
                    },
                    editrules: {required: false}
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

            },
            sortorder:'',
            pager: '#grid-pager3',
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
            //memanggil controller jqgrid yang ada di controller read
            editurl: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_hotel_controller/crud"; ?>',
            caption: "Daftar Pajak Hotel"

        });

        jQuery('#grid-table3').jqGrid('navGrid', '#grid-pager3',
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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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
    $(function($) {
        var grid_selector = "#grid-table4";
        var pager_selector = "#grid-pager4";

        $("#grid-table4").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_entertaintment_controller/crud"; ?>',
            postData:{t_vat_registration_id:<?php echo $this->input->post('t_vat_registration_id'); ?>},
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_reg_dtl_entertaintment_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'Jenis Hiburan',name: 'entertainment_desc',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:255,
                        readonly:true
                    },
                    editrules: {required: false}
                },
                {label: 'Tarif Weekend',name: 'service_charge_wd',width: 250, align: "left",editable: false},
                {label: 'Tarif Non Weekend ',name: 'service_charge_we',width: 150, align: "left",editable: false},
                {label: 'Jumlah Meja / Kursi',name: 'seat_qty',width: 250, align: "left",editable: false},
                {label: 'Jumlah Ruangan',name: 'room_qty',width: 150, align: "left",editable: true, edittype: 'textarea',
                    editoptions: {
                        size: 50,
                        maxlength:255
                    },
                    editrules: {required: false}
                },
                {label: 'Jumlah PL',name: 'clerk_qty',width: 250, align: "left",editable: false},
                {label: 'Booking Jam',name: 'booking_hour',width: 150, align: "left",editable: false},
                {label: 'F & B',name: 'f_and_b',width: 250, align: "left",editable: false},
                {label: 'Porsi/Orang',name: 'portion_person',width: 250, align: "left",editable: false}
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
            pager: '#grid-pager4',
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
            //memanggil controller jqgrid yang ada di controller read
            editurl: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_entertaintment_controller/read"; ?>',
            caption: "Daftar Potensi Pajak Hiburan"

        });

        jQuery('#grid-table4').jqGrid('navGrid', '#grid-pager',
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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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
    $(function($) {
        var grid_selector = "#grid-table5";
        var pager_selector = "#grid-pager5";

        $("#grid-table5").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_parking_controller/crud"; ?>',
            datatype: "json",
            postData:{t_vat_registration_id:<?php echo $this->input->post('t_vat_registration_id'); ?>},
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_reg_dtl_parking_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'Klasifikasi Tempat Parkir',name: 'classification_desc',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:255,
                        readonly:true
                    },
                    editrules: {required: false}
                },
                {label: 'Luas Lahan Parkir',name: 'parking_size',width: 250, align: "left",editable: false},
                {label: 'Daya Tampung Kendaraan Bermotor',name: 'max_load_qty',width: 150, align: "left",editable: false},
                {label: 'Frekuensi Kendaraan Bermotor',name: 'avg_subscription_qty',width: 150, align: "left",editable: true}
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
            pager: '#grid-pager5',
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
            //memanggil controller jqgrid yang ada di controller read
            editurl: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_parking_controller/read"; ?>',
            caption: "Daftar Potensi Pajak Parkir"

        });

        jQuery('#grid-table5').jqGrid('navGrid', '#grid-pager5',
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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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
    $(function($) {
        var grid_selector = "#grid-table6";
        var pager_selector = "#grid-pager6";

        $("#grid-table6").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_ppj_controller/crud"; ?>',
            datatype: "json",
            postData:{t_vat_registration_id:<?php echo $this->input->post('t_vat_registration_id'); ?>},
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_reg_dtl_ppj_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'Golongan',name: 'pwr_classification_desc',width: 150, align: "left",editable: true,
                    editoptions: {
                        size: 30,
                        maxlength:255,
                        readonly:true
                    },
                    editrules: {required: false}
                },
                {label: 'Kapasitas Daya',name: 'power_capacity',width: 250, align: "left",editable: false},
                {label: 'Harga Satuan',name: 'service_charge',width: 150, align: "left",editable: false},
                {label: 'Faktor Daya',name: 'power_factor',width: 250, align: "left",editable: false},
                {label: 'Deskripsi',name: 'description',width: 150, align: "left",editable: true, edittype: 'textarea',
                    editoptions: {
                        size: 50,
                        maxlength:255
                    },
                    editrules: {required: false}
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

            },
            sortorder:'',
            pager: '#grid-pager6',
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
            //memanggil controller jqgrid yang ada di controller read
            editurl: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_ppj_controller/crud"; ?>',
            caption: "Daftar Potensi Pajak Non PPJ PLN"

        });

        jQuery('#grid-table6').jqGrid('navGrid', '#grid-pager6',
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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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
    $(function($) {
        var grid_selector = "#grid-table7";
        var pager_selector = "#grid-pager7";

        $("#grid-table7").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_ppj_non_pln_controller/crud"; ?>',
            datatype: "json",
            postData:{t_vat_registration_id:<?php echo $this->input->post('t_vat_registration_id'); ?>},
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_reg_dtl_ppj_npl_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'Kapasitas Daya',name: 'power_capacity',width: 250, align: "left",editable: false},
                {label: 'Jumlah Pelanggan',name: 'owner_qty',width: 150, align: "left",editable: false},
                {label: 'Deskripsi',name: 'description',width: 150, align: "left",editable: true, edittype: 'textarea',
                    editoptions: {
                        size: 50,
                        maxlength:255
                    },
                    editrules: {required: false}
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

            },
            sortorder:'',
            pager: '#grid-pager7',
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
            //memanggil controller jqgrid yang ada di controller read
            editurl: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_ppj_non_pln_controller/crud"; ?>',
            caption: "Daftar Potensi Pajak PPJ PLN"

        });

        jQuery('#grid-table7').jqGrid('navGrid', '#grid-pager7',
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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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
    $(function($) {
        var grid_selector = "#grid-table8";
        var pager_selector = "#grid-pager8";

        $("#grid-table8").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_hotel_srvc_controller/crud"; ?>',
            postData:{t_vat_registration_id:<?php echo $this->input->post('t_vat_registration_id'); ?>},
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_vat_reg_dtl_hotel_srvc_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'Fasilitas',name: 'services',width: 250, align: "left",editable: false},
                {label: 'Deskripsi',name: 'description',width: 150, align: "left",editable: true, edittype: 'textarea',
                    editoptions: {
                        size: 50,
                        maxlength:255
                    },
                    editrules: {required: false}
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

            },
            sortorder:'',
            pager: '#grid-pager8',
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
            //memanggil controller jqgrid yang ada di controller read
            editurl: '<?php echo WS_JQGRID."transaksi.t_vat_reg_dtl_hotel_srvc_controller/crud"; ?>',
            caption: "Daftar Potensi Fasilitas Hotel"

        });

        jQuery('#grid-table8').jqGrid('navGrid', '#grid-pager8',
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
                    //reloadTreeMenu();
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
                    setTimeout(function() {
                    clearInputRqstType();
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
                    clearInputRqstType();
                    //reloadTreeMenu();


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




