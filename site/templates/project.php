<?php snippet('header') ?>

<main class="content main" role="main" data-module-init="project">
    
  <div class="content-inner">
    
    <div class="block">
      
      <div class="text overview">
        
        <div class="inner">
          
          <h1 class="project-title"><?= $page->title() ?><?php if(!$page->location()->empty()): ?>, <?= $page->location() ?><?php endif; ?><?php if($page->date()!=null): ?>, <?= $page->date('Y') ?><?php endif; ?></h1>
            
            
          <?= filteredContent($page->text()->kirbytext()->smartypants()) ?>
          
          
          <?php if (!$page->related()->empty()): ?>
            <div class="inner-related">
              <h4>Related</h4>
              <ul>
              <?php
              $pArr = explode(", ", $page->related());
              
              if(count($pArr)>1){
                foreach($pArr as &$p) {
                  $p = 'projects/'.$p;
                }
    
                $related = $pages->find($pArr)->visible();
                foreach($related as $r) {
                  $title = filteredContent($r->title());
                  $date = $r->date() != null ? $r->date('Y') : '';
                  $publication = !$r->publication()->empty() ? ', <em>'.$r->publication().', </em>' : '';
                  $location = !$r->location()->empty() ? ', '.$r->location().', ' : '';
                  
                  echo '<li><a class="indent" href="'.$r->url().'">'.$title.$location.$publication.$date.'</a></li>';
                }
              } else {
                
               
                $related = page('projects')->find($pArr[0]);
                $title = filteredContent($related->title());
                $date = $related->date() != null ? $related->date('Y') : '';
                $publication = !$related->publication()->empty() ? ', <em>'.$related->publication().', </em>' : '';
                $location = !$related->location()->empty() ? $related->location().', ' : '';
                echo '<li><a class="indent" href="'.$related->url().'">'.$title.$location.$publication.$date.'</a></li>';
                
              }

              ?>
              

              </ul>
            </div>
          <?php endif; ?>
          <!-- /collab -->
        
        </div>
        <!-- /inner -->
    
      </div>
      <!-- /text -->
      
      <h1 class="mobile-project-title"><?= $page->title()->smartypants() ?><?php if(!$page->location()->empty()): ?>, <?= $page->location() ?><?php endif; ?><?php if($page->date()!=null): ?>, <?= $page->date('Y') ?><?php endif; ?></h1>
        
      <div class="project-images">
        <!-- for mobile -->
        
          
        <?php snippet('project/project-images') ?>
        
      </div>
      
      <div class="related">
        
        <?php snippet('project/project-related') ?>
        
      </div>
      
    </div>
    <!-- /block -->
    
  </div>
  <!-- /content-inner -->

</main>
<!-- /content-main -->

<?php snippet('footer') ?>