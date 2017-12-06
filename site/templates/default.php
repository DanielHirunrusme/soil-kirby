<?php snippet('header') ?>

<?php snippet('submenu') ?>

<main class="content main" role="main" data-module-init="page">
    
  <div class="content-inner">
    
    <div class="block">
      
      <div class="text">
        
        <div class="inner project-images">
          
          <?= filteredContent($page->text()->kt()) ?>
        
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