<?php echo $this->Html->script('jquery.form') ?>

<script type="text/javascript">
    /* Upload image  */
    jQuery(document).ready(function() {
        jQuery('#loader_photo').hide();
        jQuery('#PhotoName').on('change', function() {
            jQuery('#loader_photo').show();
            jQuery("#PhotoAdminFileManagerForm").ajaxForm({
                success: showResponseImage
            }).submit();
        });
    });
    function showResponseImage(response){
        jQuery('#loader_photo').hide();
        document.getElementById('uploaded_photos').innerHTML=response;

    }

    // Delete photo
    function deletePhoto(id,product_id){
        var confirmation = confirm('Are you sure want to delete?');
        if(confirmation){
            jQuery('#loader_photo').show();
            jQuery.post(BASE_URL+'products/delete_photo/'+id+'/'+product_id,function(data){
                if(data.status){
                    jQuery('#uploaded_photos').html(data.photos);
                }
                $('#loader_photo').hide();
            },'json');
        }
    }
</script>

<h3>File Manager <span><?php echo $this->Html->link('Finish','/admin/products') ?></span></h3>
<div><?php echo $this->Html->image('/images/bx_loader.gif',array('id'=>'loader_photo')) ?></div>
<?php
echo $this->Form->create('Photo',array('type' =>'file'));
echo $this->Form->input('file_type',array('type'=>'hidden','value'=>'Photo','name'=>'data[file_type]'));
echo $this->Form->input('name',array('label'=>'Select More Photo','type'=>'file'));
echo $this->Form->end();
?>
<br/>
<div id="uploaded_photos" class="row">
<?php
    if(!empty($photo_html)){
        echo $photo_html;
    }
?>
</div>
