<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Reset Password Wajib Pajak</span>
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
                        <strong> ADMINISTRASI USER </strong>
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

    $.ajax({
            url: "<?php echo base_url().'reset_pass_wp/load_combo_status_readonly/'; ?>" ,
            type: "POST",            
            data: {},
            success: function (data) {
                $( "#comboStatus" ).html( data );
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
            }
    });

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."data_master.reset_pass_wp_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 'p_app_user_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                
                {label: 'Nama User',name: 'app_user_name',width: 150, align: "left",editable: false,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    },
                    editrules: {required: true}
                },
                

                {label: 'NPWPD',name: 'npwd',width: 200, align: "left",editable: false,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    }
                },

                {label: 'Nama Lengkap',name: 'company_brand',width: 200, align: "left",editable: false,
                    editoptions: {
                        size: 60,
                        maxlength:255
                    }
                },
                {label: 'Deskripsi',name: 'description',width: 200, align: "left",editable: false,
                    editoptions: {
                        size: 60,
                        maxlength:255
                    }
                },

                // Kebutuhan untuk form
                {label: 'Email',name: 'email_address',width: 200, align: "left",hidden:true},
                {label: 'Status',name: 'p_user_status_id',width: 200, align: "left",hidden:true},
                {label: 'Employee',name: 'is_employee',width: 200, align: "left",hidden:true},
                {label: 'Description',name: 'description',width: 200, align: "left",hidden:true},
                {label: 'ip_address_v4',name: 'ip_address_v4',width: 200, align: "left",hidden:true},
                {label: 'ip_address_v6',name: 'ip_address_v6',width: 200, align: "left",hidden:true},
                {label: 'expired_user',name: 'expired_user',width: 200, align: "left",hidden:true},
                {label: 'expired_pwd',name: 'expired_pwd',width: 200, align: "left",hidden:true},
                {label: 'last_login_time',name: 'last_login_time',width: 200, align: "left",hidden:true}
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
                
                setDaftar_customer(rowid);
                

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
            editurl: '<?php echo WS_JQGRID."data_master.reset_pass_wp_controller/read"; ?>',
            caption: "ADMINISTRASI USER"

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

    function setDaftar_customer(rowid){
        var p_app_user_id = $('#grid-table').jqGrid('getCell', rowid, 'p_app_user_id');
        var app_user_name = $('#grid-table').jqGrid('getCell', rowid, 'app_user_name');
        var full_name = $('#grid-table').jqGrid('getCell', rowid, 'full_name');
        var email_address = $('#grid-table').jqGrid('getCell', rowid, 'email_address');
        var p_user_status_id = $('#grid-table').jqGrid('getCell', rowid, 'p_user_status_id');
        var is_employee = $('#grid-table').jqGrid('getCell', rowid, 'is_employee');
        var description = $('#grid-table').jqGrid('getCell', rowid, 'description');
        var ip_address_v4 = $('#grid-table').jqGrid('getCell', rowid, 'ip_address_v4');
        var ip_address_v6 = $('#grid-table').jqGrid('getCell', rowid, 'ip_address_v6');
        var expired_user = $('#grid-table').jqGrid('getCell', rowid, 'expired_user');
        var expired_pwd = $('#grid-table').jqGrid('getCell', rowid, 'expired_pwd');
        var last_login_time = $('#grid-table').jqGrid('getCell', rowid, 'last_login_time');
        
        $('#p_app_user_id').val(p_app_user_id);
        $('#app_user_name').val(app_user_name);
        $('#full_name').val(full_name);
        $('#email_address').val(email_address);
        $('#p_user_status_id').val(p_user_status_id);
        $('#is_employee').val(is_employee);
        $('#description').val(description);
        $('#ip_address_v4').val(ip_address_v4);
        $('#ip_address_v6').val(ip_address_v6);
        $('#expired_user').val(expired_user);
        $('#expired_pwd').val(expired_pwd);
        $('#last_login_time').val(last_login_time);
    }

    function resetPass(){
        var p_app_user_id = $('#p_app_user_id').val();
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
                url: '<?php echo WS_JQGRID."data_master.reset_pass_wp_controller/reset_pass"; ?>',
                type: "POST",
                dataType: "json",
                data: {p_app_user_id: p_app_user_id},
                success: function (data) {
                    if (data.success){
                        swal({title: "Password berhasil diubah!", text: "dengan password baru : "+data.message, html: true, type: "info"});
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
<div class="panel panel-primary">
    <div class="panel-heading">Informasi Customer</div>
    <div class="panel-body">
        <div class="form-body">
            <div class="row">
                <label class="control-label col-md-3">Nama User</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group">
                            <input type="hidden" class="form-control" name="p_app_user_id" id="p_app_user_id" readonly="true"> 
                            <input type="text" class="form-control" name="app_user_name" id="app_user_name" readonly="true">                 
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Nama Lengkap</label>
                <div class="col-md-7">
                    <div class="input-group col-md-7">
                        <input type="text" class="form-control" name="full_name" id="full_name"  readonly="true">
                    </div>
                </div>
            </div>
            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Email</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="email_address" id="email_address"  readonly="true">
                    </div>
                </div>
            </div>
            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <div id="comboStatus"></div>                           
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Employee ?</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <select  name="is_employee" id="is_employee" disabled class="form-control">
                            <option value='' >Pilih</option>
                            <option value='Y' >Ya</option>
                            <option value='N' >Tidak</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Deskripsi</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="description" id="description" readonly="true">
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">IP Address v4</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="ip_address_v4" id="ip_address_v4" readonly="true">
                    </div>
                </div>
            </div>
            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">IP Address v6</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="ip_address_v6" id="ip_address_v6" readonly="true">
                    </div>
                </div>
            </div>
            
            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Expired User</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="expired_user" id="expired_user" readonly="true">
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Expired Pwd</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="expired_pwd" id="expired_pwd" readonly="true">
                    </div>
                </div>   
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Terakhir Login</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="last_login_time" id="last_login_time" readonly="true">
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <div class="input-group">
                        <a class="btn btn-success" href="#" onclick="resetPass();">Reset Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
