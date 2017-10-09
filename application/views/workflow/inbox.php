<!-- breadcrumb -->
<div class="page-bar">
<h3 class="page-title">Job List</h3>
</div>
<div class="space-4"></div>

<div id="inbox-panel"></div>
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