


<?php if(!$data->video()->empty()): ?>
  
  <div data-text-color="<?= $data->video_caption_color() ?>"  data-fit-browser="<?php echo $data->video_fit_browser() ?>" class="project-block video-block <?php if(isset($index)):?> <?php if($index == 0): ?>first active<?php endif; ?><?php endif; ?>">

    <?php $vimeoID = $data->video()->text(); ?>
    
    <!-- /this is here to fix blurred edges in safari -->
    <div class="block-holder">
    <?php
    
    $vimeoData = vimeo_data($vimeoID);
    
    
    video_player(array(
      "sound" => $data->video_sound()->bool(),
      "full_bleed" => $data->video_fit_browser()->bool(),
      "data" => $vimeoData
    ), $vimeoID);
      
    ?>
    </div>
    <!-- /block-holder -->
    
    <div class="caption">
      <div class="caption-inner">
      <div class="text">
        <div class="caption-text">
          <div class="controls"><button class="ignore-slideshow prev">Prev</button>, <button class="ignore-slideshow next">Next</button></div><p><span class="project-name"><?= $page->title(); ?> <?php if(!$data->image_caption()->empty()): ?>&mdash;<?php endif; ?> </span><span class="caption-description" data-original="<?php echo $data->image_caption(); ?>"><?php echo $data->image_caption(); ?></span></p>
        </div>
      </div>
      </div>
    </div>
    
  </div>
  <!-- /project-block -->
  

    

  
<?php endif; ?>

<?php if(!$data->image_caption()->empty()): ?>
  <p><?php echo $data->image_caption(); ?></p>
<?php endif; ?>