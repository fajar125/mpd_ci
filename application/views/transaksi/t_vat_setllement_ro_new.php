<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>CETAK SSPD/SPTPD</span>
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
                    <span class="caption-subject font-blue bold uppercase">CETAK SSPD/SPTPD
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

<?php $this->load->view('lov/lov_t_vat_setllement_ro_new'); ?>

<script >

    $('#table').css('display', 'none');
    
    function changeDenda(t_vat_setllement_id){
        modal_lov_t_vat_setllement_ro_new_show(t_vat_setllement_id);
    }
</script>


<script type="text/javascript">
    
    jQuery(function($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_new_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [
                {label: 'NAMA WP',name: 'wp_name',width: 230, align: "left"},
                {label: 'NPWPD',name: 'npwd',width: 150, align: "left"},
                {label: 'Periode',name: 'finance_period_code',width: 150, align: "left"},
                {label: 'No. Order',name: 'order_no',width: 180, align: "left"},
                {label: 'Total Transaksi',name: 'total_trans_amount',width: 180, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Total Pajak',name: 'total_vat_amount',width: 180,summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'Denda',name: 'total_penalty_amount',width: 180, summaryTpl:"{0}" ,summaryType:"sum", formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:',', defaultValue:'0'},align: "right"},
                {label: 'No Kohir',name: 'no_kohir',width: 180, align: "left"},
                {label: 'CETAK SSPD',width: 163,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var t_customer_order_id = rowObject['t_customer_order_id'];
                            return '<a class="btn btn-danger btn-xs" href="#" onclick="cetak_sspd('+t_customer_order_id+');">CETAK SSPD</a>';
                        
                    }
                },
                {label: 'CETAK STPD (TGL TAP)',width: 163,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var is_ada = rowObject['ada'];
                        if (is_ada > 0){
                            return '<button class="btn btn-xs btn-danger"  type="button" id="btn-kem" onClick="cetakStpd('+rowObject['t_vat_setllement_id']+',\'tgl_tap\');">Cetak</button>';
                        }else{
                            return "";
                        }
                        
                    }
                },
                {label: 'CETAK STPD (TGL BAYAR)',width: 168,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var is_ada = rowObject['ada'];
                        if (is_ada > 0){
                            return '<button class="btn btn-xs btn-danger"  type="button" id="btn-kem" onClick="cetakStpd('+rowObject['t_vat_setllement_id']+',\'tgl_bayar\');">Cetak</button>';
                        }else{
                            return "";
                        }
                        
                    }
                },
                {label: 'UBAH DENDA',width: 163,align: "center",
                    formatter:function(cellvalue, options, rowObject) {
                        var t_vat_setllement_id = rowObject['t_vat_setllement_id'];
                        var total_penalty_amount = rowObject['total_penalty_amount'];
                            return '<a class="btn btn-primary btn-xs" href="#" onclick="changeDenda('+t_vat_setllement_id+');">Ubah Denda</a>';
                        
                    }
                }

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
                    url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_new_controller/read"; ?>',
                    postData: {s_keyword:s_keyword}
                });
                $("#grid-table").jqGrid("setCaption", "DAFTAR SSPD/SPTPD(Pelaporan Pajak)");
                $("#grid-table").trigger("reloadGrid");
            });
            
            
        }
    }
</script>

<script>
    function cetak_sspd(t_customer_order_id){
        var url = "<?php echo base_url(); ?>"+"cetak_formulir_sspd_pdf/pageCetak?";
            url += "t_customer_order_id=" + t_customer_order_id;
         openInNewTab(url);
    }
    function cetakStpd(t_vat_setllement_id,tgl_surat){
        var url = "<?php echo base_url(); ?>"+"cetak_formulir_stpd_pdf/pageCetak?t_vat_setllement_id="+t_vat_setllement_id+"&tgl_surat="+tgl_surat;
        openInNewTab(url);
    }

    function openInNewTab(url) {
      window.open(url, '_blank', 'location=yes,height=570,width=820,scrollbars=yes,status=yes');
    }
</script>