<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Data Master Perubahan Nama Wajib Pajak</span>
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
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-2">
                        <i class="blue"></i>
                        <strong> Customer Account </strong>
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
$("#tab-2").on("click", function(event) {

    event.stopPropagation();
    var grid = $('#grid-table');
    t_customer_id = grid.jqGrid ('getGridParam', 'selrow');
    id_customer = grid.jqGrid ('getCell', t_customer_id, 't_customer_id');

    t_cust_account_id = grid.jqGrid ('getGridParam', 'selrow');
    id_cust_account = grid.jqGrid ('getCell', t_cust_account_id, 't_cust_account_id');

    //t_customer_id = $('#t_customer_id').val();
    //alert("t_customer_id = "+id_customer+" t_cust_account_id = "+id_cust_account);

    if(t_customer_id == null && t_cust_account_id == null) {
        swal('Informasi','Silahkan pilih salah satu Customer','info');
        return false;
    }

    loadContentWithParams("data_master.t_cust_account_update", {
        t_customer_id: id_customer,
        t_cust_account_id: t_cust_account_id,
        
    });
});
</script>


<script>
    
    
</script>

<script>

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."data_master.t_customer_update_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID', name: 't_customer_id', key: true, width: 5, sorttype: 'number', editable: true, hidden: true},
                {label: 'ID Cust', name: 't_cust_account_id', key: true, width: 5, sorttype: 'number', editable: false, hidden: true},
                
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

                
                {label: 'No Seluler',name: 'mobile_no_owner',width: 200, align: "left",editable: false,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    }
                },

                {label: 'Email',name: 'email_address',width: 200, align: "left",editable: false,
                    editoptions: {
                        size: 30,
                        maxlength:32
                    }
                },

                {label: 'Update By',name: 'updated_by',width: 150, align: "left",editable: false,
                    editoptions: {
                        size: 60,
                        maxlength:255
                    }
                },
                {label: 'Update Date',name: 'updated_date',width: 150, align: "left",editable: false,
                    editoptions: {
                        size: 60,
                        maxlength:255
                    }
                },

                {label: 'Kota', name: 'kota', width: 5, editable: false, hidden: true},
                {label: 'No', name: 'address_no_owner', width: 5, editable: false, hidden: true},
                {label: 'RT', name: 'address_rt_owner', width: 5, editable: false, hidden: true},
                {label: 'RW', name: 'address_rw_owner', width: 5, editable: false, hidden: true},
                {label: 'Address', name: 'address_name_owner', width: 5, editable: false, hidden: true},
                {label: 'Kecamatan', name: 'kecamatan', width: 5, editable: false, hidden: true},
                {label: 'Kelurahan', name: 'kelurahan', width: 5, editable: false, hidden: true},
                {label: 'Telepon', name: 'phone_no_owner', width: 5, editable: false, hidden: true},
                {label: 'Fax', name: 'fax_no_owner', width: 5, editable: false, hidden: true},
                {label: 'Kode Pos', name: 'zip_code_owner', width: 5, editable: false, hidden: true},
                {label: 'Jabatan', name: 'code', width: 5, editable: false, hidden: true}
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
                /*tadinya untuk mengambil page agar pas kembali ke tab satu tetep select data yang dipilih di awal*/

                /*var t_customer_id = "<?php //echo $this->input->post('t_customer_id'); ?>";
                var rowIds = $(this).jqGrid('getDataIDs');
                /*var pagenumber = $('#grid-table').getGridParam('page');;
                var pagenumber2 = $(this).trigger("reloadGrid",[{page: pagenumber}]);
                alert(rowIds+" - "+pagenumber+" - "+pagenumber2);

                if (/*some condition) {
                    setTimeout(function () {
                        $(this).trigger("reloadGrid",[{page: pagenum}]);
                    }, 50);
                }
               

                for (i = 1; i <= rowIds.length; i++) {
                    rowData = $(this).jqGrid('getRowData', i);                    

                    if (rowData['t_customer_id'] == t_customer_id ) {
                        
                       $(this).jqGrid('setSelection',i);
                       //alert("test");
                       
                        return;

                    }else{
                        $(this).jqGrid('setSelection',1);
                    } //if

                }*/ //for

                //var t_customer_id = "<?php //echo $this->input->post('t_customer_id'); ?>";
                /*if (t_customer_id != ""){
                    setTimeout(function(){
                      $("#grid-table").setSelection($("#grid-table").getDataIDs()[t_customer_id],true);
                    },500);
                }else{
                    setTimeout(function(){
                      $("#grid-table").setSelection($("#grid-table").getDataIDs()[0],true);
                    },500);
                }*/
                setTimeout(function(){
                      $("#grid-table").setSelection($("#grid-table").getDataIDs()[0],true);
                },500);

                //alert(rowid);

            },
            //memanggil controller jqgrid yang ada di controller crud
            editurl: '<?php echo WS_JQGRID."data_master.t_customer_update_controller/read"; ?>',
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

    function setDaftar_customer(rowid){
        var t_customer_id = $('#grid-table').jqGrid('getCell', rowid, 't_customer_id');
        var t_cust_account_id = $('#grid-table').jqGrid('getCell', rowid, 't_cust_account_id');
        var company_owner = $('#grid-table').jqGrid('getCell', rowid, 'company_owner');
        var code = $('#grid-table').jqGrid('getCell', rowid, 'code');
        var address_name_owner = $('#grid-table').jqGrid('getCell', rowid, 'address_name_owner');
        var address_no_owner = $('#grid-table').jqGrid('getCell', rowid, 'address_no_owner');
        var address_rt_owner = $('#grid-table').jqGrid('getCell', rowid, 'address_rt_owner');
        var address_rw_owner = $('#grid-table').jqGrid('getCell', rowid, 'address_rw_owner');
        var kota = $('#grid-table').jqGrid('getCell', rowid, 'kota');
        var kelurahan = $('#grid-table').jqGrid('getCell', rowid, 'kelurahan');
        var kecamatan = $('#grid-table').jqGrid('getCell', rowid, 'kecamatan');
        var phone_no_owner = $('#grid-table').jqGrid('getCell', rowid, 'phone_no_owner');
        var fax_no_owner = $('#grid-table').jqGrid('getCell', rowid, 'fax_no_owner');
        var mobile_no_owner = $('#grid-table').jqGrid('getCell', rowid, 'mobile_no_owner');
        var email_address = $('#grid-table').jqGrid('getCell', rowid, 'email_address');
        var zip_code_owner = $('#grid-table').jqGrid('getCell', rowid, 'zip_code_owner');

        $('#t_customer_id').val(t_customer_id);
        $('#t_cust_account_id').val(t_cust_account_id);
        $('#company_owner').val(company_owner);
        $('#code').val(code);
        $('#address_name_owner').val(address_name_owner);
        $('#address_no_owner').val(address_no_owner);
        $('#address_rt_owner').val(address_rt_owner);
        $('#address_rw_owner').val(address_rw_owner);
        $('#kota').val(kota);
        $('#kelurahan').val(kelurahan);
        $('#kecamatan').val(kecamatan);
        $('#phone_no_owner').val(phone_no_owner);
        $('#fax_no_owner').val(fax_no_owner);
        $('#mobile_no_owner').val(mobile_no_owner);
        $('#email_address').val(email_address);
        $('#zip_code_owner').val(zip_code_owner);
    }

</script>
<br>
<label class="control-label col-md-2"><b>Daftar Customer</b></label>
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
