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
            <span>Laporan REALISASI HARIAN MURNI DAN NON MURNI</span>
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
                    <span class="caption-subject font-blue bold uppercase"> Laporan REALISASI HARIAN MURNI DAN NON MURNI
                    </span>
                </div>
            </div>
            <!-- CONTENT  value="2015-09-01" -->
            <div class="form-body">
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Jenis Pajak
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control required" required name="p_vat_type_id"  id="p_vat_type_id" readonly value="4">
                                <input type="text" class="form-control required" required name="vat_code" id="vat_code" readonly value="Pajak Parkir">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-vat">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-2"></div>
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Periode Tahun
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control required" required name="p_year_period_id" id="p_year_period_id"  readonly value="26">
                                <input type="text" class="form-control required" name="year_code" required  id="year_code" readonly value="2015">
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-period">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Tanggal Penerimaan</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 required" name="tgl_penerimaan" id="tgl_penerimaan" required value="01-10-2015">                 
                        </div>
                    </div>
                    <label class="control-label col-md-1">s/d</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 required" name="tgl_penerimaan_last" id="tgl_penerimaan_last" required value="30-10-2015">
                        </div>
                    </div>
                </div> 
                <div class="space-2"></div>
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Jenis Setoran
                        </label>
                        <div class="col-md-3">
                            <select id="jenis_setoran" class="form-control required" name="jenis_setoran" required>
                                <option  value="">Pilih</option>
                                <option  value="1">POKOK</option>
                                <option  selected value="2">DENDA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-2">Jenis Laporan
                        </label>
                        <div class="col-md-3">
                            <select id="jenis_laporan" class="form-control required" name="jenis_laporan" required>
                                <option   value="all">SEMUA</option>
                                <option  value="piutang">Non Murni</option>
                                <option   value="murni">MURNI</option>
                            </select>
                        </div>
                    </div>
                </div> 
                <div class="space-2"></div>
                <div class="row col-md-offset-4">
                    <button class="btn btn-danger" type="button" onclick="toPDF()">Download PDF</button>
                    <button class="btn btn-primary" type="button" onclick="toTampilSatu()">Tampilkan</button>
                    <button class="btn btn-primary" type="button" onclick="toTampilDua()">Tampilkan 2</button>
                    <button class="btn btn-primary" type="button" onclick="toTampilTiga()">Tampilkan 3</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-content no-border" id="table-1">
    <div class="row">
        <div class="col-xs-12">
            <div id="gbox_grid-table-1" class="ui-jqgrid">
                <div id="gview_grid-table-1" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table-1"></table>
                </div>
            </div>            
        </div>
    </div>
</div>

<div class="tab-content no-border" id="table-2a">
    <div class="row">
        <div class="col-xs-12">
            <div id="gbox_grid-table-2a" class="ui-jqgrid">
                <div id="gview_grid-table-2a" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table-2a"></table>
                </div>
            </div>            
        </div>
    </div>
</div>


<div class="tab-content no-border" id="table-2b">
    <div class="row">
        <div class="col-xs-12">
            <div id="gbox_grid-table-2b" class="ui-jqgrid">
                <div id="gview_grid-table-2b" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table-2b"></table>
                </div>
            </div>            
        </div>
    </div>
</div>

<div class="tab-content no-border" id="table-3">
    <div class="row">
        <div class="col-xs-12">
            <div id="gbox_grid-table-3" class="ui-jqgrid">
                <div id="gview_grid-table-3" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table-3"></table>
                </div>
            </div>            
        </div>
    </div>
</div>


<?php $this->load->view('lov/lov_vat_type'); ?>
<?php $this->load->view('lov/lov_year_period'); ?>

<script >
    //tanggal 
    $('.datepicker1').datetimepicker({
        format: 'DD-MM-YYYY',
        // defaultDate: new Date()
    });

    $('#table').css('display', 'none');

    $("#btn-lov-vat").on('click', function() { 
        modal_lov_vat_show('p_vat_type_id','vat_code');        
    });

    $("#btn-lov-period").on('click', function() { 
        modal_year_period_show('p_year_period_id','year_code');        
    });

    $('#table-1').css('display', 'none');
    $('#table-2a').css('display', 'none');
    $('#table-2b').css('display', 'none');
    $('#table-3').css('display', 'none');
    
</script>


<script>
    function toPDF(){
        var p_vat_type_id       = $('#p_vat_type_id').val();
        var p_year_period_id    = $('#p_year_period_id').val();
        var tgl_penerimaan      = $('#tgl_penerimaan').val();
        var tgl_penerimaan_last = $('#tgl_penerimaan_last').val();
        var jenis_setoran       = $('#jenis_setoran').val(); 
        var year_code           = $('#year_code').val(); 
        var jenis_laporan       = $('#jenis_laporan').val();    

        if(p_vat_type_id == "" || p_year_period_id == ""||tgl_penerimaan == ""||tgl_penerimaan_last == ""||jenis_setoran == ""||year_code==""||jenis_laporan=="")
        {
            swal ( "Oopss" ,  "Semua Harus Terisi!" ,  "error" );
        }else
        {
            
            var url = "<?php echo base_url(); ?>"+"pdf_rep_realisasi_harian_per_jenis_pajak2/save_pdf?";
            url += "p_vat_type_id=" + p_vat_type_id;
            url += "&p_year_period_id=" + p_year_period_id;
            url += "&tgl_penerimaan='" + tgl_penerimaan;
            url += "'&tgl_penerimaan_last='" + tgl_penerimaan_last;
            url += "'&jenis_setoran=" + jenis_setoran;
            url += "&year_date=" + year_code;
            url += "&jenis_laporan=" + jenis_laporan;

            if (tgl_penerimaan_last < tgl_penerimaan){
                swal ( "Oopss" ,  "Tanggal akhir harus lebih besar atau sama dari tanggal awal" ,  "error" );
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

<script type="text/javascript">
    

    jQuery(function($) {
        var grid_selector = "#grid-table-1";

        //alert ($('#year_code').val());

        jQuery("#grid-table-1").jqGrid({
            url: '<?php echo WS_JQGRID."pelaporan.t_rep_lap_bpps_piutang2_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'NO AYAT',width: 150, align: "left",
                    formatter:function(cellvalue, options, rowObject) {
                        var kode_jns_pajak = rowObject['kode_jns_pajak'];
                        var kode_ayat = rowObject['kode_ayat'];
                        var no_ayat = kode_jns_pajak+" "+kode_ayat;
                        return '<div name="no_ayat">'+no_ayat+'</div>';
                    }
                },
                {label: 'NAMA AYAT ',name: 'nama_ayat',width: 250, align: "left" },
                {label: 'NO KOHIR ',name: 'no_kohir',width: 150, align: "left"},
                {label: 'NAMA WP',name: 'wp_name',width: 250, align: "left"},
                {label: 'NPWPD',name: 'npwpd',width: 150, align: "left",summaryTpl:"Total" ,summaryType:"sum"},
                {label: 'JUMLAH',name: 'jumlah_terima',width: 150, summaryTpl:"{0}" ,summaryType:"sum", formatter:'integer', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'MASA PAJAK',name: 'masa_pajak',width: 250, align: "center"},
                {label: 'TGL TAP',name: 'kd_tap',width: 150, align: "left"},
                {label: 'TGL BAYAR',name: 'payment_date2',width: 150, align: "left"}


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
            userDataOnFooter : true,
            gridComplete: function() {
                var $grid = $('#grid-table-1');
                var jumlah_terima = $grid.jqGrid('getCol', 'jumlah_terima', false, 'sum');
                $grid.jqGrid('footerData', 'set', { npwpd:'TOTAL PAJAK',jumlah_terima: jumlah_terima });
            },
            grouping: true, 
                groupingView : { 
                                groupField : ['nama_ayat'], 
                                groupColumnShow : [true], 
                                groupText : ['<b>{0}</b>'], 
                                groupCollapse : false, 
                                groupOrder: ['asc'], 
                                groupSummary : [true], 
                                groupDataSorted : true },
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
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
            caption: "  LAPORAN REALISASI HARIAN MURNI DAN NON MURNI"

        });

        

    });

    function responsive_jqgrid(grid_selector, pager_selector) {
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );
    }
</script>

<script type="text/javascript">
    jQuery(function($) {
        var grid_selector = "#grid-table-2a";
        
        //console.log

        jQuery("#grid-table-2a").jqGrid(
            {
            url: '<?php echo WS_JQGRID."pelaporan.t_rep_lap_bpps_piutang2_controller/read2"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {name: 'no_ayat',width: 250, align: "left" },
                {name: 'jns_pajak',width: 250, align: "left" },
                {name: 'wp_name',width: 250, align: "left" },
                {name: 'nama_ayat',width: 210, align: "left"},
                {name: 'npwpd',width: 150, align: "left" },
                {name: 'address',width: 300, align: "left" },
                {name: 'before_desember',width: 210, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'desember_old',width: 220, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'januari',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'februari',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'maret',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'april',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'mei',width: 210, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'juni',width: 220, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'juli',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'agustus',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'september',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'oktober',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'november',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'affter_november',width: 210, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'jumlah',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},

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
            userDataOnFooter : true,
            gridComplete: function() {
                var $grid = $('#grid-table-2a');
                var jumlah = $grid.jqGrid('getCol', 'jumlah', false, 'sum');
                $grid.jqGrid('footerData', 'set', { address:'TOTAL PAJAK',jumlah: jumlah });
            },
            grouping: true, 
                groupingView : { 
                                },
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            beforeProcessing: function (data) {
                var $self = $(this);
                var model = data.model; 
                var name; 
                var $colHeader;
                var $sortingIcons;
                var $col;
                if (model) {
                    for (name in model) {
                        if (model.hasOwnProperty(name)) {
                            $colHeader = $("#jqgh_" + $.jgrid.jqID(this.id + "_" + name));
                            $sortingIcons = $colHeader.find(">span.s-ico");
                            $colHeader.text(model[name].label);
                            $colHeader.append($sortingIcons);
                        }
                    }
                }

                

               //  alert(myFunction());
            },
            loadComplete: function (response) {

                

                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }

            },
            caption: "  LAPORAN REALISASI HARIAN MURNI DAN NON MURNI"

        });

        jQuery("#grid-table-2a").jqGrid('setGroupHeaders', {
            useColSpanStyle: true, 
            groupHeaders:[
                {startColumnName: 'before_desember', numberOfColumns: 16, titleText: 'REALISASI DAN TANGGAL BAYAR',alignText: "center"}
            ]
        });
        

    });

    jQuery(function($) {
        var grid_selector = "#grid-table-2b";
        
        //console.log

        jQuery("#grid-table-2b").jqGrid(
            {
            url: '<?php echo WS_JQGRID."pelaporan.t_rep_lap_bpps_piutang2_controller/read2"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {name: 'no_ayat',width: 250, align: "left" },
                {name: 'jns_pajak',width: 250, align: "left" },
                {name: 'wp_name',width: 250, align: "left" },
                {name: 'nama_ayat',width: 210, align: "left"},
                {name: 'npwpd',width: 150, align: "left" },
                {name: 'address',width: 300, align: "left" },
                {name: 'desember_old',width: 220, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'januari',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'februari',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'maret',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'april',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'mei',width: 210, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'juni',width: 220, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'juli',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'agustus',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'september',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'oktober',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'november',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right" },
                {name: 'jumlah',width: 250, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},

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
            userDataOnFooter : true,
            gridComplete: function() {
                var $grid = $('#grid-table-2b');
                var jumlah = $grid.jqGrid('getCol', 'jumlah', false, 'sum');
                $grid.jqGrid('footerData', 'set', { address:'TOTAL PAJAK',jumlah: jumlah });
            },
            grouping: true, 
                groupingView : { 
                                },
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
            jsonReader: {
                root: 'rows',
                id: 'id',
                repeatitems: false
            },
            beforeProcessing: function (data) {
                var $self = $(this);
                var model = data.model; 
                var name; 
                var $colHeader;
                var $sortingIcons;
                var $col;
                if (model) {
                    for (name in model) {
                        if (model.hasOwnProperty(name)) {
                            $colHeader = $("#jqgh_" + $.jgrid.jqID(this.id + "_" + name));
                            $sortingIcons = $colHeader.find(">span.s-ico");
                            $colHeader.text(model[name].label);
                            $colHeader.append($sortingIcons);
                        }
                    }
                }

                

               //  alert(myFunction());
            },
            loadComplete: function (response) {

                

                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }

            },
            caption: "  LAPORAN REALISASI HARIAN MURNI DAN NON MURNI"

        });

        jQuery("#grid-table-2b").jqGrid('setGroupHeaders', {
            useColSpanStyle: true, 
            groupHeaders:[
                {startColumnName: 'desember_old', numberOfColumns: 14, titleText: 'REALISASI DAN TANGGAL BAYAR',alignText: "center"}
            ]
        });
        

    });  
</script>

<script></script>

<script>
    jQuery(function($) {
        var grid_selector = "#grid-table-3";


        jQuery("#grid-table-3").jqGrid({
            url: '<?php echo WS_JQGRID."pelaporan.t_rep_lap_bpps_piutang2_controller/read3"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'NO AYAT',name: 'no_ayat', width: 150, align: "left",},
                {label: 'NAMA AYAT ',name: 'nama_ayat',width: 250, align: "left" },
                {label: 'NAMA WP',name: 'wp_name',width: 250, align: "left"},
                {label: 'NPWPD',name: 'npwpd',width: 150, align: "left"},
                {label: 'Alamat',name: 'address',width: 150, align: "left"},
                {label: 'MASA PAJAK',name: 'bulan',width: 200, align: "left",summaryTpl:"Total" ,summaryType:"sum"},
                {label: 'JUMLAH',name: 'jumlah',width: 150, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"}

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
            userDataOnFooter : true,
            gridComplete: function() {
                var $grid = $('#grid-table-3');
                var jumlah = $grid.jqGrid('getCol', 'jumlah', false, 'sum');
                $grid.jqGrid('footerData', 'set', { npwpd:'TOTAL PAJAK',jumlah: jumlah });
            },
            grouping: true, 
                groupingView : { 
                                groupField : ['wp_name'], 
                                groupColumnShow : [true], 
                                groupText : ['<b>{0}</b>'], 
                                groupCollapse : false, 
                                groupOrder: ['asc'], 
                                groupSummary : [true], 
                                groupDataSorted : true },
            onSelectRow: function (rowid) {
                /*do something when selected*/

            },
            sortorder:'',
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
            caption: "  LAPORAN REALISASI HARIAN MURNI DAN NON MURNI"

        });

        

    });
</script>

<script>


    function toTampilSatu(){
        var p_vat_type_id       = $('#p_vat_type_id').val();
        var p_year_period_id    = $('#p_year_period_id').val();
        var tgl_penerimaan      = $('#tgl_penerimaan').val();
        var tgl_penerimaan_last = $('#tgl_penerimaan_last').val();
        var jenis_setoran       = $('#jenis_setoran').val(); 
        var year_date           = $('#year_code').val(); 
        var jenis_laporan       = $('#jenis_laporan').val();




        if(p_vat_type_id == "" || p_year_period_id == ""||tgl_penerimaan == ""||tgl_penerimaan_last == ""||jenis_setoran == ""||year_date==""||jenis_laporan=="")
        {
            swal ( "Oopss" ,  "Semua Harus Terisi!" ,  "error" );
        }else
        {
            $('#table-1').css('display', '');
            $('#table-2a').css('display', 'none');
            $('#table-2b').css('display', 'none');
            $('#table-3').css('display', 'none');
            jQuery(function($) {
                var grid_selector = "#grid-table-1";

                jQuery("#grid-table-1").jqGrid('setGridParam',{
                    url: '<?php echo WS_JQGRID."pelaporan.t_rep_lap_bpps_piutang2_controller/read"; ?>',
                    postData: {p_vat_type_id:p_vat_type_id,p_year_period_id:p_year_period_id,tgl_penerimaan:tgl_penerimaan,tgl_penerimaan_last:tgl_penerimaan_last,jenis_setoran:jenis_setoran,year_date:year_date,jenis_laporan:jenis_laporan}
                });
                $("#grid-table-1").jqGrid("setCaption", "   LAPORAN REALISASI HARIAN MURNI DAN NON MURNI ");
                $("#grid-table-1").trigger("reloadGrid");
            });
        }
    }

    function toTampilDua(){
        var p_vat_type_id       = $('#p_vat_type_id').val();
        var p_year_period_id    = $('#p_year_period_id').val();
        var tgl_penerimaan      = $('#tgl_penerimaan').val();
        var tgl_penerimaan_last = $('#tgl_penerimaan_last').val();
        var jenis_setoran       = $('#jenis_setoran').val(); 
        var year_date           = $('#year_code').val(); 
        var jenis_laporan       = $('#jenis_laporan').val();

        if(p_vat_type_id == "" || p_year_period_id == ""||tgl_penerimaan == ""||tgl_penerimaan_last == ""||jenis_setoran == ""||year_date==""||jenis_laporan=="")
        {
            swal ( "Oopss" ,  "Semua Harus Terisi!" ,  "error" );
        }else
        {
            if (jenis_laporan=='all'||jenis_laporan=='piutang'){
                $('#table-1').css('display', 'none');
                $('#table-2a').css('display', '');
                $('#table-2b').css('display', 'none');
                $('#table-3').css('display', 'none');
                jQuery(function($) {
                    var grid_selector = "#grid-table-2a";

                    jQuery("#grid-table-2a").jqGrid('setGridParam',{
                        url: '<?php echo WS_JQGRID."pelaporan.t_rep_lap_bpps_piutang2_controller/read2"; ?>',
                        postData: {p_vat_type_id:p_vat_type_id,p_year_period_id:p_year_period_id,tgl_penerimaan:tgl_penerimaan,tgl_penerimaan_last:tgl_penerimaan_last,jenis_setoran:jenis_setoran,year_date:year_date,jenis_laporan:jenis_laporan}

                    });
                    $("#grid-table-2a").jqGrid("setCaption", "   LAPORAN REALISASI HARIAN MURNI DAN NON MURNI ");
                    $("#grid-table-2a").trigger("reloadGrid");
                });
            }

            if (jenis_laporan=='murni'){
                $('#table-1').css('display', 'none');
                $('#table-2a').css('display', 'none');
                $('#table-2b').css('display', '');
                $('#table-3').css('display', 'none');

                jQuery(function($) {
                    var grid_selector = "#grid-table-2b";

                    jQuery("#grid-table-2b").jqGrid('setGridParam',{
                        url: '<?php echo WS_JQGRID."pelaporan.t_rep_lap_bpps_piutang2_controller/read2"; ?>',
                        postData: {p_vat_type_id:p_vat_type_id,p_year_period_id:p_year_period_id,tgl_penerimaan:tgl_penerimaan,tgl_penerimaan_last:tgl_penerimaan_last,jenis_setoran:jenis_setoran,year_date:year_date,jenis_laporan:jenis_laporan}

                    });
                    $("#grid-table-2b").jqGrid("setCaption", "   LAPORAN REALISASI HARIAN MURNI DAN NON MURNI ");
                    $("#grid-table-2b").trigger("reloadGrid");
                });
            }

            


            
            
        }
    }

    function toTampilTiga(){
        var p_vat_type_id       = $('#p_vat_type_id').val();
        var p_year_period_id    = $('#p_year_period_id').val();
        var tgl_penerimaan      = $('#tgl_penerimaan').val();
        var tgl_penerimaan_last = $('#tgl_penerimaan_last').val();
        var jenis_setoran       = $('#jenis_setoran').val(); 
        var year_date           = $('#year_code').val(); 
        var jenis_laporan       = $('#jenis_laporan').val();

        if(p_vat_type_id == "" || p_year_period_id == ""||tgl_penerimaan == ""||tgl_penerimaan_last == ""||jenis_setoran == ""||year_date==""||jenis_laporan=="")
        {
            swal ( "Oopss" ,  "Semua Harus Terisi!" ,  "error" );
        }else
        {
            $('#table-1').css('display', 'none');
            $('#table-2a').css('display', 'none');
            $('#table-2b').css('display', 'none');
            $('#table-3').css('display', '');

            jQuery(function($) {
                var grid_selector = "#grid-table-3";

                jQuery("#grid-table-3").jqGrid('setGridParam',{
                    url: '<?php echo WS_JQGRID."pelaporan.t_rep_lap_bpps_piutang2_controller/read3"; ?>',
                    postData: {p_vat_type_id:p_vat_type_id,p_year_period_id:p_year_period_id,tgl_penerimaan:tgl_penerimaan,tgl_penerimaan_last:tgl_penerimaan_last,jenis_setoran:jenis_setoran,year_date:year_date,jenis_laporan:jenis_laporan}
                });
                $("#grid-table-3").jqGrid("setCaption", "   LAPORAN REALISASI HARIAN MURNI DAN NON MURNI ");
                $("#grid-table-3").trigger("reloadGrid");
            });
            
        }
    }
</script>