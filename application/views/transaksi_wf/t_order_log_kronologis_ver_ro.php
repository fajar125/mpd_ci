<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Log Aktifitas</span>
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
                        <strong> FORMULIR PENDAFTARAN </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-2">
                        <i class="blue"></i>
                        <strong> DATA IZIN DAN POTENSI </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-3">
                        <i class="blue"></i>
                        <strong> DOKUMEN PENDUKUNG </strong>
                    </a>
                </li>
                <li class="active">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-4">
                        <i class="blue"></i>
                        <strong> LOG AKTIFITAS </strong>
                    </a>
                </li>
            </ul>
        </div>

         <div class="space-4"></div>
    <!-- parameter untuk kembali ke workflow summary -->
    <input type="hidden" id="order_no" value="<?php echo $this->input->post('order_no'); ?>" />
    <input type="hidden" id="registration_date" value="<?php echo $this->input->post('registration_date'); ?>" />
    <input type="hidden" id="p_rqst_type_id" value="<?php echo $this->input->post('p_rqst_type_id'); ?>" />
    <input type="hidden" id="t_vat_registration_id" value="<?php echo $this->input->post('t_vat_registration_id'); ?>" />

    <input type="hidden" id="TEMP_ELEMENT_ID" value="<?php echo $this->input->post('ELEMENT_ID'); ?>" />
    <input type="hidden" id="TEMP_PROFILE_TYPE" value="<?php echo $this->input->post('PROFILE_TYPE'); ?>" />
    <input type="hidden" id="TEMP_P_W_DOC_TYPE_ID" value="<?php echo $this->input->post('P_W_DOC_TYPE_ID'); ?>" />
    <input type="hidden" id="TEMP_P_W_PROC_ID" value="<?php echo $this->input->post('P_W_PROC_ID'); ?>" />
    <input type="hidden" id="TEMP_USER_ID" value="<?php echo $this->input->post('USER_ID'); ?>" />
    <input type="hidden" id="TEMP_FSUMMARY" value="<?php echo $this->input->post('FSUMMARY'); ?>" />
    <!-- end type hidden -->

    <!-- paramater untuk kebutuhan submit dan status -->
    <input type="hidden" id="CURR_DOC_ID" value="<?php echo $this->input->post('CURR_DOC_ID'); ?>">
    <input type="hidden" id="CURR_DOC_TYPE_ID" value="<?php echo $this->input->post('CURR_DOC_TYPE_ID'); ?>">
    <input type="hidden" id="CURR_PROC_ID" value="<?php echo $this->input->post('CURR_PROC_ID'); ?>">
    <input type="hidden" id="CURR_CTL_ID" value="<?php echo $this->input->post('CURR_CTL_ID'); ?>">
    <input type="hidden" id="USER_ID_DOC" value="<?php echo $this->input->post('USER_ID_DOC'); ?>">
    <input type="hidden" id="USER_ID_DONOR" value="<?php echo $this->input->post('USER_ID_DONOR'); ?>">
    <input type="hidden" id="USER_ID_LOGIN" value="<?php echo $this->input->post('USER_ID_LOGIN'); ?>">
    <input type="hidden" id="USER_ID_TAKEN" value="<?php echo $this->input->post('USER_ID_TAKEN'); ?>">
    <input type="hidden" id="IS_CREATE_DOC" value="<?php echo $this->input->post('IS_CREATE_DOC'); ?>">
    <input type="hidden" id="IS_MANUAL" value="<?php echo $this->input->post('IS_MANUAL'); ?>">
    <input type="hidden" id="CURR_PROC_STATUS" value="<?php echo $this->input->post('CURR_PROC_STATUS'); ?>">
    <input type="hidden" id="CURR_DOC_STATUS" value="<?php echo $this->input->post('CURR_DOC_STATUS'); ?>">
    <input type="hidden" id="PREV_DOC_ID" value="<?php echo $this->input->post('PREV_DOC_ID'); ?>">
    <input type="hidden" id="PREV_DOC_TYPE_ID" value="<?php echo $this->input->post('PREV_DOC_TYPE_ID'); ?>">
    <input type="hidden" id="PREV_PROC_ID" value="<?php echo $this->input->post('PREV_PROC_ID'); ?>">
    <input type="hidden" id="PREV_CTL_ID" value="<?php echo $this->input->post('PREV_CTL_ID'); ?>">
    <input type="hidden" id="SLOT_1" value="<?php echo $this->input->post('SLOT_1'); ?>">
    <input type="hidden" id="SLOT_2" value="<?php echo $this->input->post('SLOT_2'); ?>">
    <input type="hidden" id="SLOT_3" value="<?php echo $this->input->post('SLOT_3'); ?>">
    <input type="hidden" id="SLOT_4" value="<?php echo $this->input->post('SLOT_4'); ?>">
    <input type="hidden" id="SLOT_5" value="<?php echo $this->input->post('SLOT_5'); ?>">
    <input type="hidden" id="MESSAGE" value="<?php echo $this->input->post('MESSAGE'); ?>">
    <input type="hidden" id="PROFILE_TYPE" value="<?php echo $this->input->post('PROFILE_TYPE'); ?>">
    <input type="hidden" id="ACTION_STATUS" value="<?php echo $this->input->post('ACTION_STATUS'); ?>">
    <!-- end type hidden -->

        <div class="tab-content no-border">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-danger" type="submit" id="btn-tambah" onclick="showLOVUpload()"><i class="fa fa-plus"></i> Tambah Data</button>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <div class="col-md-12">
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
                </div>
            </div>
            
        </div>
    </div>
</div>


</script>

<?php 
    $this->load->view('lov/lov_log.php'); 
?>
<script>
    $(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        $("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_order_log_kronologis_controller/read"; ?>',
            datatype: "json",
            postData:{t_customer_order_id:<?php echo $this->input->post('t_customer_order_id'); ?>},
            mtype: "POST",
            colModel: [
                {label: 'counter_no', name: 'counter_no', key: true, width: 5, sorttype: 'number', hidden: true},
                {label: 'ID', name: 't_customer_order_id',  width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'Tanggal',name: 'log_date_txt',width: 100, align: "left",editable: false},
                {label: 'Jam',name: 'log_hour',width: 100, align: "left",editable: false},
                {label: 'Aktivitas',name: 'activity',width: 300, align: "left",editable: false},                
                {label: 'Oleh',name: 'app_user_name',width: 150, align: "left",editable: false},                
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
            editurl: '<?php echo WS_JQGRID."transaksi.t_order_log_kronologis_controller/crud"; ?>',
            caption: "Daftar Log Kronologis"

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
                //serializeEditData: serializeJSON,
                width: 'auto',
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    console.log(form);
                    // form.attr('enctype','multipart/form-data');
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
                },
                beforeShowForm: function (e, form) {
                    var form = $(e[0]);
                    style_edit_form(form);

                    setTimeout(function() {
                    // clearInputLegalDocType();
                     },100);
                },
                afterShowForm: function(form) {
                    form.closest('.ui-jqdialog').center();
                },
                afterSubmit:function(response,postdata) {
                    var formData = new FormData($(this)[0]);
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

<script type="text/javascript">
     /* cek jika tipe view */
    if (  $('#ACTION_STATUS').val() == 'VIEW' ) {
        $('#btn-tambah').hide();
    }
    $("#tab-1").on("click", function(event) {
        event.stopPropagation();
        loadContentWithParams("transaksi_wf.t_vat_registration_ver_ro", { //model yang ketiga
                t_customer_order_id: $( "#CURR_DOC_ID" ).val(),
                order_no: $('#order_no').val(),
                order_date:$('#registration_date').val(),
                p_rqst_type_id: $("#p_rqst_type_id").val(),
                t_vat_registration_id: $( "#t_vat_registration_id" ).val(),
                ELEMENT_ID : $('#TEMP_ELEMENT_ID').val(),
                PROFILE_TYPE : $('#TEMP_PROFILE_TYPE').val(),
                P_W_DOC_TYPE_ID : $('#TEMP_P_W_DOC_TYPE_ID').val(),
                P_W_PROC_ID : $('#TEMP_P_W_PROC_ID').val(),
                USER_ID : $('#TEMP_USER_ID').val(),
                FSUMMARY : $('#TEMP_FSUMMARY').val(),
                CURR_DOC_ID : $('#CURR_DOC_ID').val(),
                CURR_DOC_TYPE_ID : $('#CURR_DOC_TYPE_ID').val(),
                CURR_PROC_ID : $('#CURR_PROC_ID').val(),
                CURR_CTL_ID : $('#CURR_CTL_ID').val(),
                USER_ID_DOC : $('#USER_ID_DOC').val(),
                USER_ID_DONOR : $('#USER_ID_DONOR').val(),
                USER_ID_LOGIN : $('#USER_ID_LOGIN').val(),
                USER_ID_TAKEN : $('#USER_ID_TAKEN').val(),
                IS_CREATE_DOC : $('#IS_CREATE_DOC').val(),
                IS_MANUAL : $('#IS_MANUAL').val(),
                CURR_PROC_STATUS : $('#CURR_PROC_STATUS').val(),
                CURR_DOC_STATUS : $('#CURR_DOC_STATUS').val(),
                PREV_DOC_ID : $('#PREV_DOC_ID').val(),
                PREV_DOC_TYPE_ID : $('#PREV_DOC_TYPE_ID').val(),
                PREV_PROC_ID : $('#PREV_PROC_ID').val(),
                PREV_CTL_ID : $('#PREV_CTL_ID').val(),
                SLOT_1 : $('#SLOT_1').val(),
                SLOT_2 : $('#SLOT_2').val(),
                SLOT_3 : $('#SLOT_3').val(),
                SLOT_4 : $('#SLOT_4').val(),
                SLOT_5 : $('#SLOT_5').val(),
                MESSAGE : $('#MESSAGE').val(),
                PROFILE_TYPE : $('#PROFILE_TYPE').val(),
                ACTION_STATUS : $('#ACTION_STATUS').val()
                
            });
    });

    $("#tab-2").on("click", function(event) {
        event.stopPropagation();
        loadContentWithParams("transaksi_wf.t_vat_reg_dtl_ver_ro", { //model yang ketiga
            t_customer_order_id: $( "#CURR_DOC_ID" ).val(),
            order_no: $('#order_no').val(),
            order_date:$('#registration_date').val(),
            p_rqst_type_id: $("#p_rqst_type_id").val(),
            t_vat_registration_id: $( "#t_vat_registration_id" ).val(),
            ELEMENT_ID : $('#TEMP_ELEMENT_ID').val(),
            PROFILE_TYPE : $('#TEMP_PROFILE_TYPE').val(),
            P_W_DOC_TYPE_ID : $('#TEMP_P_W_DOC_TYPE_ID').val(),
            P_W_PROC_ID : $('#TEMP_P_W_PROC_ID').val(),
            USER_ID : $('#TEMP_USER_ID').val(),
            FSUMMARY : $('#TEMP_FSUMMARY').val(),
            CURR_DOC_ID : $('#CURR_DOC_ID').val(),
            CURR_DOC_TYPE_ID : $('#CURR_DOC_TYPE_ID').val(),
            CURR_PROC_ID : $('#CURR_PROC_ID').val(),
            CURR_CTL_ID : $('#CURR_CTL_ID').val(),
            USER_ID_DOC : $('#USER_ID_DOC').val(),
            USER_ID_DONOR : $('#USER_ID_DONOR').val(),
            USER_ID_LOGIN : $('#USER_ID_LOGIN').val(),
            USER_ID_TAKEN : $('#USER_ID_TAKEN').val(),
            IS_CREATE_DOC : $('#IS_CREATE_DOC').val(),
            IS_MANUAL : $('#IS_MANUAL').val(),
            CURR_PROC_STATUS : $('#CURR_PROC_STATUS').val(),
            CURR_DOC_STATUS : $('#CURR_DOC_STATUS').val(),
            PREV_DOC_ID : $('#PREV_DOC_ID').val(),
            PREV_DOC_TYPE_ID : $('#PREV_DOC_TYPE_ID').val(),
            PREV_PROC_ID : $('#PREV_PROC_ID').val(),
            PREV_CTL_ID : $('#PREV_CTL_ID').val(),
            SLOT_1 : $('#SLOT_1').val(),
            SLOT_2 : $('#SLOT_2').val(),
            SLOT_3 : $('#SLOT_3').val(),
            SLOT_4 : $('#SLOT_4').val(),
            SLOT_5 : $('#SLOT_5').val(),
            MESSAGE : $('#MESSAGE').val(),
            PROFILE_TYPE : $('#PROFILE_TYPE').val(),
            ACTION_STATUS : $('#ACTION_STATUS').val()
            
        });
    });

    $("#tab-3").on("click", function(event) {
        event.stopPropagation();
        loadContentWithParams("transaksi_wf.t_cust_order_legal_doc_ver_ro", { //model yang ketiga
            t_customer_order_id: $( "#CURR_DOC_ID" ).val(),
            order_no: $('#order_no').val(),
            order_date:$('#registration_date').val(),
            p_rqst_type_id: $("#p_rqst_type_id").val(),
            t_vat_registration_id: $( "#t_vat_registration_id" ).val(),
            ELEMENT_ID : $('#TEMP_ELEMENT_ID').val(),
            PROFILE_TYPE : $('#TEMP_PROFILE_TYPE').val(),
            P_W_DOC_TYPE_ID : $('#TEMP_P_W_DOC_TYPE_ID').val(),
            P_W_PROC_ID : $('#TEMP_P_W_PROC_ID').val(),
            USER_ID : $('#TEMP_USER_ID').val(),
            FSUMMARY : $('#TEMP_FSUMMARY').val(),
            CURR_DOC_ID : $('#CURR_DOC_ID').val(),
            CURR_DOC_TYPE_ID : $('#CURR_DOC_TYPE_ID').val(),
            CURR_PROC_ID : $('#CURR_PROC_ID').val(),
            CURR_CTL_ID : $('#CURR_CTL_ID').val(),
            USER_ID_DOC : $('#USER_ID_DOC').val(),
            USER_ID_DONOR : $('#USER_ID_DONOR').val(),
            USER_ID_LOGIN : $('#USER_ID_LOGIN').val(),
            USER_ID_TAKEN : $('#USER_ID_TAKEN').val(),
            IS_CREATE_DOC : $('#IS_CREATE_DOC').val(),
            IS_MANUAL : $('#IS_MANUAL').val(),
            CURR_PROC_STATUS : $('#CURR_PROC_STATUS').val(),
            CURR_DOC_STATUS : $('#CURR_DOC_STATUS').val(),
            PREV_DOC_ID : $('#PREV_DOC_ID').val(),
            PREV_DOC_TYPE_ID : $('#PREV_DOC_TYPE_ID').val(),
            PREV_PROC_ID : $('#PREV_PROC_ID').val(),
            PREV_CTL_ID : $('#PREV_CTL_ID').val(),
            SLOT_1 : $('#SLOT_1').val(),
            SLOT_2 : $('#SLOT_2').val(),
            SLOT_3 : $('#SLOT_3').val(),
            SLOT_4 : $('#SLOT_4').val(),
            SLOT_5 : $('#SLOT_5').val(),
            MESSAGE : $('#MESSAGE').val(),
            PROFILE_TYPE : $('#PROFILE_TYPE').val(),
            ACTION_STATUS : $('#ACTION_STATUS').val()
            
        });
    });

</script>


<script type="text/javascript">

    function showLOVUpload() {
        var params_log = {};
        params_log.code = "TAMBAH LOG AKTIFITAS";
        params_log.CURR_DOC_ID         = $('#CURR_DOC_ID').val();  
        params_log.CURR_DOC_TYPE_ID    = $('#CURR_DOC_TYPE_ID').val();
        params_log.CURR_PROC_ID        = $('#CURR_PROC_ID').val();
        params_log.CURR_CTL_ID         = $('#CURR_CTL_ID').val();
        params_log.USER_ID_DOC         = $('#USER_ID_DOC').val();
        params_log.USER_ID_DONOR       = $('#USER_ID_DONOR').val();
        params_log.USER_ID_LOGIN       = $('#USER_ID_LOGIN').val();
        params_log.USER_ID_TAKEN       = $('#USER_ID_TAKEN').val();
        params_log.IS_CREATE_DOC       = $('#IS_CREATE_DOC').val();
        params_log.IS_MANUAL           = $('#IS_MANUAL').val();
        params_log.CURR_PROC_STATUS    = $('#CURR_PROC_STATUS').val();
        params_log.CURR_DOC_STATUS     = $('#CURR_DOC_STATUS').val();
        params_log.PREV_DOC_ID         = $('#PREV_DOC_ID').val();
        params_log.PREV_DOC_TYPE_ID    = $('#PREV_DOC_TYPE_ID').val();
        params_log.PREV_PROC_ID        = $('#PREV_PROC_ID').val();
        params_log.PREV_CTL_ID         = $('#PREV_CTL_ID').val();
        params_log.SLOT_1              = $('#SLOT_1').val();    
        params_log.SLOT_2              = $('#SLOT_2').val(); 
        params_log.SLOT_3              = $('#SLOT_3').val();    
        params_log.SLOT_4              = $('#SLOT_4').val();  
        params_log.SLOT_5              = $('#SLOT_5').val();    
        params_log.MESSAGE             = $('#MESSAGE').val();    
        params_log.PROFILE_TYPE        = $('#PROFILE_TYPE').val();
        params_log.ACTION_STATUS       = $('#ACTION_STATUS').val();

        modal_lov_log_show(params_log);
    }

</script>