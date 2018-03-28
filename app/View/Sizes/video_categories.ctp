<?php if($Categories):
        foreach($Categories as $Category):
?>
            <?php $photo = ($Category['Category']['photo'])?'/uploads/categories/'.$Category['Category']['photo'].'':'/img/default_photo.png'; ?>

            <div class="col-md-4 col-xs-4 col-sm-4">
                <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                    <div class="flipper">
                        <div style="background: #17a589" class="front">
                            <h4><?php echo $Category['Category']['name'] ?></h4>
                            <div class="flip-image-handler"><?php echo $this->Html->image($photo, array('alt' => 'Category','width'=>50,'height'=>50)) ?></div>
                            <div class="flip-text-handler"><h6>20 VIDEOS</h6></div>
                        </div>
                        <div  style="background: #3a3a3a" class="back">
                            <?php
                            echo $this->Html->link(
                                'See List',
                                '/videos/video_list/'.$Category['Category']['id'],
                                array('class' => 'btn btn-default btn-lg')
                            );
                            ?>
                            <div class="flip-image-list-handler">
                                <?php echo $this->Html->image('/images/list.png', array('alt' => 'Category')) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
        endforeach;
     endif;
?>