<?php snippet('header') ?>

<?php snippet('submenu') ?>

<main class="content main" role="main">
    
  <div class="content-inner">
    
    <div class="block">
      
      <div class="text">
        
        <div class="inner">
          
          <?php if($page->hasChildren()): ?>
            
            children
            
          <?php endif; ?>
        
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