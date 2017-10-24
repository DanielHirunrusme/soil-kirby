<?php snippet('header') ?>

<main class="content main" role="main" >
    
  <div class="content-inner">
    
    <div class="block">
      
      <div class="text">
        
        <div class="inner">
          
          <h1><?= $page->title()->smartpants() ?><?php if(!$page->location()->empty()): ?>, <?= $page->location() ?><?php endif; ?><?php if(!$page->publication()->empty()): ?>, <em><?= $page->publication() ?></em><?php endif; ?><?php if($page->date()!=null): ?>, <?= $page->date('F j, Y') ?><?php endif; ?></h1>
            
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
                  $date = $r->date() != null ? $r->date('F j, Y') : '';
                  $publication = !$r->publication()->empty() ? ', <em>'.$r->publication().', </em>' : '';
                  $location = !$r->location()->empty() ? ', '.$r->location().', ' : '';
                  
                  echo '<li class="indent"><a href="'.$r->url().'">'.$title.$location.$publication.$date.'</a></li>';
                }
              } else {
                
               
                $related = page('projects')->find($pArr[0]);
                $title = filteredContent($related->title());
                $date = $related->date() != null ? $related->date('F j, Y') : '';
                $publication = !$related->publication()->empty() ? ', <em>'.$related->publication().', </em>' : '';
                $location = !$related->location()->empty() ? $related->location().', ' : '';
                echo '<li class="indent"><a href="'.$related->url().'">'.$title.$location.$publication.$date.'</a></li>';
                
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
      
      <div class="project-images">
        
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