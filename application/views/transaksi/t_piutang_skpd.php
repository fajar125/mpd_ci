<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>PIUTANG SKPD</span>
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
                    <span class="caption-subject font-blue bold uppercase">PIUTANG SKPD
                    </span>
                </div>
            </div>
            <!-- CONTENT  -->
            <div class="form-body">
                <div class="row">                    
                    <div class="form-group">
                        <label class="control-label col-md-3">Nama WP/ NPWD/ No Kohir
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control required" name="s_keyword" required  id="s_keyword" >
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" onclick="toTampil()">Cari</button>
                                </span>
                            </div>
                        </div>
                    </div>
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


<script >

    $('#table').css('display', 'none');
    
    function changeDenda(t_vat_setllement_id){
        modal_lov_t_piutang_skpd_show(t_vat_setllement_id);
    }
</script>


<script type="text/javascript">
    
    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_piutang_skpd_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'ID',name: 't_vat_setllement_id', hidden: true ,width: 180, align: "left"},
                {label: 'ID',name: 't_customer_order_id', hidden: true ,width: 180, align: "left"},
                {label: 'ID',name: 'p_vat_type_id', hidden: true ,width: 180, align: "left"},
                {label: 'No Bayar',name: 'payment_key', hidden: true ,width: 180, align: "left"},
                {label: 'No. Order',name: 'order_no',width: 180, align: "left"},
                {label: 'NAMA WP',name: 'wp_name',width: 230, align: "left"},
                {label: 'ALAMAT WP',name: 'wp_address_name',width: 230, align: "left"},
                {label: 'Jenis Pajak',name: 'jenis_pajak',width: 230, align: "left"},
                {label: 'NPWPD',name: 'npwd',width: 150, align: "left"},
                {label: 'Periode Tahun',name: 'year_code',width: 150, align: "left"},
                {label: 'Periode',name: 'finance_period_code',width: 150, align: "left"},
                {label: 'Masa Pajak',name: 'masa_pajak',width: 150, align: "left"},
                {label: 'Total Transaksi',name: 'total_trans_amount',width: 180, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Total Penalti',name: 'total_penalty_amount',width: 180, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Tanggal Jatuh Tempo',name: 'due_date',width: 150, align: "left"},
                {label: 'Dasar Pengenaan',name: 'debt_vat_amt',width: 150, align: "left"},
                {label: 'Total Pajak',name: 'total_vat_amount',width: 180,summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Kompensasi kelebihan dari tahun sebelumnya',name: 'cr_adjustment',width: 200, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Setoran yang dilakukan',name: 'cr_payment',width: 200, align: "left"},
                {label: 'Lain-lain',name: 'cr_others',width: 180, align: "left"},
                {label: 'STP (Pokok)',name: 'cr_stp',width: 180, align: "left"},
                {label: 'Bunga (Pasal 65 ayat(2))',name: 'db_interest_charge',width: 180, align: "left"},
                {label: 'Kenaikan (Pasal 65 ayat (3))',name: 'db_increasing_charge',width: 180, align: "left"},
                {label: 'Perbaharui Denda',width: 163,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var t_vat_setllement_id = rowObject['t_vat_setllement_id'];
                            return '<a class="btn btn-danger btn-xs" href="#" onclick="updateDenda('+t_vat_setllement_id+');">Perbaharui Denda</a>';
                        
                    }
                },
                {label: 'Submit',width: 163,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var t_customer_order_id = rowObject['t_customer_order_id'];
                        var payment_key = rowObject['payment_key'];
                        var p_vat_type_id = rowObject['p_vat_type_id'];
                        var t_vat_setllement_id = rowObject['t_vat_setllement_id'];
                            return '<a class="btn btn-primary btn-xs" href="#" onclick="submit('+t_customer_order_id+','+payment_key+','+p_vat_type_id+','+t_vat_setllement_id+');">Submit</a>';
                        
                    }
                }

            ],
            height: '100%',
            autowidth: false,
            viewrecords: true,
            rowNum: 10,
            rowList: [10,20,50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            footerrow: false,
            gridComplete: function() {
                
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
            beforeProcessing: function (data) {

            },
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }

                setTimeout(function(){
                      $("#grid-table").setSelection($("#grid-table").getDataIDs()[0],true);
                },500);

            },
            caption: "DAFTAR SSPD/SPTPD(Pelaporan Pajak)"

        });



        

    });

    

    function responsive_jqgrid(grid_selector, pager_selector) {
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        $(pager_selector).jqGrid( 'setGridWidth', parent_column.width() );
    }

    

    function toTampil(){
        var s_keyword        = $('#s_keyword').val();        
        
        if( s_keyword ==""){            
            swal ( "Oopss" ,  "TahunHarus Di isi!" ,  "error" );
            return;
        }else{
            $('#table').css('display', '');
            jQuery(function($) {
                var grid_selector = "#grid-table";

                jQuery("#grid-table").jqGrid('setGridParam',{
                    url: '<?php echo WS_JQGRID."transaksi.t_piutang_skpd_controller/read"; ?>',
                    postData: {s_keyword:s_keyword}
                });
                $("#grid-table").jqGrid("setCaption", "DAFTAR SSPD/SPTPD(Pelaporan Pajak)");
                $("#grid-table").trigger("reloadGrid");
            });
            
            
        }
    }
</script>

<script>
    function updateDenda(t_vat_setllement_id){
        var url = "<?php echo WS_JQGRID."transaksi.t_piutang_skpd_controller/updateDenda/?"; ?>";
            url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            url += "&t_vat_setllement_id=" + t_vat_setllement_id;

        $.getJSON(url, function( items ) {
            

            if(items.rows != "OK"){
                swal('Peringatan', 'Denda Gagal Diperbaharui', 'error');
                return;
            }else{
                swal('Informasi', 'Denda Berhasil Diperbaharui', 'info');
                return;
            }
        })
    }

    function submit(t_customer_order_id, payment_key, p_vat_type_id, t_vat_setllement_id){

        var url = "<?php echo WS_JQGRID."transaksi.t_piutang_skpd_controller/submit/?"; ?>";
            url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            url += "&t_customer_order_id=" + t_customer_order_id;
            url += "&payment_key=" + payment_key;
            url += "&p_vat_type_id=" + p_vat_type_id;
            url += "&t_vat_setllement_id=" + t_vat_setllement_id;

        swal({
          title: "Konfirmasi",
          text: "Apa Anda yakin akan submit data ini ? ",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
          closeOnConfirm: false,
          showLoaderOnConfirm: true
        },
        function(){
          //swal("Deleted!", "Your imaginary file has been deleted.", "success");
            setTimeout(function(){
                $.getJSON(url, function( items ) {
                    if(items.rows.o_result_code != "0"){
                        swal('Peringatan', items.rows.o_result_msg, 'error');
                        return;
                    }else{
                        swal('Informasi', items.rows.o_result_msg, 'info');
                        return;
                    }
                })
            }, 2000);
        });

        
    }

</script>