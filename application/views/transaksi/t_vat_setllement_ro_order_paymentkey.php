<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>PEMBAYARAN DENGAN NO. BAYAR</span>
        </li>
    </ul> 
</div>
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="row">
                    <label class="control-label col-xs-2">Nomor Bayar</label>
                    
                        <div class="input-group col-xs-4">
                            <input type="text" class="form-control" name="payment_key" id="payment_key" style="">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" id="btn-search" onclick="showData()"><span class="fa fa-search bigger-110"></span> Cari</button>
                            </span>  
                        </div>
                    
                </div>
            </div>
        </div>
        
        
    </div>
    
    
</div>
<div class="tab-content no-border">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="form-body" id="grid-pager">
                    <div class="row">
                        <label class="control-label col-md-2">Jenis SPT</label>
                        <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="settlement_type_code" id="settlement_type_code" readonly style="">    
                        </div>
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">No. Order</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="order_no" id="order_no" readonly style="">                 
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">No. Kwitansi</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="receipt_no" id="receipt_no" readonly style="">    
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Jenis Pajak</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="jenis_pajak" id="jenis_pajak" readonly style="">    
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">No. Ayat</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="no_ayat" id="no_ayat" readonly style="">                 
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">NPWPD</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="npwd" id="npwd" readonly style="">    
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Nama WP</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="wp_name" id="wp_name" readonly style="">    
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Alamat WP</label>
                        
                            <div class="input-group col-md-5">
                                <textarea class="form-control" name="wp_address_name" id="wp_address_name" readonly style=""></textarea>  
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Periode</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="finance_period_code" id="finance_period_code" readonly style="">                 
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Masa Pajak</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="valid_from" id="valid_from">
                                <span class="input-group-addon"> s/d </span>
                                <input type="text" class="form-control" name="valid_to" id="valid_to">           
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Total Transaksi</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="total_trans_amount" id="total_trans_amount" readonly style="text-align: right">                 
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Total Pajak</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="total_vat_amount" id="total_vat_amount" readonly style="text-align: right">                 
                            </div>
                       
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Total Denda</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="total_penalty_amount" id="total_penalty_amount" readonly style="text-align: right">                 
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Total</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="total_total" id="total_total" readonly style="text-align: right">                 
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Tanggal Jatuh Tempo</label>
                        
                            <div class="input-group col-md-5">
                                <input type="text" class="form-control" name="due_date" id="due_date" readonly style="">                 
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Jenis Pembayaran</label>
                        
                            <div class="input-group col-md-3">
                                <div id="comboDocPendukung"></div>            
                            </div>
                        
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Anomali</label>
                        
                            <div class="input-group col-md-3">
                                <select id="is_anomali" name="is_anomali" class="FormElement form-control" >
                                    <option value="">--Pilih Anomali--</option>
                                    <option value="N">Tidak</option>
                                    <option value="Y">Ya</option>
                                </select>                   
                            </div>
                       
                    </div>
                    <div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">No. Kohir</label>
                        
                            <div class="input-group col-md-5">
                                <input type="number" class="form-control" name="no_kohir" id="no_kohir" readonly style="">                 
                            </div>
                        
                    </div>
					<div class="space-2"></div>
                    <div class="row">
                        <label class="control-label col-md-2">Status Pembayaran</label>
                        
                        <div class="input-group col-md-5">
							<input type="text" class="form-control" name="status_bayar" id="status_bayar" readonly>                 
                        </div>
                    </div>
                    <div class="space-2"></div>
                    <div class="row col-md-offset-3">
                        <button class="btn btn-success" type="submit" id="btn-submit" onclick="save()">Simpan</button>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#total_trans_amount').number(true,2,'.',',');
    $('#total_vat_amount').number(true,2,',','.');
    $('#total_penalty_amount').number(true,2,',','.');
    $('#total_total').number(true,2,',','.');

</script>

<script type="text/javascript">
$ ("#grid-pager").hide();



function showData(){
    $ ("#grid-pager").show();
    
    var payment_key = $('#payment_key').val();
    var var_url = "<?php echo WS_JQGRID . "transaksi.t_vat_setllement_ro_order_paymentkey_controller/read/?"; ?>";
        var_url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        var_url += "&payment_key=" + payment_key;

        //window.location = var_url;
        
        $.getJSON(var_url, function( items ) {
            //swal('Informasi',items.rows.o_mess,'info'); 
            var totaltotal = parseFloat(items.rows[0].total_vat_amount)+ parseFloat(items.rows[0].total_penalty_amount); 
            $('#settlement_type_code').val(items.rows[0].settlement_type_code); 
            $('#order_no').val(items.rows[0].order_no); 
            $('#receipt_no').val(items.rows[0].receipt_no);  
            $('#jenis_pajak').val(items.rows[0].jenis_pajak);  
            $('#no_ayat').val(items.rows[0].no_ayat); 
            $('#npwd').val(items.rows[0].npwd); 
            $('#wp_name').val(items.rows[0].wp_name);  
            $('#wp_address_name').val(items.rows[0].wp_address_name);
            $('#finance_period_code').val(items.rows[0].settlement_type_code); 
            $('#valid_from').val(items.rows[0].start_period); 
            $('#valid_to').val(items.rows[0].end_period);  
            $('#total_trans_amount').val(items.rows[0].total_trans_amount);
            $('#total_vat_amount').val(items.rows[0].total_vat_amount); 
            $('#total_penalty_amount').val(items.rows[0].total_penalty_amount); 
            $('#total_total').val(totaltotal);  
            $('#due_date').val(items.rows[0].due_date);
            $('#payment_type').val(items.rows[0].p_payment_type_id); 
            $('#is_anomali').val(items.rows[0].is_anomali); 
            $('#no_kohir').val(items.rows[0].no_kohir);  
			
			if(items.rows[0].is_settled == 'Y') $('#status_bayar').val('Lunas');
			else $('#status_bayar').val('Belum Bayar');

        })
}

function save(){

        var payment_key = $('#payment_key').val();
        var payment_type = $('#payment_type').val();
        //alert(tipe_ayat);return;
        if (payment_type == "" || payment_type == 0 || payment_type == false || payment_type == undefined ||  payment_type == null){
            swal('Informasi',"Jenis Pembayaran harus diisi",'info'); 
            return;
        }


        var var_url = "<?php echo WS_JQGRID . "transaksi.t_vat_setllement_ro_order_paymentkey_controller/insertUpdate/?"; ?>";
        var_url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        var_url += "&payment_key=" + payment_key;
        var_url += "&payment_type=" + payment_type;

        //window.location = var_url;
        
        $.getJSON(var_url, function( items ) {
            swal('Informasi',items.rows.o_mess,'info');
            if (items.rows.o_cust_order_id !=0) {
                url = '<?php echo base_url(); ?>'+'cetak_registrasi_payment_large_arial/pageCetak?payment_key='+payment_key;
                openInNewTab(url);
            }
            
        })

        
        
    }

</script>

<script> 
    $('#start_period').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'yyyy-mm-dd',
      todayBtn: 'linked',
      todayHighlight: true
    });
    $('#end_period').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'yyyy-mm-dd',
      todayBtn: 'linked',
      todayHighlight: true
    });
</script>

<script>

$.ajax({
    url: "<?php echo base_url().'transaksi/payment_type_combo/'; ?>" ,
    type: "POST",            
    data: {},
    success: function (data) {
        $( "#comboDocPendukung" ).html( data );
    },
    error: function (xhr, status, error) {
        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
    }
});


function responsive_jqgrid(grid_selector) {

        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(grid_selector).jqGrid('setGridWidth', $(".form-body").width());
        //$(pager_selector).jqGrid('setGridWidth', parent_column.width());

    }

function showLOVVat_type(id, code) {
    modal_lov_vat_show(id, code);
}
function showLOVBusinessArea(id, code) {
    modal_business_area_show(id, code);
}
function showLOVKetetapan(id, code) {
    modal_ketetapan_show(id, code);
}
function openInNewTab(url) {
    // window.open("../report/cetak_rep_lap_harian_bdhr.php?tgl_penerimaan='" + tgl_penerimaan + "'&kabid=T"+ "&kode_bank="+kode_bank, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
  window.open(url, 'No Payment', 'left=0,top=0,width=500,height=500,toolbar=no,scrollbars=yes,resizable=yes');
  // win.focus();
}

</script>
