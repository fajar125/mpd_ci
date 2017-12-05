<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>EXECUTIVE SUMMARY</span>
        </li>
    </ul>
</div>
<!-- end breadcrumb -->
<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-list font-blue"></i>
                    <span class="caption-subject font-blue bold uppercase">EXECUTIVE SUMMARY
                    </span>
                </div>
            </div>
            <!-- CONTENT PORTLET -->
            <div class="form-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-2">Tahun
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="hidden" class="form-control required" maxlength="8" name="p_year_period_id" id="p_year_period_id" readonly>
                                <input type="text" class="form-control required" name="year_code" id="year_code" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-year-period">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Jenis Pajak
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="hidden" class="form-control required " maxlength="8" name="p_vat_type_id" id="p_vat_type_id" readonly>
                                <input type="text" class="form-control required " name="vat_code" id="vat_code" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-jenis-pajak">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Periode
                        </label>
                        <div class="col-md-3">
                           <select id= "jenis_wp" name= "jenis_wp" class='form-control required'>
                               <option value="1">- Pilih Periode -</option>
                               <option value="2">Per Bulan</option>
                               <option value="2">Per Triwulan</option>
                               <option value="2">Per Semester</option>
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Bulan
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="hidden" class="form-control required" maxlength="8" name="p_finance_period_id" id="p_finance_period_id" readonly>
                                <input type="text" class="form-control required" name="code" id="code" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-finance-period">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3">
                            <button class="btn btn-danger" id="cetakPDF" onclick="showForm()">Buat Laporan</button>
                        </div>
                    </div>
                </div>

                <div class="row" id="formLaporan" style="display: none;">
                     <div class="col-md-12">
                        <div class="portlet blue box menu-panel">
                            <div class="portlet-title">
                                <div class="caption">FORM LAPORAN EXECUTIVE SUMMARY</div>
                            </div>
                            <div class="portlet-body">   
                                <div class="form-horizontal">
                                    <div class="row">
                                        <!-- start subject -->
                                        <div class="form-group">
                                            <label class="control-label col-md-2 " id="alasan-text">   Penjelasan</label>
                                            <div class="col-md-4">
                                                <textarea class="form-control" name="alasan" id="alasan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 " id="alasan-text">Permasalahan</label>
                                            <div class="col-md-4">
                                                <textarea class="form-control" name="alasan" id="alasan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2" id="alasan-text">Kesimpulan</label>
                                            <div class="col-md-4">
                                                <textarea class="form-control" name="alasan" id="alasan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 " id="alasan-text">Saran</label>
                                            <div class="col-md-4">
                                                <textarea class="form-control" name="alasan" id="alasan"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-4 col-md-9">
                                                    <a href="javascript:;" class="btn  green " id="update"> Simpan                    
                                                    </a>
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
</div>
<?php $this->load->view('lov/lov_vat_type'); ?>
<?php $this->load->view('lov/lov_year_period'); ?>
<?php $this->load->view('lov/lov_finance_period'); ?>
<!--- lov -->
<script>

    $("#btn-lov-jenis-pajak").on('click', function() {   
        modal_lov_vat_show('p_vat_type_id','vat_code');
    });

    $("#btn-lov-year-period").on('click', function() {   
        modal_year_period_show('p_year_period_id','year_code');
    });

    $("#btn-lov-finance-period").on('click', function() {   
        var periode = $('#p_year_period_id').val();
        if( periode == null || periode == ''){
            swal({title: "Error!", text: "Isi Tahun Terlebih Dahulu", html: true, type: "error"});
             return;
        }
        modal_finance_period_show('p_finance_period_id','code', periode);
    });

    function openInNewTab(url) {
        window.open(url, 'No Payment', 'left=0,top=0,width=500,height=500,toolbar=no,scrollbars=yes,resizable=yes');
    }

    function showForm() {
        document.getElementById('formLaporan').style.display = '';
    }
</script>
<script>

    $('#cetakExcel').on('click', function() {
    
        var date_start_laporan      = $('#date_start_laporan').val();
        var date_end_laporan        = $('#date_end_laporan').val();
        var p_vat_type_id           = $('#p_vat_type_id').val();
        if(date_start_laporan == "" || date_end_laporan == "" || p_vat_type_id == '' || p_vat_type_id == 0){            
            swal ( "Oopss" ,  "Semua Filter Yang Berwarna Kuning Harus Diisi" ,  "error" );
        }else{
            if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal akhir harus lebih besar dari tanggal awal ! " ,  "error" );
                return;
            }else{
                var url = "<?php echo WS_JQGRID . "pelaporan.t_laporan_harian_sptpd_controller/excel/?"; ?>";
                url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                url += "&date_start_laporan=" + date_start_laporan;
                url += "&date_end_laporan=" + date_end_laporan;
                url += "&p_vat_type_id=" + p_vat_type_id;
                //alert(url);
                window.location = url;
            }
        }
    });

    $('.datepicker').datepicker({
        todayHighlight: true,
        format: "yyyy-mm-dd",
        autoclose: true
    });

</script>