<h3>Create Upload File</h3>
<?php
echo $this->Form->create('UploadFile',array('type' =>'file'));
echo $this->element('../UploadFiles/elements');
echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Save','class'=>'btn btn-primary')).'</div>';
?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#UploadFileAdminCreateForm').validate({

        });
    });
</script>
