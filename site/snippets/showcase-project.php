<?php if($project->featured_video()->empty()): ?>


<?php if($project->featured_image()->empty()): ?>
  <?php if($image = $project->images()->sortBy('sort', 'asc')->first()): $thumb = $image->thumb(array('width' => 600)); ?>
    
    
    <?php
      
    $img = $page->isHomePage() ? $image->url() : $thumb->url();
      
    ?>
    
    <div data-text-color="<?= $project->featured_text_color() ?>" data-ratio="<?php echo $image->width()/$image->height() ?>" data-fit-browser="<?php echo $project->featured_image_size() ?>" class="project-block <?php if(isset($index)):?> <?php if($index == 0): ?>first active<?php endif; ?><?php endif; ?>" >
      
      <div class="block-holder">
      <img src="<?= $img ?>" alt="Thumbnail for <?= $project->title()->html() ?>" class="showcase-image <?= $thumb->orientation() ?>" />
      </div>
      <!-- /block-holder -->
      

        <div class="caption">
          <div class="caption-inner">
            <div class="text">
              <div class="caption-text">
                <div class="controls"><button class="ignore-slideshow prev">Prev</button>, <button class="ignore-slideshow next">Next</button></div><!-- /controls -->
                
                <p>
                  <span class="project-name <?php if($page->isHomePage()):?>caption-description<?php endif; ?>" data-original="<?= $project->title()->smartypants(); ?><?php if(!$project->location()->empty()  && !$page->isHomePage()): ?>, <?= $project->location() ?><?php endif; ?>"><?= $project->title()->smartypants(); ?><?php if(!$project->location()->empty()  && !$page->isHomePage()): ?>, <?= $project->location() ?><?php endif; ?>
                  </span>
                </p>
                
              </div>
              <!-- /caption-text -->
            </div>
            <!-- /text -->
          </div>
          <!-- /caption-inner -->
        </div>
        <!-- /caption -->

    </div>
    <!-- /project-block -->
    
  <?php endif ?>
<?php else: ?>
  <?php $image = $project->image( $project->featured_image() ); ?>
  <?php $thumb = $project->image( $project->featured_image() )->thumb(array('width' => 600)); ?>
  <div data-text-color="<?= $project->featured_text_color() ?>" data-ratio="<?php echo $image->width()/$image->height() ?>" data-fit-browser="<?php echo $project->featured_image_size() ?>" class="project-block <?php if(isset($index)):?> <?php if($index == 0): ?>first active<?php endif; ?><?php endif; ?>" >
    
    <?php
      
    $img = $page->isHomePage() ? $image->url() : $thumb->url();
      
    ?>
    
    <div class="block-holder">
    <img src="<?= $img ?>" alt="Thumbnail for <?= $project->title()->html() ?>" class="showcase-image <?= $thumb->orientation() ?>" />
    </div>
    <!-- /block-holder -->
    

          <div class="caption">
            <div class="caption-inner">
              <div class="text">
                <div class="caption-text">
                  <div class="controls"><button class="ignore-slideshow prev">Prev</button>, <button class="ignore-slideshow next">Next</button></div><!-- /controls -->
                  
                  <p>
                    <span class="project-name <?php if($page->isHomePage()):?>caption-description<?php endif; ?>" data-original="<?= $project->title()->smartypants(); ?><?php if(!$project->location()->empty()  && !$page->isHomePage()): ?>, <?= $project->location() ?><?php endif; ?>"><?= $project->title()->smartypants(); ?><?php if(!$project->location()->empty()  && !$page->isHomePage()): ?>, <?= $project->location() ?><?php endif; ?>
                    </span>
                  </p>
                
                </div>
                <!-- /caption-text -->
              </div>
              <!-- /text -->
            </div>
            <!-- /caption-inner -->
          </div>
          <!-- /caption -->

      </div>
      <!-- /project-block -->
<?php endif ?>

<?php else: ?>
    <div data-text-color="<?= $project->featured_text_color() ?>" data-fit-browser="<?php echo $project->featured_image_size() ?>" class="project-block video-block <?php if(isset($index)):?> <?php if($index == 0): ?>active first<?php endif; ?><?php endif; ?>" >
      
      <div class="block-holder">
      <?php
      
      $vimeoID = $project->featured_video();
      $vimeoData = vimeo_data($vimeoID);
    
      video_player(array(
        "sound" => false,
        "full_bleed" => 0,
        "data" => $vimeoData
      ), $vimeoID);
      
        
      ?>
      </div>
      <!-- /block-holder -->

          <div class="caption">
            <div class="caption-inner">
              <div class="text">
                <div class="caption-text">
                  <div class="controls"><button class="ignore-slideshow prev">Prev</button>, <button class="ignore-slideshow next">Next</button></div><!-- /controls -->
                
                  <p>
                    <span class="project-name <?php if($page->isHomePage()):?>caption-description<?php endif; ?>" data-original="<?= $project->title()->smartypants(); ?><?php if(!$project->location()->empty()  && !$page->isHomePage()): ?>, <?= $project->location() ?><?php endif; ?>"><?= $project->title()->smartypants(); ?><?php if(!$project->location()->empty() && !$page->isHomePage()): ?>, <?= $project->location() ?><?php endif; ?>
                    </span>
                  </p>
                
                </div>
                <!-- /caption-text -->
              </div>
              <!-- /text -->
            </div>
            <!-- /caption-inner -->
          </div>
          <!-- /caption -->

      </div>
      <!-- /project-block -->
<?php endif; ?>

