<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">PPAT</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Daftar PPAT</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <div class="tabbable tabbable-tabdrop">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab"> PPAT </a>
                </li>
                <li id="tab-2">
                    <a data-toggle="tab"> PPAT USER  </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <table id="grid-table"></table>
                    <div id="grid-pager"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="space-4"></div>
<div class="panel panel-primary">
    <div class="panel-heading"  id="captionDetail">ADD INFORMASI DETAIL PPAT</div>
    <div class="panel-body">
        <div class="form-body">
            <div class="row">
                <label class="control-label col-md-3">Nama PPAT</label>
                <div class="col-md-5">
                    <input type="hidden" class="form-control" name="t_ppat_id" id="t_ppat_id" readonly="true">
                    <input type="text" class="form-control required" required name="ppat_name" id="ppat_name" >   
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Alamat Lokasi</label>
                <div class="col-md-5">
                    <!-- <input type="text" class="form-control required" required name="address_name" id="address_name" > -->
                    <textarea rows="4" cols="50" class="form-control required" required  name="address_name" id="address_name"></textarea>
                </div>
            </div>
            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">No Lokasi</label>
                <div class="col-md-5">
                    <input type="text" class="form-control required" required name="address_no" id="address_no" >   
                </div>
            </div>
            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">RT/RW</label>
                <div class="col-md-3">
                    <div class="input-group ">
                        <input type="text" class="form-control" name="address_rt" id="address_rt">
                        <span class="input-group-addon"> / </span>
                        <input type="text" class="form-control" name="address_rw" id="address_rw">
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Kota/Kabupaten</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="hidden" class="form-control required" name="p_region_id" id="p_region_id" readonly>
                        <input type="text" class="form-control required" name="kota" id="kota" readonly>
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button" id="btn-lov-kota">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">kecamatan</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="hidden" class="form-control required" name="p_region_id_kec" id="p_region_id_kec" readonly>
                        <input type="text" class="form-control required" name="kecamatan" id="kecamatan" readonly>
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button" id="btn-lov-kec">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Kelurahan</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="hidden" class="form-control required" name="p_region_id_kel" id="p_region_id_kel" readonly>
                        <input type="text" class="form-control required" name="kelurahan" id="kelurahan" readonly>
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button" id="btn-lov-kel">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">No Identifikasi</label>
                <div class="col-md-2">
                   <div id="comboDoc"></div>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control required" required name="identification_no" id="identification_no">
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">No. Telpon</label>
                <div class="col-md-5">
                    <input type="text" class="form-control "  name="phone_no" id="phone_no" >   
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">No. Handphone</label>
                <div class="col-md-5">
                    <input type="text" class="form-control required" required name="mobile_no" id="mobile_no" >   
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">No. Fax</label>
                <div class="col-md-5">
                    <input type="text" class="form-control "  name="fax_no" id="fax_no" >   
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Kode Pos</label>
                <div class="col-md-5">
                    <input type="text" class="form-control "  name="zip_code" id="zip_code" >   
                </div>
            </div>

            <div class="space-2"></div>
            <div class="row">
                <label class="control-label col-md-3">Email</label>
                <div class="col-md-5">
                    <input type="text" class="form-control "  name="email_address" id="email_address" >   
                </div>
            </div>


            <div class="space-2"></div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <a href="javascript:;" class="btn btn-outline green button-next" id="btn-tambah">Tambah
                        </a>
                        <a href="javascript:;" class="btn  btn-primary " id="btn-update"> Simpan
                        </a>
                        <a href="javascript:;" class="btn  btn-primary " id="btn-insert"> Simpan
                        </a>
                        <a href="javascript:;" class="btn  btn-danger " id="btn-delete"> Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $this->load->view('lov/lov_kota'); ?>
<?php $this->load->view('lov/lov_kec'); ?>
<?php $this->load->view('lov/lov_kel'); ?>

<script>

    $('#btn-insert').css('display','');
    $('#btn-delete').css('display','none');
    $('#btn-update').css('display','none');
    $('#btn-tambah').css('display','none');

    $(function($) {
        $("#tab-2").on( "click", function() {
            var grid = $('#grid-table');
            selRowId = grid.jqGrid ('getGridParam', 'selrow');

            var t_ppat_id = grid.jqGrid ('getCell', selRowId, 't_ppat_id');

            if(selRowId == null) {
                swal("Informasi", "Silahkan Pilih Salah Satu Baris Data", "info");
                return false;
            }

            loadContentWithParams("transaksi.t_ppat_user", {
                t_ppat_id: t_ppat_id
            });
        });
    });

    $.ajax({
        url: "<?php echo WS_JQGRID."transaksi.t_ppat_controller/readDataCombo"; ?>" ,
        type: "POST",
        dataType: "json",
        data: {},
        success: function (data) {
            console.log(data.items);
            $("#comboDoc").html(data.items);
        },
        error: function (xhr, status, error) {
            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
        }
    });

    $("#btn-lov-kota").on('click', function() {
        modal_lov_kota_show('p_region_id','kota');
    });

    $('#p_region_id').on('change', function() {
        $('#p_region_id_kec').val('');
        $('#kecamatan').val('');
        $('#p_region_id_kel').val('');
        $('#kelurahan').val('');
    });

    $("#btn-lov-kec").on('click', function() {
        var kota = $('#p_region_id').val();
        //alert(kota);
        if( kota == null || kota == ''){
            swal({title: "Error!", text: "Isi Kota/Kabupaten Terlebih Dahulu", html: true, type: "error"});
            return;
        }
         modal_lov_kecamatan_show('p_region_id_kec','kecamatan',kota);

    });

    $('#p_region_id_kec').on('change', function() {
        $('#p_region_id_kel').val('');
        $('#kelurahan').val('');
    });

    $("#btn-lov-kel").on('click', function() {
        var kec = $('#p_region_id_kec').val();
        if( kec == null || kec == ''){
            swal({title: "Error!", text: "Isi Kecamatan Terlebih Dahulu", html: true, type: "error"});
             return;
        }
        modal_lov_kelurahan_show('p_region_id_kel','kelurahan',kec);
    });

    function showUser(t_ppat_id) {
        loadContentWithParams("transaksi.t_ppat_user", {t_ppat_id: t_ppat_id });
    }

    

</script>

<script>
   $('#btn-tambah').on('click',function(){
        $('#t_ppat_id').val(null);
        $('#ppat_name').val(null);
        $('#address_name').val(null);
        $('#address_no').val(null);
        $('#address_rt').val(null);
        $('#address_rw').val(null);
        $('#kota').val(null);
        $('#p_region_id').val(null);
        $('#kecamatan').val(null);
        $('#p_region_id_kec').val(null);
        $('#kelurahan').val(null);
        $('#p_region_id_kel').val(null);
        $('#personal_identification_id').val(null);
        $('#identification_no').val(null);
        $('#phone_no').val(null);
        $('#mobile_no').val(null);
        $('#fax_no').val(null);
        $('#zip_code').val(null);
        $('#email_address').val(null);
        
        $('#btn-insert').css('display','');
        $('#btn-delete').css('display','none');
        $('#btn-update').css('display','none');
        $('#btn-tambah').css('display','none');
        $('#captionDetail').text('ADD INFORMASI DETAIL PPAT');
    });

    function crud(oper){
        var t_ppat_id = $('#t_ppat_id').val();
        var ppat_name = $('#ppat_name').val();
        var address_name = $('#address_name').val();
        var address_no = $('#address_no').val();
        var address_rt = $('#address_rt').val();
        var address_rw = $('#address_rw').val();
        var kota = $('#kota').val();
        var p_region_id = $('#p_region_id').val();
        var kecamatan = $('#kecamatan').val();
        var p_region_id_kec = $('#p_region_id_kec').val();
        var kelurahan = $('#kelurahan').val();
        var p_region_id_kel = $('#p_region_id_kel').val();
        var personal_identification_id = $('#personal_identification_id').val();
        var identification_no = $('#identification_no').val();
        var phone_no = $('#phone_no').val();
        var mobile_no = $('#mobile_no').val();
        var fax_no = $('#fax_no').val();
        var zip_code = $('#zip_code').val();
        var email_address = $('#email_address').val();
        
        var item = {t_ppat_id:t_ppat_id,
                    ppat_name:ppat_name,
                    address_name:address_name,
                    address_no:address_no,
                    address_rt:address_rt,
                    address_rw:address_rw,
                    kota:kota,
                    p_region_id:p_region_id,
                    kecamatan:kecamatan,
                    p_region_id_kec:p_region_id_kec,
                    kelurahan:kelurahan,
                    p_region_id_kel:p_region_id_kel,
                    personal_identification_id:personal_identification_id,
                    identification_no:identification_no,
                    phone_no:phone_no,
                    mobile_no:mobile_no,
                    fax_no:fax_no,
                    zip_code:zip_code,
                    email_address:email_address,
                    };

        var itemJSON = JSON.stringify(item);

        if (oper=='del')
            itemJSON = t_ppat_id;

        $.ajax({
            url: "<?php echo WS_JQGRID."transaksi.t_ppat_controller/crud"; ?>" ,
            type: "POST",
            dataType: "json",
            data: {items:itemJSON,oper:oper},
            success: function (data) {
                if (data.success){
                    swal({title: "Informasi!", text: data.message, html: true, type: "info"});
                    $("#grid-table").trigger("reloadGrid");
                }else{
                    swal({title: "Error!", text: data.message, html: true, type: "error"});
                }
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
            }
        });
    }

    $('#btn-insert').on('click',function(){
        crud('add');
    }); 

    $('#btn-update').on('click',function(){
        crud('edit');
    });

    $('#btn-delete').on('click',function(){
        swal(
            {
              title: "Apakah anda Ingin Menghapus Data Ini?",
              text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Iya!",
              closeOnConfirm: false
            },
            function(){
                crud('del');
            }
        );
    }); 

</script>

<script>
    function setDaftar_ppat(rowid){
        var t_ppat_id = $('#grid-table').jqGrid('getCell', rowid, 't_ppat_id');
        var ppat_name = $('#grid-table').jqGrid('getCell', rowid, 'ppat_name');
        var address_name = $('#grid-table').jqGrid('getCell', rowid, 'address_name');
        var address_no = $('#grid-table').jqGrid('getCell', rowid, 'address_no');
        var address_rt = $('#grid-table').jqGrid('getCell', rowid, 'address_rt');
        var address_rw = $('#grid-table').jqGrid('getCell', rowid, 'address_rw');
        var kota = $('#grid-table').jqGrid('getCell', rowid, 'kota');
        var p_region_id = $('#grid-table').jqGrid('getCell', rowid, 'p_region_id');
        var kecamatan = $('#grid-table').jqGrid('getCell', rowid, 'kecamatan');
        var p_region_id_kec = $('#grid-table').jqGrid('getCell', rowid, 'p_region_id_kec');
        var kelurahan = $('#grid-table').jqGrid('getCell', rowid, 'kelurahan');
        var p_region_id_kel = $('#grid-table').jqGrid('getCell', rowid, 'p_region_id_kel');

        var personal_identification_id = $('#grid-table').jqGrid('getCell', rowid, 'personal_identification_id');
        var identification_no = $('#grid-table').jqGrid('getCell', rowid, 'identification_no');
        var phone_no = $('#grid-table').jqGrid('getCell', rowid, 'phone_no');
        var mobile_no = $('#grid-table').jqGrid('getCell', rowid, 'mobile_no');
        var fax_no = $('#grid-table').jqGrid('getCell', rowid, 'fax_no');
        var zip_code = $('#grid-table').jqGrid('getCell', rowid, 'zip_code');
        var email_address = $('#grid-table').jqGrid('getCell', rowid, 'email_address');
        
        $('#t_ppat_id').val(t_ppat_id);
        $('#ppat_name').val(ppat_name);
        $('#address_name').val(address_name);
        $('#address_no').val(address_no);
        $('#address_rt').val(address_rt);
        $('#address_rw').val(address_rw);
        $('#kota').val(kota);
        $('#p_region_id').val(p_region_id);
        $('#kecamatan').val(kecamatan);
        $('#p_region_id_kec').val(p_region_id_kec);
        $('#kelurahan').val(kelurahan);
        $('#p_region_id_kel').val(p_region_id_kel);
        $('#personal_identification_id').val(personal_identification_id);
        $('#identification_no').val(identification_no);
        $('#phone_no').val(phone_no);
        $('#mobile_no').val(mobile_no);
        $('#fax_no').val(fax_no);
        $('#zip_code').val(zip_code);
        $('#email_address').val(email_address);
    }
</script>


<script>

    $(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        $("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_ppat_controller/crud"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'Nama PPAT',name: 'ppat_name', width: 250},
                {label: 'Alamat',name: 'address_name', width: 320},
                {label: 'No Indentifikasi',name: 'identification_no', width: 200},
                {label: 'Pengubah',name: 'updated_by', width: 200},
                {label: 'Tanggal Ubah',name: 'updated_date', width: 200},
                {label: 'User',width: 120, align: "center",editable: false,
                    formatter: function(cellvalue, options, rowObject) {
                        return '<a href="#" onclick="showUser('+rowObject['t_ppat_id']+');"> <i class="fa fa-folder bigger-120"></i> </a>';
                    }
                },

                // Kebutuhan Form
                {label: 'ID',name: 't_ppat_id', key: true, width: 35,  hidden:true},
                {label: 'No Lokasi',name: 'address_no', width: 200, sortable: true, hidden:true},
                {label: 'RT',name: 'address_rt', width: 200, sortable: true, hidden:true},
                {label: 'RW',name: 'address_rw', width: 200, sortable: true, hidden:true},
                {label: 'Jenis Indentitas',name: 'personal_identification_id', width: 100,hidden:true},
                {label: 'kota',name: 'kota',  width: 35,hidden:true},
                {label: 'kota ID',name: 'p_region_id',  width: 35,hidden:true},
                {label: 'kecamatan',name: 'kecamatan',  width: 35,hidden:true},
                {label: 'kecamatan ID',name: 'p_region_id_kec',  width: 35,hidden:true},
                {label: 'kelurahan',name: 'kelurahan',  width: 35,hidden:true},
                {label: 'kelurahan id',name: 'p_region_id_kel',  width: 35,hidden:true},
                {label: 'No. Telpon',name: 'phone_no', width: 200, hidden:true},
                {label: 'No. Handphone',name: 'mobile_no', width: 200, hidden:true},
                {label: 'No. Fax',name: 'fax_no', width: 200,  hidden:true},
                {label: 'Kode Pos',name: 'zip_code', width: 200,  hidden:true},
                {label: 'Email',name: 'email_address', width: 200,  hidden:true}
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
                setDaftar_ppat(rowid);

                $('#btn-insert').css('display','none');
                $('#btn-delete').css('display','');
                $('#btn-update').css('display','');
                $('#btn-tambah').css('display','');

                $('#captionDetail').text('INFORMASI DETAIL PPAT');
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
            editurl: '<?php echo WS_JQGRID."transaksi.t_ppat_controller/crud"; ?>',
            caption: "DAFTAR PPAT"

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

    



</script>