
<!--  Modal Ubah Ayat -->
<div id="modal_ubah_ayat" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title">Ubah Ayat</span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <label class="control-label col-md-5"><b>Ayat Pajak Sebelumnya</b></label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="form-body">
                                <input type="hidden" name="t_vat_setllement_id" id="t_vat_setllement_id">
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Nomor Ayat</label>
                                    <div class="input-group col-md-4">
                                        <input type="text" class="form-control" name="nomor_ayat" id="nomor_ayat" readonly>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Nama Ayat</label>
                                    <div class="input-group col-md-4">
                                            <input type="text" class="form-control" name="nama_ayat" id="nama_ayat" readonly>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Nama Jenis Pajak</label>
                                    <div class="input-group col-md-4">
                                            <input type="text" class="form-control" name="nama_jns_pajak" id="nama_jns_pajak" readonly>
                                    </div>
                                </div>

                            </div>  
                        </div>       
                    </div>   
                </div>
                <label class="control-label col-md-5"><b>Perubahan Ayat</b></label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="form-body">
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Nama Ayat</label>
                                    <div class="input-group col-md-7">
                                        <input id="p_vat_type_dtl_id" type="text"  style="display:none;">
                                        <input id="vat_code_dtl" readonly type="text" class="FormElement form-control" placeholder="Pilih Nama Ayat" required>
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" type="button" onclick="showLOVVatDtl('p_vat_type_dtl_id','vat_code_dtl')">
                                                <span class="fa fa-search bigger-110"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Alasan Perubahan</label>
                                    <div class="input-group col-md-7">
                                            <textarea class="form-control" id="alasan_ayat" name="alasan_ayat" required></textarea>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                    </div>   
                </div>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-sm green-jungle radius-4" onclick="ubahData($('#t_vat_setllement_id').val(),1)">
                            <i class="ace-icon fa fa-check"></i>
                            Ubah
                        </button>
                        <button class="btn btn-danger btn-sm radius-4" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal ayat-->

<!--  Modal Ubah Tanggal -->
<div id="modal_ubah_tgl_trans" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title">Ubah Tanggal Transaksi</span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <label class="control-label col-md-5"><b>Tanggal Sebelumnya</b></label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="form-body">
                                <input type="hidden" name="t_vat_setllement_id" id="t_vat_setllement_id">
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Tanggal Transaksi</label>
                                    <div class="input-group col-md-4">
                                        <input type="text" class="form-control" name="settlement_date" id="settlement_date" readonly>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                    </div>   
                </div>
                <label class="control-label col-md-5"><b>Perubahan Tanggal</b></label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="form-body">
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Tanggal</label>
                                    <div class="input-group col-md-7">
                                        <input type="text" class="form-control" name="settlement_date_new" id="settlement_date_new" required>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Alasan Perubahan</label>
                                    <div class="input-group col-md-7">
                                            <textarea class="form-control" id="alasan_tgl" name="alasan_tgl" required></textarea>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                    </div>   
                </div>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-sm green-jungle radius-4" onclick="ubahData($('#t_vat_setllement_id').val(),2)">
                            <i class="ace-icon fa fa-check"></i>
                            Ubah
                        </button>
                        <button class="btn btn-danger btn-sm radius-4" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal tanggal-->

<!-- Modal Ubah Total -->
<div id="modal_ubah_total_trans" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title">Ubah Total Transaksi</span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <label class="control-label col-md-5"><b>Total Transaksi Sebelumnya</b></label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="form-body">
                                <input type="hidden" name="t_vat_setllement_id" id="t_vat_setllement_id">
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Total Transaksi</label>
                                    <div class="input-group col-md-4">
                                        <input type="text" class="form-control" name="total_trans_amount" id="total_trans_amount" readonly>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                    </div>   
                </div>
                <label class="control-label col-md-5"><b>Perubahan Total</b></label>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="form-body">
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Total Transaksi</label>
                                    <div class="input-group col-md-7">
                                        <input type="text" class="form-control" name="total_trans_amount_new" id="total_trans_amount_new" required>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Alasan Perubahan</label>
                                    <div class="input-group col-md-7">
                                            <textarea class="form-control" id="alasan_total" name="alasan_total" required></textarea>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                    </div>   
                </div>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-sm green-jungle radius-4" onclick="ubahData($('#t_vat_setllement_id').val(),3)">
                            <i class="ace-icon fa fa-check"></i>
                            Ubah
                        </button>
                        <button class="btn btn-danger btn-sm radius-4" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal total-->

<!-- Modal Ubah Ketetapan -->
<div id="modal_ubah_ketetapan" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title">Ubah Ketetapan</span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="form-body">
                                <div class="space-2"></div>
                                <div class="row">
                                    <input type="hidden" name="t_vat_setllement_id" id="t_vat_setllement_id">
                                    <label class="control-label col-md-3">Jenis Ketetapan</label>
                                    <div class="input-group col-md-7">
                                        <div id="settlementType"></div>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Alasan Perubahan</label>
                                    <div class="input-group col-md-7">
                                            <textarea class="form-control" id="alasan_ketetapan" name="alasan_ketetapan" required></textarea>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                    </div>   
                </div>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-sm green-jungle radius-4" onclick="ubahData($('#t_vat_setllement_id').val(),4)">
                            <i class="ace-icon fa fa-check"></i>
                            Ubah
                        </button>
                        <button class="btn btn-danger btn-sm radius-4" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal ketetapan-->

<!-- Modal Ubah Denda -->
<div id="modal_ubah_denda" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title">Ubah Denda</span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="form-body">
                                <div class="space-2"></div>
                                <div class="row">
                                    <input type="hidden" name="t_vat_setllement_id" id="t_vat_setllement_id">
                                    <label class="control-label col-md-3">Nilai Denda</label>
                                    <div class="input-group col-md-7">
                                        <input type="text" class="form-control" name="nilai_denda" id="nilai_denda" required>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Jenis Perubahan</label>
                                    <div class="input-group col-md-7">
                                        <select class="form-control" id="flag_piutang" name="flag_piutang">
                                            <option value="0">Ubah Nilai</option>
                                            <option value="1">Jadikan Ketetapan Denda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="space-2"></div>
                                <div class="row">
                                    <label class="control-label col-md-3">Deskripsi</label>
                                    <div class="input-group col-md-7">
                                            <textarea class="form-control" id="alasan_denda" name="alasan_denda" required></textarea>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                    </div>   
                </div>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-sm green-jungle radius-4" onclick="ubahData($('#t_vat_setllement_id').val(),5)">
                            <i class="ace-icon fa fa-check"></i>
                            Ubah
                        </button>
                        <button class="btn btn-danger btn-sm radius-4" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal denda-->

<!-- Modal Hapus Transaksi -->
<div id="modal_hapus_trans" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title">Hapus Transaksi</span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="form-body">
                                <div class="row">
                                    <input type="hidden" name="t_vat_setllement_id" id="t_vat_setllement_id">
                                    <label class="control-label col-md-3">Alasan Dihapus</label>
                                    <div class="input-group col-md-7">
                                            <textarea class="form-control" id="alasan_hapus" name="alasan_hapus" required></textarea>
                                    </div>
                                </div>
                            </div>  
                        </div>       
                    </div>   
                </div>
            </div>

            <!-- modal footer -->
            <div class="modal-footer no-margin-top">
                <div class="bootstrap-dialog-footer">
                    <div class="bootstrap-dialog-footer-buttons">
                        <button class="btn btn-sm green-jungle radius-4" onclick="ubahData($('#t_vat_setllement_id').val(),6)">
                            <i class="ace-icon fa fa-check"></i>
                            Hapus
                        </button>
                        <button class="btn btn-danger btn-sm radius-4" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal hapus transaksi-->



<?php $this->load->view('lov/lov_vat_type_dtl'); ?>


<script>

    function modal_ubah_data_show(id, i_mode){
        //alert(i_mode);
        if (i_mode == 1){
            $("#modal_ubah_ayat").modal("toggle"); 
        } else if (i_mode == 2){
            $("#modal_ubah_tgl_trans").modal("toggle");
        } else if (i_mode == 3){
            $("#modal_ubah_total_trans").modal("toggle");
        } else if (i_mode == 4){
            $("#modal_ubah_ketetapan").modal("toggle");
        } else if (i_mode == 5){
            $("#modal_ubah_denda").modal("toggle");
        } else if (i_mode == 6){
            $("#modal_hapus_trans").modal("toggle");
        }

        $(function() {
                $.ajax({
                    url: '<?php echo WS_JQGRID."transaksi.t_vat_setllement_ro_modifikasi_controller/readData"; ?>',
                    type: "POST",
                    dataType: 'json',
                    data: {t_vat_setllement_id: id, i_mode:i_mode},
                    success: function (data) {
                        if (i_mode == 1){
                            $('#t_vat_setllement_id').val(data.rows.t_vat_setllement_id);  
                            $('#nomor_ayat').val(data.rows.nomor_ayat);   
                            $('#nama_ayat').val(data.rows.nama_ayat);
                            $('#nama_jns_pajak').val(data.rows.nama_jns_pajak);
                        } else if(i_mode == 2){
                            $('#t_vat_setllement_id').val(data.rows.t_vat_setllement_id);  
                            $('#settlement_date').val(data.rows.settlement_date);
                        } else if(i_mode == 3){
                             $('#t_vat_setllement_id').val(data.rows.t_vat_setllement_id);
                             $('#total_trans_amount').val(data.rows.total_trans_amount);
                        } else if(i_mode == 4){
                            $('#t_vat_setllement_id').val(data.rows.t_vat_setllement_id);  
                        } else if(i_mode == 5){
                             $('#t_vat_setllement_id').val(data.rows.t_vat_setllement_id);
                        } else if(i_mode == 6){
                             $('#t_vat_setllement_id').val(data.rows.t_vat_setllement_id);
                        }

                    },
                    error: function (xhr, status, error) {
                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                    }
                });

            });
        
    }
</script>

<script>
     function ubahData($t_vat_setllement_id, $i_mode){
        if ($i_mode == 1){
            keyword = $('#p_vat_type_dtl_id').val();
            alasan = $('#alasan_ayat').val(); 
            flag_piutang = 0;
            pesan_keyword = "Nama Ayat Harus Diisi";
        } else if ($i_mode == 2){
            keyword = $('#settlement_date_new').val();
            alasan = $('#alasan_tgl').val(); 
            flag_piutang = 0;
            pesan_keyword = "Tanggal Harus Diisi";
        } else if ($i_mode == 3){
            keyword = $('#total_trans_amount_new').val();
            alasan = $('#alasan_total').val(); 
            flag_piutang = 0;
            pesan_keyword = "Total Harus Diisi";
        } else if ($i_mode == 4){
            keyword = $('#p_settlement_type_id').val();
            alasan = $('#alasan_ketetapan').val(); 
            flag_piutang = 0;
            pesan_keyword = "Jenis Ketetapan Harus Diisi";
        } else if ($i_mode == 5){
            keyword = $('#nilai_denda').val();
            alasan = $('#alasan_denda').val(); 
            flag_piutang = $('#flag_piutang').val();
        } else if ($i_mode == 6){
            keyword = $i_mode;
            alasan = $('#alasan_hapus').val();
            flag_piutang = 0;
        }
        if ($i_mode!=5){
            if (keyword == 0 || keyword == null || keyword == undefined || keyword == ''){
                swal('Peringatan',pesan_keyword, 'error');  
                return;
            }
            if (alasan == 0 || alasan == null || alasan == undefined || alasan == ''){
                swal('Peringatan','Alasan Harus Diisi', 'error');  
                return;
            }
        } else {
            if (keyword == 0 || keyword == null || keyword == undefined || keyword == ''){
                keyword = 0 ;
            }
        }
        var var_url = "<?php echo WS_JQGRID . "transaksi.t_vat_setllement_ro_modifikasi_controller/updateData/?"; ?>";
            var_url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            var_url += '&t_vat_setllement_id='+$t_vat_setllement_id;
            var_url += '&keyword='+keyword;
            var_url += '&alasan='+alasan;
            var_url += '&flag_piutang='+flag_piutang;
            var_url += '&i_mode='+$i_mode;
        $.getJSON(var_url, function( items ) {
                swal('Informasi',items.rows.msg,'info');  
            }) 

        //alert(var_url+"\n"+keyword+"\n"+alasan+"\n"+flag_piutang+"\n"+pesan_keyword);

    }
</script>

<script>
    $('#settlement_date_new').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'dd-mm-yyyy',
      todayBtn: 'linked',
      todayHighlight: true
    });

    $.ajax({
        url: "<?php echo base_url().'transaksi/jenis_ketetapan_combo/'; ?>" ,
        type: "POST",
        success: function (data) {
            $( "#settlementType" ).html( data );
        },
        error: function (xhr, status, error) {
            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
        }
    });

    function showLOVVatDtl(id, code) {
        modal_lov_vat_dtl_show(id, code);
    }
</script>