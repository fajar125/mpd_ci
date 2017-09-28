<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Daftar BPHTB</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Add BPHTB</span>
            <i class="fa fa-circle"></i>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" class="back" id="tab-0">
                        <i class="blue"></i>
                        <strong> Daftar BPHTB </strong>
                    </a>
                </li>
                <li class="active">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-1">
                        <i class="blue"></i>
                        <strong> Add BPHTB </strong>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content no-border">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet blue box menu-panel">
                        <div class="portlet-title">
                            <div class="caption">Add BPHTB</div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body">   
                            <div class="form-horizontal">
                                <div class="row">
                                    <!-- start subject -->
                                    <div class="form-group">
                                        <label class="control-label col-md-2"> A. Subjek Pajak </label>
                                        <label class="control-label col-md-4" style="text-align: left !important;" id="subject_pajak" name="subject_pajak"></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Nama
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="wp_name" id="wp_name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">NPWP
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="npwp" id="npwp">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Alamat
                                        </label>
                                        <div class="col-md-4">
                                            <textarea rows="4" cols="50" class="form-control"  name="wp_address_name" id="wp_address_name"> </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">No Telp
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="phone_no" id="phone_no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">No Hp
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control formatRight" name="mobile_phone_no" id="mobile_phone_no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">RT/RW
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control" name="wp_rt" id="wp_rt">
                                                <span class="input-group-addon"> / </span>
                                                <input type="text" class="form-control" name="wp_rw" id="wp_rw">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kota/Kabupaten
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="wp_p_region_id" id="wp_p_region_id" readonly>
                                                <input type="text" class="form-control required" name="wp_kota" id="wp_kota" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kota-subjek">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">kecamatan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="wp_p_region_id_kec" id="wp_p_region_id_kec" readonly>
                                                <input type="text" class="form-control required" name="wp_kecamatan" id="wp_kecamatan" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kecamatan-subjek">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kelurahan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="wp_p_region_id_kel" id="wp_p_region_id_kel" readonly>
                                                <input type="text" class="form-control required" name="wp_kelurahan" id="wp_kelurahan" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kelurahan-subjek">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End subject -->

                                    <!-- start Objek -->
                                    <div class="form-group">
                                        <label class="control-label col-md-2 " > B. Objek Pajak </label>
                                        <label class="control-label col-md-4" style="text-align: left !important;" id="objek_pajak" name="objek_pajak"></label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2">No Objek Pajak
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="njop_pbb" id="njop_pbb">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Letak Tanah dan atau Bangunan
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="object_letak_tanah" id="object_letak_tanah">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2">RT/RW
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control" name="object_rt" id="object_rt">
                                                <span class="input-group-addon"> / </span>
                                                <input type="text" class="form-control" name="object_rw" id="object_rw">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kota/Kabupaten
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="object_p_region_id" id="object_p_region_id" readonly>
                                                <input type="text" class="form-control required" name="object_kota" id="object_kota" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kota-objek">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">kecamatan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="object_p_region_id_kec" id="object_p_region_id_kec" readonly>
                                                <input type="text" class="form-control required" name="object_kecamatan" id="object_kecamatan" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kecamatan-objek">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kelurahan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="in_kelurahan_id_objek" id="in_kelurahan_id_objek" readonly>
                                                <input type="text" class="form-control required" name="in_kelurahan_name_objek" id="in_kelurahan_name_objek" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kelurahan-objek">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Dokumen Pendukung 
                                        </label>
                                        <div class="col-md-3">
                                           <div id="comboDocPendukung"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="bphtb_legal_doc_description" id="bphtb_legal_doc_description">
                                        </div>
                                        <input type="text" class="form-control" name="nilai_doc" id="nilai_doc">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Pendukung
                                        </label>
                                        <div class="col-md-2">
                                            <div class="input-group ">
                                                <input type="text" class="form-control formatRight" name="add_disc_percent" id="add_disc_percent">
                                                <span class="input-group-addon">% </span>
                                            </div> 
                                        </div>
                                        <label class="control-label col-md-6 col-md-offset-2">(Gunakan tanda "."(titik) untuk luas dengan bilangan pecahan)
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Nilai Tanah (Ref)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control formatRight"  readonly="true" name="land_area_real" id="land_area_real">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat" readonly="true" name="land_price_real" id="land_price_real">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2"> Nilai bangunan (Ref)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control formatRight"  readonly="true" name="building_area_real" id="building_area_real">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat" readonly="true" name="building_price_real" id="building_price_real">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2"> Tanah 
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control formatRight"   name="land_area" id="land_area">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="land_price_per_m" id="land_price_per_m">
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="land_total_price" id="land_total_price">
                                            </div> 
                                        </div>
                                        <label class="control-label col-md-5 col-md-offset-2">(Gunakan tanda "."(titik) untuk luas dengan bilangan pecahan)
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">  Bangunan 
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control formatRight"   name="building_area" id="building_area">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="building_price_per_m" id="building_price_per_m">
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="building_total_price" id="building_total_price">
                                            </div> 
                                        </div>
                                        <label class="control-label col-md-5 col-md-offset-2">(Gunakan tanda "."(titik) untuk luas dengan bilangan pecahan)
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-md-offset-2">  Total
                                        </label>
                                        <div class="col-md-3 col-md-offset-4 ">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp</span>
                                                <input type="text" class="form-control priceformat"   name="total_price" id="total_price">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-3 col-md-offset-2">
                                            <select  name="jenis_harga_bphtb" id="jenis_harga_bphtb" class="form-control">
                                                <option value='1' >Harga transaksi</option>
                                                <option value='2' >Harga Pasar</option>
                                                <option value='3' >Harga Lelang</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-md-offset-3 ">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp</span>
                                                <input type="text" class="form-control priceformat"   name="market_price" id="market_price">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Potongan Kebijakan untuk Waris
                                        </label>
                                        <div class="col-md-3 ">
                                            <select  name="potongan_waris" id="potongan_waris" class="form-control">
                                                <option value='1/1' >Bukan Waris</option>
                                                <option value='1/2' >1/2</option>
                                                <option value='1/3' >1/3</option>
                                                <option value='2/3' >2/3</option>
                                                <option value='1/4' >1/4</option>
                                                <option value='1/7' >1/7</option>
                                                <option value='3/4' >3/4</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Nilai Perolehan Objek Pajak (NPOP)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="npop" id="npop">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Potongan Tambahan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="add_discount" id="add_discount">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Nilai Perolehan Objek Pajak Tidak Kena Pajak(NPOPTKP)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="npop_tkp" id="npop_tkp">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Nilai Perolehan Objek Pajak Kena Pajak(NPOPKP)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="npop_kp" id="npop_kp">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Bea Perolehan Hak atas Tanah dan Bangunan yang terutang
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="bphtb_amt" id="bphtb_amt">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Potongan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="bphtb_discount" id="bphtb_discount">
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="description" id="description">
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <label class="control-label input-group-addon  ">  Cek Potongan :
                                                </label>
                                                <span class="input-group-addon"><input type="checkbox" class="form-control" name="check_potongan" id="check_potongan"></span>
                                            </div> 
                                        </div>
                                        <label class="control-label col-md-5 col-md-offset-6">(Silahkan cheklis utk pembayaran yg ada potongan)
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <h7 class="control-label col-md-2 ">Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar </h7>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  name="bphtb_amt_final" id="bphtb_amt_final">
                                            </div> 
                                        </div>
                                        
                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <a href="javascript:;" class="btn default button-previous back" id="back">
                                                    <i class="fa fa-angle-left"></i> Back </a>
                                                <a href="javascript:;" class="btn btn-outline green button-next"> CETAK NOTA VERIFIKASI (INDRA WISNU)                                                    
                                                </a>
                                                <button type="submit" class="btn green button-submit"> Submit
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Objek -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('lov/lov_kota'); ?>
<?php $this->load->view('lov/lov_kec'); ?>
<?php $this->load->view('lov/lov_kel'); ?>
<script >
    
    $(".priceformat").number( true, 0 , '.',','); /* price number format */
    $(".priceformat").css("text-align", "right");

    $(".numberformat").number( true, 0 , '.','.');
    $(".numberformat").css("text-align", "right");
    $(".formatRight").css("text-align", "right");


    $('.back').on('click', function(event){
        event.stopPropagation();
        loadContentWithParams("transaksi.t_bphtb_registration_list", {});
    });

    $("#btn-lov-kota-subjek").on('click', function() {   
        modal_lov_kota_show('wp_p_region_id','wp_kota');
    });

    $('#wp_p_region_id').on('change', function() {
        $('#wp_p_region_id_kec').val('');
        $('#wp_kecamatan').val('');
        $('#wp_p_region_id_kel').val('');
        $('#wp_kelurahan').val('');
    });

    $("#btn-lov-kecamatan-subjek").on('click', function() { 
        var kota = $('#wp_p_region_id').val(); 
        //alert(kota);
        if( kota == null || kota == ''){
            swal({title: "Error!", text: "Isi Kota/Kabupaten Terlebih Dahulu", html: true, type: "error"});
            return;
        }
         modal_lov_kecamatan_show('wp_p_region_id_kec','wp_kecamatan',kota);
        
    });

    $('#wp_p_region_id_kec').on('change', function() {
        $('#wp_p_region_id_kel').val('');
        $('#wp_kelurahan').val('');
    });

    $("#btn-lov-kelurahan-subjek").on('click', function() { 
        var kec = $('#wp_p_region_id_kec').val();
        if( kec == null || kec == ''){
            swal({title: "Error!", text: "Isi Kecamatan Terlebih Dahulu", html: true, type: "error"});
             return;
        }
        modal_lov_kelurahan_show('wp_p_region_id_kel','wp_kelurahan',kec);
    });

    function getdok(dok){
        //alert(dok.value);
        var id = dok.value;
        $.ajax({
            url: "<?php echo base_url().'bphtb_registration/call_service_doc'; ?>" ,
            type: "POST",            
            data: {
                id : id
            },
            dataType: "json",
            success: function (data) {
                console.log(data[0].p_bphtb_legal_doc_type_id);
                if(data[0].doc_cons > 0 && data[0].doc_cons != '' ){
                    $('#npop_tkp').val(data[0].doc_cons*document.getElementById(npop));
                    $('#nilai_doc').val(data[0].doc_cons);
                }else{
                    $('#npop_tkp').val("15");
                }
                
                $('#bphtb_discount').val("0");
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                $('#bphtb_discount').val("0");
            }
        });
    }

    $.ajax({
            url: "<?php echo base_url().'bphtb_registration/load_combo_dok_pendukung/'; ?>" ,
            type: "POST",            
            data: {},
            success: function (data) {
                $( "#comboDocPendukung" ).html( data );
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
            }
        });


    

</script>