<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Sistem Manajemen Pajak Daerah</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <?php $this->load->view('template/scripts');?>
        <?php $this->load->view('template/styles');?>
        <!-- for electron.io shakes -->
        <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
    </head>

   <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md page-header-fixed page-sidebar-fixed" style="background-color: #64D76B !important;">
<!-- breadcrumb -->
<!-- end breadcrumb -->

<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">

        <div class="tab-content no-border">
            <!-- <div class="row">
                <div class="col-xs-12">
                   <table id="grid-table"></table>
                   <div id="grid-pager"></div>
                </div>
            </div> -->
            <div style="text-align: center;"><img src="<?php echo base_url(); ?>assets/image/logo-2.png" width="50px" height="" alt=""></div>
            <div style="text-align: center; color: #ffffff; font-weight: bold; font-size: 20px;">PEMERINTAH KABUPATEN LOMBOK UTARA</div>
            <div style="text-align: center; color: #ffffff; font-weight: bold; font-size: 20px;">BADAN PENDAPATAN DAERAH</div>
            <hr>
            <div class="row">  
                <div class="col-xs-6">
                    <div DISPLAY: inline-block" id="container"></div>
                </div>  
                <div class="col-xs-6">
                    <div DISPLAY: inline-block" id="container2"></div>
                </div>  
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>

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



<script>

    // untuk dapatkan tahun
    var d = new Date();
    var n = d.getFullYear();


    // alert(n);

    reloadChart(n);
    reloadChart2(n);

    setTimeout(function() {
        reloadChart(n);
        reloadChart2(n);
    },100000);


    function reloadChart(year_code) {
        $.getJSON( "<?php echo base_url('Target_realisasi_dash/target_realisasi_tahun?year_code=')?>"+year_code, function( items ) {
                var target_amt = items[0][0];
                var realisasi_amt = items[0][1];
                var tahun = items[0][2];
                                Highcharts.setOptions({
                                        lang:{
                                                numericSymbols: [" Ribu"," Juta"," Milyar"," Triliun"," Biliun"," Seliun"]
                                        }
                                });
                $("#container").highcharts({
                                                chart: {
                                type: "column"
                        },
                        title: {
                                text: "Target vs Realisasi " + tahun
                        },
                        subtitle: {
                                text: "Bapenda Lombok Utara"
                        },
                        tooltip: {
                                
                        },
                        xAxis: {
                                categories: [tahun]
                        },
                        yAxis: {
                                title: {
                    text: ""
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
                        series: [
                        {showInLegend: true, name: "Target " + tahun, data: [target_amt]},
                        {showInLegend: true, name: "Realisasi " + tahun, data: [realisasi_amt]}
                        ]
                });
        });
    }

    function reloadChart2(year_code) {
        $.getJSON( "<?php echo base_url('Target_realisasi_dash/t_target_realisasi_bulan_all?year_code=')?>"+year_code, function( items ) {
        //$.getJSON( "http://localhost/mpd/services/t_target_realisasi_bulan_all.php?p_year_period_id=28", function( items ) {
                var target_amount = [];
                var realisasi_amt = [];
                var vat_code = [];
                
                var jumlah = items.length;
                
                for(i = 0; i < jumlah; i++){
                        target_amount[i] = parseFloat(items[i][1]);
                        realisasi_amt[i] = parseFloat(items[i][2])+parseFloat(items[i][3])+parseFloat(items[i][4]);
                        vat_code[i] = items[i][0];
                }
                $("#container2").highcharts({
                        chart: {
                                type: "column"
                        },
                        title: {
                                text: "Target vs Realisasi Tahunan"
                        },
                        subtitle: {
                                text: "Bapenda Lombok Utara"
                        },
                        xAxis: {
                                categories: vat_code
                        },
                        yAxis: {
                                min: 0,
                                title: {
                                        text: ""
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
                        {showInLegend: true, name: "Target", data: target_amount},
                        {showInLegend: true, name: "Realisasi", data: realisasi_amt}
                        ]
                });
        });
    }

    

</script>

</body>
</html>