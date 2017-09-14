<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pelaporan Pajak Manual</span>
        </li>
    </ul> 
</div>
<div class="space-4"></div>
<div class="row">
    <div class="col-md-8">
        <div class="portlet light bordered">
            <div class="form-body" id="grid-pager">
                <div class="row">
                    <label class="control-label col-md-3">NPWPD</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input id="form_cust_account_id" type="text"  style="display:none;">
                            <input id="form_npwpd" readonly type="text" class="FormElement form-control" placeholder="Pilih NPWPD">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVCustAcc('form_cust_account_id','form_npwpd', 'company_brand', 'form_vat_type_id','form_vat_code', 'form_vat_dtl_id','form_vat_dtl_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Nama</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" name="company_brand" id="company_brand" readonly style="width: 260px">                 
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Periode Tahun</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input id="form_year_period_id" type="text"  style="display:none;">
                            <input id="form_year_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Periode Tahun">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button"  onclick="showLOVYearPeriod('form_year_period_id','form_year_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Periode</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input id="form_finance_period_id" type="text"  style="display:none;" onchange="showPiutang($('#form_cust_account_id').val(), $('#form_finance_period_id').val())">
                            <input id="form_finance_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Periode">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" id="btn-lov-period" onclick="showLOVFinancePeriod('form_finance_period_id','form_finance_code', 'valid_from', 'valid_to')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Masa Pajak</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" id="valid_from">  
                            <label class="control-label col-md-3">s/d</label>    
                            <input type="text" class="form-control" id="valid_to">             
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Ayat Pajak</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input id="form_vat_type_id" type="text"  style="display:none;">
                            <input id="form_vat_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Ayat Pajak">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVVatType('form_vat_type_id','form_vat_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Tipe Ayat</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input id="form_vat_dtl_id" type="text"  style="display:none;">
                            <input id="form_vat_dtl_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Tipe Ayat">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVTypeDtl('form_vat_dtl_id','form_vat_dtl_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelas</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input id="form_class_id" type="text"  style="display:none;">
                            <input id="form_class_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kelas">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVClass('form_class_id','form_class_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Jumlah Omset</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" name="total_trans_amount" id="total_trans_amount">                 
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Jumlah Kamar/Kursi Terjual</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" name="qty_room_sold" id="qty_room_sold">                 
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row col-md-offset-3">
                    <button class="btn btn-success" type="submit" id="btn-submit" onclick="save()">Simpan</button>
                </div>
            </div>
        </div>
        
        
    </div>
    <?php $this->load->view('lov/lov_cust_account'); ?>
    <?php $this->load->view('lov/lov_year_period'); ?>
    <?php $this->load->view('lov/lov_finance_period'); ?>
    <?php $this->load->view('lov/lov_vat_type'); ?>
    <?php $this->load->view('lov/lov_vat_type_dtl'); ?>
    <?php $this->load->view('lov/lov_ayat_class'); ?>
    <div class="tab-content no-border">
    <div class="row">
        <div class="col-md-4">
            <div id="gbox_grid-table" class="ui-jqgrid">
                <div id="gview_grid-table" class="ui-jqgrid-view table-responsive" role="grid">
                    <table id="grid-table-piutang" border="1"></table>
                </div>
            </div>            
        </div>
    </div>
</div>
    
</div>


<!-- <script type="text/javascript">
    
    jQuery(function ($) {
        var grid_selector = "#grid-table-piutang";
        jQuery("#grid-table-piutang").jqGrid({
            colModel: [
                {label: 'Periode',name: 'period',width: 150, align: "left"},
                {label: 'Status',name: 'vat_code',width: 150, align: "left"},

            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: -1,
            rowList: [10, 20, 50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: true,
            multiboxonly: true,
            caption: "Informasi Pajak Belum Bayar"
        });
        
    });    
</script> -->

<script> 
    $('#valid_from').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'dd-mm-yyyy',
      todayBtn: 'linked',
      todayHighlight: true
    });
    $('#valid_to').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'dd-mm-yyyy',
      todayBtn: 'linked',
      todayHighlight: true
    });
</script>

<script type="text/javascript">

    

    function save(){

        var cust_acc_id = $('#form_cust_account_id').val();
        var npwpd = $('#form_npwpd').val();
        var nama = $('#company_brand').val();        
        var year_period = $('#form_year_period_id').val();
        var finance_period = $('#form_finance_period_id').val();
        var ayat = $('#form_vat_id').val();
        var tipe_ayat = $('#form_vat_dtl_id').val();
        var kelas = $('#form_class_id').val();        
        var jml_omset = $('#total_trans_amount').val();
        var jml_kamar = $('#qty_room_sold').val();
        var start_period = $('#valid_from').val();
        var end_period = $('#valid_to').val();


        var url = "<?php echo WS_JQGRID . "transaksi.t_vat_setlement_manual_controller/insertUpdate/?"; ?>";
        url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        url += "&t_cust_account_id=" + $("#grid-pager").getGridParam("postData").cust_acc_id;
        url += "&p_finance_period_id=" + $("#grid-pager").getGridParam("postData").finance_period;
        url += "&npwd=" + $("#grid-pager").getGridParam("postData").npwpd;
        url += "&start_date=" + $("#grid-pager").getGridParam("postData").start_period;
        url += "&end_date=" + $("#grid-pager").getGridParam("postData").end_period;
        url += "&qty_room_sold=" + $("#grid-pager").getGridParam("postData").jml_kamar;
        url += "&trans_amount=" + $("#grid-pager").getGridParam("postData").jml_omset;
        url += "&p_vat_type_dtl_id=" + $("#grid-pager").getGridParam("postData").tipe_ayat;
        url += "&p_vat_type_dtl_cls_id=" + $("#grid-pager").getGridParam("postData").kelas;

        window.location = url;
    }

        

    //     jQuery(function($) {
    //    // var grid_selector = "#grid-table-piutang";
    //     //var pager_selector = "#grid-pager-bpps2";
    //     /*

    //     */

    //         // jQuery("#grid-pager").jqGrid('setGridParam',{
    //         //     url: '<?php //echo WS_JQGRID."transaksi.t_vat_setlement_manual_controller/insertUpdate"; ?>',
    //         //     postData: {t_cust_account_id :cust_acc_id,
                            // p_finance_period_id: finance_period,
                            // npwd: npwpd,
                            // start_date: start_period,
                            // end_date: end_period,
                            // qty_room_sold:jml_kamar,
                            // trans_amount:jml_omset,
                            // p_vat_type_dtl_id:tipe_ayat,
                            // p_vat_type_dtl_cls_id:kelas
    //         //             }

    //         // });
    //     });
    // });

</script>

<script type="text/javascript">
    function showPiutang(cust_acc_id, finance_period_id){
        $('#grid-table-piutang').show(1000,function(){
                $('#grid-table-piutang').css('display','table')      
        });
                var no_block = [15,17,21,27,30,41,42,43];
                var type_id= parseFloat($('#form_vat_dtl_id').val());
                                if(type_id == null || type_id==0 || type_id =='')return;
                if( $.inArray( type_id, no_block ) > -1 ){ 
                    $('#grid-table-piutang').fadeOut(1000);
                    $('#grid-table-piutang').empty();
                    return;
                }
        $.getJSON("Transaksi/getPiutang?t_cust_account_id="+cust_acc_id+"&p_finance_period_id="+finance_period_id, function( items ) {
                jumlah = items.length;
                if(jumlah < 1) {
                    $('#grid-table-piutang').empty();
                    $('#grid-table-piutang').append(
                                                        '<tr>'+
                                                                '<th>'+
                                                                        'PERIODE'+
                                                                '</th>'+
                                                                '<th>'+
                                                                        'STATUS'+
                                                                '</th>'+
                                                        '</tr>'
                    );

            
                    return;
                
                
                }
                $('#grid-table-piutang').empty();
                $('#grid-table-piutang').append(
                                                        '<tr>'+
                                                                '<th>'+
                                                                        'PERIODE'+
                                                                '</th>'+
                                                                '<th>'+
                                                                        'STATUS'+
                                                                '</th>'+
                                                        '</tr>'
                );
                for(i = 0; i < jumlah; i++){
                    $('#grid-table-piutang').append(
                                                    '<tr>'+
                                                            '<td>'+
                                                                    items[i][2]+
                                                            '</td>'+
                                                            '<td>'+
                                                                    items[i][1]+
                                                            '</td>'+
                                                    '</tr>'
                    )
                }
                $('#grid-table-piutang').fadeIn(1000);
        })
    }
</script>

<script>
function responsive_jqgrid(grid_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid('setGridWidth', $(".form-body").width());
        //$(pager_selector).jqGrid('setGridWidth', parent_column.width());

    }

function showLOVCustAcc(id, code, name, id_vat, vat_code, id_dtl, vat_dtl) {
    modal_cust_account_show(id, code, name, id_vat, vat_code, id_dtl, vat_dtl);
}
function showLOVYearPeriod(id, code) {

    modal_year_period_show(id, code);
}
function showLOVFinancePeriod(id, code, start_date,end_date) {
    if ($('#form_year_period_id').val()=='' || $('#form_year_period_id').val()==0 ) {
        swal('Informasi','Periode Tahun Harus Diisi','info');
        return false;
    } else {
        //swal('Informasi', $('#form_year_period_id').val(),'info');

        modal_finance_period_show(id, code, $('#form_year_period_id').val(), start_date,end_date);
    }
    
}
function showLOVVatType(id, code) {
    modal_lov_vat_show(id, code);
}
function showLOVTypeDtl(id, code) {
    if ($('#form_vat_type_id').val()=='' || $('#form_vat_type_id').val()==0 ) {
        swal('Informasi','Ayat Pajak Harus Diisi','info');
        return false;
    } else {
        //swal('Informasi', $('#form_year_period_id').val(),'info');

        modal_lov_vat_dtl_show(id, code,$('#form_vat_type_id').val());
    }
    
}
function showLOVClass(id, code, parent) {
    if ($('#form_vat_dtl_id').val()=='' || $('#form_vat_dtl_id').val()==0 ) {
        swal('Informasi','Tipe Pajak Harus Diisi','info');
        return false;
    } else {
        //swal('Informasi', $('#form_year_period_id').val(),'info');

        modal_vat_type_dtl_cls_show(id, code,$('#form_vat_dtl_id').val());
    }
}

</script>
