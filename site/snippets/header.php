<!doctype html>
<html lang="<?= site()->language() ? site()->language()->code() : 'en' ?>" class="cssfilters">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="viewport" content="width=device-width,initial-scale=1.0, user-scalable=no" />
  
  <title><?= html_entity_decode($site->title()->html()) ?> | <?= $page->title()->html() ?></title>
  <meta name="description" content="<?= $site->description()->html() ?>">
  
  <link href="http://vjs.zencdn.net/6.4.0/video-js.css" rel="stylesheet">

  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  
  <!--favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= $site->url() ?>/assets/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= $site->url() ?>/assets/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= $site->url() ?>/assets/images/favicon-16x16.png">
  <link rel="manifest" href="<?= $site->url() ?>/assets/images/manifest.json">
  <link rel="mask-icon" href="<?= $site->url() ?>/assets/images/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="theme-color" content="#ffffff">
  
  <?php
    
  function getOGImage($page, $site){
    
    if($page->template() != 'project') {
      return $site->url().'/assets/images/so-il-og.png';
    } else {
      
      if($page->featured_image()->isNotEmpty()) {
        return $page->image( $page->featured_image() )->url();
        
      } else {
        foreach($page->builder()->toStructure() as $section) {
          if ($section->image()->isNotEmpty()) {
            return $page->image( $section->image() )->url();
           
          }
        }
      }
      
    
    }
    
  }
    
  ?>
  
  
  <!-- og meta -->
  <meta property="og:url"                content="<?= $page->url() ?>" />
  <meta property="og:type"               content="article" />
  <meta property="og:title"              content="<?= html_entity_decode($site->title()->html()) ?> | <?= $page->title()->html() ?>" />
  <meta property="og:description"        content="<?= strip_tags($page->text()->kt()) ?>" />
  <meta property="og:image"              content="<?= getOGImage($page, $site) ?>" />
  

  <?= css('assets/css/main.min.css') ?>

</head>
<body data-module-init="body blur-content hypher" class="<?php echo $page->template(); ?> <?php if($page->isHomePage()): ?>slideshow<?php endif; ?> <?php if($page->template() == 'project'): ?><?php if( count($page->builder()->toStructure()) > 1 ): ?>overview<?php else: ?>slideshow single-slideshow<?php endif; ?><?php endif; ?>" data-uid="<?php echo $page->uid() ?>">

  <header class="banner container" role="banner">
    <div class="banner-inner">
      
      <?php if($page->template() != 'project' && $page->template() != 'writing'): ?>
        <?php snippet('menu') ?>
      <?php else: ?>
        <?php snippet('project-menu'); ?>
      <?php endif; ?>

    </div>
  </header>
