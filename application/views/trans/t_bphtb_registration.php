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
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-0">
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
                                            <input type="text" class="form-control" name="in_name_subjek">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">NPWP
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="in_npwp_subjek">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Alamat
                                        </label>
                                        <div class="col-md-4">
                                            <textarea rows="4" cols="50" class="form-control"  name="in_alamat_subjek" id="in_alamat_subjek"> </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">No Telp
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="in_no_telp_subjek">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">No Hp
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="in_no_hp_subjek">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">RT/RW
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control" name="in_rt_subjek">
                                                <span class="input-group-addon"> / </span>
                                                <input type="text" class="form-control" name="in_rw_subjek">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kota/Kabupaten
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="in_kota_id_subjek" id="in_kota_id_subjek" readonly>
                                                <input type="text" class="form-control required" name="in_kota_name_subjek" id="in_kota_name_subjek" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kota-subjek">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kecematan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="in_kecematan_id_subjek" id="in_kecematan_id_subjek" readonly>
                                                <input type="text" class="form-control required" name="in_kecematan_name_subjek" id="in_kecematan_name_subjek" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kecematan-subjek">
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
                                                <input type="hidden" class="form-control required" name="in_kelurahan_id_subjek" id="in_kelurahan_id_subjek" readonly>
                                                <input type="text" class="form-control required" name="in_kelurahan_name_subjek" id="in_kelurahan_name_subjek" readonly>
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
                                            <input type="text" class="form-control" name="in_no_pajak_objek">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Letak Tanah dan atau Bangunan
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="in_letak_tanah_objek">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2">RT/RW
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control" name="in_rt_objek">
                                                <span class="input-group-addon"> / </span>
                                                <input type="text" class="form-control" name="in_rw_objek">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kota/Kabupaten
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="in_kota_id_objek" id="in_kota_id_objek" readonly>
                                                <input type="text" class="form-control required" name="in_kota_name_objek" id="in_kota_name_objek" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kota-objek">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kecematan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="in_kecematan_id_objek" id="in_kecematan_id_objek" readonly>
                                                <input type="text" class="form-control required" name="in_kecematan_name_objek" id="in_kecematan_name_objek" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kecematan-objek">
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
                                            <input type="text" class="form-control" name="in_no_pajak_objek">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Pendukung
                                        </label>
                                        <div class="col-md-2">
                                            <div class="input-group ">
                                                <input type="text" class="form-control" name="in_pendukung_objek">
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
                                                <input type="text" class="form-control"  readonly="true" name="in_nilai_tanah_objek">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" readonly="true" name="in_rp_nilai_tanah_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2"> Nilai bangunan (Ref)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control"  readonly="true" name="in_nilai_bangunan_objek">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" readonly="true" name="in_rp_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2"> Tanah 
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control"   name="in_nilai_bangunan_objek">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
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
                                                <input type="text" class="form-control"   name="in_nilai_bangunan_objek">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
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
                                                <input type="text" class="form-control"   name="in_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-3 col-md-offset-2">
                                            <select  name="in_dok_pendukung_objek" id="in_dok_pendukung_objek" class="form-control">
                                                <option value='1' >Harga Transaksi</option>
                                                <option value='2' >Harga Pasar</option>
                                                <option value='3' >Harga Lelang</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-md-offset-3 ">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp</span>
                                                <input type="text" class="form-control"   name="in_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Potongan Kebijakan untuk Waris
                                        </label>
                                        <div class="col-md-3 ">
                                            <select  name="in_dok_pendukung_objek" id="in_dok_pendukung_objek" class="form-control">
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
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Potongan Tambahan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Nilai Perolehan Objek Pajak Tidak Kena Pajak(NPOPTKP)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Nilai Perolehan Objek Pajak Kena Pajak(NPOPKP)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Bea Perolehan Hak atas Tanah dan Bangunan yang terutang
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Potongan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h7 class="control-label col-md-2 ">Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar </h7>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control"  name="in_rp_nilai_bangunan_objek">
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

<script >
    $('#tab-0').on('click', function(event){
        event.stopPropagation();
        loadContentWithParams("trans.t_bphtb_registration_list", {});
    });

    $.ajax({
            url: "<?php echo base_url().'home/load_combo_dok_pendukung/'; ?>" ,
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