<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url(); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>PIUTANG SKPDKB LB</span>
        </li>
    </ul>
</div>

<div class="space-4"></div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">                    
                    <span class="caption-subject font-blue bold uppercase"> PIUTANG SKPDKB LB
                    </span>
                </div>
            </div>
            <!-- CONTENT  value="2015-09-01" -->
            <div class="form-body">
                <div class="row col-md-offset-4">     
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="s_keyword" id="s_keyword">                 
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="toTampil()">Cari</button>
                </div> 
            </div>
        </div>
    </div>
</div>
<div class="space-4"></div>
<!-- Table  -->
<div class="tab-content no-border" id="table">
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
<div class="space-4"></div>
<!-- Content  -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">                    
                    <span class="caption-subject font-blue bold uppercase"> INFORMASI SKPDKB LB
                    </span>
                </div>
            </div>
            <!-- CONTENT  value="2015-09-01" -->
            <div class="form-body">
                <div class="row">   
                	<label class="control-label col-md-2">No Order</label>  
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="order_no" id="order_no" readonly>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">   
                	<label class="control-label col-md-2">Nama WP</label>  
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" style="width: 400px" class="form-control" name="wp_name" id="wp_name" readonly>
                        </div>
                    </div>
                </div>
                <div class="space-2"></div>
                <div class="row">   
                	<label class="control-label col-md-2">Alamat WP</label>  
                    <div class="col-md-4">
                        <div class="input-group">
                            <textarea rows="3" cols="70" style="width: 400px" class="form-control" maxlength="256"  name="wp_address_name" id="wp_address_name" readonly></textarea>
                        </div>
                    </div>
                </div>
                <div class="space-4"></div>
                <div class="row">   
                	<button class="btn btn-primary" type="button" onclick="showLOVskpdkblb()">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('lov/lov_t_vat_setllement_manual_skpdkb_lb'); ?>

<script type="text/javascript">
	

	function showLOVskpdkblb(id, code) {
	    modal_lov_skpdkblb_show();
	}
</script>