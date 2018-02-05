<link href="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Laporan Daftar BPHTB Verifikasi</span>
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
                    <span class="caption-subject font-blue bold uppercase"> Laporan Daftar BPHTB Verifikasi
                    </span>
                </div>
            </div>
            <!-- CONTENT  value="2015-09-01" -->
            <div class="form-body">
                <div class="row">
                    <label class="control-label col-md-2">Tanggal</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 required" name="date_start_laporan" id="date_start_laporan" required >
                        </div>
                    </div>
                    <label class="control-label col-md-1">s/d</label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker1 required" name="date_end_laporan" id="date_end_laporan" required >
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>

                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-2">kecamatan
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="object_p_region_id_kec" maxlength="8" id="object_p_region_id_kec" readonly>
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-kecamatan">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-2"></div>
                <div class="row col-md-offset-4">
                    <button class="btn btn-danger" type="button" onclick="toExcel()" id="excel">Download Excel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('lov/lov_kec'); ?>

<script >
    //tanggal
    $('.datepicker1').datetimepicker({
        format: 'YYYY-MM-DD',
        // defaultDate: new Date()
    });

    // call lov kecematan
    $("#btn-lov-kecamatan").on('click', function() {
        var kota = 659;  // id kota sama dengan cocas yaitu id dari kota bandung

        if( kota == null || kota == ''){
            swal({title: "Error!", text: "Isi Kota/Kabupaten Terlebih Dahulu", html: true, type: "error"});
            return;
        }
        modal_lov_kecamatan_show('object_p_region_id_kec','kecamatan',kota);
    });

    function toExcel(){
        var date_start_laporan     = $('#date_start_laporan').val();
        var date_end_laporan       = $('#date_end_laporan').val();
        var object_p_region_id_kec = $('#object_p_region_id_kec').val();

        if(date_start_laporan == "" || date_end_laporan == ""){
            swal ( "Oopss" ,  "Kolom Tanggal Tidak Boleh Kosong!" ,  "error" );
        }else{


            var url = "<?php echo WS_JQGRID . "transaksi.t_laporan_daftar_bphtb_verifikasi_controller/excel/?"; ?>";
            url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
            url += "&date_start_laporan=" + date_start_laporan;
            url += "&date_end_laporan=" + date_end_laporan;
            url += "&object_p_region_id_kec=" + object_p_region_id_kec;

            /*if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal awal harus lebih besar dari tanggal akhir" ,  "error" );
                return;
            }else{*/
                window.location = url;
            // }

        }
    }
</script>