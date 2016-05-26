<div id="form_upload" data-action="<?php echo admin_url('admin-ajax.php'); ?>">
    <input type="file" name="file" class="file" multiple>
    <button type="button" class="submit_upload">Envoyer</button>
</div>

<div id="upload_modal">
    <div class="header">
        <h1 class="text">Importations</h1>
    </div>
    <div id="uploads"></div>
</div>

<script type="text/html" id="upload_progress_template">
    <div class="upload_container">
        <div class="upload_progress">
            <div class="progress"></div>
            <div class="text">Traitement...</div>
        </div>
    </div>
</script>