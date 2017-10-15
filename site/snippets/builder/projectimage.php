<section class="imageBanner">
   <?php if ($data->image()->isNotEmpty()): ?>
  <div style="float:left;">
  <img src="<?= $page->image($data->image())->url() ?>" width="100">
  </div>
  
  <div style="float:left; margin-left:10px;">
  <h2 class="imageBanner-headline" style="font-weight:normal;">
    <?= $data->image_caption() ?><br>
    <span style="color:#ccc;"><?=  $data->image()->filename() ?> </span>
  </h2>
  <?php endif ?>
  </div>
  
  <br style="clear:both;">
  
</section>