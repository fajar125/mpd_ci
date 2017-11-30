<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Formulir Pendaftaran</span>
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
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-1">
                        <i class="blue"></i>
                        <strong> FORMULIR PENDAFTARAN </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-2">
                        <i class="blue"></i>
                        <strong> DATA IZIN DAN POTENSI </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-3">
                        <i class="blue"></i>
                        <strong> DOKUMEN PENDUKUNG </strong>
                    </a>
                </li>
                 <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-4">
                        <i class="blue"></i>
                        <strong> LOG AKTIFITAS </strong>
                    </a>
                </li>
            </ul>
        </div>

        
    </div>
</div>

<?php $this->load->view('lov/lov_kota'); ?>
<?php $this->load->view('lov/lov_kec'); ?>
<?php $this->load->view('lov/lov_kel'); ?>
<?php $this->load->view('lov/lov_vat_type_dtl'); ?>
<?php $this->load->view('lov/lov_job_position'); ?>
<?php $this->load->view('workflow/lov_submitter.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="row">
                    <label class="control-label col-md-3">Nomor Order</label>                
                        <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="t_vat_registration_id" id="t_vat_registration_id" style="display:none;">   
                            <input type="text" class="form-control" name="p_rqst_type_id" id="p_rqst_type_id" style="display:none;">   
                            <input type="text" class="form-control" name="order_no" id="order_no" readonly="true">                 
                        </div>
                    
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Tanggal Pendaftaran</label>
                        <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="registration_date" id="registration_date" readonly="true">                 
                        </div>                 
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Nama Ayat</label>
                    <div class="input-group col-md-5">
                        <div id="namaAyat"></div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Username</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="wp_user_name" id="wp_user_name" readonly="true">
                        </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Password</label>
                        <div class="input-group col-md-5">
                            <input type="password" class="form-control" name="wp_user_pwd" id="wp_user_pwd" readonly="true">                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<label class="control-label col-md-5"><b>Keterangan Wajib Pajak</b></label>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Nama Wajib Pajak</label>
                    <div class="input-group col-md-5">
                        <input type="text" class="form-control" name="wp_name" id="wp_name" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Alamat Wajib Pajak</label>
                    <div class="input-group col-md-5">
                            <textarea class="form-control" name="wp_address_name" id="wp_address_name" readonly="true"></textarea>
                        </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No</label>
                        <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="wp_address_no" id="wp_address_no" readonly="true">      
                            <span class="input-group-addon"> RT </span> 
                            <input type="text" class="form-control" name="wp_address_rt" id="wp_address_rt" readonly="true">   
                            <span class="input-group-addon"> RW </span> 
                            <input type="text" class="form-control" name="wp_address_rw" id="wp_address_rw" readonly="true">                            
                        </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                
                    <label class="control-label col-md-3">Kota/Kabupaten</label>
                    <div class="input-group col-md-5">
                            <input id="wp_p_region_id" type="text"  style="display:none;">
                            <input id="wp_kota" readonly type="text" class="FormElement form-control" placeholder="Pilih Kota/Kabupaten">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKota('wp_p_region_id','wp_kota')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kecamatan</label>
                    <div class="input-group col-md-5">
                            <input id="wp_p_region_id_kecamatan" type="text"  style="display:none;">
                            <input id="wp_kecamatan" readonly type="text" class="FormElement form-control" placeholder="Pilih Kecamatan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKec('wp_p_region_id_kecamatan','wp_kecamatan', $('#wp_p_region_id').val())">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>               
                </div>

                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="input-group col-md-5">
                        <input id="wp_p_region_id_kelurahan" type="text"  style="display:none;">
                        <input id="wp_kelurahan" readonly type="text" class="FormElement form-control" placeholder="Pilih Kelurahan">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button" onclick="showLOVKel('wp_p_region_id_kelurahan','wp_kelurahan',$('#wp_p_region_id_kecamatan').val())">
                                <span class="fa fa-search bigger-110"></span>
                             </button>
                        </span>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Email</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="wp_email" id="wp_email" readonly="true">
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Telepon</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="wp_phone_no" id="wp_phone_no" readonly="true">
                            <span class="input-group-addon">No. Seluler </span>
                            <input type="text" class="form-control" name="wp_mobile_no" id="wp_mobile_no" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Fax</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="wp_fax_no" id="wp_fax_no" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kode Pos</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="wp_zip_code" id="wp_zip_code" readonly="true">
                    </div>
                </div>
            </div>  
        </div>       
    </div>   
</div>

<label class="control-label col-md-5"><b>Keterangan Perusahaan atau Badan</b></label>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">               
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Nama Badan/Perusahaan</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="company_name" id="company_name" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Alamat Badan</label>
                    <div class="input-group col-md-5">
                            <textarea class="form-control" name="address_name" id="address_name" readonly="true"></textarea>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="address_no" id="address_no" readonly="true">      
                            <span class="input-group-addon"> RT </span> 
                            <input type="text" class="form-control" name="address_rt" id="address_rt" readonly="true">   
                            <span class="input-group-addon"> RW </span> 
                            <input type="text" class="form-control" name="address_rw" id="address_rw" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                
                    <label class="control-label col-md-3">Kota/Kabupaten</label>
                    <div class="input-group col-md-5">
                            <input id="p_region_id" type="text"  style="display:none;">
                            <input id="kota_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kota/Kabupaten">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKota('p_region_id','kota_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kecamatan</label>
                    <div class="input-group col-md-5">
                            <input id="p_region_id_kecamatan" type="text"  style="display:none;">
                            <input id="kecamatan_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kecamatan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKec('p_region_id_kecamatan','kecamatan_code', $('#p_region_id').val())">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>               
                
                    
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="input-group col-md-5">
                            <input id="p_region_id_kelurahan" type="text"  style="display:none;">
                            <input id="kelurahan_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kelurahan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKel('p_region_id_kelurahan','kelurahan_code',$('#p_region_id_kecamatan').val())">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Telepon</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="phone_no" id="phone_no" readonly="true">
                            <span class="input-group-addon">No. Seluler </span>
                            <input type="text" class="form-control" name="mobile_no" id="mobile_no" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Fax</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="fax_no" id="fax_no" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kode Pos</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="zip_code" id="zip_code" readonly="true">
                    </div>
                </div>          
            </div>
        </div>
    </div>
</div>

<label class="control-label col-md-5"><b>Keterangan Merk Dagang</b></label>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Nama Merk Dagang</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="company_brand" id="company_brand" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Alamat</label>
                    <div class="input-group col-md-5">
                            <textarea class="form-control" name="brand_address_name" id="brand_address_name" readonly="true"></textarea>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No.</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="brand_address_no" id="brand_address_no" readonly="true">      
                            <span class="input-group-addon"> RT </span> 
                            <input type="text" class="form-control" name="brand_address_rt" id="brand_address_rt" readonly="true">   
                            <span class="input-group-addon"> RW </span> 
                            <input type="text" class="form-control" name="brand_address_rw" id="brand_address_rw" readonly="true">
                    </div>
                   
                </div>
                <div class="space-2"></div>
                <div class="row">                
                    <label class="control-label col-md-3">Kota/Kabupaten</label>
                    <div class="input-group col-md-5">
                            <input id="brand_p_region_id" type="text"  style="display:none;">
                            <input id="brand_kota" readonly type="text" class="FormElement form-control" placeholder="Pilih Kota/Kabupaten">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKota('brand_p_region_id','brand_kota')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kecamatan</label>
                    <div class="input-group col-md-5">
                            <input id="brand_p_region_id_kec" type="text"  style="display:none;">
                            <input id="brand_kecamatan" readonly type="text" class="FormElement form-control" placeholder="Pilih Kecamatan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKec('brand_p_region_id_kec','brand_kecamatan', $('#brand_p_region_id').val())">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>               
                
                    
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="input-group col-md-5">
                            <input id="brand_p_region_id_kel" type="text"  style="display:none;">
                            <input id="brand_kelurahan" readonly type="text" class="FormElement form-control" placeholder="Pilih Kelurahan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKel('brand_p_region_id_kel','brand_kelurahan',$('#brand_p_region_id_kec').val())">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Telepon</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="brand_phone_no" id="brand_phone_no" readonly="true">
                            <span class="input-group-addon">No. Seluler </span>
                            <input type="text" class="form-control" name="brand_mobile_no" id="brand_mobile_no" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Fax</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="brand_fax_no" id="brand_fax_no" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kode Pos</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="brand_zip_code" id="brand_zip_code" readonly="true">
                    </div>
                </div>
            </div>  
        </div>       
    </div>   
</div>

<label class="control-label col-md-5"><b>Keterangan Pemilik/Pengelola</b></label>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Nama Pemilik/Pengelola</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="company_owner" id="company_owner" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Jabatan</label>
                    <div class="input-group col-md-5">
                            <input id="p_job_position_id" type="text"  style="display:none;">
                            <input id="job_position_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Jabatan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVJabatan('p_job_position_id','job_position_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Alamat Pemilik/Pengelola</label>
                    <div class="input-group col-md-5">
                            <textarea class="form-control" name="address_name_owner" id="address_name_owner" readonly="true"></textarea>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No.</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="address_no_owner" id="address_no_owner" readonly="true">      
                            <span class="input-group-addon"> RT </span> 
                            <input type="text" class="form-control" name="address_rt_owner" id="address_rt_owner" readonly="true">   
                            <span class="input-group-addon"> RW </span> 
                            <input type="text" class="form-control" name="address_rw_owner" id="address_rw_owner" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                
                    <label class="control-label col-md-3">Kota/Kabupaten</label>
                    <div class="input-group col-md-5">
                            <input id="p_region_id_owner" type="text"  style="display:none;">
                            <input id="kota_own_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kota/Kabupaten">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKota('p_region_id_owner','kota_own_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kecamatan</label>
                    <div class="input-group col-md-5">
                            <input id="p_region_id_kec_owner" type="text"  style="display:none;">
                            <input id="kecamatan_own_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kecamatan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKec('p_region_id_kec_owner','kecamatan_own_code', $('#p_region_id_owner').val())">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>               
                
                    
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="input-group col-md-5">
                            <input id="p_region_id_kel_owner" type="text"  style="display:none;">
                            <input id="kelurahan_own_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kelurahan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKel('p_region_id_kel_owner','kelurahan_own_code',$('#p_region_id_kec_owner').val())">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Email</label>
                    <div class="input-group col-md-5">
                        <input type="text" class="form-control" name="email" id="email" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Telepon</label>
                    <div class="input-group col-md-5">
                        <input type="text" class="form-control" name="phone_no_owner" id="phone_no_owner" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Fax</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="fax_no_owner" id="fax_no_owner" readonly="true">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kode Pos</label>
                    <div class="input-group col-md-5">
                            <input type="text" class="form-control" name="zip_code_owner" id="zip_code_owner" readonly="true">
                    </div>
                </div>
            </div>  
        </div>       
    </div>   
</div>

<label class="control-label col-md-5"><b>Lupa Password</b></label>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Pilih Pertanyaaan</label>
                    <div class="input-group col-md-5">                            
                        <div id="privateQuestion"></div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Jawaban</label>
                    <div class="input-group col-md-5">
                        <input type="text" class="form-control" name="private_answer" id="private_answer" readonly="true">
                    </div>
                </div>
            </div>  
        </div>       
    </div>   
</div>


<label class="control-label col-md-5"><b>Validasi</b></label>
<div class="row">
    <div class="col-xs-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Seluler</label>
                    <div class="input-group col-md-5">
                        <input type="text" class="form-control" name="mobile_no_owner" id="mobile_no_owner" readonly="true">
                    </div>
                 
                </div> 
                <!-- <div class="space-2"></div> -->
                <!-- <div class="row">
                    <div class="col-sm-offset-3">
                        <button class="btn btn-success" type="button" id="btn-add" onclick="">CETAK SPTPD/SKPDKB/SKPDN</button>
                        <button class="btn btn-success" type="button" id="btn-edit" onclick="">CETAK FORMULIR</button>
                        <button class="btn btn-success" type="button" id="btn-del" onclick="">CETAK SURAT PENOLAKAN</button>
                        <button class="btn btn-danger" type="button" id="btn-del" onclick="">SUBMIT</button>
                    </div>
                 
                </div>  -->

            </div>       
        </div>   
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div style="text-align: center;">
                <button class="btn btn-success" type="button" id="btn-ctk2" onclick="cetak1();">CETAK TANDA TERIMA</button>
                <button class="btn btn-danger" type="button" id="btn-sub" onclick="submitform();">SUBMIT</button>
                <button class="btn btn-danger" type="button" id="btn-kel" onclick="backform();">KEMBALI</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function cetak1(){
        var t_customer_order_id = $('#CURR_DOC_ID').val();

        var url = "<?php echo base_url(); ?>"+"cetak_formulir_tanda_terima_pengukuhan_pdf/save_pdf?t_customer_order_id="+t_customer_order_id;

        PopupCenter(url,"Tanda Terima",500,500);
    }    

    
    $.ajax({
        url: "<?php echo base_url().'transaksi/private_question_combo/'; ?>" ,
        type: "POST",            
        data: {},
        success: function (data) {
            $( "#privateQuestion" ).html( data );
        },
        error: function (xhr, status, error) {
            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
        }
    });

    $("#tab-2").on("click", function(event) {
        
        loadContentWithParams("transaksi_wf.t_vat_reg_dtl_srt_ro", { //model yang ketiga
            t_customer_order_id: $( "#CURR_DOC_ID" ).val(),
            order_no: $('#order_no').val(),
            order_date:$('#registration_date').val(),
            p_rqst_type_id: $("#p_rqst_type_id").val(),
            t_vat_registration_id: $( "#t_vat_registration_id" ).val(),
            ELEMENT_ID : $('#TEMP_ELEMENT_ID').val(),
            PROFILE_TYPE : $('#TEMP_PROFILE_TYPE').val(),
            P_W_DOC_TYPE_ID : $('#TEMP_P_W_DOC_TYPE_ID').val(),
            P_W_PROC_ID : $('#TEMP_P_W_PROC_ID').val(),
            USER_ID : $('#TEMP_USER_ID').val(),
            FSUMMARY : $('#TEMP_FSUMMARY').val(),
            CURR_DOC_ID : $('#CURR_DOC_ID').val(),
            CURR_DOC_TYPE_ID : $('#CURR_DOC_TYPE_ID').val(),
            CURR_PROC_ID : $('#CURR_PROC_ID').val(),
            CURR_CTL_ID : $('#CURR_CTL_ID').val(),
            USER_ID_DOC : $('#USER_ID_DOC').val(),
            USER_ID_DONOR : $('#USER_ID_DONOR').val(),
            USER_ID_LOGIN : $('#USER_ID_LOGIN').val(),
            USER_ID_TAKEN : $('#USER_ID_TAKEN').val(),
            IS_CREATE_DOC : $('#IS_CREATE_DOC').val(),
            IS_MANUAL : $('#IS_MANUAL').val(),
            CURR_PROC_STATUS : $('#CURR_PROC_STATUS').val(),
            CURR_DOC_STATUS : $('#CURR_DOC_STATUS').val(),
            PREV_DOC_ID : $('#PREV_DOC_ID').val(),
            PREV_DOC_TYPE_ID : $('#PREV_DOC_TYPE_ID').val(),
            PREV_PROC_ID : $('#PREV_PROC_ID').val(),
            PREV_CTL_ID : $('#PREV_CTL_ID').val(),
            SLOT_1 : $('#SLOT_1').val(),
            SLOT_2 : $('#SLOT_2').val(),
            SLOT_3 : $('#SLOT_3').val(),
            SLOT_4 : $('#SLOT_4').val(),
            SLOT_5 : $('#SLOT_5').val(),
            MESSAGE : $('#MESSAGE').val(),
            PROFILE_TYPE : $('#PROFILE_TYPE').val(),
            ACTION_STATUS : $('#ACTION_STATUS').val()
            
        });
    });

    $("#tab-3").on("click", function(event) {
        event.stopPropagation();
    loadContentWithParams("transaksi_wf.t_cust_order_legal_doc_srt_ro", { //model yang ketiga
            t_customer_order_id: $( "#CURR_DOC_ID" ).val(),
            order_no: $('#order_no').val(),
            order_date:$('#registration_date').val(),
            p_rqst_type_id: $("#p_rqst_type_id").val(),
            t_vat_registration_id: $( "#t_vat_registration_id" ).val(),
            ELEMENT_ID : $('#TEMP_ELEMENT_ID').val(),
            PROFILE_TYPE : $('#TEMP_PROFILE_TYPE').val(),
            P_W_DOC_TYPE_ID : $('#TEMP_P_W_DOC_TYPE_ID').val(),
            P_W_PROC_ID : $('#TEMP_P_W_PROC_ID').val(),
            USER_ID : $('#TEMP_USER_ID').val(),
            FSUMMARY : $('#TEMP_FSUMMARY').val(),
            CURR_DOC_ID : $('#CURR_DOC_ID').val(),
            CURR_DOC_TYPE_ID : $('#CURR_DOC_TYPE_ID').val(),
            CURR_PROC_ID : $('#CURR_PROC_ID').val(),
            CURR_CTL_ID : $('#CURR_CTL_ID').val(),
            USER_ID_DOC : $('#USER_ID_DOC').val(),
            USER_ID_DONOR : $('#USER_ID_DONOR').val(),
            USER_ID_LOGIN : $('#USER_ID_LOGIN').val(),
            USER_ID_TAKEN : $('#USER_ID_TAKEN').val(),
            IS_CREATE_DOC : $('#IS_CREATE_DOC').val(),
            IS_MANUAL : $('#IS_MANUAL').val(),
            CURR_PROC_STATUS : $('#CURR_PROC_STATUS').val(),
            CURR_DOC_STATUS : $('#CURR_DOC_STATUS').val(),
            PREV_DOC_ID : $('#PREV_DOC_ID').val(),
            PREV_DOC_TYPE_ID : $('#PREV_DOC_TYPE_ID').val(),
            PREV_PROC_ID : $('#PREV_PROC_ID').val(),
            PREV_CTL_ID : $('#PREV_CTL_ID').val(),
            SLOT_1 : $('#SLOT_1').val(),
            SLOT_2 : $('#SLOT_2').val(),
            SLOT_3 : $('#SLOT_3').val(),
            SLOT_4 : $('#SLOT_4').val(),
            SLOT_5 : $('#SLOT_5').val(),
            MESSAGE : $('#MESSAGE').val(),
            PROFILE_TYPE : $('#PROFILE_TYPE').val(),
            ACTION_STATUS : $('#ACTION_STATUS').val()
            
        });
    });

    $("#tab-4").on("click", function(event) {
        
        loadContentWithParams("transaksi_wf.t_order_log_kronologis_srt_ro", { //model yang ketiga
            t_customer_order_id: $( "#CURR_DOC_ID" ).val(),
            order_no: $('#order_no').val(),
            order_date:$('#registration_date').val(),
            p_rqst_type_id: $("#p_rqst_type_id").val(),
            t_vat_registration_id: $( "#t_vat_registration_id" ).val(),
            ELEMENT_ID : $('#TEMP_ELEMENT_ID').val(),
            PROFILE_TYPE : $('#TEMP_PROFILE_TYPE').val(),
            P_W_DOC_TYPE_ID : $('#TEMP_P_W_DOC_TYPE_ID').val(),
            P_W_PROC_ID : $('#TEMP_P_W_PROC_ID').val(),
            USER_ID : $('#TEMP_USER_ID').val(),
            FSUMMARY : $('#TEMP_FSUMMARY').val(),
            CURR_DOC_ID : $('#CURR_DOC_ID').val(),
            CURR_DOC_TYPE_ID : $('#CURR_DOC_TYPE_ID').val(),
            CURR_PROC_ID : $('#CURR_PROC_ID').val(),
            CURR_CTL_ID : $('#CURR_CTL_ID').val(),
            USER_ID_DOC : $('#USER_ID_DOC').val(),
            USER_ID_DONOR : $('#USER_ID_DONOR').val(),
            USER_ID_LOGIN : $('#USER_ID_LOGIN').val(),
            USER_ID_TAKEN : $('#USER_ID_TAKEN').val(),
            IS_CREATE_DOC : $('#IS_CREATE_DOC').val(),
            IS_MANUAL : $('#IS_MANUAL').val(),
            CURR_PROC_STATUS : $('#CURR_PROC_STATUS').val(),
            CURR_DOC_STATUS : $('#CURR_DOC_STATUS').val(),
            PREV_DOC_ID : $('#PREV_DOC_ID').val(),
            PREV_DOC_TYPE_ID : $('#PREV_DOC_TYPE_ID').val(),
            PREV_PROC_ID : $('#PREV_PROC_ID').val(),
            PREV_CTL_ID : $('#PREV_CTL_ID').val(),
            SLOT_1 : $('#SLOT_1').val(),
            SLOT_2 : $('#SLOT_2').val(),
            SLOT_3 : $('#SLOT_3').val(),
            SLOT_4 : $('#SLOT_4').val(),
            SLOT_5 : $('#SLOT_5').val(),
            MESSAGE : $('#MESSAGE').val(),
            PROFILE_TYPE : $('#PROFILE_TYPE').val(),
            ACTION_STATUS : $('#ACTION_STATUS').val()
            
        });
    });
</script>

<script type="text/javascript">
    $.ajax({
        url: "<?php echo WS_JQGRID . "transaksi.t_vat_registration_controller/readro"; ?>" ,
        type: "POST", 
        datatype: "json",           
        data: {
            t_customer_order_id : "<?php echo $this->input->post('CURR_DOC_ID'); ?>"
        },
        success: function (data) {
            var data1 = data.row[0];
           if(data.row[0].t_vat_registration_id){
                $('#t_vat_registration_id').val(data1.t_vat_registration_id); 
                $('#order_no').val(data1.order_no); 
                $('#registration_date').val(data1.registration_date); 
                // $('#p_vat_type_dtl').val(data1.p_vat_type_dtl_id); 
                
                $('#wp_user_name').val(data1.wp_user_name);  
                $('#wp_user_pwd').val(data1.wp_user_pwd); 

                $('#wp_name').val(data1.wp_name);  
                $('#wp_address_name').val(data1.wp_address_name);
                $('#wp_address_no').val(data1.wp_address_no); 
                $('#wp_address_rt').val(data1.wp_address_rt); 
                $('#wp_address_rw').val(data1.wp_address_rw);  
                $('#wp_kota').val(data1.wp_kota);
                $('#wp_p_region_id').val(data1.wp_p_region_id);
                $('#wp_kecamatan').val(data1.wp_kecamatan); 
                $('#wp_p_region_id_kecamatan').val(data1.wp_p_region_id_kecamatan);
                $('#wp_kelurahan').val(data1.wp_kelurahan);
                $('#wp_p_region_id_kelurahan').val(data1.wp_p_region_id_kelurahan); 
                $('#wp_email').val(data1.wp_email);  
                $('#wp_phone_no').val(data1.wp_phone_no);  
                $('#wp_mobile_no').val(data1.wp_mobile_no);
                $('#wp_fax_no').val(data1.wp_fax_no); 
                $('#wp_zip_code').val(data1.wp_zip_code); 

                $('#company_name').val(data1.company_name);  
                $('#address_name').val(data1.address_name);
                $('#address_no').val(data1.address_no); 
                $('#address_rt').val(data1.address_rt); 
                $('#address_rw').val(data1.address_rw);  
                $('#kota_code').val(data1.kota_code);
                $('#p_region_id').val(data1.p_region_id);
                $('#kecamatan_code').val(data1.kecamatan_code); 
                $('#p_region_id_kecamatan').val(data1.p_region_id_kecamatan);
                $('#kelurahan_code').val(data1.kelurahan_code);
                $('#p_region_id_kelurahan').val(data1.p_region_id_kelurahan); 
                $('#phone_no').val(data1.phone_no);  
                $('#mobile_no').val(data1.mobile_no);
                $('#fax_no').val(data1.fax_no); 
                $('#zip_code').val(data1.zip_code); 

                $('#company_brand').val(data1.company_brand);  
                $('#brand_address_name').val(data1.brand_address_name);
                $('#brand_address_no').val(data1.brand_address_no); 
                $('#brand_address_rt').val(data1.brand_address_rt); 
                $('#brand_address_rw').val(data1.brand_address_rw);  
                $('#brand_kota').val(data1.brand_kota);
                $('#brand_p_region_id').val(data1.brand_p_region_id);
                $('#brand_kecamatan').val(data1.brand_kecamatan); 
                $('#brand_p_region_id_kecamatan').val(data1.brand_p_region_id_kecamatan);
                $('#brand_kelurahan').val(data1.brand_kelurahan);
                $('#brand_p_region_id_kelurahan').val(data1.brand_p_region_id_kelurahan); 
                $('#brand_phone_no').val(data1.brand_phone_no);  
                $('#brand_mobile_no').val(data1.brand_mobile_no);
                $('#brand_fax_no').val(data1.brand_fax_no); 
                $('#brand_zip_code').val(data1.brand_zip_code); 

                $('#company_owner').val(data1.company_owner);  
                $('#address_name_owner').val(data1.address_name_owner);
                $('#p_job_position_id').val(data1.p_job_position_id);
                $('#job_position_code').val(data1.job_position_code);
                $('#address_no_owner').val(data1.address_no_owner); 
                $('#address_rt_owner').val(data1.address_rt_owner); 
                $('#address_rw_owner').val(data1.address_rw_owner);  
                $('#kota_own_code').val(data1.kota_own_code);
                $('#p_region_id_owner').val(data1.p_region_id_owner);
                $('#kecamatan_own_code').val(data1.kecamatan_own_code); 
                $('#p_region_id_kecamatan_owner').val(data1.p_region_id_kecamatan_owner);
                $('#kelurahan_own_code').val(data1.kelurahan_own_code);
                $('#p_region_id_kelurahan').val(data1.p_region_id_kelurahan_owner); 
                $('#email').val(data1.email);  
                $('#phone_no_owner').val(data1.phone_no_owner);  
                $('#mobile_no_owner').val(data1.mobile_no_owner);
                $('#fax_no_owner').val(data1.fax_no_owner); 
                $('#zip_code_owner').val(data1.zip_code_owner);

                // $('#p_private_question_id').val(data1.p_private_question_id);
                setTimeout(function(){
                    $('#p_private_question_id').val(data1.p_private_question_id);
                }, 500); 
                
                $('#private_answer').val(data1.private_answer);

                $( "#p_rqst_type_id" ).val(data1.p_rqst_type_id);

                $.ajax({
                    url: "<?php echo base_url().'transaksi/nama_ayat_combo/'; ?>" ,
                    type: "POST",            
                    data: {p_rqst_type_id:  data1.p_rqst_type_id },
                    success: function (data) {
                        $( "#namaAyat" ).html( data );   

                        setTimeout(function(){
                            $('#p_vat_type_dtl').val(data1.p_vat_type_dtl_id);
                        }, 500);                   
                    },
                    error: function (xhr, status, error) {
                        swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
                    }
                });

                
                
           }
            
        },
        error: function (xhr, status, error) {
            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
        }
    });

</script>

<script type="text/javascript">

    /* parameter kembali ke workflow summary */
    params_back_summary = {};
    params_back_summary.ELEMENT_ID = $('#TEMP_ELEMENT_ID').val();
    params_back_summary.PROFILE_TYPE = $('#TEMP_PROFILE_TYPE').val();
    params_back_summary.P_W_DOC_TYPE_ID = $('#TEMP_P_W_DOC_TYPE_ID').val();
    params_back_summary.P_W_PROC_ID = $('#TEMP_P_W_PROC_ID').val();
    params_back_summary.USER_ID = $('#TEMP_USER_ID').val();
    params_back_summary.FSUMMARY = $('#TEMP_FSUMMARY').val();

    setTimeout(function(){
        params_back_summary.WP_NAME = $('#wp_user_name').val();
        params_back_summary.WP_PWD = $('#wp_user_pwd').val();
        params_back_summary.WP_EMAIL = $('#wp_email').val(); 
    },3000);
       
    /* end parameter */ 

    /*ketika tombol cancel diklik, maka kembali ke summary*/
    function backform(){
        loadContentWithParams( $('#TEMP_FSUMMARY').val() , params_back_summary );
    };

    /* cek jika tipe view */
    if (  $('#ACTION_STATUS').val() == 'VIEW' ) {
        $('#form_customer_order_btn_submit').remove();
        $('#form_customer_order_btn_save').remove();
        $('#add_legal_doc').hide();
        $('#add_log').hide();
    }

    function showLOVKota(id, code) {
        return false;
    }
    function showLOVKec(id, code, parent) {
        return false;
        
    }
    function showLOVKel(id, code, parent) {
        return false;
    }
    function showLOVJabatan(id, code) {
        return false;
    }
    function showLOVVatTypeDtl(id, code) {
        return false;
    }

    function submitform(){
        var params_submit = {};
        
        params_submit.CURR_DOC_ID         = $('#CURR_DOC_ID').val();  
        params_submit.CURR_DOC_TYPE_ID    = $('#CURR_DOC_TYPE_ID').val();
        params_submit.CURR_PROC_ID        = $('#CURR_PROC_ID').val();
        params_submit.CURR_CTL_ID         = $('#CURR_CTL_ID').val();
        params_submit.USER_ID_DOC         = $('#USER_ID_DOC').val();
        params_submit.USER_ID_DONOR       = $('#USER_ID_DONOR').val();
        params_submit.USER_ID_LOGIN       = $('#USER_ID_LOGIN').val();
        params_submit.USER_ID_TAKEN       = $('#USER_ID_TAKEN').val();
        params_submit.IS_CREATE_DOC       = $('#IS_CREATE_DOC').val();
        params_submit.IS_MANUAL           = $('#IS_MANUAL').val();
        params_submit.CURR_PROC_STATUS    = $('#CURR_PROC_STATUS').val();
        params_submit.CURR_DOC_STATUS     = $('#CURR_DOC_STATUS').val();
        params_submit.PREV_DOC_ID         = $('#PREV_DOC_ID').val();
        params_submit.PREV_DOC_TYPE_ID    = $('#PREV_DOC_TYPE_ID').val();
        params_submit.PREV_PROC_ID        = $('#PREV_PROC_ID').val();
        params_submit.PREV_CTL_ID         = $('#PREV_CTL_ID').val();
        params_submit.SLOT_1              = $('#SLOT_1').val();    
        params_submit.SLOT_2              = $('#SLOT_2').val(); 
        params_submit.SLOT_3              = $('#SLOT_3').val();    
        params_submit.SLOT_4              = $('#SLOT_4').val();  
        params_submit.SLOT_5              = $('#SLOT_5').val();    
        params_submit.MESSAGE             = $('#MESSAGE').val();    
        params_submit.PROFILE_TYPE        = $('#PROFILE_TYPE').val();
        params_submit.ACTION_STATUS       = $('#ACTION_STATUS').val();

        if (  $('#ACTION_STATUS').val() != 'VIEW' ) {
            modal_lov_submitter_show(params_submit, params_back_summary); 
        } else {
            loadContentWithParams( $('#TEMP_FSUMMARY').val() , params_back_summary );
        }
    }
</script>


