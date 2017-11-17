<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Daftar BPHTB</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-list font-blue"></i>
                    <span class="caption-subject font-blue bold uppercase"> Daftar BPHTB
                    </span>
                </div>
            </div>
            <!-- CONTENT PORTLET -->
            <div class="form-body">
                <button class="btn btn-danger" id="add-bphtb"> <i class="fa fa-plus"></i>Tambah</button>
                <button class="btn btn-success" id="detail-bphtb" disabled=""> <i class="fa fa-newspaper-o"></i>Detail BPHTB</button>
                

                <div class="row">
                    <div class="col-md-12 ">
                        <table id="grid-table"></table>
                        <div id="grid-pager"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('#add-bphtb').on('click', function(event){
        loadContentWithParams('transaksi.t_bphtb_registration', {FLAG:'Add',id:0});
    });

    $('#detail-bphtb').on('click', function(event){
        var grid = $('#grid-table');
        var rowid = grid.jqGrid ('getGridParam', 'selrow');
        var id = grid.jqGrid ('getCell', rowid, 't_bphtb_registration_id');
        //alert(id);
        loadContentWithParams('transaksi.t_bphtb_registration', {FLAG:'Detail',id:id});

    });


    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_bphtb_registration_id',  width: 5, sorttype: 'number', hidden: false},
                {label: 'Nama Wajib Pajak', name: 'wp_name',  width: 15, sorttype: 'text', hidden: false},
                {label: 'No Order', name: 'order_no',  width: 7, sorttype: 'text', hidden: false},
                {label: 'Via Online ?',  width: 5, sorttype: 'text', hidden: false,
                    formatter:function(cellvalue, options, rowObject) {
                        var t_ppat_id = rowObject['t_ppat_id'];
                        if (t_ppat_id==null || t_ppat_id==''){
                            return '<div>Manual</div>';
                        }else{
                            return '<div>Via Online</div>';
                        }
                        

                    }
                },
                {name: 'Options',width: 20, align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var t_bphtb_registration_id = rowObject['t_bphtb_registration_id'];
                        var t_customer_order_id = rowObject['t_customer_order_id'];
                        var check_potongan = rowObject['check_potongan'];
                        var t_ppat_id = rowObject['t_ppat_id'];
                        if (t_ppat_id==null || t_ppat_id==''){
                            return '<a class="btn btn-danger btn-xs" href="#" onclick="PopupCenter(\''+check_potongan+'\','+t_customer_order_id+','+t_bphtb_registration_id+');">Submit</a>';
                        }else{
                            return '';
                        }
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
                $('#detail-bphtb').prop( "disabled", false );
                

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
            editurl: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/read"; ?>',
            caption: "Daftar BPHTB"

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

    function PopupCenter(check_potongan,t_customer_order_id,t_bphtb_registration_id){
        // alert(check_potongan);
        swal({
          title: "Apakah Melanjutkan Ke Tahap Verifikasi?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Ya",
          closeOnConfirm: false
        },
        function(){
            setTimeout(function(){
            if (check_potongan=='Y'){
                $.ajax({
                    url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/getOrderStatus"; ?>',
                    type: "POST",
                    dataType: "json",
                    data: {
                        t_bphtb_registration_id: t_bphtb_registration_id
                    },
                    success: function (data) {
                        if(data.success){
                            var dt = data.result;

                            console.log(dt.p_order_status_id);

                            if (dt.p_order_status_id!=3){
                                swal({title: "Error!", text:"Proses Permohonan Pengurangan BPHTB Belum Selesai. Data tidak dapat disubmit", html: true, type: "error"});
                            }else{
                                $.ajax({
                                    url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/getJumlahProductOrder"; ?>',
                                    type: "POST",
                                    dataType: "json",
                                    data: {
                                        t_customer_order_id: t_customer_order_id
                                    },
                                    success: function (data) {
                                        if(data.success){
                                            var dt = data.result;

                                            var jumlah_data = dt.jml;

                                            if (jumlah_data==0){
                                                $.ajax({
                                                        url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/SubmitTable"; ?>',
                                                        type: "POST",
                                                        dataType: "json",
                                                        data: {
                                                            t_customer_order_id: t_customer_order_id
                                                        },
                                                        success: function (data) {
                                                            if(data.success){
                                                                var msg = data.result.f_first_submit_engine;
                                                               swal({title: "Informasi!", text: msg, html: true, type: "info"});
                                                                jQuery(function($) {
                                                                    var grid_selector = "#grid-table";

                                                                    jQuery("#grid-table-2b").jqGrid('setGridParam',{
                                                                        url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/read"; ?>',
                                                                        postData: {}

                                                                    });
                                                                    $("#grid-table").trigger("reloadGrid");
                                                                });
                                                            }
                                                            // console.log(dt.product_name);
                                                        },
                                                        error: function (xhr, status, error) {
                                                            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                                                        }
                                                    });
                                            }else{
                                                swal({title: "Error!", text:"Data BPHTB Sudah Tersubmit", html: true, type: "error"});
                                            }

                                           
                                        }
                                        // console.log(dt.product_name);
                                    },
                                    error: function (xhr, status, error) {
                                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                                    }
                                });
                            }

                           
                        }
                        // console.log(dt.product_name);
                    },
                    error: function (xhr, status, error) {
                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                    }
                });
            }else{
                $.ajax({
                    url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/getJumlahProductOrder"; ?>',
                    type: "POST",
                    dataType: "json",
                    data: {
                        t_customer_order_id: t_customer_order_id
                    },
                    success: function (data) {
                        if(data.success){
                            var dt = data.result;

                            var jumlah_data = dt.jml;

                            if (jumlah_data==0){
                                $.ajax({
                                        url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/SubmitTable"; ?>',
                                        type: "POST",
                                        dataType: "json",
                                        data: {
                                            t_customer_order_id: t_customer_order_id
                                        },
                                        success: function (data) {
                                            if(data.success){
                                                var msg = data.result.f_first_submit_engine;
                                                swal({title: "Informasi!", text: msg, html: true, type: "info"});
                                                jQuery(function($) {
                                                    var grid_selector = "#grid-table";

                                                    jQuery("#grid-table-2b").jqGrid('setGridParam',{
                                                        url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/read"; ?>',
                                                        postData: {}

                                                    });
                                                    $("#grid-table").trigger("reloadGrid");
                                                });
                                            }
                                            // console.log(dt.product_name);
                                        },
                                        error: function (xhr, status, error) {
                                            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                                        }
                                    });
                            }else{
                                swal({title: "Error!", text:"Data BPHTB Sudah Tersubmit", html: true, type: "error"});
                            }

                           
                        }
                        // console.log(dt.product_name);
                    },
                    error: function (xhr, status, error) {
                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                    }
                });
            }
        }, 3000);
           
        });
        
    }

</script>