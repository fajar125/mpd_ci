<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>GRAFIK JUMLAH WP BAYAR PER BULAN</span>
        </li>
    </ul> 
</div>
<script type="text/javascript">

</script>
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="row">
                    <label class="control-label col-md-2">Periode Tahun</label>
                    <div class="col-md-3">
                        <div class="input-group">
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
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-2">Masa Pajak</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group">
                            <input id="form_finance_period_id" type="text"  style="display:none;">
                            <input id="form_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Masa Pajak">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVFinancePeriod('form_finance_period_id','form_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="space-4"></div>
                <div class="row col-md-offset-2">
                    <button class="btn btn-success" type="button" id="btn-search" onclick="showGrafik()">Tampilkan Grafik</button>
                </div>
            </div>
        </div>
    </div>  
</div>
    <div class="tab-content no-border">
        <div class="row">  
            <div class="col-xs-12">
                <div class="col-xs-12">
                    <div DISPLAY: inline-block" id="container"></div>
                </div>  
            </div>
            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div DISPLAY: inline-block" id="container3"></div>
                </div>  
                <div class="col-xs-6">
                    <div DISPLAY: inline-block" id="container4"></div>
                </div>  
            </div>
        </div>  
    </div>
</div>

<?php $this->load->view('lov/lov_year_period'); ?> 
<?php $this->load->view('lov/lov_finance_period'); ?>

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



<script type="text/javascript">
    

    function showGrafik(){

        var p_finance_period_id = $('#form_finance_period_id').val();
        var p_year_period_id = $('#form_year_period_id').val(); 

        if (p_finance_period_id==''||p_year_period_id==''){
            swal('Informasi','Semua Harus Diisi','info');
            return;
        }

        
        reloadChart(p_finance_period_id);
    

        
        


    }



</script>


<script> 


    function reloadChart(p_finance_period_id) {

        var var_url = "<?php echo base_url(); ?>"+"pembayaran_per_bulan/showData2?p_finance_period_id="+p_finance_period_id;

        $.getJSON( var_url , function( items ) {
           
           var tanggal = [];
           var realisasi1 = [];
           var realisasi2 = [];
           var realisasi3 = [];
           var realisasi4 = [];

            //alert(items[0][30]); return;


           
           

            for (var j = 0; j <items[0].length; j++) {

                if(items[0].length==59){
                    if (j>=0 && j < 30){
                        realisasi1.push(items[0][j]);
                        realisasi2.push(items[1][j]);
                        realisasi3.push(items[2][j]);
                        realisasi4.push(items[3][j]);
                    }

                    if (j>=29) {
                        tanggal.push(items[0][j]);
                    }        
                }

                if(items[0].length==61){
                    if (j>0 && j < 31){
                        realisasi1.push(items[0][j]);
                        realisasi2.push(items[1][j]);
                        realisasi3.push(items[2][j]);
                        realisasi4.push(items[3][j]);
                    }
                    if (j>=30) {
                        tanggal.push(items[0][j]);
                    }
                }

                if(items[0].length==63){
                    if (j>0 && j < 32){
                        realisasi1.push(items[0][j]);
                        realisasi2.push(items[1][j]);
                        realisasi3.push(items[2][j]);
                        realisasi4.push(items[3][j]);
                    }
                    if (j>31) {
                        tanggal.push(items[0][j]);
                    }
                }

               
                    
                
                
            }

            //alert(realisasi1); return;

            //alert(realisasi1); return;

            $("#container").highcharts({
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Grafik Jumlah WP Bayar Bulan ' + $('#form_code').val()
                },
                subtitle: {
                    text: 'Bapenda Lombok Utara'
                },
                xAxis: {
                    categories: tanggal,
                    tickmarkPlacement: 'on',
                    title: {
                        text: 'Tanggal'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Wajib Pajak'
                    },
                    labels: {
                        formatter: function () {
                            return this.value / 1000;
                        }
                    }
                },
                tooltip: {
                    split: true,
                },
                plotOptions: {
                    area: {
                        stacking: 'normal',
                        lineColor: '#666666',
                        lineWidth: 1,
                        marker: {
                            lineWidth: 1,
                            lineColor: '#666666'
                        }
                    }
                },
                series: [{
                    name: 'Pajak Hotel',
                    data: realisasi1
                }, {
                    name: 'Pajak Restoran',
                    data: realisasi2
                }, {
                    name: 'Pajak Hiburan',
                    data: realisasi3
                }, {
                    name: 'Pajak Parkir',
                    data: realisasi4
                }]
            });
            

        });

        //alert(rls1); return;

            
            

            //alert(rls); return;
        
            
        
    }

    function reloadChart1(p_finance_period_id){
        $.getJSON( "<?php echo base_url(); ?>"+"pembayaran_per_bulan/showData/?p_finance_period_id="+p_finance_period_id+"&p_vat_type_id=1", function( items ) {

                var tanggal = [];
                var realisasi = [];
                for (var i =0;i<items.length;i++){
                        tanggal.push(items[i][0]);
                        realisasi.push(parseFloat(items[i][1]));
                }
                var theseries;
                var color=['#fe0000','#56b945','#0000fe']
                    Highcharts.setOptions({
                                                    lang:{
                                                            numericSymbols: [" Ribu"," Juta"," Milyar"," Triliun"," Biliun"," Seliun"]
                                                    }
                                            });
                    $("#container").highcharts({
                    chart: {
                            type: "line"
                    },
                    title: {
                            text: "Grafik Pembayaran Bulan"+$('#form_code').val()
                    },
                    subtitle: {
                            text: "Pajak Hotel"
                    },
                    tooltip: {
                            
                    },
                    xAxis: {
                            categories: tanggal,
                            title: {
                                    text: 'Tanggal'
                                }
                    },
                    yAxis: {
                            title: {
                                        text: 'Realisasi'
                                    }
                    },
                    plotOptions: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                    },
                    series: [{
                                name: 'Realisasi Pajak Hotel',
                                data: realisasi
                            }]
            });

                                

        });
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
function showLOVFinancePeriod(id, code) {
    if ($('#form_year_period_id').val() == 0 || $('#form_year_period_id').val() == '' || $('#form_year_period_id').val() == null || $('#form_year_period_id').val() == undefined || $('#form_year_period_id').val() == false){
        swal('Peringatan', 'Periode Tahun Harus Diisi', 'error');
        return;
    }
    modal_finance_period_show(id, code,$('#form_year_period_id').val());
}
</script>


