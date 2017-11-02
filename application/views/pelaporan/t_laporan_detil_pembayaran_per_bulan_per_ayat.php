<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>LAPORAN DETIL PEMBAYARAN PER JENIS DAN MASA PAJAK  </span>
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
                    <span class="caption-subject font-blue bold uppercase"> LAPORAN DETIL PEMBAYARAN PER JENIS DAN MASA PAJAK  
                    </span>
                </div>
            </div>
            <!-- CONTENT PORTLET -->
            <div class="form-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-2">Periode Tahun
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="hidden" class="form-control required" maxlength="8" name="p_year_period_id" id="p_year_period_id" readonly>
                                <input type="text" class="form-control required" name="year_code" id="year_code" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-year-period">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Tanggal Penerimaan
                        </label>
                        <div class="col-md-3">
                            <input class="form-control datepicker required " type="text" value=""
                                   id="tanggal_penerimaan" name="tanggal_penerimaan">
                        </div>
                        <label class=" contol-label col-xs-1"><span>s.d.</span></label>
                        <div class="col-md-3">
                            <input class="form-control datepicker required" type="text" value=""
                                   id="tanggal_penerimaan_last" name="tanggal_penerimaan_last">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Jenis WP
                        </label>
                        <div class="col-md-3">
                           <select id= "jenis_wp" name= "jenis_wp" class='form-control required'>
                               <option value="1">Semua </option>
                               <option value="2">Hanya NPWPD Jabatan</option>
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Wilayah
                        </label>
                        <div class="col-md-3">
                           <div id="comboBoxWilayah"></div>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" class="form-control required" name="business_area_name" id="business_area_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-5">
                            <button class="btn btn-danger" id="cetak">Tampilkan</button>
                            <button class="btn btn-danger" id="cetakExcel">Tampilkan Excel</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                     <div class="col-xs-12">
                        <div id="gbox_grid-table" class="ui-jqgrid">
                            <div id="gview_grid-table" class="ui-jqgrid-view table-responsive" role="grid">
                                <!-- <h2 style="color:black;" align="center">PEMBAYARAN PAJAK HOTEL, RESTORAN, HIBURAN, PARKIR, DAN PPJ</h2>
                                <h2 style="color:black;" align="center">NPWPD JABATAN</h2>
                                <h2 style="color:black;" align="center">KOTA BANDUNG</h2> -->
                                <table id="grid-table"></table>
                                <div id="grid-pager"></div>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('lov/lov_vat_type'); ?>
<?php $this->load->view('lov/lov_year_period'); ?>
<!--- lov -->
<script>
    $("#btn-lov-jenis-pajak").on('click', function() {   
        modal_lov_vat_show('p_vat_type_id','vat_code');
    });

    $("#btn-lov-year-period").on('click', function() {   
        modal_year_period_show('p_year_period_id','year_code');
    });
</script>
<script>
    $.ajax({
        url: "<?php echo base_url().'Laporan_pembayaran_berdasarkan_cara_bayar_dan_ketetapan/comboBoxWilayah/'; ?>" ,
        type: "POST",            
        data: {},
        success: function (data) {
            $( "#comboBoxWilayah" ).html( data );
        },
        error: function (xhr, status, error) {
            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
        }
    });

    $('#gview_grid-table').hide();
    jQuery(function ($) {
            var grid_selector = "#grid-table";
            var pager_selector = "#grid-pager";

            jQuery("#grid-table").jqGrid({
                url: '<?php echo WS_JQGRID . "pelaporan.t_laporan_detil_pembayaran_per_bulan_per_ayat_controller/read"; ?>',
                datatype: "json",
                mtype: "POST",
                colModel: [
                    {label: 'JENIS PAJAK',name: 'jenis_pajak',width: 150,sorttype: 'text'},
                    {label: 'URAIAN JENIS PAJAK',name: 'ayat_pajak', width: 200,sorttype: 'text'},
                    {label: 'NPWPD',name: 'npwd',width: 150,sorttype: 'text'},
                    {label: 'OBJEK PAJAK',name: 'company_brand',width: 300,sorttype: 'text'},
                    {label: 'ALAMAT',name: 'brand_address_name',width: 200,sorttype: 'text'},
                    {label: 'MASA PAJAK',name: 'masa_pajak', width: 150,sorttype: 'text'},
                    {label: 'TOTAL BAYAR',name: 'payment_amount',width: 150, align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}
                    },
                    {label: 'TANGGAL BAYAR',name: 'tanggal_bayar',width: 150,sorttype: 'text'},
                    {label: 'WILAYAH',name : 'wilayah',width: 250,sorttype: 'text'}
                ],
                height: '100%',
                autowidth: false,
                viewrecords: true,
                rowNum: -1,
                rowList: [10, 20, 50],
                rownumbers: true, // show row numbers
                rownumWidth: 35, // the width of the row numbers columns
                altRows: true,
                shrinkToFit: false,
                multiboxonly: true,
                footerrow: true,
                gridComplete: function() {
                    var $grid = $('#grid-table');

                    /*var colSum2 = $grid.jqGrid('getCol', 'payment_amount', false, 'sum');
                    $grid.jqGrid('footerData', 'set', { kode_wilayah : 'JUMLAH ', 'payment_amount': colSum2 });*/
                },
                loadComplete: function (response) {
                    if(response.success == false) {
                        swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                    }

                },
                caption: "LAPORAN DETIL PEMBAYARAN PER JENIS DAN MASA PAJAK"

            });

            jQuery('#grid-table').jqGrid('navGrid', '#grid-pager',
                {   //navbar options
                    edit: false,
                    editicon: 'fa fa-pencil blue bigger-120',
                    add: false,
                    addicon: 'fa fa-plus-circle purple bigger-120',
                    del: false,
                    delicon: 'fa fa-trash-o red bigger-120',
                    search: false,
                    searchicon: 'fa fa-search orange bigger-120',
                    refresh: false,
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


    $('#cetak').on('click', function() {
    //function showData(){
        //alert('masuk');
        var p_year_period_id = $('#p_year_period_id').val();
        var tanggal_penerimaan = $('#tanggal_penerimaan').val();
        var tanggal_penerimaan_last = $('#tanggal_penerimaan_last').val();
        //alert(tanggal_penerimaan+' s.d '+tanggal_penerimaan_last);
        if(p_year_period_id == "" || tanggal_penerimaan == "" || tanggal_penerimaan_last == ""){            
            swal ( "Oopss" ,  "Semua Filter Harus Diisi !" ,  "error" );
        }else{
            if (tanggal_penerimaan_last < tanggal_penerimaan){
                swal ( "Oopss" ,  "Tanggal akhir harus lebih besar dari tanggal awal !" ,  "error" );
                return;
            }else{
                $('#gview_grid-table').show();
                jQuery(function($) {
                    var grid_selector = "#grid-table";

                    jQuery("#grid-table").jqGrid('setGridParam',{
                        url: '<?php echo WS_JQGRID . "pelaporan.t_laporan_detil_pembayaran_per_bulan_per_ayat_controller/read"; ?>',
                        postData:{kode_wilayah : $('#business_area_name').val(),
                                  npwpd_jabatan : $('#jenis_wp').val(),
                                  tanggal_penerimaan : $('#tanggal_penerimaan').val(),
                                  tanggal_penerimaan_last : $('#tanggal_penerimaan_last').val()}
                    });
                    $("#grid-table").jqGrid("setCaption", "LAPORAN DETIL PEMBAYARAN PER JENIS DAN MASA PAJAK");
                    $("#grid-table").trigger("reloadGrid");
                });
            }
        }
        //$("#grid-table").trigger("reloadGrid");

    //}
    });

    $('#cetakExcel').on('click', function() {
    
        var p_year_period_id = $('#p_year_period_id').val();
        var tanggal_penerimaan = $('#tanggal_penerimaan').val();
        var tanggal_penerimaan_last = $('#tanggal_penerimaan_last').val();
        if(p_year_period_id == "" || tanggal_penerimaan == "" || tanggal_penerimaan_last == ""){            
            swal ( "Oopss" ,  "Semua Filter Harus Diisi !" ,  "error" );
        }else{
            if (tanggal_penerimaan_last < tanggal_penerimaan){
                swal ( "Oopss" ,  "Tanggal akhir harus lebih besar dari tanggal awal !" ,  "error" );
                return;
            }else{
                var url = "<?php echo WS_JQGRID . "pelaporan.t_laporan_detil_pembayaran_per_bulan_per_ayat_controller/excel/?"; ?>";
                url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                url += "&tanggal_penerimaan=" + tanggal_penerimaan;
                url += "&tanggal_penerimaan_last=" + tanggal_penerimaan_last;
                url += "&kode_wilayah=" + $('#business_area_name').val();
                url += "&npwpd_jabatan=" + $('#jenis_wp').val();
                //alert(url);
                window.location = url;
            }
        }
    });

    
    $('.datepicker').datepicker({
        todayHighlight: true,
        format: "dd-mm-yyyy",
        autoclose: true
    });

    function currencyFormat (num) {
        return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

</script>