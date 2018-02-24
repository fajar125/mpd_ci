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
    <div class="col-md-12">
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
                            <input type="text" class="form-control" name="company_brand" id="company_brand" readonly style="width: 260px;">
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
                            <span class="input-group-addon"> s/d </span>
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
                                <button class="btn btn-success" type="button" id="btn-lov-class" name="btn-lov-class">
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
                        <div class="input-group" >
                            <input style="text-align: right;" type="text" class="form-control" name="total_trans_amount" id="total_trans_amount">
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Jumlah Kamar/Kursi Terjual</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input style="text-align: right;" type="text" class="form-control" name="qty_room_sold" id="qty_room_sold">
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row col-md-offset-3">
                    <button class="btn btn-success" type="submit" id="btn-submit" onclick="save()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <h4 id="info-belum-bayar">Informasi Pajak Belum Bayar</h4>
        <table id="grid-table-piutang" class="table table-bordered"></table>
    </div>

</div>

<?php $this->load->view('lov/lov_cust_account'); ?>
<?php $this->load->view('lov/lov_year_period'); ?>
<?php $this->load->view('lov/lov_finance_period'); ?>
<?php $this->load->view('lov/lov_vat_type'); ?>
<?php $this->load->view('lov/lov_vat_type_dtl'); ?>
<?php $this->load->view('lov/lov_ayat_class'); ?>

<script>
$(function() {
    $('#info-belum-bayar').hide();
});
</script>

<script>
    $("#total_trans_amount").number(true,0,'.',',');
    $("#qty_room_sold").number(true,0,'.',',');
</script>

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
    $('#btn-lov-class').on('click', function() {
        //alert( $('#form_vat_dtl_id').val());
        if ($('#form_vat_dtl_id').val()=='' || $('#form_vat_dtl_id').val()==0 ) {
            swal('Informasi','Tipe Pajak Harus Diisi','info');
            return false;
        } else {
             modal_vat_type_dtl_cls_show('form_class_id','form_class_code',$('#form_vat_dtl_id').val());
        }
    });

    $('#form_vat_dtl_id').on('change', function() {
        $('#form_class_id').val('');
        $('#form_class_code').val('');
    });

    $('#form_cust_account_id').on('change', function() {
        $('#info-belum-bayar').hide();
        $('#grid-table-piutang').empty();
        $('#form_year_period_id').val('');
        $('#form_year_code').val('');
        $('#form_finance_period_id').val('');
        $('#form_finance_code').val('');
        $('#valid_from').val('');
        $('#valid_to').val('');
    });

</script>

<script type="text/javascript">

    function save(){
        /*loadContentWithParams("transaksi.t_vat_setllement_ro_otobuk_v2", {
            CURR_DOC_ID: 720589
        });
        return;*/
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
        //alert(tipe_ayat);return;
        if (cust_acc_id == "" || cust_acc_id == 0 || cust_acc_id == false || cust_acc_id == undefined ||  cust_acc_id == null){
            swal('Informasi',"NPWPD harus diisi",'info');
            return;
        }
        if (finance_period == "" || finance_period == 0 || finance_period == false || finance_period == undefined ||  finance_period == null){
            swal('Informasi',"Periode Pelaporan Pajak harus diisi",'info');
            return;
        }
        if (tipe_ayat == "" || tipe_ayat == 0 || tipe_ayat == false || tipe_ayat == undefined ||  tipe_ayat == null){
            swal('Informasi',"Tipe Ayat harus diisi",'info');
            return;
        }

		if (jml_omset == "" || jml_omset == false || jml_omset == undefined ||  jml_omset == null){
            swal({
                title: 'Apakah Anda Yakin?',
                type: 'info',
                html: true,
                text: 'Jumlah Omzet yg diinputkan adalah 0 (Nihil). Apakah Anda yakin untuk melanjutkan dengan ketetapan SKPDN(Nihil) ?',
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                closeOnConfirm: false,
                closeOnCancel:true
            },
            function(isConfirm){
                if(isConfirm) submitPelaporanPajak();
            });
        }else {
            submitPelaporanPajak();
        }

    }

</script>


<script>

    function submitPelaporanPajak() {

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

        var var_url = "<?php echo WS_JQGRID . "transaksi.t_vat_setlement_manual_controller/insertUpdate/?"; ?>";
        var_url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        var_url += "&t_cust_account_id=" + cust_acc_id;
        var_url += "&p_finance_period_id=" + finance_period;
        var_url += "&npwd=" + npwpd;
        var_url += "&start_date=" + start_period;
        var_url += "&end_date=" + end_period;
        var_url += "&qty_room_sold=" + jml_kamar;
        var_url += "&trans_amount=" + jml_omset;
        var_url += "&p_vat_type_dtl_id=" + tipe_ayat;
        var_url += "&p_vat_type_dtl_cls_id=" + kelas;

        //window.location = var_url;

        $.getJSON(var_url, function( items ) {
            swal('Informasi',items.rows.o_mess,'info');

            if(items.rows.o_cust_order_id != 0){
                loadContentWithParams("transaksi.t_vat_setllement_ro_otobuk_v2", {
                    CURR_DOC_ID: items.rows.o_cust_order_id
                });
            }
        })

    }

</script>

<script type="text/javascript">
    function showPiutang(cust_acc_id, finance_period_id){
        $('#grid-table-piutang').empty();

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

                $('#info-belum-bayar').show();
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
</script>