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
            <span>Laporan Konfirmasi Nota Verifikasi BPTHB </span>
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
                    <span class="caption-subject font-blue bold uppercase"> Laporan Konfirmasi Nota Verifikasi BPTHB 
                    </span>
                </div>
            </div>
            <!-- CONTENT  value="2015-09-01" -->
            <div class="form-body">
                <div class="row">                    
                    <label class="control-label col-md-2">Tanggal</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 required" name="date_start_laporan" id="date_start_laporan" required >                 
                        </div>
                    </div>
                    <label class="control-label col-md-1">s/d</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 required" name="date_end_laporan" id="date_end_laporan" required >
                        </div>
                    </div>
                </div> 

                <div class="space-2"></div>
                <div class="row col-md-offset-2">
                    <button class="btn btn-danger" type="button" onclick="toTegurBar()" id="sTegur">Cetak Surat Teguran</button>
                    <button class="btn btn-danger" type="button" onclick="toTegur()" id="sTegurBar">Cetak Surat Teguran Tanpa Barcode </button>
                    <button class="btn btn-primary" type="button" onclick="toTampil()" id="Tampil">Tampilkan</button>
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
                    <div id="grid-pager"></div>
                </div>
            </div>            
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#table').css('display', 'none');
    var today = new Date();
    //alert (today);

    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_laporan_teguran_bphtb_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {name: 'Cetak Teguran',width: 200, align: "center",
                    formatter:function(cellvalue, options, rowObject) {

                        var t_bphtb_registration_id = rowObject['t_bphtb_registration_id'];
                        
                        return '<a href="#" onclick="showCetakTeguran('+t_bphtb_registration_id+')">Cetak Teguran</a>';

                    }
                },
                {label: 'Tanggal',name: 'creation_date',width: 120, align: "left"},
                {label: 'No Registrasi',name: 'registration_no',width: 120, align: "left"},
                {label: 'Nama WP',name: 'wp_name',width: 240, align: "left"},
                {label: 'Jenis Transaksi',name: 'description',width: 190, align: "left"},
                {label: 'NOP',name: 'njop_pbb',width: 150, align: "left"},
                {label: 'LT/LB',name: 'land_area',width: 80, align: "right"},
                {label: 'HARGA TANAH (Rp)',name: 'land_total_price',width: 150, align: "right"},
                {label: 'HARGA BANGUNAN (Rp)    ',name: 'building_area',width: 180, align: "right"},
                {label: 'TOTAL NJOP (Rp)',name: 'building_total_price',width: 150, align: "right"},
                {label: 'HARGA PASAR TRANSAKSI LELANG (Rp)',name: 'market_price',width: 200, align: "right"},
                {label: 'NILAI PAJAK YANG  HARUS DIBAYAR(Rp)',name: 'bphtb_amt_final',width: 290, align: "right"}

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
            caption: "Laporan Konfirmasi Nota Verifikasi BPTHB"

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

        if(date_start_laporan == "" || date_end_laporan == ""){            
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
                        url: '<?php echo WS_JQGRID."transaksi.t_laporan_teguran_bphtb_controller/read"; ?>',
                        postData: {date_start_laporan:date_start_laporan,date_end_laporan:date_end_laporan}
                    });
                    $("#grid-table").jqGrid("setCaption", "Laporan Konfirmasi Nota Verifikasi BPTHB");
                    $("#grid-table").trigger("reloadGrid");
                });
            }
            
        }

        
    
    }
</script>

<script >
    //tanggal 
    $('.datepicker1').datetimepicker({
        format: 'YYYY-MM-DD',
        // defaultDate: new Date()
    });

    function toTegurBar(){
        var date_start_laporan     = $('#date_start_laporan').val();        
        var date_end_laporan       = $('#date_end_laporan').val();

        if(date_start_laporan == "" || date_end_laporan == ""){            
            swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
        }else{
            
            var url = "<?php echo base_url(); ?>"+"pdf_lap_teguran_bphtb/save_pdf_t_lap_teguran_bphtb?";
            url += "date_start_laporan=" + date_start_laporan;
            url += "&date_end_laporan=" + date_end_laporan;
            url += "&FLAG=0" ;

            //alert(url);
            //return;

            if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal awal harus lebih besar dari tanggal akhir" ,  "error" );
                return;
            }else{
                openInNewTab(url);
            }
            
        }
    }

    function toTegur(){
        var date_start_laporan     = $('#date_start_laporan').val();        
        var date_end_laporan       = $('#date_end_laporan').val();

        if(date_start_laporan == "" || date_end_laporan == ""){            
            swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
        }else{
            
            var url = "<?php echo base_url(); ?>"+"pdf_lap_teguran_bphtb/save_pdf_t_lap_teguran_bphtb?";
            url += "date_start_laporan=" + date_start_laporan;
            url += "&date_end_laporan=" + date_end_laporan;
            url += "&FLAG=1" ;

            if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal awal harus lebih besar dari tanggal akhir" ,  "error" );
                return;
            }else{
                openInNewTab(url);
            }
            
        }
    }

    function showCetakTeguran(t_bphtb_registration_id){
        var date_start_laporan     = $('#date_start_laporan').val();        
        var date_end_laporan       = $('#date_end_laporan').val();

        if(date_start_laporan == "" || date_end_laporan == ""){            
            swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
        }else{
            
            var url = "<?php echo base_url(); ?>"+"pdf_lap_teguran_bphtb/save_pdf_t_lap_teguran_bphtb?";
            url += "date_start_laporan=" + date_start_laporan;
            url += "&date_end_laporan=" + date_end_laporan;
            url += "&t_bphtb_registration_id="+t_bphtb_registration_id ;
            url += "&FLAG=1" ;

            if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal awal harus lebih besar dari tanggal akhir" ,  "error" );
                return;
            }else{
                openInNewTab(url);
            }
            
        }
    }

    

    function openInNewTab(url) {
      window.open(url, '_blank', 'location=yes,height=570,width=820,scrollbars=yes,status=yes');
    }

    

</script>