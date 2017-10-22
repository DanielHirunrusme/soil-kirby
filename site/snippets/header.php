<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>" class="cssfilters <?php if(s::get('device_class') == 'mobile'): ?>touch<?php endif; ?>">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="viewport" content="width=device-width,initial-scale=1.0, user-scalable=no" />
  
  <title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">
  
  <link href="http://vjs.zencdn.net/6.2.8/video-js.css" rel="stylesheet">
  <!-- If you'd like to support IE8 -->
    

  <?= css('assets/css/main.min.css') ?>

</head>
<body data-module-init="body blur-content hypher" class="<?php echo $page->template(); ?> <?php if($page->isHomePage() || $page->template() == 'project'): ?>slideshow<?php endif; ?>" data-uid="<?php echo $page->uid() ?>">

  <header class="banner container" role="banner">
    <div class="banner-inner">
      
      <?php if($page->template() != 'project' && $page->template() != 'writing'): ?>
        <?php snippet('menu') ?>
      <?php else: ?>
        <?php snippet('project-menu'); ?>
      <?php endif; ?>

    </div>
  </header>
