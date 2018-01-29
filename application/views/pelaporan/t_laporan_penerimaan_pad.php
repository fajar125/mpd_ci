<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Laporan Penerimaan PAD</span>
        </li>
    </ul> 
</div>
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="row">
                    <label class="control-label col-md-2">Periode Tahun</label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input id="form_year_period_id" type="text"  style="display:none;">
                            <input id="form_year_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Periode Tahun">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVYearPeriod('form_year_period_id','form_year_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>  
                    </div> 
                </div>
                
                
                <div class="space-4"></div>
                <div class="row col-md-offset-2">
                    <button class="btn btn-success" type="button" id="btn-show" onclick="showData()">Tampilkan</button>
                    <button class="btn btn-success" type="button" onclick="toExcel()" id="excel">Tampilkan Excel</button>
                    <button class="btn btn-success" type="button" onclick="toPDF()" id="pdf">Tampilkan PDF</button>
                </div>
            </div>
        </div>
    </div>  
</div>


<div class="tab-content no-border">
    <div class="row">
        <div class="col-xs-12">
            <div id="gbox_grid-table" class="ui-jqgrid">
                <div id="gview_grid-table-history" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table-history"></table>           
                </div>
            </div>            
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div id="tbl-bayar"></div>
        </div>
    </div>
</div>


<?php $this->load->view('lov/lov_year_period'); ?> 

<script type="text/javascript">
$ ("#gview_grid-table-history").hide();

    jQuery(function ($) {

        var grid_selector = "#grid-table-history";

        jQuery("#grid-table-history").jqGrid({
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'Jenis Penerimaan',name: 'rc_pad_formated',width: 150, align: "left"},
                {label: 'Target',name: 'target',width: 200, align: "right"},

                {label: 'Januari',name: 'januari',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'Februari',name: 'februari',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'Maret',name: 'maret',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'April',name: 'apil',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'Mei',name: 'mei',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'Juni',name: 'juni',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'Juli',name: 'juli',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'Agustus',name: 'agustus',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'September',name: 'september',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'Oktober',name: 'oktober',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'November',name: 'november',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label:'Desember ', name: 'desember',width: 150, align: "right", summaryTpl:"{0}",summaryType:"sum",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},

                
                {label: 'Jumlah',name: 'total',width: 150, align: "right",formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'Persentase',name: 'persentasi',width: 150, align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}}

            ],
            height: '100%',
            autowidth: false,
            viewrecords: true,
            rowNum: -1,
            rowList: [10, 20, 50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            footerrow: true,
            gridComplete: function() {
                var $grid = $('#grid-table-history');

                var colSum1 = $grid.jqGrid('getCol', 'januari', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'januari': colSum1 });  
                var colSum2 = $grid.jqGrid('getCol', 'februari', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'februari': colSum2 });   
                var colSum3 = $grid.jqGrid('getCol', 'maret', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'maret': colSum3 });   

                var colSum4 = $grid.jqGrid('getCol', 'april', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'april': colSum4 });  
                var colSum5 = $grid.jqGrid('getCol', 'mei', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'mei': colSum5 });   
                var colSum6 = $grid.jqGrid('getCol', 'juni', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'juni': colSum6 }); 

                var colSum7 = $grid.jqGrid('getCol', 'juli', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'juli': colSum7 });  
                var colSum8 = $grid.jqGrid('getCol', 'agustus', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'agustus': colSum8 });   
                var colSum9 = $grid.jqGrid('getCol', 'september', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'september': colSum9 }); 

                var colSum10 = $grid.jqGrid('getCol', 'oktober', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'oktober': colSum10 });  
                var colSum12 = $grid.jqGrid('getCol', 'november', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'november': colSum12 });   
                var colSum13 = $grid.jqGrid('getCol', 'desember', false, 'sum');
                $grid.jqGrid('footerData', 'set', { 'desember': colSum13 }); 

            },
            caption: "Daftar Penerimaan PAD"
        });
    
        var year_code = $('#form_year_code').val();

        
        jQuery("#grid-table-history").jqGrid('setGroupHeaders', {
            useColSpanStyle: true, 
            groupHeaders:[
                {startColumnName: 'jan', numberOfColumns: 12, titleText: 'Bulan'}
            ]
        });
    });

    function showData(){

        $("#gview_grid-table-history").show();

        var p_year_period_id = $('#form_year_period_id').val();

        var year_code = $('#form_year_code').val();

        //alert(year_code-1);
          

        if (year_code==''||p_year_period_id==''){
            swal('Informasi','Semua Harus Diisi','info');
            $ ("#gview_grid-table-history").hide();
            return;

        }

        jQuery(function($) {
            jQuery("#grid-table-history").jqGrid('setGridParam',{
                url: '<?php echo WS_JQGRID."pelaporan.t_laporan_penerimaan_pad_controller/read"; ?>',
                postData: {
                            p_year_period_id : p_year_period_id
                        }

            });


            $("#grid-table-history").jqGrid("setCaption", "Daftar Penerimaan PAD");
            $("#grid-table-history").trigger("reloadGrid");
        });
       
        
    }





</script>

<script type="text/javascript">
    function showData1(){

        var kode_wilayah = $('#kode_wilayah').val();
        var tgl_penerimaan  = $('#start_period').val();
        var tgl_penerimaan_last = $('#end_period').val();
        var npwpd_jabatan = $('#jenis_wp').val();
        var year_code = $('#form_year_code').val();

        if (kode_wilayah==''||tgl_penerimaan==''||tgl_penerimaan_last==''||npwpd_jabatan==''||year_code==''){
            swal('Informasi','Semua Harus Diisi','info');
            $ ("#gview_grid-table-history").hide();
            return;

        }

        var url = '<?php echo WS_JQGRID . "pelaporan.t_laporan_penerimaan_pad_controller/readHTML?"; ?>';
        url += 'kode_wilayah='+ kode_wilayah;
        url += '&tgl_penerimaan ='+ tgl_penerimaan;
        url += '&tgl_penerimaan_last='+ tgl_penerimaan_last;
        url += '&npwpd_jabatan='+ npwpd_jabatan;
        url += '&year_code='+ year_code;
        
        $.getJSON(url, function( items ) {
            document.getElementById('tbl-bayar').innerHTML = items.rows ;
        })
    }
</script>



<script type="text/javascript">

    function toExcel() {

        var p_year_period_id = $('#form_year_period_id').val();
        var year_code = $('#form_year_code').val();


        if (p_year_period_id==''||year_code==''){
            swal('Informasi','Periode Tahun Harus Diisi','info');
            $ ("#gview_grid-table-history").hide();
            return;

        }
        // alert("Convert to Excel");
        var url = "<?php echo WS_JQGRID . "pelaporan.t_laporan_penerimaan_pad_controller/excel/?"; ?>";
        url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        url += "&p_year_period_id=" +  p_year_period_id;
        url += "&year_code=" +  year_code;


        window.location = url;
    }

    function toPDF() {

        var p_year_period_id = $('#form_year_period_id').val();
        var year_code = $('#form_year_code').val();


        if (p_year_period_id==''||year_code==''){
            swal('Informasi','Periode Tahun Harus Diisi','info');
            $ ("#gview_grid-table-history").hide();
            return;

        }
        // alert("Convert to Excel");
        var url = "<?php echo base_url(); ?>"+"cetak_laporan_pad/pageCetak?";
        url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        url += "&p_year_period_id=" +  p_year_period_id;
        url += "&year_code=" +  year_code;


        PopupCenter(url,"Laporan Penerimaan PAD",500,500);
    }


</script>

<script>
    function responsive_jqgrid(grid_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid('setGridWidth', $(".form-body").width());
        //$(pager_selector).jqGrid('setGridWidth', parent_column.width());

    }

    function showLOVYearPeriod(id, code) {
        modal_year_period_show(id, code);
    }

</script>
