<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pendaftaran Pajak</span>
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
                        <strong> PERMINTAAN PELANGGAN </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-2">
                        <i class="blue"></i>
                        <strong> FORMULIR PENDAFTARAN </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-3">
                        <i class="blue"></i>
                        <strong> DATA IZIN DAN POTENSI </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-4">
                        <i class="blue"></i>
                        <strong> DOKUMEN PENDUKUNG </strong>
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
$("#tab-2").on("click", function(event) {
    
    event.stopPropagation();
    var grid = $('#grid-table');
    t_customer_order_id = grid.jqGrid ('getGridParam', 'selrow');
    p_rqst_type_id = grid.jqGrid ('getCell', t_customer_order_id, 'p_rqst_type_id');
    order_no = grid.jqGrid ('getCell', t_customer_order_id, 'order_no');
    order_date = grid.jqGrid ('getCell', t_customer_order_id, 'order_date');
    t_vat_registration_id = grid.jqGrid ('getCell', t_customer_order_id, 't_vat_registration_id');
   
    if(t_customer_order_id == null) {
        swal('Informasi','Silahkan pilih salah satu Permintaan Pelanggan','info');
        return false;
    }

    loadContentWithParams("transaksi.t_vat_registration", {

        t_customer_order_id: t_customer_order_id,
        order_no:order_no,
        order_date:order_date,
        p_rqst_type_id:p_rqst_type_id,
        t_vat_registration_id:t_vat_registration_id

    });
});

$("#tab-3").on("click", function(event) {
    
    event.stopPropagation();
    var grid = $('#grid-table');
    t_customer_order_id = grid.jqGrid ('getGridParam', 'selrow');
    p_rqst_type_id = grid.jqGrid ('getCell', t_customer_order_id, 'p_rqst_type_id');
    order_no = grid.jqGrid ('getCell', t_customer_order_id, 'order_no');
    order_date = grid.jqGrid ('getCell', t_customer_order_id, 'order_date');
    t_vat_registration_id = grid.jqGrid ('getCell', t_customer_order_id, 't_vat_registration_id');
    
    
    if(t_vat_registration_id == null || t_vat_registration_id == 0 || t_vat_registration_id == "") {
        swal('Peringatan!','Isi Formulir Pendataran Terlebih Dahulu','error');
        return false;
    }


    loadContentWithParams("transaksi.t_vat_reg_dtl", {
        t_customer_order_id: t_customer_order_id,
        order_no:order_no,
        order_date:order_date,
        p_rqst_type_id:p_rqst_type_id,
        t_vat_registration_id:t_vat_registration_id
    });
});

$("#tab-4").on("click", function(event) {
    
    event.stopPropagation();
    var grid = $('#grid-table');
    t_customer_order_id = grid.jqGrid ('getGridParam', 'selrow');
    p_rqst_type_id = grid.jqGrid ('getCell', t_customer_order_id, 'p_rqst_type_id');
    order_no = grid.jqGrid ('getCell', t_customer_order_id, 'order_no');
    t_vat_registration_id = grid.jqGrid ('getCell', t_customer_order_id, 't_vat_registration_id');
    
    
    if(t_customer_order_id == null) {
        swal('Informasi','Silahkan pilih salah satu Permintaan Pelanggan','info');
        return false;
    }


    loadContentWithParams("transaksi.t_cust_order_legal_doc", {
        t_customer_order_id: t_customer_order_id,
        order_no:order_no,
        p_rqst_type_id:p_rqst_type_id,
        t_vat_registration_id:t_vat_registration_id
    });
});
</script>



<?php $this->load->view('lov/lov_p_rqst_type'); ?>



<script type="text/javascript">
    function submit($t_customer_order_id, $company_brand, $npwpd, $order_no, $brand_address_name){

        var var_url = "<?php echo WS_JQGRID."transaksi.t_customer_order_controller/submit/?";?>";
        var_url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        var_url += "&t_customer_order_id=" + $t_customer_order_id;
        var url = "<?php echo base_url(); ?>"+"cetak_kartu_npwpd/pageCetak?t_customer_order_id="+$t_customer_order_id;

        text_submit = "<pre style='text-align:left;'>" +
                "Nomor Order             : "+$order_no +"\n" +
                "NPWPD                   : "+ $npwpd +"\n" +
                "Merk Dagang             : "+ $company_brand +"\n" +
                "Alamat Merk Dagang      : "+ $brand_address_name +"\n" +
            "</pre>"+
            "<h5>Apakah anda yakin akan mengirim data ini?</h5>";
        //     alert(text_submit);
        // return;
        swal({
           title: '<b>Konfirmasi</b>',
              type: 'info',
              html: true,
              text: text_submit,
             showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger'
        },
        function(){
            setTimeout(function(){
            $.getJSON(var_url, function( items ) {
                swal(items.rows.o_result_msg);
                loadContentWithParams("transaksi.t_customer_order", {});
            });
        }, 3000);
            PopupCenter(url,"Kartu NPWPD",500,500);
           
        });
        

        
    }

    function cetak($p_rqst_type_id, $t_customer_order_id){
        var url = "<?php echo base_url(); ?>";
        if ($p_rqst_type_id == 1){
                url+="cetak_formulir_hotel_pdf/pageCetak?t_customer_order_id="+$t_customer_order_id;
        }else if($p_rqst_type_id == 2){
                url+="cetak_formulir_restaurant_pdf/pageCetak?t_customer_order_id="+$t_customer_order_id;
        }else if($p_rqst_type_id == 3){
                url+="cetak_formulir_hiburan_pdf/pageCetak?t_customer_order_id="+$t_customer_order_id;
        }else if($p_rqst_type_id == 4){
                url+="cetak_formulir_parkir_pdf/pageCetak?t_customer_order_id="+$t_customer_order_id;
        }else if($p_rqst_type_id == 5){
                url+="cetak_formulir_ppj_pdf/pageCetak?t_customer_order_id="+$t_customer_order_id;
        }else{
                swal("Peringatan" ,"Jenis Permohonan Tidak Diketahui!" , "error");
                return;
        }

        PopupCenter(url,"Cetak Formulir",500,500);
    }
</script>

<script>
    $(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        $("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_customer_order_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_customer_order_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 't_vat_registration_id',  width: 5, sorttype: 'number', hidden: true},
                {label: 'ID', name: 'p_order_status_id', width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID', name: 'p_rqst_type_id', width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Nomor Order',name: 'order_no',width: 150, align: "left",editable: true, edittype:'text',
                    editoptions: {
                        size: 30,
                        maxlength:255,
                        readonly:true
                    },
                    editrules: {required: false}
                },
                {label: 'Alamat',name: 'brand_address_name',width: 250, align: "left",editable: false, hidden:true},
                {label: 'Jenis Permohonan',name: 'rqst_type_code',width: 250, align: "left",editable: false},
                {label: 'Jenis Permohonan',
                    name: 'p_rqst_type_id',
                    width: 100,
                    sortable: true,
                    editable: true,
                    hidden: true,
                    editrules: {edithidden: true, required:false},
                    edittype: 'custom',
                    editoptions: {
                        "custom_element":function( value  , options) {
                            var elm = $('<span></span>');

                            // give the editor time to initialize
                            setTimeout( function() {
                                elm.append('<input id="form_p_rqst_type_id" type="text" style="display:none;" >'+
                                        '<input id="form_p_rqst_type_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Jenis Permohonan" required=true>'+
                                        '<button class="btn btn-success" type="button"  onclick="showLOVRqstType(\'form_p_rqst_type_id\',\'form_p_rqst_type_code\')">'+
                                        '   <span class="fa fa-search bigger-110"></span>'+
                                        '</button>');
                                $("#form_p_rqst_type_id").val(value);
                                elm.parent().removeClass('jqgrid-required');
                            }, 100);

                            return elm;
                        },
                        "custom_value":function( element, oper, gridval) {

                            if(oper === 'get') {
                                return $("#form_p_rqst_type_id").val();
                            } else if( oper === 'set') {
                                $("#form_p_rqst_type_id").val(gridval);
                                var gridId = this.id;
                                // give the editor time to set display
                                setTimeout(function(){
                                    var selectedRowId = $("#"+gridId).jqGrid ('getGridParam', 'selrow');
                                    if(selectedRowId != null) {
                                        var code_display = $("#"+gridId).jqGrid('getCell', selectedRowId, 'rqst_type_code');
                                        $("#form_p_rqst_type_code").val( code_display );
                                    }
                                },100);
                            }
                        }
                    }
                },
                {label: 'Tanggal Permintaan ',name: 'order_date',width: 150, align: "left",editable: false},
                {label: 'Merk Dagang',name: 'company_brand',width: 250, align: "left",editable: false},
                {label: 'NPWPD',name: 'npwpd',width: 150, align: "left",editable: false, edittype:'text',},
                {label: 'Deskripsi',name: 'description',width: 150, align: "left",editable: true, edittype: 'textarea',
                    editoptions: {
                        size: 50,
                        maxlength:255
                    },
                    editrules: {required: false}
                },
                {name: 'Options',width: 200, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var custId = rowObject['t_customer_order_id'];
                        var rqstId = rowObject['p_rqst_type_id'];
                        var npwpd = rowObject['npwpd'];
                        var order_no = rowObject['order_no'];
                        var company_brand = rowObject['company_brand'];
                        var brand_address_name = rowObject['brand_address_name'];
                        var display = "";
                        if (npwpd == "" || npwpd == null || npwpd == 0){
                            display = "disabled";
                        }
                        return '<button class="btn btn-danger btn-xs" type="submit" '+display+' id="btn_cetak" onclick="cetak(\''+rqstId+'\',\''+custId+'\');"><i class="fa fa-print"></i>Cetak</button> <button class="btn btn-success btn-xs" type="submit" id="btn_submit" onclick="submit(\''+custId+'\',\''+company_brand+'\',\''+npwpd+'\',\''+order_no+'\',\''+brand_address_name+'\');"><i class="fa fa-save"></i>Submit</button>';

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
            shrinkToFit: false,
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
            editurl: '<?php echo WS_JQGRID."transaksi.t_customer_order_controller/crud"; ?>',
            caption: "Daftar Permintaan Pelanggan"

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

<script type="text/javascript"></script>




<script>
/**
 * [showLOVRqstType called by input menu_icon to show List Of Value (LOV) of icon]
 * @param  {[type]} id   [description]
 * @param  {[type]} code [description]
 * @return {[type]}      [description]
 */
function showLOVRqstType(id, code) {
    modal_p_rqst_type_show(id, code);
}

/**
 * [clearInputRqstType called by beforeShowForm method to clean input of menu_icon]
 * @return {[type]} [description]
 */
function clearInputRqstType() {
    $('#form_p_rqst_type_id').val('');
    $('#form_p_rqst_type_code').val('');
}

</script>