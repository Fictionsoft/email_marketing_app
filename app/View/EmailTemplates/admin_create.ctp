<h3>Create Email Template</h3>
<?php
echo $this->Form->create('EmailTemplate',array('type' =>'file'));
echo $this->element('../EmailTemplates/elements');
echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Save','class'=>'btn btn-primary')).'</div>';
?>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#EmailTemplateAdminCreateForm').validate({

        });
    });
</script>
