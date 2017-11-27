<div id="modal_lov_bphtb_ws" class="modal fade" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog" style="width:900px;">
        <div class="modal-content">
            <!-- modal title -->
            <div class="modal-header no-padding">
                <div class="table-header">
                    <span class="form-add-edit-title">INFORMASI NOP </span>
                </div>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <label class="control-label col-md-2">NOP</label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="nop_search" id="nop_search">
                            </div>
                        </div>
                    </div>
                    <div class="space-2"></div>

                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-2">Tahun</label>
                            <div class="col-md-3">
                                <div id="comboTahun"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space-2"></div>
                    <div class="row col-md-offset-4">
                        <button class="btn btn-primary" type="button" onclick="toFind()" id="find">Cari</button>
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="panel panel-primary" id="panel-form" style="display: none">
                    <div class="panel-heading">INFORMASI DETIL NOMOR OBJEK PAJAK</div>
                    <div class="panel-body">
                        <div class="form-body">

                            <div class="row">
                                <label class="control-label col-md-3">NOP</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lov_NOP" id="lov_NOP" readonly="true">     
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>

                            <div class="row">
                                <label class="control-label col-md-3">KOTA</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="lov_kota" id="lov_kota" readonly="true">          
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lov_nama_kota" id="lov_nama_kota"  readonly="true">     
                                        <input type="hidden" class="form-control" name="lov_id_kota" id="lov_id_kota" readonly="true">            
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>

                            <div class="row">
                                <label class="control-label col-md-3">KECAMATAN</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lov_kecamatan" id="lov_kecamatan" readonly="true">          
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lov_nama_kecamatan" id="lov_nama_kecamatan" readonly="true">
                                        <input type="hidden" class="form-control" name="lov_id_kecamatan" id="lov_id_kecamatan" readonly="true">            
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>

                            <div class="row">
                                <label class="control-label col-md-3">KELURAHAN</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="lov_kelurahan" id="lov_kelurahan" readonly="true">          
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lov_nama_kelurahan" id="lov_nama_kelurahan"   readonly="true">
                                        <input type="hidden" class="form-control" name="lov_id_kelurahan" id="lov_id_kelurahan"  readonly="true">            
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>

                            <div class="row">
                                <label class="control-label col-md-3">JALAN</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lov_jalan" id="lov_jalan"  readonly="true">     
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>
                            
                            <div class="row">
                                <label class="control-label col-md-3">RT</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lov_rt" id="lov_rt" readonly="true">     
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>
                            
                            <div class="row">
                                <label class="control-label col-md-3">RW</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lov_rw" id="lov_rw" readonly="true">     
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>
                            
                            <div class="row">
                                <label class="control-label col-md-3">LUAS BUMI</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control priceformat" name="lov_luas_bumi" id="lov_luas_bumi"  readonly="true">
                                        <input type="hidden" class="form-control" name="lov_luas_bumi1" id="lov_luas_bumi1"  readonly="true">     
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>
                            
                            <div class="row">
                                <label class="control-label col-md-3">LUAS BANGUNAN</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control priceformat" name="lov_luas_bangunan" id="lov_luas_bangunan"  readonly="true">
                                        <input type="hidden" class="form-control" name="lov_luas_bangunan1" id="lov_luas_bangunan1"  readonly="true">     
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>
                            
                            <div class="row">
                                <label class="control-label col-md-3">NJOP BANGUNAN</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control priceformat" name="lov_njop_bangunan" id="lov_njop_bangunan"  readonly="true">
                                        <input type="hidden" class="form-control" name="lov_njop_bangunan1" id="lov_njop_bangunan1"  readonly="true">     
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>
                            
                            <div class="row">
                                <label class="control-label col-md-3">NJOP BUMI</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control priceformat" name="lov_njop_bumi" id="lov_njop_bumi"  readonly="true">
                                        <input type="hidden" class="form-control" name="lov_njop_bumi1" id="lov_njop_bumi1"  readonly="true">     
                                    </div> 
                                </div>
                            </div>

                            <div class="space-2"></div>
                            
                            <div class="row">
                                <label class="control-label col-md-3">NJOP PBB</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control priceformat" name="lov_njop_pbb" id="lov_njop_pbb"  readonly="true">
                                        <input type="hidden" class="form-control" name="lov_njop_pbb1" id="lov_njop_pbb1" readonly="true">     
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>
                            
                            <div class="row">
                                <label class="control-label col-md-3">PBB TERHUTANG</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control priceformat" name="lov_pbb_terhutang" id="lov_pbb_terhutang" readonly="true">
                                        <input type="hidden" class="form-control" name="lov_pbb_terhutang1" id="lov_pbb_terhutang1"  readonly="true">    
                                    </div>
                                </div>
                            </div>

                            <div class="space-2"></div>
                            
                            <div class="row">
                                <label class="control-label col-md-3">STATUS PEMBAYARAN BPHTB</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="lov_status_bayar" id="lov_status_bayar"  readonly="true">   
                                    </div>
                                </div>
                            </div>


                            <div class="space-2"></div>

                            <div class="row">
                                <div class="col-md-3 col-md-offset-4">
                                    <div class="input-group">
                                        <button class="btn btn-success btn-sm radius-4" id="btn-pilih">
                                            Pilih
                                        </button>
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
                        <button class="btn btn-danger btn-sm radius-4" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script>
    $(".priceformat").number( true, 0 , '.',','); /* price number format */
    $(".priceformat").css("text-align", "right");
    $.ajax({
            url: "<?php echo base_url().'bphtb_registration/tahun_period_combo/'; ?>" ,
            type: "POST",            
            data: {},
            success: function (data) {
                $( "#comboTahun" ).html( data );
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
            }
    });


    

    function toFind(){
        var nop_search = $('#nop_search').val();
        var year_code = $('#year_code').val();

        if ((nop_search!= null ||nop_search!='')&&(year_code!= null ||year_code!='')){
            
            //start Hardcode

            /*$('#lov_NOP').val('327303000200400950');
            $('#lov_kota').val('KABUPATEN xxxxxxxxx');
            $('#lov_nama_kota').val('KABUPATEN xxxxxxxxxx');
            $('#lov_id_kota').val('750');
            $('#lov_kecamatan').val('KECAMATAN XXXXXXXXXXXXXXxxx');
            $('#lov_nama_kecamatan').val('KECAMATAN XXXXXXXXXXXXXXxxx');
            $('#lov_id_kecamatan').val('2095');
            $('#lov_kelurahan').val('KELURAHAN XXXXXXXXXXXXx');
            $('#lov_nama_kelurahan').val('KELURAHAN XXXXXXXXXXXXx');
            $('#lov_id_kelurahan').val('2108');
            $('#lov_jalan').val('Parhal');
            $('#lov_rt').val('04');
            $('#lov_rw').val('01');
            $('#lov_luas_bumi').val('100000');
            $('#lov_luas_bumi1').val('100000');
            $('#lov_luas_bangunan').val('100000');
            $('#lov_luas_bangunan1').val('100000');
            $('#lov_njop_bangunan').val('100000');
            $('#lov_njop_bangunan1').val('100000');
            $('#lov_njop_bumi').val('100000');
            $('#lov_njop_bumi1').val('100000');
            $('#lov_njop_pbb').val('100000');
            $('#lov_njop_pbb1').val('100000');
            $('#lov_pbb_terhutang').val('100000');
            $('#lov_pbb_terhutang1').val('100000');
            $('#lov_status_bayar').val('OK');

            $('#panel-form').css('display','');*/

            //END Hardcode


            //start Call WS
            //ket call ws sudah bisa dan error atau pesan dari ws sudah ke tangkap tetapi kurang yakin karena items selalu kosong atau selalu tidak ada datanya

            $.ajax({
                url: '<?php echo WS_JQGRID."transaksi.t_bphtb_registration_list_controller/read_ws"; ?>',
                type: "POST",
                dataType: "json",
                data: {
                   nop_search: nop_search,
                   year_code: year_code
                },
                success: function (data) {
                    console.log(data);
                    if(data.success){
                        var dt = data.items;
                        if (dt != null || dt != ''){
                            $('#lov_NOP').val(dt.NOP);
                            $('#lov_kota').val(dt.kota);
                            $('#lov_nama_kota').val(dt.nama_kota);
                            $('#lov_id_kota').val(dt.id_kota);
                            $('#lov_kecamatan').val(dt.kecamatan);
                            $('#lov_nama_kecamatan').val(dt.nama_kecamatan);
                            $('#lov_id_kecamatan').val(dt.id_kecamatan);
                            $('#lov_kelurahan').val(dt.kelurahan);
                            $('#lov_nama_kelurahan').val(dt.nama_kelurahan);
                            $('#lov_id_kelurahan').val(dt.id_kelurahan);
                            $('#lov_jalan').val(dt.jalan);
                            $('#lov_rt').val(dt.rt);
                            $('#lov_rw').val(dt.rw);
                            $('#lov_luas_bumi').val(dt.luas_bumi);
                            $('#lov_luas_bumi1').val(dt.luas_bumi);
                            $('#lov_luas_bangunan').val(dt.luas_bangunan);
                            $('#lov_luas_bangunan1').val(dt.luas_bangunan);
                            $('#lov_njop_bangunan').val(dt.njop_bangunan);
                            $('#lov_njop_bangunan1').val(dt.njop_bangunan);
                            $('#lov_njop_bumi').val(dt.njop_bumi);
                            $('#lov_njop_bumi1').val(dt.njop_bumi);
                            $('#lov_njop_pbb').val(dt.njop_pbb);
                            $('#lov_njop_pbb1').val(dt.njop_pbb);
                            $('#lov_pbb_terhutang').val(dt.pbb_terhutang);
                            $('#lov_pbb_terhutang1').val(dt.pbb_terhutang);
                            $('#lov_status_bayar').val(dt.status_bayar);
                            $('#panel-form').css('display','');
                        }
                    }else{
                        swal({title: "Error!", text: data.message, html: true, type: "error"});
                    }
                },
                error: function (xhr, status, error) {
                    swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                }
            });

            //END Call WS
        }

        
    }

    $('#btn-pilih').on('click',function(){
        var NOP = $('#lov_NOP').val();
        var kota = $('#lov_kota').val();
        var nama_kota = $('#lov_nama_kota').val();
        var id_kota = $('#lov_id_kota').val();
        var kecamatan = $('#lov_kecamatan').val();
        var nama_kecamatan = $('#lov_nama_kecamatan').val();
        var id_kecamatan = $('#lov_id_kecamatan').val();
        var kelurahan = $('#lov_kelurahan').val();
        var nama_kelurahan = $('#lov_nama_kelurahan').val();
        var id_kelurahan = $('#lov_id_kelurahan').val();
        var jalan = $('#lov_jalan').val();
        var rt = $('#lov_rt').val();
        var rw = $('#lov_rw').val();
        var luas_bumi = $('#lov_luas_bumi').val();
        var luas_bumi1 = $('#lov_luas_bumi1').val();
        var luas_bangunan = $('#lov_luas_bangunan').val();
        var luas_bangunan1 = $('#lov_luas_bangunan1').val();
        var njop_bangunan = $('#lov_njop_bangunan').val();
        var njop_bangunan1 = $('#lov_njop_bangunan1').val();
        var njop_bumi = $('#lov_njop_bumi').val();
        var njop_bumi1 = $('#lov_njop_bumi1').val();
        var njop_pbb = $('#lov_njop_pbb').val();
        var njop_pbb1 = $('#lov_njop_pbb1').val();
        var pbb_terhutang = $('#lov_pbb_terhutang').val();
        var pbb_terhutang1 = $('#lov_pbb_terhutang1').val();
        var status_bayar = $('#lov_status_bayar').val();


        $('#njop_pbb').val(NOP);
        $('#object_rt').val(rt);
        $('#object_rw').val(rw);

        $('#land_area').val(luas_bumi);
        $('#building_area').val(luas_bangunan);
        $('#land_area_real').val(luas_bumi);

        $('#building_area_real').val(luas_bangunan);
        $('#object_letak_tanah').val(jalan);
        $('#land_price_real').val(njop_bumi1);

        $('#building_price_real').val(njop_bangunan1);

        if (luas_bumi1 != 0){
            $('#land_price_per_m').val(njop_bumi1/luas_bumi1);
        }else{
            $('#land_price_per_m').val(0);
        }

        if (luas_bangunan1 != 0){
            $('#building_price_per_m').val(njop_bangunan1/luas_bangunan1);
        }else{
            $('#building_price_per_m').val(0);
        }

        $('#land_total_price').val(njop_bumi1);
        $('#building_total_price').val(njop_bangunan1);
        $('#total_price').val(parseFloat(njop_bangunan1)+parseFloat(njop_bumi1));

        $('#object_p_region_id').val(id_kota);
        $('#object_p_region_id_kec').val(id_kecamatan);
        $('#object_p_region_id_kel').val(id_kelurahan);

        $('#object_kota').val(nama_kota);
        $('#object_kecamatan').val(nama_kecamatan);
        $('#object_kelurahan').val(nama_kelurahan);


        $('#modal_lov_bphtb_ws').modal('hide');
    });

    function modal_lov_bphtb_ws_show() {
        $('#nop_search').val(null);
        $('#year_code').val(null);
        $('#panel-form').css('display','none');

        $("#modal_lov_bphtb_ws").modal({backdrop: 'static'});
    }
</script>