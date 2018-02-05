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
            <span>Lembar Kontrol BPHTB</span>
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
                    
                    <span class="caption-subject font-blue bold uppercase"> Lembar Kontrol BPHTB
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
        
    });

    //$('#table').css('display', 'none');
</script>

<script type="text/javascript">
    jQuery(function($) {
        var grid_selector = "#grid-table";
        //var pager_selector = "#grid-pager";
        $('#table').css('display', 'none');
        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_lembar_kontrol_bphtb_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                //{label: 'ID',name: 't_bphtb_registration_id',hidden:true, width: 180, align: "center"},
                {label: 'Tanggal',name: 'creation_date',width: 100, align: "left"},
                {label: 'No Registrasi',name: 'registration_no',width: 100, align: "left"},
                {label: 'Nama WP',name: 'wp_name',width: 200, align: "left"},
                {label: 'NOP',name: 'njop_pbb',width: 150, align: "left"},
                {label: 'LT/LB',name: 'land_area',width: 80, align: "right"},
                {label: 'Nilai Pajak Yang Harus Dibayar (Rp)',name: 'bphtb_amt_final',width: 250, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'No Transaksi',name: 'receipt_no',width: 120, align: "right"},
                {label: 'Tanggal Bayar',name: 'payment_date',width: 120, align: "right"}            
                
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
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            gridComplete: function() {
                var $grid = $('#grid-table');
                var colSum = $grid.jqGrid('getCol', 'bphtb_amt_final', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'land_area':'Total', 'bphtb_amt_final': colSum });
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

        if(date_start_laporan == "" && date_end_laporan == ""){            
            swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
        }else{
           /* if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal awal harus lebih besar dari tanggal akhir" ,  "error" );
                return;
            }else{*/
                $('#table').css('display', '');
                jQuery(function($) {
                    var grid_selector = "#grid-table";

                    jQuery("#grid-table").jqGrid('setGridParam',{
                        url: '<?php echo WS_JQGRID."transaksi.t_lembar_kontrol_bphtb_controller/read"; ?>',
                        postData: {date_start_laporan:date_start_laporan,
                                    date_end_laporan:date_end_laporan}
                    });
                    $("#grid-table").jqGrid("setCaption", "Lembar Kontrol BPHTB");
                    $("#grid-table").trigger("reloadGrid");
                });
            // }
            
        }        
    
    }
</script>