<link href="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Laporan Permohonan BPHTB Pengurangan</span>
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
                    <span class="caption-subject font-blue bold uppercase"> Laporan Permohonan BPHTB Pengurangan
                    </span>
                </div>
            </div>
            <!-- CONTENT  value="2015-09-01" -->
            <div class="form-body">
                <div class="row">                    
                    <label class="control-label col-md-2">Tanggal</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 " name="date_start_laporan" id="date_start_laporan"  >                 
                        </div>
                    </div>
                    <label class="control-label col-md-1">s/d</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 " name="date_end_laporan" id="date_end_laporan"  >
                        </div>
                    </div>
                </div>  

                <div class="space-2"></div>
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">No Transaksi 
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="receipt_no" id="receipt_no" >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">NOP  
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="njop_pbb" id="njop_pbb" >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Nama  
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="wp_name" id="wp_name" >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">kecamatan
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="p_region_id_kecamatan" maxlength="8" id="p_region_id_kecamatan" readonly>
                                <input type="text" class="form-control" name="nama_kecamatan" id="nama_kecamatan" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-kecamatan">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-2"></div>
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Kelurahan
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="p_region_id_kelurahan" maxlength="8" id="p_region_id_kelurahan" readonly>
                                <input type="text" class="form-control" name="nama_kelurahan" id="nama_kelurahan" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-kelurahan">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Jenis Transaksi  
                        </label>
                        <div class="col-md-3">
                           <div id="comboJenisTransaksi"></div>
                        </div>
                    </div>
                </div>


                <div class="space-2"></div>
                <div class="row col-md-offset-4">
                    <button class="btn btn-primary" type="button" onclick="toTampil()" id="tampil">Tampilkan</button>
                    <button class="btn btn-danger" type="button" onclick="toExcel()" id="excel">Download Excel</button>
                    <button class="btn btn-outline green" type="button" onclick="toReset()" id="reset">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-content no-border" id="table">
    <div class="row">
        <div class="col-xs-12">
            <div id="gbox_grid-table" class="ui-jqgrid">
                <div id="gview_grid-table" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table"></table>
                   <!--  <div id="grid-pager"></div> -->
                </div>
            </div>            
        </div>
    </div>
</div>

<?php $this->load->view('lov/lov_kec'); ?>
<?php $this->load->view('lov/lov_kel'); ?>

<script >
    //tanggal 
    $('.datepicker1').datetimepicker({
        format: 'YYYY-MM-DD',
        // defaultDate: new Date()
    });

    $('#table').css('display', 'none');

    $("#btn-lov-kecamatan").on('click', function() { 
        var kota = 749;  // id kota sama dengan cocas yaitu id dari kota bandung

        if( kota == null || kota == ''){
            swal({title: "Error!", text: "Isi Kota/Kabupaten Terlebih Dahulu", html: true, type: "error"});
            return;
        }
        modal_lov_kecamatan_show('p_region_id_kecamatan','nama_kecamatan',kota);        
    });

    $('#p_region_id_kecamatan').on('change', function() {
        $('#p_region_id_kelurahan').val('');
        $('#nama_kelurahan').val('');
    });

    $("#btn-lov-kelurahan").on('click', function() { 
        var kec = $('#p_region_id_kecamatan').val();
        if( kec == null || kec == ''){
            swal({title: "Error!", text: "Isi Kecamatan Terlebih Dahulu", html: true, type: "error"});
             return;
        }
        modal_lov_kelurahan_show('p_region_id_kelurahan','nama_kelurahan',kec);
    });

    $.ajax({
            url: "<?php echo base_url().'bphtb_registration/load_combo_jenis_transaksi'; ?>" ,
            type: "POST",            
            data: {},
            success: function (data) {
                $( "#comboJenisTransaksi" ).html( data );
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
            }
    });

    

</script>

<script type="text/javascript">
    

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_laporan_permohonan_bphtb_pengurangan_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'Nama Pemohon',name: 'wp_name',width: 200, align: "left"},
                {name: 'Alamat',width: 300, align: "center",
                    formatter:function(cellvalue, options, rowObject) {

                        var wp_address_name = rowObject['wp_address_name'];
                        var kelurahan_name = rowObject['kelurahan_name'];
                        var kecamatan_name = rowObject['kecamatan_name'];
                        var kota_name = rowObject['kota_name'];

                        var alamat = wp_address_name+"<br>"+kelurahan_name+"<br>"+kecamatan_name+"<br>"+kota_name;
                        
                        return '<div>'+alamat+'</div>';

                    }
                },
                {label: 'NOP PBB',name: 'njop_pbb',width: 150, align: "left"},
                {name: 'Letak Tanah dan Bangunan',width: 300, align: "center",
                    formatter:function(cellvalue, options, rowObject) {

                        var wp_address_name = rowObject['object_address_name'];
                        var kelurahan_name = rowObject['object_kelurahan_name'];
                        var kecamatan_name = rowObject['object_kecamatan_name'];
                        var kota_name = rowObject['object_kota_name'];

                        var alamat = wp_address_name+"<br>"+kelurahan_name+"<br>"+kecamatan_name+"<br>"+kota_name;
                        
                        return '<div>'+alamat+'</div>';

                    }
                },
                {label: 'Akta/Risalah Lelang/Kep. Pemberian Hak/Dokumen lainnya',name: 'keterangan_opsi_c',width: 430, align: "left"},
                {label: 'NJOP (Rp)',name: 'njop',width: 150, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'BPHTB TERHUTANG (Rp)',name: 'bphtb_amt',width: 180, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'PENGURANGAN (Rp)',name: 'bphtb_discount',width: 180,summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'TANGGAL MENGAJUKAN PERMOHONAN',name: 'creation_date',width: 300, align: "center"},

            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: -1,
            rowList: [10,20,50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            footerrow: true,
            gridComplete: function() {
                var $grid = $('#grid-table');
                var njop = $grid.jqGrid('getCol', 'njop', false, 'sum');
                var bphtb_amt = $grid.jqGrid('getCol', 'bphtb_amt', false, 'sum');
                var bphtb_discount = $grid.jqGrid('getCol', 'bphtb_discount', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'njop': njop,
                                                    'bphtb_amt':bphtb_amt,
                                                    'bphtb_discount':bphtb_discount

                 });
            },
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
            caption: "Laporan Hasil Validasi BPHTB"

        });

        

    });

    function responsive_jqgrid(grid_selector, pager_selector) {
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );
    }

    

    function toTampil(){
        var date_start_laporan        = $('#date_start_laporan').val();        
        var date_end_laporan          = $('#date_end_laporan').val();
        var receipt_no                = $('#receipt_no').val();
        var njop_pbb                  = $('#njop_pbb').val();
        var wp_name                   = $('#wp_name').val();
        var p_region_id_kecamatan     = $('#p_region_id_kecamatan').val();
        var p_region_id_kelurahan     = $('#p_region_id_kelurahan').val();
        var p_bphtb_legal_doc_type_id = $('#p_bphtb_legal_doc_type_id').val();

        
        if( date_start_laporan == "" && 
            date_end_laporan == "" && 
            receipt_no == "" &&
            njop_pbb == "" &&
            wp_name == "" &&
            p_region_id_kecamatan == "" &&
            p_region_id_kelurahan == "" &&
            p_bphtb_legal_doc_type_id == "" ){            
            swal ( "Oopss" ,  "Harus Terisi Salah Satu!" ,  "error" );
            return;
        }else{
            if (date_start_laporan != "" && date_end_laporan == ""){
                swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
                return;
            }
            if (date_start_laporan == "" && date_end_laporan != ""){
                swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
                return;
            }

            if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal awal harus lebih besar dari tanggal akhir" ,  "error" );
                return;
            }else{
                $('#table').css('display', '');
                jQuery(function($) {
                    var grid_selector = "#grid-table";

                    jQuery("#grid-table").jqGrid('setGridParam',{
                        url: '<?php echo WS_JQGRID."transaksi.t_laporan_permohonan_bphtb_pengurangan_controller/read"; ?>',
                        postData: {date_start_laporan:date_start_laporan,date_end_laporan:date_end_laporan,receipt_no:receipt_no,njop_pbb:njop_pbb,wp_name:wp_name,p_region_id_kecamatan:p_region_id_kecamatan,p_region_id_kelurahan:p_region_id_kelurahan,p_bphtb_legal_doc_type_id:p_bphtb_legal_doc_type_id}
                    });
                    $("#grid-table").jqGrid("setCaption", " Laporan Permohonan BPHTB Pengurangan");
                    $("#grid-table").trigger("reloadGrid");
                });
            }
            
        }

        
    
    }
</script>

<script>
    function toReset(){
        $('#date_start_laporan').val('');
        $('#date_end_laporan').val('');
        $('#receipt_no').val('');
        $('#njop_pbb').val('');
        $('#wp_name').val('');

        $('#p_region_id_kecamatan').val('');
        $('#nama_kecamatan').val('');
        $('#p_region_id_kelurahan').val('');
        $('#nama_kelurahan').val('');

        $('#p_bphtb_legal_doc_type_id').val('');

    }

    function toExcel(){
        var date_start_laporan        = $('#date_start_laporan').val();        
        var date_end_laporan          = $('#date_end_laporan').val();
        var receipt_no                = $('#receipt_no').val();
        var njop_pbb                  = $('#njop_pbb').val();
        var wp_name                   = $('#wp_name').val();
        var p_region_id_kecamatan     = $('#p_region_id_kecamatan').val();
        var p_region_id_kelurahan     = $('#p_region_id_kelurahan').val();
        var p_bphtb_legal_doc_type_id = $('#p_bphtb_legal_doc_type_id').val();
        

        if( date_start_laporan == "" && 
            date_end_laporan == "" && 
            receipt_no == "" &&
            njop_pbb == "" &&
            wp_name == "" &&
            p_region_id_kecamatan == "" &&
            p_region_id_kelurahan == "" &&
            p_bphtb_legal_doc_type_id == "" ){            
            swal ( "Oopss" ,  "Harus Terisi Salah Satu!" ,  "error" );
            return;
        }else{
            if (date_start_laporan != "" && date_end_laporan == ""){
                swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
                return;
            }
            if (date_start_laporan == "" && date_end_laporan != ""){
                swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
                return;
            }

            var url = "<?php echo WS_JQGRID . "transaksi.t_laporan_permohonan_bphtb_pengurangan_controller/excel/?"; ?>";
            url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            url += "&date_start_laporan=" + date_start_laporan;
            url += "&date_end_laporan=" + date_end_laporan;
            url += "&receipt_no=" + receipt_no;
            url += "&njop_pbb=" + njop_pbb;
            url += "&wp_name=" + wp_name;
            url += "&p_region_id_kecamatan=" + p_region_id_kecamatan;
            url += "&p_region_id_kelurahan=" + p_region_id_kelurahan;
            url += "&p_bphtb_legal_doc_type_id=" + p_bphtb_legal_doc_type_id;

            if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal awal harus lebih besar dari tanggal akhir" ,  "error" );
                return;
            }else{
                window.location = url;
            }
            
        }
    }
</script>
