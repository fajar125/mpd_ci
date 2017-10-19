<div id="modal_upload_file" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		    <!-- modal title -->
			<div class="modal-header no-padding">
				<div class="table-header">
					<span class="form-add-edit-title"> Tambah Data </span>
				</div>
			</div>
			            
			<!-- modal body -->
			<form method="post" id="form-upload-file" enctype="multipart/form-data">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="modal-body">
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-3">Jenis Dokumen
						</label>
						<div class="col-md-7">
							<div class="input-group">
	                            <input id="form_p_legal_doc_type_id" type="text" name="legal_doc_desc" style="display:none;">
	                            <input id="form_p_legal_doc_type_code" readonly type="text" class="FormElement form-control" placeholder="Pilih Jenis Dokumen">
	                            <span class="input-group-btn">
	                                <button class="btn btn-success" type="button" onclick="showLOVLegalDocType('form_p_legal_doc_type_id','form_p_legal_doc_type_code')">
	                                    <span class="fa fa-search bigger-110"></span>
	                                </button>
	                            </span>
                    		</div>
						</div>			
					</div>
				</div>
			   	<div class="space-2"></div>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-3">Upload File
						</label>
						<div class="col-md-7">
							<div class="input-group">
							<input type="file" id="file_name" name="file_name" required/>
							</div>
						</div>			
					</div>
				</div>
				<div class="space-2"></div>
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-3">Deskripsi
						</label>
						<div class="col-md-7">
							<div class="input-group">
							<textarea class="form-control" id="description" name="description"></textarea>
							</div>
						</div>			
					</div>
				</div>
			</div>

			<!-- modal footer -->
			<div class="modal-footer no-margin-top">
			    <div class="bootstrap-dialog-footer">
			        <div class="bootstrap-dialog-footer-buttons">
        				
						<button class="btn btn-md green-jungle radius-4">
        					<i class="ace-icon fa fa-check"></i>
        					Submit
        				</button>
						<button class="btn btn-danger btn-md radius-4" data-dismiss="modal">
        					<i class="ace-icon fa fa-times"></i>
        					Close
        				</button>
    				</div>
				</div>
			</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.end modal -->
<?php $this->load->view('lov/lov_p_legal_doc_type'); ?>
<script>
	function modal_upload_file_show(){
		$("#modal_upload_file").modal("toggle");
	};

    $('#form-upload-file').submit(function(e){
		var url_submit = "<?php echo WS_JQGRID.'transaksi.t_cust_order_legal_doc_controller/uploadFiles'; ?>"
		var formData = new FormData($(this)[0]);
		 $.ajax({
            url: url_submit,
            type:"POST",
            secureuri: false,
            dataType: "json",
            data: formData,
            success: function (data, status) {

                if (typeof (data.success) != 'undefined') {
                    if (data.success == true) {
                        return;
                    } else {
                        alert(data.message);
                    }
                }
                else {
                    return alert('Failed to upload!');
                }
            },
            error: function (data, status, e) {
                return alert('Failed to upload!');
            }
        });
		$('#modal_upload_file').modal('hide');
		return false;
	});
</script>
<script>
	function showLOVLegalDocType(id, code) {
    	modal_p_legal_doc_type_show(id, code);
	}
</script>