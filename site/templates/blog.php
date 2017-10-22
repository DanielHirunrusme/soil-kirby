<?php snippet('header') ?>
<?php snippet('submenu') ?>

<main class="content main news" role="main">
    
  <div class="content-inner">
    
    <div class="block">
      
      <div class="text">
        
        <div class="inner">
          

            <?php foreach($page->children()->sortBy('date', 'desc') as $subpage): ?>
            <article class="article">
                
                <h1><?php echo html($subpage->date('F d Y')) ?><br><?php echo html($subpage->title()) ?></h1>
              
              <?php echo html($subpage->text()->kt()) ?>
                
            </article>
            <!-- /article -->
            <?php endforeach ?>
          
        
        </div>
        <!-- /inner -->
    
      </div>
      <!-- /text -->
      
    </div>
    <!-- /block -->
    
  </div>
  <!-- /content-inner -->

</main>
<!-- /content-main -->

<?php snippet('footer') ?>