<?php if(!$data->image()->empty() && $data->image() != null): ?>
<div data-text-color="<?= $data->image_caption_color() ?>" data-fit-browser="<?php echo $data->image_fit_browser() ?>" data-ratio="<?php echo $page->image($data->image())->width()/$page->image($data->image())->height() ?>" class="project-block <?php if(isset($index)):?> <?php if($index == 0): ?>first active<?php endif; ?><?php endif; ?>">
  
    
  <?php
  $image = $page->image( $data->image() );
  //shrinkImage($image);
  
  ?>
  <!-- /this is here to fix blurred edges in safari -->
  <div class="block-holder">
    <img src="<?php echo $image->url(); ?>" />
  </div>
  <!-- /image-holder -->

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