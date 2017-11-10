
<script>
    var urlJS = "<?php echo base_url(); ?>assets/js/highcharts.js";

    if (!isScriptAlreadyIncluded(urlJS)){
      // DOM: Create the script element
        var jsElm = document.createElement("script");
        // set the type attribute
        jsElm.type = "application/javascript";
        // make the script element load file
        jsElm.src = urlJS;
        // finally insert the element to the body element in order to load the script
        document.body.appendChild(jsElm);
    }

    function isScriptAlreadyIncluded(src){
        var scripts = document.getElementsByTagName("script");
        for(var i = 0; i < scripts.length; i++) 
           if(scripts[i].getAttribute('src') == src) return true;
        return false;
    }
</script>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Laporan Jumlah WP</span>
        </li>
    </ul> 
</div>
<div class="space-4"></div>

<div class="tab-content no-border">
    <div class="row">
        <div class="col-sm-6">
            <div id="gbox_grid-table" class="ui-jqgrid">
                <div id="gview_grid-table" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table-lap"></table>
                </div>
            </div>            
        </div>
    </div>
    <hr>
    <div class="row">  
        <div class="col-xs-12">
            <div DISPLAY: inline-block" id="container"></div>
        </div>    
    </div>
</div>



<script type="text/javascript">
    
    jQuery(function ($) {
        var grid_selector = "#grid-table-lap";
        jQuery("#grid-table-lap").jqGrid({
            url: '<?php echo WS_JQGRID . "pelaporan.t_status_pelaporan_wp_detil_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'Status Text', name: 'status_text',width: 5,hidden: true},
                {label: 'ID Jenis Pajak', name: 'p_vat_type_id',width: 5, sorttype: 'number',hidden: true},
				{label: 'Jenis Pajak',width: 300, align: "left",
                    formatter:function(cellvalue, options, rowObject) {

                        var vat_code = rowObject['vat_code'];
                        var p_vat_type_id = rowObject['p_vat_type_id'];
                        
                        return '<a href="#" onclick="pdf_wp_detil('+p_vat_type_id+')">'+vat_code+'</a>';

                    }
                },

				{label: 'Jumlah',name: 'jumlah', width: 190, align: "left"}
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
           
            gridComplete: function() {
                
            },
            onSelectRow: function (rowid) {
                /*do something when selected*/
                
            },
            loadComplete: function () {
                reloadCharwp();             
               
            },
            caption: "Daftar Jenis WP Per Jenis Pajak"
        });
        
        
    });    
</script>

<script>
    function reloadCharwp(){
        var var_url = "<?php echo base_url(); ?>"+"T_rep_laporan_wp_detil/t_rep_wp_detil";
        $.getJSON( var_url, function( items ) {

            /*var kriteria = [];
            var data_patuh = [];
            var data_kurang_patuh = []; 
            var data_tidak_patuh = [];
            for (var i=0; i<items.length; i++){
                for(var j=0; j < items[i].length; j++){
                    kriteria = items[i][j];
                }
            }*/
            
            //var tes = parseInt(items[0][2]);
            //alert(tes);return;*/

            $("#container").highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Jumlah Wajib Pajak Per Jenis Pajak Dengan Status Aktif'
                },
                subtitle: {
                    text: 'Disyanjak Kota Bandung '
                },
                xAxis: {
                    categories: ['Jenis Pajak']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah WP'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    {
                        name: items[0][1],
                        data: [parseInt(items[0][2])]

                    }, 
                    {
                        name: items[1][1],
                        data: [parseInt(items[1][2])]

                    }, 
                    {
                        name: items[2][1],
                        data: [parseInt(items[2][2])]

                    }, 
                    {
                        name: items[3][1],
                        data: [parseInt(items[3][2])]

                    }, 
                    {
                        name: items[4][1],
                        data: [parseInt(items[4][2])]

                    }
                ]
            });
        });

        
    }

    function pdf_wp_detil(p_vat_type_id){
         url = '<?php echo base_url(); ?>'+'pdf_status_pelaporan_wp_detil/save_pdf_t_status_pelporan_wp_detil/'+p_vat_type_id;
            openInNewTab(url);
    }

    function openInNewTab(url) {    
        window.open(url, '_blank', 'location=yes,height=570,width=820,scrollbars=yes,status=yes');
    }
</script>

