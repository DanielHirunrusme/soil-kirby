
<?php if($image = $page->coverimage()->toFile()): ?>
  <figure>
    <img src="<?= $image->url() ?>" alt="" />
  </figure>
<?php endif ?>
