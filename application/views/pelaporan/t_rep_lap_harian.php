<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Laporan Harian</span>
        </li>
    </ul> 
</div>
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="row">                    
                    <label class="control-label col-md-2">Tanggal Penerimaan</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="tgl_penerimaan" id="tgl_penerimaan" required="">                 
                        </div>
                    </div>
                    <label class="control-label col-md-2">Bank Penerimaan</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <select id="kode_bank" name="kode_bank" class="FormElement form-control" >
                                <option selected="" value="">Semua</option>
                                <option value="0000">BENDAHARA PENERIMA</option>
                                <option value="110">BJB</option>
                            </select>
                        </div>
                    </div>
                </div>                
                <div class="space-2"></div>
                <div class="row col-md-offset-4">
                    <button class="btn btn-success" type="button" id="btn-search">Tampilkan Data</button>
                    <button class="btn btn-success" type="button" onclick="print_pdf()" id="pdf">Donwload PDF</button>
                </div>
            </div>
        </div>       
    </div>    
</div>
<div class="tab-content no-border">
    <div class="row">
        <div class="col-xs-12">
            <div id="gbox_grid-table" class="ui-jqgrid">
                <div id="gview_grid-table" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table-lap"></table>
                </div>
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
    
    jQuery(function ($) {
        var grid_selector = "#grid-table-lap";
        jQuery("#grid-table-lap").jqGrid({
            url: '<?php echo WS_JQGRID . "pelaporan.t_rep_lap_harian_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'Ayat',name: 'nomor_ayat',width: 70, align: "left"},

				{label: 'Pajak/Retribusi',name: 'nama_ayat',width: 140, align: "left"},

				{label: 'Jenis Pajak',name: 'nama_jns_pajak', width: 110, align: "left"},

				{label: 'Jumlah (Rp.)',name: 'jml_hari_ini',width: 130, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},

				{label: 'Jumlah SSPD',name: 'jml_transaksi',width: 120, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},

				{label: 'Jumlah (Rp.)',name: 'jml_sd_hari_lalu',width: 130, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},

				{label: 'Jumlah SSPD',name: 'jml_transaksi_sampai_kemarin',width: 120, summaryTpl:"{0}",summaryType:"sum",formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'}, align: "right"},

				{label: 'Jumlah (Rp.)',name: 'jml_sd_hari_ini',width: 130, summaryTpl:"{0}",summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},

				{label: 'Jumlah SSPD',name: 'jml_transaksi_sampai_hari_ini',width: 120,summaryTpl:"{0}",summaryType:"sum",formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'}, align: "right"}
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
            grouping:true,
            groupingView: 
                    {
                        groupField: ["nama_jns_pajak"],
                        groupColumnShow: [true],
                        groupText: ["<b>{0}</b>"],
                        groupOrder: ["asc"],
                        groupSummary: [true], // will use the "summaryTpl" property of the respective column
                        groupCollapse: false,
                        groupDataSorted: true
                    },
            gridComplete: function() {
                var $grid = $('#grid-table-lap');
                var col_jml_hari_ini = $grid.jqGrid('getCol', 'jml_hari_ini', false, 'sum');
                var col_jml_transaksi = $grid.jqGrid('getCol', 'jml_transaksi', false, 'sum');
                var col_jml_sd_hari_lalu = $grid.jqGrid('getCol', 'jml_sd_hari_lalu', false, 'sum');
                var col_jml_transaksi_sampai_kemarin = $grid.jqGrid('getCol', 'jml_transaksi_sampai_kemarin', false, 'sum');
                var col_jml_sd_hari_ini = $grid.jqGrid('getCol', 'jml_sd_hari_ini', false, 'sum');
                var col_jml_transaksi_sampai_hari_ini = $grid.jqGrid('getCol', 'jml_transaksi_sampai_hari_ini', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'jml_hari_ini': col_jml_hari_ini,
                									'jml_transaksi':col_jml_transaksi,
                									'jml_sd_hari_lalu':col_jml_sd_hari_lalu,
                									'jml_transaksi_sampai_kemarin':col_jml_transaksi_sampai_kemarin,
                									'jml_sd_hari_ini':col_jml_sd_hari_ini,
                									'jml_transaksi_sampai_hari_ini':col_jml_transaksi_sampai_hari_ini

                 });
            },
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            loadComplete: function () {                
               
            },
              
            caption: "Laporan Harian"
        });
        $("#grid-table-lap").jqGrid('setLabel','nomor_ayat','',{'text-align':'center'});
        jQuery("#grid-table-lap").jqGrid('setGroupHeaders', {
  			useColSpanStyle: true, 
  			groupHeaders:[
				{startColumnName: 'jml_hari_ini', numberOfColumns: 2, titleText: 'Jumlah Hari Ini'},
				{startColumnName: 'jml_sd_hari_lalu', numberOfColumns: 2, titleText: 'Jumlah S/D Hari Yang Lalu'},
				{startColumnName: 'jml_sd_hari_ini', numberOfColumns: 2, titleText: 'Jumlah S/D Hari Ini'}
  			]
		});
        
    });    
</script>

<script> 
    $('#tgl_penerimaan').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'dd-mm-yyyy',
      todayBtn: 'linked',
      todayHighlight: true
    });
</script>

<script type="text/javascript">

    $("#btn-search").on('click', function() {       
        var tgl_penerimaan = $('#tgl_penerimaan').val();        
        var kode_bank = $('#kode_bank').val();
        
        if(tgl_penerimaan == ""){            
            swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
        }
        jQuery(function($) {
        var grid_selector = "#grid-table-lap";
        //var pager_selector = "#grid-pager-bpps2";

            jQuery("#grid-table-lap").jqGrid('setGridParam',{
                url: '<?php echo WS_JQGRID."pelaporan.t_rep_lap_harian_controller/read"; ?>',
                postData: { tgl_penerimaan: tgl_penerimaan,
                            kode_bank: kode_bank
                        }

            });


            $("#grid-table-lap").jqGrid("setCaption", "Laporan Harian");
            $("#grid-table-lap").trigger("reloadGrid");
        });
    });

</script>

<script>
    function responsive_jqgrid(grid_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid('setGridWidth', $(".form-body").width());
        //$(pager_selector).jqGrid('setGridWidth', parent_column.width());

    }


    function print_pdf(){
        var tgl_penerimaan = $('#tgl_penerimaan').val();        
        var kode_bank = $('#kode_bank').val();
        if(tgl_penerimaan == ""){
            swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );           
        }else{
            url = '<?php echo base_url(); ?>'+'pdf/save_pdf_t_rep_lap_harian/'+'harian'+'/'+tgl_penerimaan+'/'+kode_bank;
            openInNewTab(url);

        }


        
    }
    
function openInNewTab(url) {
    // window.open("../report/cetak_rep_lap_harian_bdhr.php?tgl_penerimaan='" + tgl_penerimaan + "'&kabid=T"+ "&kode_bank="+kode_bank, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
  window.open(url, '_blank', 'location=yes,height=570,width=820,scrollbars=yes,status=yes');
  // win.focus();
}

</script>
