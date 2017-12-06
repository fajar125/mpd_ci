<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>CETAK SKPDKB PEMERIKSAAN DUPLIKAT</span>
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
                    <span class="caption-subject font-blue bold uppercase">CETAK SKPDKB PEMERIKSAAN DUPLIKAT
                    </span>
                </div>
            </div>
            <!-- CONTENT PORTLET -->
            <div class="form-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-3"> Nama WP/ NOP / No Registrasi :
                        </label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" class="form-control" name="s_keyword" id="s_keyword">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button" id="search">
                                    Cari
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

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
        </div>
    </div>
</div>
<!--- lov -->
<script>

    function openInNewTab(url) {
        window.open(url, 'No Payment', 'left=0,top=0,width=500,height=500,toolbar=no,scrollbars=yes,resizable=yes');
    }

    function cetakSKPD(t_vat_setllement_id) {
        url = "<?php echo base_url(); ?>"+"cetak_formulir_sptpd_pdf/pageCetak?t_vat_setllement_id="+t_vat_setllement_id;
        openInNewTab(url);
    }
</script>
<script>
//t_vat_setllement_cetak_skpd_penelitian_controller
    $('#gview_grid-table').hide();
    jQuery(function ($) {
            var grid_selector = "#grid-table";
            var pager_selector = "#grid-pager";

            jQuery("#grid-table").jqGrid({
                url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_cetak_skpd_penelitian_controller/read_data"; ?>',
                postData:{s_keyword : $('#s_keyword').val()},
                datatype: "json",
                mtype: "POST",
                colModel: [
                    {label: 'NAMA WP',name: 'wp_name',width: 300,sorttype: 'text'},  
                    {label: 'NPWPD',name: 'npwd',width: 130,sorttype: 'text'},
                    {label: 'Periode',name: 'finance_period_code',width: 150,sorttype: 'number'},
                    {label: 'Jenis Ketetapan',name: 'sett_code',width: 200,sorttype: 'text'},
                    {label: 'Total Transaksi',name: 'total_trans_amount',width: 150, align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}
                    },
                    {label: 'Total Pajak',name: 'total_vat_amount',width: 150, align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}
                    },
                    {label: 'Denda',name: 'total_penalty_amount',width: 150, align: "right",formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}
                    },
                    {label: 'No Kohir',name: 'no_kohir',width: 120,sorttype: 'number', align: 'right'},
                    {label: 'Cetak SKPD Penelitian',name: 'Options',width: 200, align: "center",
                        formatter:function(cellvalue, options, rowObject) {
                            var t_vat_setllement_id = rowObject['t_vat_setllement_id'];
                            return '<a class="btn btn-primary btn-xs" href="#" onClick="cetakSKPD('+t_vat_setllement_id+')">Cetak SKPD Penelitian</a>';
                        }
                    }
                ],
                height: '100%',
                autowidth: true,
                viewrecords: true,
                rowNum: -1,
                rowList: [10, 20, 50],
                rownumbers: true, // show row numbers
                rownumWidth: 35, // the width of the row numbers columns
                altRows: true,
                shrinkToFit: false,
                multiboxonly: true,
                loadComplete: function (response) {
                    if(response.success == false) {
                        swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                    }

                },
                caption: "DAFTAR SKPDKB PEMERIKSAAN(Pelaporan Pajak)"

            });
        });


    $('#search').on('click', function() {
        if($('#s_keyword').val() == ""){            
            swal ( "Oopss" ,  "Filter Harus Diisi !" ,  "error" );
        }else{
            $('#gview_grid-table').show();
            jQuery(function($) {
                var grid_selector = "#grid-table";

                jQuery("#grid-table").jqGrid('setGridParam',{
                    url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_cetak_skpd_penelitian_controller/read_data"; ?>',
                    postData:{s_keyword : $('#s_keyword').val()}
                });
                $("#grid-table").jqGrid("setCaption", "DAFTAR SKPDKB PEMERIKSAAN(Pelaporan Pajak)");
                $("#grid-table").trigger("reloadGrid");
            });
        }
    });

</script>