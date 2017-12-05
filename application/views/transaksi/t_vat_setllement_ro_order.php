<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Pembayaran Loket BKP</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-1">
                        <i class="blue"></i>
                        <strong> PEMBAYARAN LOKET BKP </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-2" disabled>
                        <i class="blue"></i>
                        <strong> DATA LOG AKTIFITAS </strong>
                    </a>
                </li>
            </ul>
        </div>        
    </div>
</div>
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">               
                <div class="row col-md-offset-3">
                    <label class="control-label col-md-2">No Kohir</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="s_keyword" id="s_keyword">  
                        </div>
                    </div> 
                    <button class="btn btn-primary" type="button" onclick="toTampil()">Cari</button>
                </div>                
            </div>
        </div>       
    </div>   
</div>
<div class="space-2"></div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    
                    <span class="caption-subject font-blue bold uppercase"> Informasi 
                    </span>
                </div>
            </div>
            <!-- CONTENT  value="2015-09-01" -->
            <div class="form-body">
                <div class="row">                    
                    <label class="control-label col-md-2">No Order</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="order_no" id="order_no" readonly>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">No Kwitansi</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="receipt_no" id="receipt_no" readonly>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Jenis Pajak</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="jenis_pajak" id="jenis_pajak" readonly>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">No Ayat</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="no_ayat" id="no_ayat" readonly>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">NPWPD</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="npwd" id="npwd" readonly>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Nama WP</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="wp_name" id="wp_name" readonly>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Alamat WP</label>
                    <div class="col-md-7">
                        <div class="input-group">
                             <textarea rows="4" cols="100" class="form-control" maxlength="256"  name="wp_address_name" id="wp_address_name" readonly></textarea>                 
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Periode</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="finance_period_code" id="finance_period_code" readonly>                 
                    </div>
                    
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Masa Pajak</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1" name="start_period" id="start_period" readonly>                 
                        </div>
                    </div>
                    <label class="control-label col-md-1">s/d</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1" name="end_period" id="end_period" readonly>
                        </div>
                    </div>
                </div>  
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Total Transaksi</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="total_trans_amount" id="total_trans_amount" readonly>                 
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Total Pajak</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="total_vat_amount" id="total_vat_amount" readonly>                 
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Total Denda</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="total_penalty_amount" id="total_penalty_amount" readonly>                 
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Total</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="total_total" id="total_total" readonly>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">Tanggal Jatuh Tempo</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="due_date" id="due_date" readonly>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-2">Anomali</label>
                    <div class="col-md-2">
                        <select id="is_anomali" name="is_anomali" class="FormElement form-control" style="background-color: orange" disabled>
                            <option value="N">TIDAK</option>
                            <option value="Y">YA</option>
                        </select>
                        
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                    
                    <label class="control-label col-md-2">No Kohir</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="no_kohir" id="no_kohir" style="background-color: orange" readonly>                
                        
                    </div>
                </div>
                <div class="row col-md-offset-9">
                    <button class="btn btn-primary" type="button" onclick="flagPayment()">Flag Payment</button>
                    <button class="btn btn-primary" type="button" onclick="cetakRegister()">Cetak Register</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function toTampil(){
        var s_keyword = $('#s_keyword').val();

        if(s_keyword == '' || s_keyword == null){
            swal({title: "Error!", text:"No Kohir Harus Diisi!", html: true, type: "error"});
        }else{
            //alert(s_keyword);return;
            $.ajax({
                url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_order_controller/read"; ?>',
                type: "POST",
                //dataType: "json",
                data: {s_keyword: s_keyword
                },
                success: function (data) {
                    if(data.result != ''){
                        //alert(data.result);
                        var dt = data.items;
                        //alert(data.items);return;

                        $('#order_no').val(dt.order_no);
                        $('#receipt_no').val(dt.receipt_no);
                        $('#jenis_pajak').val(dt.jenis_pajak);
                        $('#no_ayat').val(dt.no_ayat);
                        $('#npwd').val(dt.npwd);
                        $('#wp_name').val(dt.wp_name);
                        $('#wp_address_name').val(dt.wp_address_name);
                        $('#start_period').val(dt.start_period);
                        $('#end_period').val(dt.end_period);
                        $('#total_trans_amount').val(dt.total_trans_amount);
                        $('#total_vat_amount').val(dt.total_vat_amount);
                        $('#total_penalty_amount').val(dt.total_penalty_amount);
                        $('#total_total').val(dt.total_total);
                        $('#due_date').val(dt.due_date);
                        $('#no_kohir').val(dt.no_kohir);


                    }
                    //console.log(data);
                    
                    
                },
                error: function (xhr, status, error) {
                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                }
            });  
        }

        
    }
</script>