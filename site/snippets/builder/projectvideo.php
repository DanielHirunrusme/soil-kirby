<section class="imageBanner">
   <?php if ($data->video()->isNotEmpty()): ?>
  <div>
    <p>Vimeo ID: <?=$data->video()?></p>
  </div>


    <h2 class="imageBanner-headline" style="font-weight:normal;">
      <?= $data->video_caption() ?>
    </h2>

  <?php endif ?>
  
  
  <br style="clear:both;">
  
</section>