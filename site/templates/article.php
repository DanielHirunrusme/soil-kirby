<?php snippet('header') ?>

  <main class="main" role="main">
    
    <article class="article single wrap">

      <header class="article-header">
        <h1><?= $page->title()->html() ?></h1>
        <div class="intro text">
          <?= $page->date('F jS, Y') ?>
        </div>
        <hr />
      </header>
      
      cover image
      <?php snippet('coverimage', $page) ?>
      
      <div class="text">
        <?= $page->text()->kt() ?>
      </div>
      
    </article>
    
    <?php snippet('prevnext', ['flip' => true]) ?>
    
  </main>

<?php snippet('footer') ?>