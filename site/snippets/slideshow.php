
<?php if($project->featured_image()->empty()): ?>
  <?php if($image = $project->images()->sortBy('sort', 'asc')->first()): $thumb = $image->thumb(array('width' => 600)); ?>
    <div class="block <?php if($index == 0): ?>first<?php endif; ?>" data-id="<?= $index ?>" style="background-image:url(<?= $image->url() ?>)">
      <div class="block-inner">
        <div class="text">
          <div class="inner">
            <div class="caption showcase-caption">
              <h3 class="showcase-title"><?= $project->title()->html() ?></h3>
            </div>
          </div>
        </div>
      </div>
      
      <img src="<?= $image->url() ?>" alt="Thumbnail for <?= $project->title()->html() ?>" class="showcase-image" />
    
    </div>
  <?php endif ?>
<?php else: ?>
  <?php $image = $project->image( $project->featured_image() ); ?>
  <?php $thumb = $project->image( $project->featured_image() )->thumb(array('width' => 600)); ?>
  <div class="block <?php if($index == 0): ?>first<?php endif; ?>" data-id="<?= $index ?>" style="background-image:url(<?= $image->url() ?>)">
    <div class="block-inner">
      <div class="text">
        <div class="inner">
          <div class="caption showcase-caption">
            <h3 class="showcase-title"><?= $project->title()->html() ?></h3>
          </div>
        </div>
      </div>
    </div>
    
    <img src="<?= $image->url() ?>" alt="Thumbnail for <?= $project->title()->html() ?>" class="showcase-image" />
  </div>
<?php endif ?>

