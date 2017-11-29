<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>MONITORING PENDAFTARAN WP</span>
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
                    <span class="caption-subject font-blue bold uppercase">MONITORING PENDAFTARAN WP
                    </span>
                </div>
            </div>
            <!-- CONTENT PORTLET -->
            <div class="form-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-2">Jenis Pajak
                        </label>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="hidden" class="form-control" maxlength="8" name="p_vat_type_id" id="p_vat_type_id" readonly>
                                <input type="text" class="form-control" name="vat_code" id="vat_code" readonly>
                                <span class="input-group-btn">
                                    <button class="btn btn-success" type="button" id="btn-lov-jenis-pajak">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Periode Pendaftaran
                        </label>
                        <div class="col-md-3">
                            <input class="form-control datepicker required " type="text" value=""
                                   id="date_start_laporan" name="date_start_laporan">
                        </div>
                        <label class=" contol-label col-xs-1"><span>s.d.</span></label>
                        <div class="col-md-3">
                            <input class="form-control datepicker required" type="text" value=""
                                   id="date_end_laporan" name="date_end_laporan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Status Proses
                        </label>
                        <div class="col-md-3">
                           <select name="nilai" id="nilai" class='form-control required'>
                               <option value="0">SEMUA</option>
                               <option value="2">PROSES</option>
                               <option value="3">SELESAI</option>
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3">
                            <button class="btn btn-danger" id="cetak">Tampilkan</button>
                            <button class="btn btn-danger" id="cetakExcel">Cetak Excel</button>
                            <button class="btn btn-danger" id="cetakPDF" onclick="cetakNotaDinas()">Cetak Nota Dinas</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                     <div class="col-xs-12">
                        <div id="gbox_grid-table" class="ui-jqgrid">
                            <div id="gview_grid-table" class="ui-jqgrid-view table-responsive" role="grid">
                                <table id="grid-table"></table>
                                <div id="grid-pager"></div>
                            </div>
                        </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('lov/lov_vat_type'); ?>
<!--- lov -->
<script>

    $("#btn-lov-jenis-pajak").on('click', function() {   
        modal_lov_vat_show('p_vat_type_id','vat_code');
    });

    function openInNewTab(url) {
        window.open(url, 'No Payment', 'left=0,top=0,width=500,height=500,toolbar=no,scrollbars=yes,resizable=yes');
    }

    function cetakNotaDinas() {
        var date_start_laporan      = $('#date_start_laporan').val();
        var date_end_laporan        = $('#date_end_laporan').val();
        var p_vat_type_id           = $('#p_vat_type_id').val();
        var nilai                   = $('#nilai').val();
        url = "<?php echo base_url(); ?>"+"nota_dinas_pengantar_penerbitan_npwpd/pageCetak?date_start_laporan="+date_start_laporan+"&date_end_laporan="+date_end_laporan+"&p_vat_type_id="+p_vat_type_id+"&nilai="+nilai;
        openInNewTab(url);
    }
</script>
<script>
//T_bphtb_delete_list_controller
    $('#gview_grid-table').hide();
    jQuery(function ($) {
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        jQuery("#grid-table").jqGrid({
            url: '<?php echo WS_JQGRID."pelaporan.t_monitoring_pendaftaran_new_per_tanggal_controller/read"; ?>',
            datatype: "json",
            mtype: "POST",
            colModel: [ 
                {label: 'NO ORDER',name: 'nomor_order',width: 120,sorttype: 'text'},
                {label: 'NPWPD',name: 'npwpd',width: 150,sorttype: 'text'}, 
                {label: 'NAMA WP',name: 'nama',width: 200,sorttype: 'text'},
                {label: 'ALAMAT',name: 'alamat',width: 250,sorttype: 'text'},
                {label: 'TANGGAL DIBUAT ',name: 'tanggal_dibuat',width: 150,sorttype: 'text'},
                {label: 'VERIFIKASI PENDAFTARAN WP',name: 'verifikasi_pendaftaran_wp',width: 250,sorttype: 'text'},
                {label: 'DISPOSISI BAP',name: 'disposisi_bap',width: 200,sorttype: 'text'},
                {label: 'BERITA ACARA PEMERIKSAAN',name: 'berita_acara_pemeriksaan',width: 250,sorttype: 'text'},
                {label: 'DRAFT PENGUKUHAN',name: 'draft_pengukuhan',width: 200,sorttype: 'text'},
                {label: 'APPROVAL KASI PENDAFTARAN DAN PENDATAAN',name: 'approval_kasi_pendaftaran_dan_pendataan',width: 370,sorttype: 'text'},
                {label: 'APPROVAL KABID PAJAK PENDAFTARAN',name: 'approval_kabid_pajak_pendaftaran',width: 280,sorttype: 'text'},
                {label: 'APPROVAL KADIS PELAYANAN PAJAK',name: 'approval_kadis_pelayanan_pajak',width: 280,sorttype: 'text'},
                {label: 'PENYERAHAN SURAT PENGUKUHAN',name: 'penyerahan_surat_pengukuhan',width: 280,sorttype: 'text'},
                {label: 'DURASI S/D PENGUKUHAN',name: 'durasi_sd_pengukuhan',width: 200,align: 'right',formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}},
                {label: 'DURASI S/D PENYERAHAN',name: 'durasi_sd_penyerahan',width: 200,align: 'right',formatter:'currency', formatoptions: {prefix:"", thousandsSeparator:','}}
            ],
            height: '100%',
            autowidth: true,
            viewrecords: true,
            rowNum: 10,
            rowList: [10, 20, 50],
            rownumbers: true, // show row numbers
            rownumWidth: 35, // the width of the row numbers columns
            altRows: true,
            shrinkToFit: false,
            multiboxonly: true,
            footerrow: false,
            //pager: '#grid-pager',
            loadComplete: function (response) {
                if(response.success == false) {
                    swal({title: 'Attention', text: response.message, html: true, type: "warning"});
                }
            },
            caption: "INFORMASI MONITORING"
        });
    });


    $('#cetak').on('click', function() {
        showData();
    });

    function showData(){
        var date_start_laporan = $('#date_start_laporan').val();
        var date_end_laporan = $('#date_end_laporan').val();
        var newdatestart = date_start_laporan.split("-").reverse().join("-");
        var newdateend = date_end_laporan.split("-").reverse().join("-");

        if(newdatestart > newdateend){
            swal('Informasi','Periksa Kembali inputan Tanggal', 'info');
        }else if(date_start_laporan == '' || date_end_laporan == ''){
            swal('Informasi','Filter Yang Berwarna Kuning Harus Diisi', 'info');
        }else{
            $('#gview_grid-table').show();
            jQuery(function($) {
                var grid_selector = "#grid-table";

                jQuery("#grid-table").jqGrid('setGridParam',{
                    url: '<?php echo WS_JQGRID."pelaporan.t_monitoring_pendaftaran_new_per_tanggal_controller/read"; ?>',
                    postData:{date_start_laporan : date_start_laporan,
                          date_end_laporan : date_end_laporan,
                          p_vat_type_id : $('#p_vat_type_id').val(),
                          nilai : $('#nilai').val()}
                });
                $("#grid-table").jqGrid("setCaption", "INFORMASI MONITORING");
                $("#grid-table").trigger("reloadGrid");
            });
        }
    }

    $('#cetakExcel').on('click', function() {
    
        var date_start_laporan      = $('#date_start_laporan').val();
        var date_end_laporan        = $('#date_end_laporan').val();
        var p_vat_type_id           = $('#p_vat_type_id').val();
        var nilai                   = $('#nilai').val();
        if(date_start_laporan == "" || date_end_laporan == ""){            
            swal ( "Oopss" ,  "Semua Filter Yang Berwarna Kuning Harus Diisi" ,  "error" );
        }else{
            if (date_end_laporan < date_start_laporan){
                swal ( "Oopss" ,  "Tanggal akhir harus lebih besar dari tanggal awal ! " ,  "error" );
                return;
            }else{
                var url = "<?php echo WS_JQGRID . "pelaporan.t_monitoring_pendaftaran_new_per_tanggal_controller/excel/?"; ?>";
                url += "<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>";
                url += "&date_start_laporan=" + date_start_laporan;
                url += "&date_end_laporan=" + date_end_laporan;
                url += "&p_vat_type_id=" + p_vat_type_id;
                url += "&nilai=" + nilai;
                //alert(url);
                window.location = url;
            }
        }
    });

    $('.datepicker').datepicker({
        todayHighlight: true,
        format: "dd-mm-yyyy",
        autoclose: true
    });

</script>