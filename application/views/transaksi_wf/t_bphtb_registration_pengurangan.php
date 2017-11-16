<!--breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Informasi Formulir Pendaftaran</span>
            <i class="fa fa-circle"></i>
        </li>
        
    </ul>
</div>
<div class="space-4"></div>
    <!-- parameter untuk kembali ke workflow summary -->
    <input type="hidden" id="TEMP_ELEMENT_ID" value="<?php echo $this->input->post('ELEMENT_ID'); ?>" />
    <input type="hidden" id="TEMP_PROFILE_TYPE" value="<?php echo $this->input->post('PROFILE_TYPE'); ?>" />
    <input type="hidden" id="TEMP_P_W_DOC_TYPE_ID" value="<?php echo $this->input->post('P_W_DOC_TYPE_ID'); ?>" />
    <input type="hidden" id="TEMP_P_W_PROC_ID" value="<?php echo $this->input->post('P_W_PROC_ID'); ?>" />
    <input type="hidden" id="TEMP_USER_ID" value="<?php echo $this->input->post('USER_ID'); ?>" />
    <input type="hidden" id="TEMP_FSUMMARY" value="<?php echo $this->input->post('FSUMMARY'); ?>" />
    <!-- end type hidden -->

    <!-- paramater untuk kebutuhan submit dan status -->
    <input type="hidden" id="CURR_DOC_ID" value="<?php echo $this->input->post('CURR_DOC_ID'); ?>">
    <input type="hidden" id="CURR_DOC_TYPE_ID" value="<?php echo $this->input->post('CURR_DOC_TYPE_ID'); ?>">
    <input type="hidden" id="CURR_PROC_ID" value="<?php echo $this->input->post('CURR_PROC_ID'); ?>">
    <input type="hidden" id="CURR_CTL_ID" value="<?php echo $this->input->post('CURR_CTL_ID'); ?>">
    <input type="hidden" id="USER_ID_DOC" value="<?php echo $this->input->post('USER_ID_DOC'); ?>">
    <input type="hidden" id="USER_ID_DONOR" value="<?php echo $this->input->post('USER_ID_DONOR'); ?>">
    <input type="hidden" id="USER_ID_LOGIN" value="<?php echo $this->input->post('USER_ID_LOGIN'); ?>">
    <input type="hidden" id="USER_ID_TAKEN" value="<?php echo $this->input->post('USER_ID_TAKEN'); ?>">
    <input type="hidden" id="IS_CREATE_DOC" value="<?php echo $this->input->post('IS_CREATE_DOC'); ?>">
    <input type="hidden" id="IS_MANUAL" value="<?php echo $this->input->post('IS_MANUAL'); ?>">
    <input type="hidden" id="CURR_PROC_STATUS" value="<?php echo $this->input->post('CURR_PROC_STATUS'); ?>">
    <input type="hidden" id="CURR_DOC_STATUS" value="<?php echo $this->input->post('CURR_DOC_STATUS'); ?>">
    <input type="hidden" id="PREV_DOC_ID" value="<?php echo $this->input->post('PREV_DOC_ID'); ?>">
    <input type="hidden" id="PREV_DOC_TYPE_ID" value="<?php echo $this->input->post('PREV_DOC_TYPE_ID'); ?>">
    <input type="hidden" id="PREV_PROC_ID" value="<?php echo $this->input->post('PREV_PROC_ID'); ?>">
    <input type="hidden" id="PREV_CTL_ID" value="<?php echo $this->input->post('PREV_CTL_ID'); ?>">
    <input type="hidden" id="SLOT_1" value="<?php echo $this->input->post('SLOT_1'); ?>">
    <input type="hidden" id="SLOT_2" value="<?php echo $this->input->post('SLOT_2'); ?>">
    <input type="hidden" id="SLOT_3" value="<?php echo $this->input->post('SLOT_3'); ?>">
    <input type="hidden" id="SLOT_4" value="<?php echo $this->input->post('SLOT_4'); ?>">
    <input type="hidden" id="SLOT_5" value="<?php echo $this->input->post('SLOT_5'); ?>">
    <input type="hidden" id="MESSAGE" value="<?php echo $this->input->post('MESSAGE'); ?>">
    <input type="hidden" id="PROFILE_TYPE" value="<?php echo $this->input->post('PROFILE_TYPE'); ?>">
    <input type="hidden" id="ACTION_STATUS" value="<?php echo $this->input->post('ACTION_STATUS'); ?>">
    <!-- end type hidden -->
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-xs-12">
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" class="back" id="tab-0">
                        <i class="blue"></i>
                        <strong> Formulir Pengurangan BPHTB</strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-1">
                        <i class="blue"></i>
                        <strong> Dokumen Pendukung </strong>
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab-content no-border">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet blue box menu-panel">
                        <div class="portlet-title">
                            <div class="caption">Informasi Formulir Pengurangan BPHTB</div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body">   
                            <div class="form-horizontal">
                                <div class="row">
                                    <!-- start subject -->
                                    <div class="form-group">
                                        <label class="control-label col-md-2" id="keterangan-kurang-bayar">  </label>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2"> A. Subjek Pajak </label>
                                        <label class="control-label col-md-4" style="text-align: left !important;" id="subject_pajak" name="subject_pajak"></label>

                                    </div>
                                    <div class="form-group" style="display: none">
                                        <label class="control-label col-md-2">No Registrasi
                                        </label>
                                        <div class="col-md-3">
                                            <input type="hidden" class="form-control" name="registration_no" id="registration_no">

                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Nama
                                        </label>
                                        <div class="col-md-3">
                                            <input type="hidden" class="form-control" name="t_bphtb_registration_id" id="t_bphtb_registration_id">
                                            <input type="text" class="form-control" maxlength="64" name="wp_name" id="wp_name">
                                            <input type="hidden" class="form-control" name="p_bphtb_type_id" id="p_bphtb_type_id">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">NPWP
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" maxlength="32" name="npwp" id="npwp">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Alamat
                                        </label>
                                        <div class="col-md-4">
                                            <textarea rows="4" cols="50" class="form-control" maxlength="256"  name="wp_address_name" id="wp_address_name"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">No Telp
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" maxlength="32" name="phone_no" id="phone_no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">No Hp
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control formatRight" maxlength="32" name="mobile_phone_no" id="mobile_phone_no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">RT/RW
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control" maxlength="10" name="wp_rt" id="wp_rt">
                                                <span class="input-group-addon"> / </span>
                                                <input type="text" class="form-control" maxlength="10" name="wp_rw" id="wp_rw">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kota/Kabupaten
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" maxlength="8" name="wp_p_region_id" id="wp_p_region_id" readonly>
                                                <input type="text" class="form-control required" name="wp_kota" id="wp_kota" readonly>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-success" type="button" id="btn-lov-kota-subjek">
                                                    <i class="fa fa-search"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kecamatan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" name="wp_p_region_id_kec" maxlength="8" id="wp_p_region_id_kec" readonly>
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
                                                <input type="hidden" class="form-control required" name="wp_p_region_id_kel" maxlength="8" id="wp_p_region_id_kel" readonly>
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
                                            <input type="text" class="form-control" maxlength="48" name="njop_pbb" id="njop_pbb">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Letak Tanah dan atau Bangunan
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" maxlength="128" name="object_letak_tanah" id="object_letak_tanah">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2">RT/RW
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" class="form-control" maxlength="10" name="object_rt" id="object_rt">
                                                <span class="input-group-addon"> / </span>
                                                <input type="text" class="form-control" maxlength="10" name="object_rw" id="object_rw">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Kota/Kabupaten
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control required" maxlength="10" name="object_p_region_id" id="object_p_region_id" readonly>
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
                                                <input type="hidden" class="form-control required" maxlength="10" name="object_p_region_id_kec" id="object_p_region_id_kec" readonly>
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
                                                <input type="hidden" class="form-control required" maxlength="10" name="object_p_region_id_kel" id="object_p_region_id_kel" readonly>
                                                <input type="text" class="form-control required" name="object_kelurahan" id="object_kelurahan" readonly>
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
                                            <input type="text" class="form-control" maxlength="100" name="bphtb_legal_doc_description" id="bphtb_legal_doc_description">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="hidden" class="form-control" name="nilai_doc" id="nilai_doc">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Pendukung
                                        </label>
                                        <div class="col-md-2">
                                            <div class="input-group ">
                                                <input type="text" class="form-control formatRight" name="add_disc_percent" onkeyup="hitungTotalTanah();return 1;" id="add_disc_percent">
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
                                                <input type="text" onkeyup="hitungTotalTanah();return 1;" class="form-control formatRight"  readonly="true" maxlength="16" name="land_area_real" id="land_area_real">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" onkeyup="hitungTotalTanah();" maxlength="16" class="form-control priceformat" readonly="true" name="land_price_real" id="land_price_real">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2"> Nilai bangunan (Ref)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" onkeyup="hitungTotalBangunan();" maxlength="16" class="form-control formatRight"  readonly="true" name="building_area_real" id="building_area_real">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" onkeyup="hitungTotalBangunan();" maxlength="16" class="form-control priceformat" readonly="true" name="building_price_real" id="building_price_real">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2"> Tanah 
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <input type="text" onkeyup="hitungTotalTanah();return 1;" maxlength="10"  class="form-control formatRight"   name="land_area" id="land_area">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" onkeyup="hitungTotalTanah();" maxlength="10" class="form-control priceformat"  name="land_price_per_m" id="land_price_per_m">
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control  priceformat"  maxlength="16" name="land_total_price" id="land_total_price">
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
                                                <input type="text" onkeyup="hitungTotalBangunan();"  maxlength="10" class="form-control formatRight"   name="building_area" id="building_area">
                                                <span class="input-group-addon">m2</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" onkeyup=" hitungTotalBangunan();"  maxlength="10" class="form-control priceformat"  name="building_price_per_m" id="building_price_per_m">
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat"  maxlength="16"  name="building_total_price" id="building_total_price">
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
                                                <input type="text" onkeyup=" getNPOP();" maxlength="16"  class="form-control priceformat"   name="market_price" id="market_price">
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
                                                <input type="text" class="form-control priceformat" maxlength="16" readonly  name="npop" id="npop">
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
                                                <input type="text" class="form-control priceformat" maxlength="16"  name="npop_tkp" id="npop_tkp">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Nilai Perolehan Objek Pajak Kena Pajak(NPOPKP)
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat" maxlength="16" name="npop_kp" id="npop_kp">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 ">  Bea Perolehan Hak atas Tanah dan Bangunan yang terutang
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat" maxlength="16"  name="bphtb_amt" id="bphtb_amt">
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <label class="control-label col-md-2 ">  Potongan
                                        </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat" maxlength="16"  name="bphtb_discount" id="bphtb_discount">
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

                                    <div id="div-harus-bayar" class="form-group" style="display: none">
                                        <label class="control-label col-md-2 " class="control-label col-md-2 ">Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="bphtb_amt_final_old" id="bphtb_amt_final_old">
                                        </div>
                                    </div>

                                    <div id="div-pembayaran-sebelumnya" class="form-group" style="display: none">
                                        <label class="control-label col-md-2 " class="control-label col-md-2 ">Nilai Pajak yang sudah dibayar </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="prev_payment_amount" id="prev_payment_amount">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 " id="total-bayar-text" class="control-label col-md-2 ">Bea Perolehan Hak atas Tanah dan Bangunan yang harus dibayar </label>
                                        <div class="col-md-3">
                                            <div class="input-group ">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control priceformat" maxlength="16" name="bphtb_amt_final" id="bphtb_amt_final">
                                            </div> 
                                        </div>
                                        
                                    </div>
                                    <div class="form-group" style="background: #45f442">
                                        <label class="control-label col-md-5 " > DATA DIBAWAH INI KHUSUS UNTUK LEMBAR CETAKAN :
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 " > PILIH LEMBAR CETAKAN UNTUK  </label>
                                        <div class="col-md-3 ">
                                            <select name="pilih_lembar_cetak" id="pilih_lembar_cetak" class="form-control" onchange="getValueData()">
                                                <option value='' >-- Pilih Lembar Cetakan --</option>
                                                <option value='1' >Waris</option>
                                                <option value='2' >Fasos</option>
                                                <option value='3' >Rumah Dinas</option>
                                                <option value='4' >Waris Gono Gini</option>
                                                <option value='5' >Hibah</option>
                                                <option value='6' >Peralihan Hak Baru</option>
                                                <option value='7' >Harta Bersama</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 " > C. Lembar Perhitungan </label>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-2">Pilih Untuk A2
                                        </label>
                                        <div class="col-md-3">
                                             <select  name="opsi_a2" id="opsi_a2" class="form-control">
                                             </select>
                                            <input type="hidden" class="form-control" name="a2_val" id="a2_val">
                                        </div>
                                        <label class="control-label col-md-2">Keterangan A2
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="opsi_a2_keterangan" id="opsi_a2_keterangan">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Pilih Untuk B7
                                        </label>
                                        <div class="col-md-3">
                                             <select  name="opsi_b7" id="opsi_b7" class="form-control">
                                             </select>
                                            <input type="hidden" class="form-control" name="b7_val" id="b7_val">
                                        </div>
                                        <label class="control-label col-md-2">Keterangan B7
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="opsi_b7_keterangan" id="opsi_b7_keterangan">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Keterangan Opsi C
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="keterangan_opsi_c" id="keterangan_opsi_c">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Tanggal SK
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="tgl_sk" id="tgl_sk">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Nomor Notaris
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="nomor_notaris" id="nomor_notaris">
                                        </div>
                                    </div>

                                    <div class="form-group" id="keterangan-gono-gini" >
                                        <label class="control-label col-md-2"><font color="green">Keterangan Opsi C Khusus Gono-Gini/Harta Bersama :
                                        </font></label>
                                        <div class="col-md-4">
                                            <textarea rows="4" cols="50" class="form-control" maxlength="256"  name="keterangan_opsi_c_gono_gini" id="keterangan_opsi_c_gono_gini"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 " > D. Lembar Berita Acara </label>                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Nomor Berita Acara
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="nomor_berita_acara" id="nomor_berita_acara">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Tanggal Berita Acara
                                        </label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="tgl_berita_acara" id="tgl_berita_acara">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Petugas Administrator
                                        </label>
                                        <div class="col-md-3">
                                            <div id="administrator"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">Petugas Penerima
                                        </label>
                                        <div class="col-md-3">
                                            <div id="pemeriksa"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 " > E. Lembar Disposisi </label>                                        
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">DASAR PENGURANGAN (LEMBAR DISPOSISI) :
                                        </label>
                                        <div class="col-md-7">
                                            <textarea rows="4" cols="100" class="form-control" maxlength="256"  name="dasar_pengurang" id="dasar_pengurang"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2">ANALISA PERMOHONAN PENGURANGAN (LEMBAR DISPOSISI) :
                                        </label>
                                        <div class="col-md-7">
                                            <textarea rows="4" cols="100" class="form-control" maxlength="256"  name="analisa_pengurangan" id="analisa_pengurangan"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group" style="">
                                        <label class="control-label col-md-5"><font color="red">*sebelum cetak harap tekan tombol "SIMPAN" terlebih dahulu
                                        </font></label>
                                    </div>

                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="javascript:;" class="btn green" id="perhitungan" style="display: none"> CETAK LEMBAR KENDALI</a>

                                                <a href="javascript:;" class="btn green" id="perhitungan" onclick="cetakPdf('perhitungan')"> LEMBAR PERHITUNGAN (1)</a>        
                                               <a href="javascript:;" class="btn green " id="disposisi" onclick="cetakPdf('disposisi')">LEMBAR DISPOSISI (2)</a>

                                                <a href="javascript:;" class="btn  green " id="acara" onclick="cetakPdf('acara')">BERITA ACARA (3)</a>

                                                <a href="javascript:;" class="btn  green " id="kasi" onclick="cetakPdf('kasi')">NOTA DINAS KASI (4)</a>

                                                <a href="javascript:;" class="btn  green " id="kabid" onclick="cetakPdf('kabid')">NOTA DINAS KABID (4)</a>

                                                <a href="javascript:;" class="btn  green " id="kadis"onclick="cetakPdf('kadis')">KEPUTUSAN KADIS (5)</a>

                                                <a href="javascript:;" class="btn  green " id="submit">SUBMIT</a>

                                                <a href="javascript:;" style="display: none" class="btn  green " id="disposisi">SIMPAN</a>

                                                <a href="javascript:;" style="display: none" class="btn  green " id="disposisi">SIMPAN</a>

                                                <a href="javascript:;" style="display: none" class="btn  green " id="disposisi">HAPUS</a>

                                                <a href="javascript:;" style="display: none" class="btn  green " id="disposisi">BATAL</a>
                                                
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
<!-- First Load -->
<script type="text/javascript">
    var lembar_cetak = $('#pilih_lembar_cetak').val();
    $("#opsi_a2").html("");
    $("#opsi_b7").html("");

    var a2_val = $("#a2_val").val();
    var b7_val = $("#b7_val").val();

    var arrA2Option = getArrOptA2(lembar_cetak);
    var arrB7Option = getArrOptB7(lembar_cetak);

    for (i = 0; i < arrA2Option.length; i++){
        $('<option/>').val(arrA2Option[i]).html(arrA2Option[i]).appendTo('#opsi_a2');
    }

    for (i = 0; i < arrB7Option.length; i++){
        $('<option/>').val(arrB7Option[i]).html(arrB7Option[i]).appendTo('#opsi_b7');
    }

    $("#opsi_a2").val(a2_val);
    $("#opsi_b7").val(b7_val);

    if(lembar_cetak == '4' || lembar_cetak == '7') { //gono-gini
        $("#keterangan-gono-gini").css('display','');
    }else {
        $("#keterangan-gono-gini").css('display','none');
    }

    function getValueData(){
        selected_val = $("#pilih_lembar_cetak").val();
        var arrA2Option = getArrOptA2(selected_val);
        var arrB7Option = getArrOptB7(selected_val);

        $("#opsi_a2").html("");
        $("#opsi_b7").html("");

        if(selected_val == '4' || selected_val == '7') { //gono-gini
            $("#keterangan-gono-gini").css('display','');

        }else {
            $("#keterangan_opsi_c_gono_gini").html("");
            $("#keterangan-gono-gini").css('display','none');
        }

        for (i = 0; i < arrA2Option.length; i++){
            $('<option/>').val(arrA2Option[i]).html(arrA2Option[i]).appendTo('#opsi_a2');
        }

        for (i = 0; i < arrB7Option.length; i++){
            $('<option/>').val(arrB7Option[i]).html(arrB7Option[i]).appendTo('#opsi_b7');
        }

        /*analisa pengurangan*/
        $("#analisa_pengurangan").html("");
        if(selected_val != "") {
            if(selected_val == '4' || selected_val == '6' || selected_val == '7'){
                $("#analisa_pengurangan").html("Setelah diteliti secara administratif Permohonan Pengurangan Waris untuk Tanah dan Bangunan sebagaimana yang diajukan oleh Pemohon dapat dipertimbangkan");            
            }else{
                $("#analisa_pengurangan").html("Setelah diteliti secara administratif Permohonan Pengurangan "+ $("#pilih_lembar_cetak option:selected").text() +" untuk Tanah dan Bangunan sebagaimana yang diajukan oleh Pemohon dapat dipertimbangkan");
            }
        }
        
        $("#dasar_pengurang").html("");
        if(selected_val != "") {
            $("#dasar_pengurang").html(getDasarPengurangan(selected_val));
        }



    }

    function getArrOptA2(lembar_cetak) {                
        if(lembar_cetak == '1')
                return ['Ahli Waris'];
        if(lembar_cetak == '2')
                return ['Fasilitas Untuk'];
        if(lembar_cetak == '3')
                return ['Janda PNS','Duda PNS','Janda Pensiunan PNS','Duda Pensiunan PNS','Janda TNI/POLRI','Duda TNI/POLRI','PNS','Pensiunan PNS','TNI/POLRI','Pensiunan TNI/POLRI'];
        if(lembar_cetak == '4')
                return ['Ahli Waris'];
        if(lembar_cetak == '5')
                return ['Anak Dari','Orang Tua Dari'];
        if(lembar_cetak == '6')
                return ['Penerima Hibah Dari'];
        if(lembar_cetak == '7')
                return ['Ahli Waris'];
        return [];
    }

    function getArrOptB7(lembar_cetak) {                
        if(lembar_cetak == '1')
                return ['SHM No','SK Kepala Kantor Pertanahan','Letter C', 'HGB No', 'Surat Keterangan'];
        if(lembar_cetak == '2')
                return ['SHM No','SK Kepala Kantor Pertanahan','Letter C', 'HGB No', 'Surat Keterangan'];
        if(lembar_cetak == '3')
                return ['SHM No','SK Kepala Kantor Pertanahan','Letter C', 'HGB No', 'Surat Keterangan'];
        if(lembar_cetak == '4')
                return ['SHM No','SK Kepala Kantor Pertanahan','Letter C', 'HGB No', 'Surat Keterangan'];
        if(lembar_cetak == '5')
                return ['SHM No','SK Kepala Kantor Pertanahan','Letter C', 'HGB No', 'Surat Keterangan'];
        if(lembar_cetak == '6')
                return ['SK Kepala Kantor Pertanahan', 'HGB No', 'Surat Keterangan'];
        if(lembar_cetak == '7')
                return ['SHM No','SK Kepala Kantor Pertanahan','Letter C', 'HGB No', 'Surat Keterangan'];
        
        return [];
    }

    function getDasarPengurangan(lembar_cetak) {
                        
        if(lembar_cetak == '1') {
                return 'Secara normatif, berdasarkan Pasal 17 Ayat 3 huruf a angka 4 Peraturan Walikota Nomor 308 Tahun 2013 bahwa Pemberian pengurangan dan keringanan dapat diberikan kepada Wajib Pajak orang pribadi yang menerima waris dari orang pribadi yang mempunyai hubungan keluarga sedarah dalam garis keturunan lurus satu derajat ke atas atau satu derajat ke bawah, sebesar 50% (lima puluh persen) yang didukung oleh bukti keterangan waris yang berdasarkan ketentuan yang berlaku. Di luar garis keturunan tersebut tidak memperoleh hak keringanan atau pengurangan';
        }
        if(lembar_cetak == '2') {
                return 'Secara normatif, berdasarkan Pasal 20 Ayat 3 huruf c Peraturan Walikota Nomor 308 Tahun 2013 bahwa Pemberian pengurangan dan keringanan dapat diberikan berdasarkan pertimbangan atau keadaan tertentu yaitu Tanah dan/atau bangunan yang digunakan untuk tujuan tertentu yaitu untuk kepentingan sosial atau pendidikan yang semata-mata tidak bertujuan mencari keuntungan antara lain untuk Pemberdayaan Masyarakat Miskin dan Penyantunan Anak Terlantar, panti jompo, rumah yatim piatu, sekolah yang tidak ditujukan mencari keuntungan, rumah sakit swasta milik institusi pelayanan sosial masyarakat';
        }
        if(lembar_cetak == '3') {
                return 'Secara normatif berdasarkan Pasal 17 Ayat 3 huruf b Angka 6 Peraturan Walikota No 308 Tahun 2013 Wajib Pajak atau penanggung pajak orang pribadi Veteran, Pegawai Negeri Sipil (PNS), Tentara Nasional Indonesia (TNI), Polisi Republik Indonesia (Polri), Pensiunan PNS, Purnawirawan TNI, Purnawirawan Polri atau janda/duda-nya yang memperoleh hak atas tanah dan/atau bangunan rumah dinas Pemerintah, sebesar 50% (lima puluh persen) yang dibuktikan dengan Akta maupun keterangan sesuai dengan ketentuan pelepasan hak atas tanah dan/atau bangunan rumah dinas Pemerintah dimaksud. Di luar wajib pajak atau penanggung pajak dimaksud tidak memperoleh hak keringanan atau pengurangan';
        }
        if(lembar_cetak == '4') {
                return 'Secara normatif, berdasarkan Pasal 17 Ayat 3 huruf a angka 4 Peraturan Walikota Nomor 308 Tahun 2013 bahwa Pemberian pengurangan dan keringanan dapat diberikan kepada Wajib Pajak orang pribadi yang menerima waris dari orang pribadi yang mempunyai hubungan keluarga sedarah dalam garis keturunan lurus satu derajat ke atas atau satu derajat ke bawah, sebesar 50% (lima puluh persen) yang didukung oleh bukti keterangan waris yang berdasarkan ketentuan yang berlaku. Di luar garis keturunan tersebut tidak memperoleh hak keringanan atau pengurangan';
        }
        if(lembar_cetak == '5') {
                return 'Secara normatif, berdasarkan Pasal 17 Ayat 3 huruf a angka 4 Peraturan Walikota Nomor 308 Tahun 2013 bahwa Pemberian pengurangan dan keringanan dapat diberikan kepada Wajib Pajak orang pribadi yang menerima waris dari orang pribadi yang mempunyai hubungan keluarga sedarah dalam garis keturunan lurus satu derajat ke atas atau satu derajat ke bawah, sebesar 50% (lima puluh persen) yang didukung oleh bukti keterangan waris yang berdasarkan ketentuan yang berlaku. Di luar garis keturunan tersebut tidak memperoleh hak keringanan atau pengurangan';
        }
        if(lembar_cetak == '6') {
                return 'Pemberian pengurangan dan keringanan dapat diberikan kepada Wajib Pajak atau penanggung pajak badan yang memperoleh hak baru selain Hak Pengelolaan dan telah menguasai tanan dan/atau bangunan secara fisik lebih dari 20 (dua puluh) tahun yang dibuktikan dengan surat pernyataan Wajib Pajak atau penanggung pajak dan keterangan dari Pejabat Pemerintah Daerah setempat, diberikan pengurangan sebersar 50% ( lima puluh persen ).';
        }
                                if(lembar_cetak == '7') {
                return 'Secara normatif, berdasarkan Pasal 17 Ayat 3 huruf a angka 4 Peraturan Walikota Nomor 308 Tahun 2013 bahwa Pemberian pengurangan dan keringanan dapat diberikan kepada Wajib Pajak orang pribadi yang menerima waris dari orang pribadi yang mempunyai hubungan keluarga sedarah dalam garis keturunan lurus satu derajat ke atas atau satu derajat ke bawah, sebesar 50% (lima puluh persen) yang didukung oleh bukti keterangan waris yang berdasarkan ketentuan yang berlaku. Di luar garis keturunan tersebut tidak memperoleh hak keringanan atau pengurangan';
        }
        return '';
    }




</script>

<script>

    $('#tgl_sk').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'dd-mm-yyyy',
      todayBtn: 'linked',
      todayHighlight: true
    });

    $('#tgl_berita_acara').datepicker({ // mengambil dari class datepicker
      autoclose: true,
      format : 'dd-mm-yyyy',
      todayBtn: 'linked',
      todayHighlight: true
    });


    $(".priceformat").number( true, 0 , '.',','); /* price number format */
    $(".priceformat").css("text-align", "right");

    $(".numberformat").number( true, 0 , '.','.');
    $(".numberformat").css("text-align", "right");
    $(".formatRight").css("text-align", "right");

    $.ajax({
        url: "<?php echo base_url().'bphtb_registration/petugas_administrator_combo/'; ?>" ,
        type: "POST",
        success: function (data) {
            $( "#administrator" ).html( data );
        },
        error: function (xhr, status, error) {
            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
        }
    });

    $.ajax({
        url: "<?php echo base_url().'bphtb_registration/petugas_pemeriksa_combo/'; ?>" ,
        type: "POST",
        success: function (data) {
            $( "#pemeriksa" ).html( data );
        },
        error: function (xhr, status, error) {
            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
        }
    });

    $.ajax({
            url: "<?php echo base_url().'bphtb_registration/load_combo_dok_pendukung_readonly/'; ?>" ,
            type: "POST",            
            data: {},
            success: function (data) {
                $( "#comboDocPendukung" ).html( data );
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
            }
    });



    $.ajax({
            url: '<?php echo WS_JQGRID."transaksi_wf.t_bphtb_registration_pengurangan_controller/read"; ?>',
            type: "POST",
            dataType: "json",
            data: {
                t_customer_order_id: 513211
            },
            success: function (data) {
                if(data.success){
                    var dt = data.rows[0];



                    $('#t_bphtb_registration_id').val(dt.t_bphtb_registration_id);
                    $('#wp_name').val(dt.wp_name);
                    $('#npwp').val(dt.npwp);
                    $('#wp_address_name').val(dt.wp_address_name);
                    $('#wp_rt').val(dt.wp_rt);
                    $('#wp_rw').val(dt.wp_rw);
                    $('#wp_p_region_id').val(dt.wp_p_region_id);
                    $('#wp_kota').val(dt.wp_kota);
                    $('#wp_p_region_id_kec').val(dt.wp_p_region_id_kec);
                    $('#wp_kecamatan').val(dt.wp_kecamatan);
                    $('#wp_p_region_id_kel').val(dt.wp_p_region_id_kel);
                    $('#wp_kelurahan').val(dt.wp_kelurahan);
                    $('#phone_no').val(dt.phone_no);
                    $('#mobile_phone_no').val(dt.mobile_phone_no);
                    $('#njop_pbb').val(dt.njop_pbb);
                    $('#object_letak_tanah').val(dt.object_address_name);
                    $('#object_rt').val(dt.object_rt);
                    $('#object_rw').val(dt.object_rw);
                    $('#object_p_region_id').val(dt.object_p_region_id);
                    $('#object_kota').val(dt.object_region);
                    $('#object_p_region_id_kec').val(dt.object_p_region_id_kec);
                    $('#object_kecamatan').val(dt.object_kecamatan);
                    $('#object_p_region_id_kel').val(dt.object_p_region_id_kel);
                    $('#object_kelurahan').val(dt.object_kelurahan);
                    $('#p_bphtb_legal_doc_type_id').val(dt.p_bphtb_legal_doc_type_id);
                    $('#land_area').val(dt.land_area);
                    $('#land_price_per_m').val(dt.land_price_per_m);
                    $('#land_total_price').val(dt.land_total_price);
                    $('#building_area').val(dt.building_area);
                    $('#building_price_per_m').val(dt.building_price_per_m);
                    $('#building_total_price').val(dt.building_total_price);
                    $('#market_price').val(dt.market_price);
                    $('#npop').val(dt.npop);
                    $('#npop_tkp').val(dt.npop_tkp);
                    $('#npop_kp').val(dt.npop_kp);
                    $('#bphtb_amt').val(dt.bphtb_amt);
                    $('#bphtb_discount').val(dt.bphtb_discount);
                    $('#bphtb_amt_final').val(dt.bphtb_amt_final);
                    $('#description').val(dt.description);
                    $('#jenis_harga_bphtb').val(dt.jenis_harga_bphtb);
                    $('#bphtb_legal_doc_description').val(dt.bphtb_legal_doc_description);
                    $('#add_disc_percent').val(dt.add_disc_percent);
                    $('#add_discount').val(dt.add_discount);
                    $('#total_price').val(Number($('#land_total_price').val())+Number($('#building_total_price').val()));
                    if(dt.check_potongan == 'Y'){
                        $('#check_potongan').attr('checked', true);
                    };
                    $('#land_area_real').val(dt.land_area_real);
                    $('#land_price_real').val(dt.land_price_real);
                    $('#building_area_real').val(dt.building_area_real);
                    $('#building_price_real').val(dt.building_price_real);
                    $('#pilih_lembar_cetak').val(dt.pilihan_lembar_cetak);
                    $('#opsi_a2').val(dt.opsi_a2);
                    $('#opsi_a2_keterangan').val(dt.opsi_a2_keterangan);
                    $('#opsi_b7').val(dt.opsi_b7);
                    $('#opsi_b7_keterangan').val(dt.opsi_b7_keterangan);
                    $('#keterangan_opsi_c').val(dt.keterangan_opsi_c);
                    $('#tgl_sk').val(dt.tanggal_sk);
                    $('#nomor_notaris').val(dt.nomor_notaris);
                    $('#nomor_berita_acara').val(dt.nomor_berita_acara);
                    $('#keterangan_opsi_c_gono_gini').val(dt.keterangan_opsi_c);
                    $('#tgl_berita_acara').val(dt.tanggal_berita_acara);
                    $('#administrator_id').val(dt.administrator_id);
                    $('#pemeriksa_id').val(dt.pemeriksa_id);
                    $('#dasar_pengurang').val(dt.dasar_pengurang);
                    $('#analisa_pengurangan').val(dt.analisa_penguranan);
                    getValueData();
                   
                }
                // console.log(dt.product_name);
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
            }
        });
</script>
<!-- /First Load -->

<!-- LOV -->
<script>
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



    $("#btn-lov-kota-objek").on('click', function() {   
        modal_lov_kota_show('object_p_region_id','object_kota');
    });

    $('#object_p_region_id').on('change', function() {
        $('#object_p_region_id_kec').val('');
        $('#object_kecamatan').val('');
        $('#object_p_region_id_kel').val('');
        $('#object_kelurahan').val('');
    });

    $("#btn-lov-kecamatan-objek").on('click', function() { 
        var kota = $('#object_p_region_id').val(); 
        //alert(kota);
        if( kota == null || kota == ''){
            swal({title: "Error!", text: "Isi Kota/Kabupaten Terlebih Dahulu", html: true, type: "error"});
            return;
        }
         modal_lov_kecamatan_show('object_p_region_id_kec','object_kecamatan',kota);
        
    });

    $('#object_p_region_id_kec').on('change', function() {
        $('#object_p_region_id_kel').val('');
        $('#object_kelurahan').val('');
    });

    $("#btn-lov-kelurahan-objek").on('click', function() { 
        var kec = $('#object_p_region_id_kec').val();
        if( kec == null || kec == ''){
            swal({title: "Error!", text: "Isi Kecamatan Terlebih Dahulu", html: true, type: "error"});
             return;
        }
        modal_lov_kelurahan_show('object_p_region_id_kel','object_kelurahan',kec);
    });
</script>
<!-- /LOV -->

<!-- PERHITUNGAN -->

<script>
    function ReplaceNumberWithCommas(yourNumber) {
        var n = yourNumber.toString().split(".");
        n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return n.join(".");
    }

    function hitungNPOPKP(){ 
        var npop_tkp     = $('#npop_tkp').val().replace(/,/g ,''); 
        var npop         = $('#npop').val().replace(/,/g ,''); 
        var add_discount = $('#add_discount').val().replace(/,/g ,''); 
        var npop_kp      = $('#npop_kp').val().replace(/,/g ,''); 
        var result       = 0;

        if(npop_tkp == '' || npop_tkp == 'undefined'){
            npop_tkp = 0;
        }

        if(npop == '' || npop == 'undefined'){
            npop = 0;
        }
 
        if(add_discount == '' || add_discount == 'undefined'){
            add_discount = 0;
        }

        result = parseFloat(npokp)-parseFloat(npotkp)-parseFloat(add_discount);

        if(result < 0){
            $('#npop_kp').val(ReplaceNumberWithCommas(0));
        }else{
            $('#npop_kp').val(ReplaceNumberWithCommas(result));
        }

        hitungTerutang(npop_kp);
    }

    function hitungTerutang(nilai){ 
      var terutang = Math.ceil(nilai/100*5);
      $('#bphtb_amt').val(ReplaceNumberWithCommas(terutang));
      hitungPembayaran();
    }

    function hitungPembayaran(){
        var bphtb_amt           = $('#bphtb_amt').val().replace(/,/g ,'');
        var bphtb_discount      = $('#bphtb_discount').val().replace(/,/g ,''); 
        var prev_payment_amount = $('#prev_payment_amount').val().replace(/,/g ,'');
        var bphtb_amt_final_old = $('#bphtb_amt_final_old').val().replace(/,/g ,''); 
        var p_bphtb_type_id     = $('#p_bphtb_type_id').val(); 
        var bphtb_amt_final     = $('#bphtb_amt_final').val(); 
        var result              = ReplaceNumberWithCommas(parseInt(jumlah)-parseInt(diskon));
        var result_amt_final    = 0;

        if(bphtb_amt == '' || bphtb_amt == 'undefined'){
            bphtb_amt = 0;
        }

        if(bphtb_discount == '' || bphtb_discount == 'undefined'){
            bphtb_discount = 0;
        }

        if(p_bphtb_type_id != 3) {
            if(bphtb_amt_final < 0){
                $('#bphtb_amt_final').val(0); 
            }else{
                
                $('#bphtb_amt_final').val(result); 
            }
        }else {
            if(bphtb_amt_final_old < 0){
                $('#bphtb_amt_final_old').val(0);
            }else{
                $('#bphtb_amt_final_old').val(result);
            }

            result_amt_final = ReplaceNumberWithCommas(parseInt(bphtb_amt_final_old)-parseInt(prev_payment_amount));
            $('#bphtb_amt_final').val(result_amt_final);
        }
    }

    function getNPOP(){
        var waris               = $('#potongan_waris').val(); 
        var total_price         = $('#total_price').val().replace(/,/g ,''); 
        var market_price        = $('#market_price').val().replace(/,/g ,''); 
        var nilai_doc           = $('#nilai_doc').val();
        var npop                = $('#npop').val().replace(/,/g ,''); 
        var add_disc_percent    = $('#add_disc_percent').val()/100;

        var res        = waris.split("/"); 
        var components = [];
        var result     = 0 ;

        if(total_price==''){
            total_price=0;
        }

        if(market_price==''){
            market_price=0;
        }


        var total_p  = ReplaceNumberWithCommas(total_price*(res[0]/res[1]));
        var market_p = ReplaceNumberWithCommas(market_price*(res[0]/res[1]));



        if(parseFloat(total_price)> parseFloat(market_price)){
          components = total_p.toString().split(".");
        }else{
          components = market_p.toString().split(".");
        }
        //alert(components);

        $('#npop').val(components[0]);

        if(nilai_doc==''){
            nilai_doc=0;
        }

        if(nilai_doc >= 0 && nilai_doc != ''){
            result = ReplaceNumberWithCommas(Math.ceil(npop*nilai_doc*res[0]/res[1]));
            $('#npop').val(result);       
        }
        if(add_disc_percent==''){
            add_disc_percent=0;
        }
        result = ReplaceNumberWithCommas(Math.ceil(npop*add_disc_percent));
        $('#add_discount').val(result);

        hitungNPOPKP();
        
    }


    function hitungTotalTanah(){
      var hasil                 = 0;
      var r_tot_p               = 0;
      var r_l_tot_p             = 0;
      var land_area             = $('#land_area').val(); 
      var land_price_per_m      = $('#land_price_per_m').val();
      var land_total_price      = $('#land_total_price').val().replace(/,/g ,''); 
      var building_total_price  = $('#building_total_price').val().replace(/,/g ,''); 

      if(land_area!=0||land_price_per_m!=0){
        hasil = parseFloat(land_area.replace(/,/g ,''))*parseFloat(land_price_per_m.replace(/,/g ,''));
      }
      
      r_l_tot_p =  ReplaceNumberWithCommas(hasil);
      $('#land_total_price').val(r_l_tot_p);

      // r_tot_p = ReplaceNumberWithCommas(parseFloat(land_total_price)+parseFloat(building_total_price));
      r_tot_p = ReplaceNumberWithCommas(parseFloat(r_l_tot_p.replace(/,/g ,''))+parseFloat(building_total_price));
      $('#total_price').val(r_tot_p);

      getNPOP();
      hitungNPOPKP();
    }

    function hitungTotalBangunan(){
        var hasil                = 0;
        var result               = 0;
        var building_area        = $('#building_area').val();   
        var building_price_per_m = $('#building_price_per_m').val(); 
        var building_total_price = $('#building_total_price').val();
        var land_total_price     = $('#land_total_price').val(); 

        if (building_area != 0 || building_price_per_m != 0){
            hasil = parseFloat(building_area.replace(/,/g ,'')) * parseFloat(building_price_per_m.replace(/,/g ,''));
        }
        hasil = ReplaceNumberWithCommas(hasil);
        $('#building_total_price').val(hasil);

        // result = parseFloat(land_total_price.replace(/,/g ,'')) + parseFloat(building_total_price.replace(/,/g ,''));
        result = ReplaceNumberWithCommas(parseFloat(land_total_price.replace(/,/g ,'')) + parseFloat(hasil.replace(/,/g ,'')));
        $('#total_price').val(result); 

        getNPOP();   
    }

</script>

<!-- /PERHITUNGAN -->

<!-- Function Pendukung -->

<script>

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
                //console.log(data[0].p_bphtb_legal_doc_type_id);
                var npop = $('#npop').val().replace(/,/g ,'');
                var total_price = $('#total_price').val().replace(/,/g ,'');
                var market_price = $('#market_price').val().replace(/,/g ,'');

                var doc_cons = data[0].doc_cons;
                var npoptkp = data[0].npoptkp;
                
                if(doc_cons > 0 && doc_cons != '' ){
                    
                    //$('#npop_tkp').val(ReplaceNumberWithCommas(doc_cons * npop));

                    $('#nilai_doc').val(doc_cons);

                    if (parseFloat(total_price) > parseFloat(market_price)) {
                        $('#npop').val(ReplaceNumberWithCommas(Math.ceil(total_price*doc_cons)));
                    }else{
                        $('#npop').val(ReplaceNumberWithCommas(Math.ceil(market_price*doc_cons)));
                    }

                }else{
                    if (parseFloat(total_price) > parseFloat(market_price)) {
                        $('#npop').val(ReplaceNumberWithCommas(total_price));
                    }else{
                        $('#npop').val(ReplaceNumberWithCommas(market_price));
                    }
                }
                
                $('#npop_tkp').val(ReplaceNumberWithCommas(npoptkp));
            },
            error: function (xhr, status, error) {
                swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                $('#bphtb_discount').val("0");
            }
        });
    }

    function setNormalValue(){

        $(".priceformat").each(function(){
            var thisVal = $(this).val();
            if(thisVal!=0){
                $(this).val(thisVal.replace(/,/g ,''))
            }
        });
    }
    
</script>

<!-- /Function Pendukung -->

<!-- Action -->

<script>

    $('#njop_pbb').on('change', function() {
        var njop_pbb = $('#njop_pbb').val();
        if(njop_pbb != "") {
            var result = njop_pbb.replace(/[^0-9]/g,'');
            $('#njop_pbb').val(result);
        }
    });

    $('#potongan_waris').on('change', function() {  
        getNPOP();
    });

    $('#bphtb_discount').on('change', function() {
        hitungPembayaran();
    });    
    
</script>

<script type="text/javascript">
    function printLaporan(){
        //alert(pejabat);
        var params          = $('#t_bphtb_registration_id').val();
        var p_bphtb_type_id = $('#p_bphtb_type_id').val();

        if(p_bphtb_type_id == 3) {
           url = '<?php echo base_url(); ?>'+'cetak_rep_bphtb_kb/pageCetak/'+params;
            openInNewTab(url);
            /*window.open("../report/cetak_rep_bphtb_kb.php?t_bphtb_registration_id="+params, "_blank", "toolbar=0,location=0,menubar=0");*/
        }else {
            url = '<?php echo base_url(); ?>'+'cetak_rep_bphtb/pageCetak/'+params;
            openInNewTab(url);
            //window.open("../report/cetak_rep_bphtb.php?t_bphtb_registration_id="+params, "_blank", "toolbar=0,location=0,menubar=0");
        }
    }

    function openInNewTab(url) {    
        window.open(url, '_blank', 'location=yes,height=570,width=820,scrollbars=yes,status=yes');
    }

    function cetakPdf(aksi){
        var lembar_cetak = $('#lembar_cetak').val();
        var params       = $('#t_bphtb_registration_id').val();
        var url          = "<?php echo base_url(); ?>";
        //alert(params);return;

        /*if(lembar_cetak == '' || lembar_cetak == null){
            swal ( "Oopss" ,  "Pilih Lembar Cetakan Harus Dipilih!" ,  "error" );
        }else{*/
            if(aksi == 'perhitungan'){
                //if(lembar_cetak == '4' || lembar_cetak == '7'){    
                    url += "cetak_rep_pengurangan_bphtb_gono_gini/pageCetak_perhitungan?";
                    url += "t_bphtb_registration_id=" + params;        

                    openInNewTab(url);
                //}
            }else if(aksi == 'disposisi'){

            }else if(aksi == 'acara'){

            }else if(aksi == 'kasi'){

            }else if(aksi == 'kabid'){

            }else if(aksi == 'kabid'){

            }
        //}

        
    }
</script>

<!-- Action -->