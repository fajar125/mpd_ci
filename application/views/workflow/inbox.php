<div class="space-4"></div>
<h3 class="page-title">Task List</h3>
<div id="inbox-panel">

</div>
<script>

    $(function() {
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