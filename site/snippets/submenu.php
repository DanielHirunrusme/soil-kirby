<?php

$items = false;

// get the open item on the first level
if($root = $pages->findOpen()) {

  // get visible children for the root item
  $items = $root->children()->visible();
}

// only show the menu if items are available
if($items and $items->count()):

?>

<div class="sticky-container">
  <nav class="container sub-nav">
   <ul class="inner">
     <?php foreach($items as $item): ?>
     <li><a<?php e($item->isOpen(), ' class="active"') ?> href="<?php echo $item->url() ?>"><?php echo $item->title()->html() ?></a></li>
     <?php endforeach ?>
   </ul>
  </nav>
</div>


<?php endif ?>