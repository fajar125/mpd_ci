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
            <span>Validasi BPHTB</span>
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
                    
                    <span class="caption-subject font-blue bold uppercase"> Validasi BPHTB 
                    </span>
                </div>
            </div>
            <!-- CONTENT  value="2015-09-01" -->
            <div class="form-body">
                <div class="row">                    
                    <label class="control-label col-md-2">Tanggal</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 required" name="date_start_laporan" id="date_start_laporan">                 
                        </div>
                    </div>
                    <label class="control-label col-md-1">s/d</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 required" name="date_end_laporan" id="date_end_laporan">
                        </div>
                    </div>
                </div>  
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Nama WP</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_wp" id="nama_wp">                 
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row col-md-offset-5">
                    <button class="btn btn-primary" type="button" onclick="toTampil()">Tampilkan</button>
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
                    <!-- <div id="grid-pager"></div> -->
                </div>
            </div>            
        </div>
    </div>
</div>
<script >
    //tanggal 
    $('.datepicker1').datetimepicker({
        format: 'YYYY-MM-DD',
        // defaultDate: new Date()
    });

    $('#table').css('display', 'none');
</script>

<script type="text/javascript">    

    jQuery(function($) {
        var grid_selector = "#grid-table";
        //var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_laporan_rekap_bphtb_verifikasi_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                //{label: 'ID',name: 't_bphtb_registration_id',hidden:true, width: 180, align: "center"},
                {label: 'Tanggal',name: 'creation_date',width: 100, align: "left"},
                {label: 'No Registrasi',name: 'registration_no',width: 100, align: "left"},
                {label: 'Nama WP',name: 'wp_name',width: 200, align: "left"},
                {label: 'Jenis Transaksi',name: 'description',width: 150, align: "left"},
                {label: 'NOP',name: 'njop_pbb',width: 150, align: "left"},
                {label: 'LT/LB',name: 'land_area',width: 80, align: "right"},
                {label: 'HARGA TANAH (Rp)',name: 'land_total_price',width: 150, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'HARGA BANGUNAN (Rp)    ',name: 'building_total_price',width: 150, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'TOTAL NJOP (Rp)',name: 'nilai_njop',width: 150, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'HARGA PASAR TRANSAKSI LELANG (Rp)',name: 'market_price',width: 280, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'NILAI PAJAK YANG  HARUS DIBAYAR(Rp)',name: 'bphtb_amt_final',width: 280, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {name: 'Validasi',width: 100, align: "center",
                    formatter:function(cellvalue, options, rowObject) {

                        var t_bphtb_registration_id = rowObject['t_bphtb_registration_id'];
                        
                        return '<button class="btn btn-xs btn-danger" type="button" onclick="updateStatusVerifikasi('+t_bphtb_registration_id+')">Validasi</button>';

                    }
                }

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
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            //pager: '#grid-pager',
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
            caption: "Validasi BPHTB"

        });

        

    });

    function responsive_jqgrid(grid_selector, pager_selector) {
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );
    }

    

    function toTampil(){
        var date_start_laporan     = $('#date_start_laporan').val();        
        var date_end_laporan       = $('#date_end_laporan').val();
        var nama_wp                = $('#nama_wp').val();

        if(date_start_laporan == "" && date_end_laporan == ""){            
            swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
        }else{
            if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal awal harus lebih besar dari tanggal akhir" ,  "error" );
                return;
            }else{
                $('#table').css('display', '');
                jQuery(function($) {
                    var grid_selector = "#grid-table";

                    jQuery("#grid-table").jqGrid('setGridParam',{
                        url: '<?php echo WS_JQGRID."transaksi.t_laporan_rekap_bphtb_verifikasi_controller/read"; ?>',
                        postData: {date_start_laporan:date_start_laporan,
                                    date_end_laporan:date_end_laporan,
                                    nama_wp: nama_wp}
                    });
                    $("#grid-table").jqGrid("setCaption", "Validasi BPHTB");
                    $("#grid-table").trigger("reloadGrid");
                });
            }
            
        }        
    
    }
</script>

<script type="text/javascript">
    function updateStatusVerifikasi(t_bphtb_registration_id){
        var date_start_laporan     = $('#date_start_laporan').val();        
        var date_end_laporan       = $('#date_end_laporan').val();
        var nama_wp                = $('#nama_wp').val();

        swal({
           title: 'Anda Yakin Untuk Memvalidasi BPHTB ini?',
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
                    url: '<?php echo WS_JQGRID."transaksi.t_laporan_rekap_bphtb_verifikasi_controller/update"; ?>',
                    type: "POST",
                    data: {t_bphtb_registration_id: t_bphtb_registration_id},
                    success: function (data) {
                        if(data.result != ''){
                            //alert(data.result);

                            //swal('BPHTB telah diverifikasi dengan nomor : '+data.result);
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'BPHTB telah diverifikasi dengan nomor : '+data.result,
                              showConfirmButton: false,
                              timer: 800
                            });

                            $('#table').css('display', '');
                            jQuery(function($) {
                                var grid_selector = "#grid-table";

                                jQuery("#grid-table").jqGrid('setGridParam',{
                                    url: '<?php echo WS_JQGRID."transaksi.t_laporan_rekap_bphtb_verifikasi_controller/read"; ?>',
                                    postData: {date_start_laporan:date_start_laporan,
                                                date_end_laporan:date_end_laporan,
                                                nama_wp: nama_wp}
                                });
                                $("#grid-table").jqGrid("setCaption", "Validasi BPHTB");
                                $("#grid-table").trigger("reloadGrid");
                            });

                            
                        }else{
                            swal({title: "Error!", text: 'Maaf, Gagal Memvalidasi.', html: true, type: "error"});
                        }
                        // console.log(dt.product_name);
                    },
                    error: function (xhr, status, error) {
                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                    }
                });
           
        });

    }
</script>