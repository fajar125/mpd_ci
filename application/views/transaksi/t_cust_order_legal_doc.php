<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Dokumen Pendukung</span>
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
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-3">
                        <i class="blue"></i>
                        <strong> DATA IZIN DAN POTENSI </strong>
                    </a>
                </li>
                <li class="active">
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
                    <button class="btn btn-danger" type="submit" id="btn-submit" onclick="showLOVUpload()"><i class="fa fa-plus"></i> Tambah Data</button>
                    <button class="btn btn-success" type="submit" id="btn-submit" onclick="cetak()"><i class="fa fa-pencil"></i> Edit Data</button>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <div class="col-md-12">
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
                </div>
            </div>
            
            <div class="space-2"></div>
            <div class="row">
                <div class="col-md-offset-5">
                    <button class="btn btn-danger" type="submit" id="btn-submit" onclick="cetak()"><i class="fa fa-print"></i>Cetak Tanda Terima</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function cetak(){

        var t_customer_order_id = <?php echo $_POST['t_customer_order_id'];?>;

        var url = "<?php echo base_url(); ?>"+"cetak_formulir_tanda_terima_pdf/pageCetak?t_customer_order_id="+t_customer_order_id;

        PopupCenter(url,"Kartu Tanda Terima",500,500);
    } 
</script>

<script>
$("#tab-1").on("click", function(event) {
    event.stopPropagation();
    loadContentWithParams("transaksi.t_customer_order",{});
});

$("#tab-3").on("click", function(event) {
    event.stopPropagation();
    t_vat_registration_id = <?php echo $_POST['t_vat_registration_id'];?> ;
    p_rqst_type_id = <?php echo $_POST['p_rqst_type_id'];?> ;
    t_customer_order_id = <?php echo $_POST['t_customer_order_id'];?> ;
    order_no = <?php echo $_POST['order_no'];?> ;
    order_date = order_date = '<?php echo $this->input->post('order_date'); ?>' ;
    //alert(p_rqst_type_id);
    // t_vat_reg_employee_id = $('#t_vat_reg_employee_id').val() ;
    // t_vat_reg_dtl_restaurant_id = $('#t_vat_reg_dtl_restaurant_id').val() ;
    // t_license_letter_id = $('#t_license_letter_id').val() ;
    if(t_vat_registration_id == null || t_vat_registration_id == 0 || t_vat_registration_id == ""){
        swal('Peringatan','Isi Formulir Pendaftaran Terlebih Dahulu!','error');
        return false;
    }

    loadContentWithParams("transaksi.t_vat_reg_dtl", { //model yang ketiga
        t_customer_order_id: t_customer_order_id,
        order_no:order_no,
        order_date:order_date,
        p_rqst_type_id: p_rqst_type_id,
        t_vat_registration_id: t_vat_registration_id
        
    });
});

$("#tab-2").on("click", function(event) {

    event.stopPropagation();
    var grid = $('#grid-table');
    t_customer_order_id = <?php echo $_POST['t_customer_order_id'];?>;
    t_vat_registration_id = <?php echo $_POST['t_vat_registration_id'];?> ;
    p_rqst_type_id = <?php echo $_POST['p_rqst_type_id'];?> ;
    order_no = <?php echo $_POST['order_no'];?> ;
    order_date = '<?php echo $_POST['order_date'];?>' ;
    
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
</script>
</script>

<?php $this->load->view('lov/lov_p_legal_doc_type'); ?>
<?php $this->load->view('lov/lov_upload_file'); ?>

<script>
    $(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        $("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_cust_order_legal_doc_controller/crud"; ?>',
            datatype: "json",
            postData:{t_customer_order_id:<?php echo $this->input->post('t_customer_order_id'); ?>},
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_cust_order_legal_doc_id', key: true, width: 5, sorttype: 'number', hidden: true},
                {label: 'ID', name: 't_customer_order_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Jenis Dokumen',name: 'legal_doc_desc',width: 150, align: "left",editable: false},
                {label: 'Jenis Dokumen',
                    name: 'p_legal_doc_type_id',
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
                                elm.append('<input id="form_p_legal_doc_type_id" type="text" style="display:none;" >'+
                                        '<input id="form_p_legal_doc_type_code" name="legal_doc_desc" readonly type="text" class="FormElement form-control" placeholder="Pilih Jenis Dokumen" required=true>'+
                                        '<button class="btn btn-success" type="button" onclick="showLOVLegalDocType(\'form_p_legal_doc_type_id\',\'form_p_legal_doc_type_code\')">'+
                                        '   <span class="fa fa-search bigger-110"></span>'+
                                        '</button>');
                                $("#form_p_legal_doc_type_id").val(value);
                                elm.parent().removeClass('jqgrid-required');
                            }, 100);

                            return elm;
                        },
                        "custom_value":function( element, oper, gridval) {

                            if(oper === 'get') {
                                return $("#form_p_legal_doc_type_id").val();
                            } else if( oper === 'set') {
                                $("#form_p_legal_doc_type_id").val(gridval);
                                var gridId = this.id;
                                // give the editor time to set display
                                setTimeout(function(){
                                    var selectedRowId = $("#"+gridId).jqGrid ('getGridParam', 'selrow');
                                    if(selectedRowId != null) {
                                        var code_display = $("#"+gridId).jqGrid('getCell', selectedRowId, 'legal_doc_type_code');
                                        $("#form_p_legal_doc_type_code").val( code_display );
                                    }
                                },100);
                            }
                        }
                    }
                },
                {label: 'Nama File',name: 'file_name',width: 150, align: "left",editable: true, edittype:'file',
                    editoptions:{
                        enctype:'multipart/form-data'
                    }
                },
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
            editurl: '<?php echo WS_JQGRID."transaksi.t_cust_order_legal_doc_controller/crud"; ?>',
            caption: "Daftar Dokumen Pendukung"

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
                //serializeEditData: serializeJSON,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    console.log(form);
                    form.attr('enctype','multipart/form-data');
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
               
                editData : {
                    t_customer_order_id: function() {
                        return <?php echo $this->input->post('t_customer_order_id'); ?>;
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
                onInitializeForm: function(e, form) {
                    var form = $(e[0]);
                    form.attr('enctype','multipart/form-data');
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    form.attr('enctype','multipart/form-data');
                    console.log(form);
                    style_edit_form(form);

                    setTimeout(function() {
                    clearInputLegalDocType();
                     },100);
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var formData = new FormData($(this)[0]);
                    var response = jQuery.parseJSON(response.responseText);
                    console.log(formData);
                    if(response.success == false) {
                        return [false,response.message,response.responseText];
                    }

                    $(".tinfo").html('<div class="ui-state-success">' + response.message + '</div>');
                    var tinfoel = $(".tinfo").show();
                    tinfoel.delay(3000).fadeOut();
                    clearInputLegalDocType();
                    uploadFile(response,postdata);
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
                    //console.log(response.rows);
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
/**
 * [showLOVLegalDocType called by input menu_icon to show List Of Value (LOV) of icon]
 * @param  {[type]} id   [description]
 * @param  {[type]} code [description]
 * @return {[type]}      [description]
 */
function showLOVLegalDocType(id, code) {
    modal_p_legal_doc_type_show(id, code);
}

/**
 * [clearInputLegalDocType called by beforeShowForm method to clean input of menu_icon]
 * @return {[type]} [description]
 */
function clearInputLegalDocType() {
    $('#form_p_legal_doc_type_id').val('');
    $('#form_p_legal_doc_type_code').val('');
}

function uploadFile(response, postdata) {
    // alert($.parseJSON(response.responseText));
    // return;
    //alert(response.success);
    if (response.success == true) {
        alert($("#file_name").val());
        if ($("#file_name").val() != "") {
            //alert(response.success);
            ajaxFileUpload(response);

        }
    }

}

function ajaxFileUpload(data) {
    
    $("#loading").ajaxStart(function () {
        $(this).show();
    }).ajaxComplete(function () {
        $(this).hide();
    });
    //alert(data.success);

    $.ajax({
            url: "<?php echo WS_JQGRID.'transaksi.t_cust_order_legal_doc_controller/uploadFiles'; ?>",
            type:"POST",
            secureuri: false,
            dataType: "json",
            data: data,
            success: function (data, status) {

                if (typeof (data.success) != 'undefined') {
                    if (data.success == true) {
                        return;
                    } else {
                        alert(data.message);
                    }
                }
                else {
                    return alert('Failed to upload!');
                }
            },
            error: function (data, status, e) {
                return alert('Failed to upload!');
            }
        }
    )          
}  
</script>

<script type="text/javascript">
    function showLOVUpload() {
        modal_upload_file_show();
    }
</script>