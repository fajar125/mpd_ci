<?php if ($this->input->get('p_application_id') != 999) : ?>

<h3 class="page-title">Home</h3>
<div class="alert alert-default" role="alert">
    <strong class="red">Welcome to Modul Penerimaan Daerah</strong>
</div>

<?php else: ?>
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<h3 class="page-title">Task List</h3>
<div class="space-4"></div>
<div id="inbox-panel">

</div>
<script>

    $(function() {
        var csfrData = {};
        csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
        $.ajaxSetup({
            data: csfrData,
            cache: false
        });

        $.ajax({
            type: 'POST',
            url: '<?php echo WS_JQGRID."workflow.wf_controller/list_inbox"; ?>',
            timeout: 10000,
            success: function(data) {
                 $("#inbox-panel").html(data);
            }
        });
    });
</script>
<?php endif; ?>