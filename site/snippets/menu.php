<nav class="navigation main-nav" role="navigation">
  <ul class="inner">
    <li>
      <a href="<?= url() ?>" data-blur="content" class="<?= r($page->isHomePage(), ' active') ?>" rel="home"><?= filteredContent($site->title()) ?></a>
    </li>
    <?php foreach($pages->visible() as $item): ?>
    <li class="menu-item">
      <a  data-blur="content" class="<?= r($item->isOpen(), ' active') ?> <?php if( $page->template() == $item->template()): ?>active<?php endif; ?>" href="<?= $item->url() ?>"><?= $item->title()->html() ?></a>
    </li>
    <?php endforeach ?>
  </ul>
  
  <a data-blur="content"  class="close ignore-slideshow" href="<?= $page->url() ?>"><i></i></a>
</nav>