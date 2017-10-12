<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>FORMULIR PENDAFTARAN</span>
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
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-1">
                        <i class="blue"></i>
                        <strong> PERMINTAAN PELANGGAN </strong>
                    </a>
                </li>
                <li class="active">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-2">
                        <i class="blue"></i>
                        <strong> FORMULIR PENDAFTARAN </strong>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true" id="tab-3">
                        <i class="blue"></i>
                        <strong> DATA IZIN DAN POTENSI </strong>
                    </a>
                </li>
            </ul>
        </div>

        
    </div>
</div>

<script>
$("#tab-1").on("click", function(event) {
    event.stopPropagation();
    loadContentWithParams("transaksi.t_customer_order",{});
});

$("#tab-3").on("click", function(event) {
    event.stopPropagation();
    t_vat_registration_id = <?php echo $_POST['t_vat_registration_id'];?> ;
    p_rqst_type_id = <?php echo $_POST['p_rqst_type_id'];?> ;
    t_customer_order_id = <?php echo $_POST['t_customer_order_id'];?> ;
    //alert(p_rqst_type_id);
    // t_vat_reg_employee_id = $('#t_vat_reg_employee_id').val() ;
    // t_vat_reg_dtl_restaurant_id = $('#t_vat_reg_dtl_restaurant_id').val() ;
    // t_license_letter_id = $('#t_license_letter_id').val() ;
    if(t_vat_registration_id == null || t_vat_registration_id == 0 || t_vat_registration_id == ""){
        swal('Peringatan','Isi Formulir Pendaftaran Terlebih Dahulu!','error');
        return false;
    }

    loadContentWithParams("transaksi.t_vat_reg_dtl", { //model yang ketiga
        t_customer_order_id: t_customer_order_id,
        p_rqst_type_id: p_rqst_type_id,
        t_vat_registration_id: t_vat_registration_id
        
    });
});
</script>

<script type="text/javascript">
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

    $.ajax({
        url: "<?php echo base_url().'transaksi/nama_ayat_combo/'; ?>" ,
        type: "POST",            
        data: {p_rqst_type_id:<?php echo $_POST['p_rqst_type_id'];?>},
        success: function (data) {
            $( "#namaAyat" ).html( data );
        },
        error: function (xhr, status, error) {
            swal({title: "Error!", text: xhr.responseText, html: true, type: "error"});
        }
    });
</script>

<script type="text/javascript">


    var var_url = "<?php echo WS_JQGRID . "transaksi.t_vat_registration_controller/read/?"; ?>";
        var_url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
        var_url += "&t_customer_order_id=<?php echo $_POST['t_customer_order_id'];?>";

        //window.location = var_url;
        var t_vat_registration_id = <?php echo $_POST['t_vat_registration_id'];?>;
        var order_no = <?php echo $_POST['order_no'];?> ;
        
        if (t_vat_registration_id == 0) {
            $('#order_no').val(order_no); 
            $('#registration_date').val(); 
        }

        
            $.getJSON(var_url, function( items ) {

                $('#t_vat_registration_id').val(items.row[0].t_vat_registration_id); 
                $('#order_no').val(items.row[0].order_no); 
                $('#registration_date').val(items.row[0].registration_date); 

                $('#p_vat_type_dtl').val(items.row[0].p_vat_type_dtl_id); 
                //alert(p_vat_type_dtl_id);
                $('#wp_user_name').val(items.row[0].wp_user_name);  
                $('#wp_user_pwd').val(items.row[0].wp_user_pwd); 

                $('#wp_name').val(items.row[0].wp_name);  
                $('#wp_address_name').val(items.row[0].wp_address_name);
                $('#wp_address_no').val(items.row[0].wp_address_no); 
                $('#wp_address_rt').val(items.row[0].wp_address_rt); 
                $('#wp_address_rw').val(items.row[0].wp_address_rw);  
                $('#wp_kota').val(items.row[0].wp_kota);
                $('#wp_p_region_id').val(items.row[0].wp_p_region_id);
                $('#wp_kecamatan').val(items.row[0].wp_kecamatan); 
                $('#wp_p_region_id_kecamatan').val(items.row[0].wp_p_region_id_kecamatan);
                $('#wp_kelurahan').val(items.row[0].wp_kelurahan);
                $('#wp_p_region_id_kelurahan').val(items.row[0].wp_p_region_id_kelurahan); 
                $('#wp_email').val(items.row[0].wp_email);  
                $('#wp_phone_no').val(items.row[0].wp_phone_no);  
                $('#wp_mobile_no').val(items.row[0].wp_mobile_no);
                $('#wp_fax_no').val(items.row[0].wp_fax_no); 
                $('#wp_zip_code').val(items.row[0].wp_zip_code); 

                $('#company_name').val(items.row[0].company_name);  
                $('#address_name').val(items.row[0].address_name);
                $('#address_no').val(items.row[0].address_no); 
                $('#address_rt').val(items.row[0].address_rt); 
                $('#address_rw').val(items.row[0].address_rw);  
                $('#kota_code').val(items.row[0].kota_code);
                $('#p_region_id').val(items.row[0].p_region_id);
                $('#kecamatan_code').val(items.row[0].kecamatan_code); 
                $('#p_region_id_kecamatan').val(items.row[0].p_region_id_kecamatan);
                $('#kelurahan_code').val(items.row[0].kelurahan_code);
                $('#p_region_id_kelurahan').val(items.row[0].p_region_id_kelurahan); 
                $('#phone_no').val(items.row[0].phone_no);  
                $('#mobile_no').val(items.row[0].mobile_no);
                $('#fax_no').val(items.row[0].fax_no); 
                $('#zip_code').val(items.row[0].zip_code); 

                $('#company_brand').val(items.row[0].company_brand);  
                $('#brand_address_name').val(items.row[0].brand_address_name);
                $('#brand_address_no').val(items.row[0].brand_address_no); 
                $('#brand_address_rt').val(items.row[0].brand_address_rt); 
                $('#brand_address_rw').val(items.row[0].brand_address_rw);  
                $('#brand_kota').val(items.row[0].brand_kota);
                $('#brand_p_region_id').val(items.row[0].brand_p_region_id);
                $('#brand_kecamatan').val(items.row[0].brand_kecamatan); 
                $('#brand_p_region_id_kecamatan').val(items.row[0].brand_p_region_id_kecamatan);
                $('#brand_kelurahan').val(items.row[0].brand_kelurahan);
                $('#brand_p_region_id_kelurahan').val(items.row[0].brand_p_region_id_kelurahan); 
                $('#brand_phone_no').val(items.row[0].brand_phone_no);  
                $('#brand_mobile_no').val(items.row[0].brand_mobile_no);
                $('#brand_fax_no').val(items.row[0].brand_fax_no); 
                $('#brand_zip_code').val(items.row[0].brand_zip_code); 

                $('#company_owner').val(items.row[0].company_owner);  
                $('#address_name_owner').val(items.row[0].address_name_owner);
                $('#p_job_position_id').val(items.row[0].p_job_position_id);
                $('#job_position_code').val(items.row[0].job_position_code);
                $('#address_no_owner').val(items.row[0].address_no_owner); 
                $('#address_rt_owner').val(items.row[0].address_rt_owner); 
                $('#address_rw_owner').val(items.row[0].address_rw_owner);  
                $('#kota_own_code').val(items.row[0].kota_own_code);
                $('#p_region_id_owner').val(items.row[0].p_region_id_owner);
                $('#kecamatan_own_code').val(items.row[0].kecamatan_own_code); 
                $('#p_region_id_kecamatan_owner').val(items.row[0].p_region_id_kecamatan_owner);
                $('#kelurahan_own_code').val(items.row[0].kelurahan_own_code);
                $('#p_region_id_kelurahan').val(items.row[0].p_region_id_kelurahan_owner); 
                $('#email').val(items.row[0].email);  
                $('#phone_no_owner').val(items.row[0].phone_no_owner);  
                $('#mobile_no_owner').val(items.row[0].mobile_no_owner);
                $('#fax_no_owner').val(items.row[0].fax_no_owner); 
                $('#zip_code_owner').val(items.row[0].zip_code_owner);

                $('#p_private_question_id').val(items.row[0].p_private_question_id);
                $('#private_answer').val(items.row[0].private_answer);


                 

            })
        

</script>



<?php $this->load->view('lov/lov_kota'); ?>
<?php $this->load->view('lov/lov_kec'); ?>
<?php $this->load->view('lov/lov_kel'); ?>
<?php $this->load->view('lov/lov_vat_type_dtl'); ?>
<?php $this->load->view('lov/lov_job_position'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="form-body">
                <div class="row">
                    <label class="control-label col-md-3">Nomor Order</label>                
                        <div class="input-group col-md-4 col-md-4">
                            <input type="text" class="form-control" name="t_vat_registration_id" id="t_vat_registration_id" style="display:none;">   
                            <input type="text" class="form-control" name="order_no" id="order_no" readonly="true">                 
                        </div>
                    
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Tanggal Pendaftaran</label>
                        <div class="input-group col-md-4 col-md-4">
                            <input type="text" class="form-control" name="registration_date" id="registration_date" readonly="true">                 
                        </div>                 
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Nama Ayat</label>
                    <div class="input-group col-md-4 col-md-4">
                        <div id="namaAyat"></div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Username</label>
                    <div class="input-group col-md-4 col-md-4">
                            <input type="text" class="form-control" name="wp_user_name" id="wp_user_name">
                        </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Password</label>
                        <div class="input-group col-md-4 col-md-4">
                            <input type="password" class="form-control" name="wp_user_pwd" id="wp_user_pwd">                            
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
                    <div class="input-group col-md-4">
                        <input type="text" class="form-control" name="wp_name" id="wp_name">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Alamat Wajib Pajak</label>
                    <div class="input-group col-md-4">
                            <textarea class="form-control" name="wp_address_name" id="wp_address_name"></textarea>
                        </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No</label>
                        <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="wp_address_no" id="wp_address_no">      
                            <span class="input-group-addon"> RT </span> 
                            <input type="text" class="form-control" name="wp_address_rt" id="wp_address_rt">   
                            <span class="input-group-addon"> RW </span> 
                            <input type="text" class="form-control" name="wp_address_rw" id="wp_address_rw">                            
                        </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                
                    <label class="control-label col-md-3">Kota/Kabupaten</label>
                    <div class="input-group col-md-4">
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
                    <div class="input-group col-md-4">
                            <input id="wp_p_region_id_kecamatan" type="text"  style="display:none;">
                            <input id="wp_kecamatan" readonly type="text" class="FormElement form-control" placeholder="Pilih Kecamatan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKec('wp_p_region_id_kecamatan','wp_kecamatan')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>               
                </div>

                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="input-group col-md-4">
                        <input id="wp_p_region_id_kelurahan" type="text"  style="display:none;">
                        <input id="wp_kelurahan" readonly type="text" class="FormElement form-control" placeholder="Pilih Kelurahan">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="button" onclick="showLOVKel('wp_p_region_id_kelurahan','wp_kelurahan')">
                                <span class="fa fa-search bigger-110"></span>
                             </button>
                        </span>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Email</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="wp_email" id="wp_email">
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Telepon</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="wp_phone_no" id="wp_phone_no">
                            <span class="input-group-addon">No. Seluler </span>
                            <input type="text" class="form-control" name="wp_mobile_no" id="wp_mobile_no">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Fax</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="wp_fax_no" id="wp_fax_no">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kode Pos</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="wp_zip_code" id="brand_zip_code">
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
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="company_name" id="company_name">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Alamat Badan</label>
                    <div class="input-group col-md-4">
                            <textarea class="form-control" name="address_name" id="address_name"></textarea>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="address_no" id="address_no">      
                            <span class="input-group-addon"> RT </span> 
                            <input type="text" class="form-control" name="address_rt" id="address_rt">   
                            <span class="input-group-addon"> RW </span> 
                            <input type="text" class="form-control" name="address_rw" id="address_rw">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                
                    <label class="control-label col-md-3">Kota/Kabupaten</label>
                    <div class="input-group col-md-4">
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
                    <div class="input-group col-md-4">
                            <input id="p_region_id_kecamatan" type="text"  style="display:none;">
                            <input id="kecamatan_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kecamatan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKec('p_region_id_kecamatan','kecamatan_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>               
                
                    
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="input-group col-md-4">
                            <input id="p_region_id_kelurahan" type="text"  style="display:none;">
                            <input id="kelurahan_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kelurahan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKel('p_region_id_kelurahan','kelurahan_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Telepon</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="wp_phone_no" id="wp_phone_no">
                            <span class="input-group-addon">No. Seluler </span>
                            <input type="text" class="form-control" name="wp_mobile_no" id="wp_mobile_no">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Fax</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="brand_fax_no" id="brand_fax_no">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kode Pos</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="brand_zip_code" id="brand_zip_code">
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
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="company_brand" id="company_brand">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Alamat</label>
                    <div class="input-group col-md-4">
                            <textarea class="form-control" name="brand_address_name" id="brand_address_name"></textarea>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No.</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="brand_address_no" id="brand_address_no">      
                            <span class="input-group-addon"> RT </span> 
                            <input type="text" class="form-control" name="brand_address_rt" id="brand_address_rt">   
                            <span class="input-group-addon"> RW </span> 
                            <input type="text" class="form-control" name="brand_address_rw" id="brand_address_rw">
                    </div>
                   
                </div>
                <div class="space-2"></div>
                <div class="row">                
                    <label class="control-label col-md-3">Kota/Kabupaten</label>
                    <div class="input-group col-md-4">
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
                    <div class="input-group col-md-4">
                            <input id="brand_p_region_id_kec" type="text"  style="display:none;">
                            <input id="brand_kecamatan" readonly type="text" class="FormElement form-control" placeholder="Pilih Kecamatan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKec('brand_p_region_id_kec','brand_kecamatan')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>               
                
                    
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="input-group col-md-4">
                            <input id="brand_p_region_id_kel" type="text"  style="display:none;">
                            <input id="brand_kelurahan" readonly type="text" class="FormElement form-control" placeholder="Pilih Kelurahan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKel('brand_p_region_id_kel','brand_kelurahan')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Telepon</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="wp_phone_no" id="wp_phone_no">
                            <span class="input-group-addon">No. Seluler </span>
                            <input type="text" class="form-control" name="wp_mobile_no" id="wp_mobile_no">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Fax</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="brand_fax_no" id="brand_fax_no">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kode Pos</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="brand_zip_code" id="brand_zip_code">
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
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="company_owner" id="company_owner">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Jabatan</label>
                    <div class="input-group col-md-4">
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
                    <div class="input-group col-md-4">
                            <textarea class="form-control" name="address_name_owner" id="address_name_owner"></textarea>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No.</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="address_no_owner" id="address_no_owner">      
                            <span class="input-group-addon"> RT </span> 
                            <input type="text" class="form-control" name="address_rt_owner" id="address_rt_owner">   
                            <span class="input-group-addon"> RW </span> 
                            <input type="text" class="form-control" name="address_rw_owner" id="address_rw_owner">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">                
                    <label class="control-label col-md-3">Kota/Kabupaten</label>
                    <div class="input-group col-md-4">
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
                    <div class="input-group col-md-4">
                            <input id="p_region_id_kec_owner" type="text"  style="display:none;">
                            <input id="kecamatan_own_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kecamatan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKec('p_region_id_kec_owner','kecamatan_own_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>               
                
                    
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kelurahan</label>
                    <div class="input-group col-md-4">
                            <input id="p_region_id_kel_owner" type="text"  style="display:none;">
                            <input id="kelurahan_own_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Kelurahan">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="showLOVKel('p_region_id_kel_owner','kelurahan_own_code')">
                                    <span class="fa fa-search bigger-110"></span>
                                </button>
                            </span>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Email</label>
                    <div class="input-group col-md-4">
                        <input type="text" class="form-control" name="email" id="email">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Telepon</label>
                    <div class="input-group col-md-4">
                        <input type="text" class="form-control" name="phone_no_owner" id="phone_no_owner">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">No. Fax</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="fax_no_owner" id="fax_no_owner">
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Kode Pos</label>
                    <div class="input-group col-md-4">
                            <input type="text" class="form-control" name="zip_code_owner" id="zip_code_owner">
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
                    <div class="input-group col-md-4">                            
                        <div id="privateQuestion"></div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">
                    <label class="control-label col-md-3">Jawaban</label>
                    <div class="input-group col-md-4">
                        <input type="text" class="form-control" name="private_answer" id="private_answer">
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
                    <div class="input-group col-md-4">
                        <input type="text" class="form-control" name="mobile_no_owner" id="mobile_no_owner">
                    </div>
                 
                </div> 
                <div class="space-2"></div>
                <div class="row">
                    <div class="col-sm-offset-3">
                        <button class="btn btn-success" type="button" id="btn-add" onclick="insertUpdate('I')">Simpan</button>
                        <button class="btn btn-success" type="button" id="btn-edit" onclick="insertUpdate('U')">Simpan</button>
                        <button class="btn btn-success" type="button" id="btn-del" onclick="insertUpdate('D')">Hapus</button>
                    </div>
                 
                </div> 

            </div>       
        </div>   
    </div>
</div>



<script type="text/javascript">
    var t_vat_registration_id = $('#t_vat_registration_id').val(); 

    if (t_vat_registration_id == 0 || t_vat_registration_id == "" || t_vat_registration_id == false || t_vat_registration_id == undefined ||  t_vat_registration_id == null){
        $('#btn-add').show();
        $('#btn-edit').hide();
    } else{    
        $('#btn-edit').show();
        $('#btn-add').hide();
    }

    function insertUpdate($imode){
        // alert($imode);
        // return;
        // alert();
        var t_vat_registration_id = $('#t_vat_registration_id').val(); 
       // alert($imode);
        var order_no = $('#order_no').val(); 
        var registration_date = $('#registration_date').val(); 
        var p_vat_type_dtl_id = $('#p_vat_type_dtl').val(); 
         
        //alert(p_vat_type_dtl_id);
        var wp_user_name = $('#wp_user_name').val();  
        var wp_user_pwd = $('#wp_user_pwd').val(); 

        var wp_name = $('#wp_name').val();  
        var wp_address_name = $('#wp_address_name').val();
        var wp_address_no = $('#wp_address_no').val(); 
        var wp_address_rt = $('#wp_address_rt').val(); 
        var wp_address_rw = $('#wp_address_rw').val();  
        var wp_kota = $('#wp_kota').val();
        var wp_p_region_id = $('#wp_p_region_id').val();
        var wp_kecamatan = $('#wp_kecamatan').val(); 
        var wp_p_region_id_kecamatan = $('#wp_p_region_id_kecamatan').val();
        var wp_kelurahan = $('#wp_kelurahan').val();
        var wp_p_region_id_kelurahan = $('#wp_p_region_id_kelurahan').val(); 
        var wp_email = $('#wp_email').val();  
        var wp_phone_no = $('#wp_phone_no').val();  
        var wp_mobile_no = $('#wp_mobile_no').val();
        var wp_fax_no = $('#wp_fax_no').val(); 
        var wp_zip_code = $('#wp_zip_code').val(); 

        var company_name = $('#company_name').val();  
        var address_name = $('#address_name').val();
        var address_no = $('#address_no').val(); 
        var address_rt = $('#address_rt').val(); 
        var address_rw = $('#address_rw').val();  
        var kota = $('#kota_code').val();
        var p_region_id = $('#p_region_id').val();
        var kecamatan = $('#kecamatan_code').val(); 
        var p_region_id_kecamatan = $('#p_region_id_kecamatan').val();
        var kelurahan = $('#kelurahan_code').val();
        var p_region_id_kelurahan = $('#p_region_id_kelurahan').val(); 
        var phone_no = $('#phone_no').val();  
        var mobile_no = $('#mobile_no').val();
        var fax_no = $('#fax_no').val(); 
        var zip_code = $('#zip_code').val(); 

        var company_brand = $('#company_brand').val();  
        var brand_address_name = $('#brand_address_name').val();
        var brand_address_no = $('#brand_address_no').val(); 
        var brand_address_rt = $('#brand_address_rt').val(); 
        var brand_address_rw = $('#brand_address_rw').val();  
        var brand_kota = $('#brand_kota').val();
        var brand_p_region_id = $('#brand_p_region_id').val();
        var brand_kecamatan = $('#brand_kecamatan').val(); 
        var brand_p_region_id_kecamatan = $('#brand_p_region_id_kecamatan').val();
        var brand_kelurahan = $('#brand_kelurahan').val();
        var brand_p_region_id_kelurahan = $('#brand_p_region_id_kelurahan').val(); 
        var brand_phone_no = $('#brand_phone_no').val();  
        var brand_mobile_no = $('#brand_mobile_no').val();
        var brand_fax_no = $('#brand_fax_no').val(); 
        var brand_zip_code = $('#brand_zip_code').val(); 

        var company_owner = $('#company_owner').val();  
        var p_job_position_id = $('#p_job_position_id').val(); 
        var address_name_owner = $('#address_name_owner').val();
        var address_no_owner = $('#address_no_owner').val(); 
        var address_rt_owner = $('#address_rt_owner').val(); 
        var address_rw_owner = $('#address_rw_owner').val();  
        var kota_own_code = $('#kota_own_code').val();
        var p_region_id_owner = $('#p_region_id_owner').val();
        var kecamatan_own_code = $('#kecamatan_own_code').val(); 
        var p_region_id_kecamatan_owner = $('#p_region_id_kecamatan_owner').val();
        var kelurahan_own_code = $('#kelurahan_own_code').val();
        var p_region_id_kelurahan_owner = $('#p_region_id_kelurahan').val(); 
        var email = $('#email').val();  
        var phone_no_owner = $('#phone_no_owner').val();  
        var mobile_no_owner = $('#mobile_no_owner').val();
        var fax_no_owner = $('#fax_no_owner').val(); 
        var zip_code_owner = $('#zip_code_owner').val();


        var p_private_question_id = $('#p_private_question_id').val();
        var private_answer = $('#private_answer').val();

        if (wp_zip_code == "" || wp_zip_code == 0 || wp_zip_code == false || wp_zip_code == undefined ||  wp_zip_code == null){
            wp_zip_code = "-";
        }
        if (zip_code == "" || zip_code == 0 || zip_code == false || zip_code == undefined ||  zip_code == null){
            zip_code = "-";
        }
        if (brand_zip_code == "" || brand_zip_code == 0 || brand_zip_code == false || brand_zip_code == undefined ||  brand_zip_code == null){
            brand_zip_code = "-"; 
        }
        if (zip_code_owner == "" || zip_code_owner == 0 || zip_code_owner == false || zip_code_owner == undefined ||  zip_code_owner == null){
            zip_code_owner = "-"; 
        }

        if (wp_address_rt == "" || wp_address_rt == 0 || wp_address_rt == false || wp_address_rt == undefined ||  wp_address_rt == null){
            wp_address_rt = "-"; 
        }
        if (wp_address_rw == "" || wp_address_rw == 0 || wp_address_rw == false || wp_address_rw == undefined ||  wp_address_rw == null){
            wp_address_rw = "-"; 
        }
        if (address_rw == "" || address_rw == 0 || address_rw == false || address_rw == undefined ||  address_rw == null){
            address_rw = "-"; 
        }
        if (address_rt == "" || address_rt == 0 || address_rt == false || address_rt == undefined ||  address_rt == null){
            address_rt = "-"; 
        }
        if (brand_address_rt == "" || brand_address_rt == 0 || brand_address_rt == false || brand_address_rt == undefined ||  brand_address_rt == null){
            brand_address_rt = "-";
        }
        if (address_rt_owner == "" || address_rt_owner == 0 || address_rt_owner == false || address_rt_owner == undefined ||  address_rt_owner == null){
            address_rt_owner = "-"; 
        }
        if (address_rw_owner == "" || address_rw_owner == 0 || address_rw_owner == false || address_rw_owner == undefined ||  address_rw_owner == null){
            address_rw_owner = "-"; 
        }

        
        if (wp_name == "" || wp_name == 0 || wp_name == false || wp_name == undefined ||  wp_name == null){
            swal('Informasi',"Nama Wajib Pajak harus diisi",'info'); 
            return;
        }
        if (wp_address_name == "" || wp_address_name == 0 || wp_address_name == false || wp_address_name == undefined ||  wp_address_name == null){
            swal('Informasi',"Alamat Wajib Pajak harus diisi",'info'); 
            return;
        }
        if (wp_p_region_id == "" || wp_p_region_id == 0 || wp_p_region_id == false || wp_p_region_id == undefined ||  wp_p_region_id == null){
            swal('Informasi',"Kota harus diisi",'info'); 
            return;
        }
        if (company_name == "" || company_name == 0 || company_name == false || company_name == undefined ||  company_name == null){
            swal('Informasi',"Nama Perusahaan/Badan harus diisi",'info'); 
            return;
        }
        if (address_name == "" || address_name == 0 || address_name == false || address_name == undefined ||  address_name == null){
            swal('Informasi',"Alamat Perusahaan/Badan harus diisi",'info'); 
            return;
        }
        if (address_no == "" || address_no == 0 || address_no == false || address_no == undefined ||  address_no == null){
            swal('Informasi',"No. Alamat Perusahaan/Badan harus diisi",'info'); 
            return;
        }
        if (company_brand == "" || company_brand == 0 || company_brand == false || company_brand == undefined ||  company_brand == null){
            swal('Informasi',"Nama Merk Dagang harus diisi",'info'); 
            return;
        }
        if (brand_address_name == "" || brand_address_name == 0 || brand_address_name == false || brand_address_name == undefined ||  brand_address_name == null){
            swal('Informasi',"Alamat Merk Dagang harus diisi",'info'); 
            return;
        }
        if (brand_address_no == "" || brand_address_no == 0 || brand_address_no == false || brand_address_no == undefined ||  brand_address_no == null){
            swal('Informasi',"No. Alamat Merk Dagang harus diisi",'info'); 
            return;
        }
        if (brand_p_region_id == "" || brand_p_region_id == 0 || brand_p_region_id == false || brand_p_region_id == undefined ||  brand_p_region_id == null){
            swal('Informasi',"Kota Merk Dagang harus diisi",'info'); 
            return;
        }
        if (p_region_id_owner == "" || p_region_id_owner == 0 || p_region_id_owner == false || p_region_id_owner == undefined ||  p_region_id_owner == null){
            swal('Informasi',"Kota Pemilik/Pengelola harus diisi",'info'); 
            return;
        }
         
        var var_url = "<?php echo WS_JQGRID . "transaksi.t_vat_registration_controller/insertUpdate/?"; ?>";
            var_url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            var_url += '&icode=null';
            var_url += '&t_customer_order_id='+t_customer_order_id;
            var_url += '&p_region_id_kelurahan='+p_region_id_kelurahan;
            var_url += '&p_region_id_kecamatan='+p_region_id_kecamatan;
            var_url += '&p_region_id='+p_region_id;

            var_url += '&p_region_id_kel_owner='+p_region_id_kel_owner;
            var_url += '&p_region_id_kec_owner='+p_region_id_kec_owner;
            var_url += '&p_region_id_owner='+p_region_id_owner;
            var_url += '&company_name='+company_name;
            var_url += '&address_name='+address_name;
            var_url += '&p_job_position_id='+p_job_position_id;
            var_url += '&company_brand='+company_brand;
            var_url += '&address_no='+address_no;
            var_url += '&address_rt='+address_rt;
            var_url += '&address_rw='+address_rw;
            var_url += '&address_no_owner='+address_no_owner;
            var_url += '&address_rt_owner='+address_rt_owner;
            var_url += '&address_rw_owner='+address_rw_owner;
            var_url += '&phone_no='+phone_no;
            var_url += '&fax_no='+fax_no;
            var_url += '&zip_code='+zip_code;
            var_url += '&phone_no_owner='+phone_no_owner;
            var_url += '&company_owner='+company_owner;
            var_url += '&mobile_no_owner='+mobile_no_owner;
            var_url += '&fax_no_owner='+fax_no_owner;
            var_url += '&zip_code_owner='+zip_code_owner;
            var_url += '&mobile_no='+mobile_no;
            var_url += '&address_name_owner='+address_name_owner;
            var_url += '&email='+email;
            var_url += '&p_vat_type_dtl_id='+p_vat_type_dtl_id;
            var_url += '&wp_user_name='+wp_user_name ;
            var_url += '&wp_user_pwd='+wp_user_pwd ;
            var_url += '&wp_name='+wp_name ;
            var_url += '&wp_address_name='+wp_address_name ;
            var_url += '&wp_address_no='+wp_address_no ;
            var_url += '&wp_address_rt='+ wp_address_rt;
            var_url += '&wp_address_rw='+wp_address_rw;
            var_url += '&wp_p_region_id_kelurahan='+wp_p_region_id_kelurahan;
            var_url += '&wp_p_region_id_kecamatan='+wp_p_region_id_kecamatan;
            var_url += '&wp_p_region_id='+wp_p_region_id;
            var_url += '&wp_phone_no='+wp_phone_no;
            var_url += '&wp_mobile_no='+wp_mobile_no;
            var_url += '&wp_fax_no='+wp_fax_no ;
            var_url += '&wp_zip_code='+wp_zip_code ;
            var_url += '&wp_email='+wp_email;
            var_url += '&brand_address_name='+brand_address_name ;
            var_url += '&brand_address_no='+brand_address_no;
            var_url += '&brand_address_rt='+brand_address_rt ;
            var_url += '&brand_address_rw='+brand_address_rw;
            var_url += '&brand_p_region_id_kel='+brand_p_region_id_kel;
            var_url += '&brand_p_region_id_kec='+brand_p_region_id_kec;
            var_url += '&brand_p_region_id='+brand_p_region_id;
            var_url += '&brand_phone_no='+brand_phone_no ;
            var_url += '&brand_mobile_no='+brand_mobile_no;
            var_url += '&brand_fax_no='+ brand_fax_no;
            var_url += '&brand_zip_code='+brand_zip_code;
            var_url += '&t_vat_registration_id='+t_vat_registration_id;
            var_url += '&p_private_question_id='+p_private_question_id;
            var_url += '&private_answer='+private_answer;
            var_url += '&i_mode='+$imode;

            $.getJSON(var_url, function( items ) {
                swal('Informasi',items.rows.f_crud_vat_reg,'info');  
            }) 
   
    }
</script>



<script type="text/javascript">
    function showLOVKota(id, code) {
        modal_lov_kota_show(id, code);
    }
    function showLOVKec(id, code) {
        modal_lov_kecamatan_show(id, code);
    }
    function showLOVKel(id, code) {
        modal_lov_kelurahan_show(id, code);
    }
    function showLOVJabatan(id, code) {
        modal_job_position_show(id, code);
    }
    function showLOVVatTypeDtl(id, code) {
        modal_lov_vat_dtl_show(id, code);
    }
</script>


