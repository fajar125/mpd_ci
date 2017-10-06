<!-- breadcrumb -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php base_url();?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Workflow</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Inbox</span>
        </li>
    </ul>
</div>

<!-- end breadcrumb -->
<div class="space-4"></div>
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