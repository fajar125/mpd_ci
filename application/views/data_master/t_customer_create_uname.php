<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Generate Username & Password Wajib Pajak</span>
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
                        <strong> Customer </strong>
                    </a>
                </li>
            </ul>
        </div>
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
            url: '<?php echo WS_JQGRID."data_master.t_customer_create_uname_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_customer_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},

                {label: 'Generate',width: 150, align: "left",editable: false,
                    formatter:function(cellvalue, options, rowObject) {
                        var t_customer_id = rowObject['t_customer_id'];
                            return '<a class="btn btn-primary btn-xs" href="#" onclick="genUname('+t_customer_id+');">Generate</a>';
                        
                    }
                },
                
                {label: 'Nama Pemilik/Pengelola',name: 'company_owner',width: 150, align: "left",editable: false,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                

                {label: 'Alamat WP',name: 'alamat',width: 200, align: "left",editable: false,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    }
                },

                {label: 'Merek Dagang',name: 'company_brand',width: 200, align: "left",editable: false,
                    editoptions: {
                        size: 60,
                        maxlength:255
                    }
                },
                {label: 'Alamat Merek Dagang',name: 'brand_address_name',width: 200, align: "left",editable: false,
                    editoptions: {
                        size: 60,
                        maxlength:255
                    }
                },

                {label: 'Jenis Pajak',name: 'vat_code',width: 200, align: "left",editable: false,
                    editoptions: {
                        size: 60,
                        maxlength:255
                    }
                },

                {label: 'No Seluler',name: 'mobile_no_owner',width: 150, align: "left",editable: false,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    }
                },

                {label: 'Email',name: 'email_address',width: 150, align: "left",editable: false,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    }
                }
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
                $.ajax({
                    url: '<?php echo WS_JQGRID."data_master.t_customer_create_uname_controller/read_detail"; ?>',
                    type: "POST",
                    dataType: "json",
                    data: {
                       t_customer_id: rowid
                    },
                    success: function (data) {
                        if(data.success){
                            var dt = data.items;
                            if (dt != null || dt != ''){
                                setDaftar_customer(dt);
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                    }
                });
                

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

    function setDaftar_customer(data){

        $('#t_customer_id').val(data.t_customer_id);
        $('#t_cust_account_id').val(data.t_cust_account_id);
        $('#company_owner').val(data.company_owner);
        $('#code').val(data.nama_jabatan);
        $('#address_name_owner').val(data.address_name_owner);
        $('#address_no_owner').val(data.address_no_owner);
        $('#address_rt_owner').val(data.address_rt_owner);
        $('#address_rw_owner').val(data.address_rw_owner);
        $('#kota').val(data.nama_kota);
        $('#kelurahan').val(data.nama_kelurahan);
        $('#kecamatan').val(data.nama_kecamatan);
        $('#phone_no_owner').val(data.phone_no_owner);
        $('#fax_no_owner').val(data.fax_no_owner);
        $('#mobile_no_owner').val(data.mobile_no_owner);
        $('#email_address').val(data.email_address);
        $('#zip_code_owner').val(data.zip_code_owner);
    }

    function genUname(t_customer_id){
        swal({
            title: 'Apakah Anda Yakin?',
            type: 'info',
            html: true,
            text: 'Anda Tidak Akan Bisa Mengembalikan Aksi Ini!',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger'
        },
        function(){
            $.ajax({
                url: '<?php echo WS_JQGRID."data_master.t_customer_create_uname_controller/generate_uname"; ?>',
                type: "POST",
                dataType: "json",
                data: {t_customer_id: t_customer_id},
                success: function (data) {
                    if (data.success){
                        swal({title: "Informasi!", text: data.message, html: true, type: "info"});
                    }else{
                        swal({title: "Error!", text: data.message, html: true, type: "error"});
                    }
                    
                },
                error: function (xhr, status, error) {
                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                }
            });
        });
    }

</script>
<div class="space-4"></div>
<label class="control-label col-md-2"><b>Informasi Customer</b></label>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="row">
                    <label class="control-label col-md-3">Nama Pemilik/Pengelola</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="company_owner" id="company_owner" style="width: 560px;" readonly="true">                 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Jabatan</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="code" id="code" style="width: 560px;" readonly="true">                 
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Alamat</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <textarea class="form-control" name="address_name_owner" id="address_name_owner" style="width: 560px;" readonly="true"></textarea>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No</label>
                    <div class="col-md-1">
                        <div class="input-group">
                            <input type="text" class="form-control" name="address_no_owner" id="address_no_owner" readonly="true">                            
                        </div>
                    </div>
                    <label class="control-label col-sm-1">RT</label>
                    <div class="col-md-1">
                        <div class="input-group">
                            <input type="text" class="form-control" name="address_rt_owner" id="address_rt_owner" readonly="true">                            
                        </div>
                    </div>
                    <label class="control-label col-sm-1">RW</label>
                    <div class="col-md-1">
                        <div class="input-group">
                            <input type="text" class="form-control" name="address_rw_owner" id="address_rw_owner" readonly="true">                            
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kota</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kota" id="kota" readonly="true">
                        </div>
                    </div>
                
                
                    <label class="control-label col-md-1">Kecamatan</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan" readonly="true">
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kelurahan" id="kelurahan" readonly="true">
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No Telepon</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="phone_no_owner" id="phone_no_owner" readonly="true">
                        </div>
                    </div>
                
                    <label class="control-label col-md-1">No Fax</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="fax_no_owner" id="fax_no_owner" readonly="true">
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No Seluler</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="mobile_no_owner" id="mobile_no_owner" readonly="true">
                        </div>
                    </div>               
                
                    <label class="control-label col-md-1">Email</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="email_address" id="email_address" readonly="true">
                        </div>
                    </div>
                </div>
                 <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kode Pos</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="zip_code_owner" id="zip_code_owner" readonly="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>   
</div>
