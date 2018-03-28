<script>
    var slug = function(str) {
        var $slug = '';
        var trimmed = jQuery.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }

    jQuery(document).ready(function () {
        //creates FAQ slug
        jQuery('#FaqQuestion').keyup(function(){
            jQuery('#FaqSlug').val(slug(jQuery('#FaqQuestion').val()));
        });
    });

</script>
<?php echo $this->Form->create('Faq'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit FAQ'); ?></legend>
	<?php
		echo $this->Form->input('id');
		include('_entry.ctp');
	?>
	</fieldset>
<?php echo '<div class="submit_button">'.$this->Form->end(array('label'=>'Update','class'=>'btn btn-primary')).'</div>'; ?>

