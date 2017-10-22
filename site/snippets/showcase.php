<?php

/*
*
*   1. if the uid is set from routing loop through all of the project category titles
*   2. if one matches, filter the projects here
*
*/

if(count($uid) > 0) {

  $projects = page('projects')->children()->visible();

  foreach($page->builder()->toStructure() as $section) {
    
    if( urlencode( strtolower( $section->projectcategorytitle() ) ) == $uid['uid']) {
      
      $pArr = explode(", ", $section->projectcategoryprojects());
      
      foreach($pArr as &$p) {
        $p = 'projects/'.$p;
      }
    
      $projects = $pages->find($pArr)->visible();
    }
  }

  
} else {
  $projects = page('projects')->children()->visible();
}

if(isset($limit)) $projects = $projects->limit($limit);

$col_count = 0;
?>

<div class="showcase grid">
  
  <?php if(count($projects) > 1): ?>
      <?php $index = 0; ?>
      <?php foreach($projects as $project): ?>
    
        <?php if($col_count == 0): ?>
          <div class="showcase-row">
        <?php endif; ?>
 
        <div class="showcase-item project-block column">
      
            <a href="<?= $project->url() ?>" class="showcase-link block">
              <div class="inner">

               <?php if( $project->template() == 'project'): ?>
             
                 <?php snippet('showcase-project', array('project' => $project, 'index' => $index)); ?>
           
               <?php else: ?>
                 
                 <?php snippet('showcase-writing', array('project' => $project, 'index' => $index)); ?>
             
               <?php endif; ?>
            
              </div>
              <!-- /inner -->
          
            </a>
        
        </div>
        <!-- /showcase-item -->
    
        <?php $col_count++; ?>
    
        <?php if($col_count == 2): ?>
         <?php $col_count = 0; ?>
          </div>
          <!-- /showcase-row -->
        <?php endif; ?>
        
      <?php $index++; ?>  
      <?php endforeach ?>
  
  <?php else: ?>
    
    <div class="showcase-row">
      <div class="showcase-item column block">
        <div class="inner">
          <?php if( $projects->template() == 'project'): ?>
        
            <?php snippet('showcase-project', array('project' => $projects->page())); ?>
      
          <?php else: ?>
        
            <?php snippet('showcase-writing', array('project' => $projects->page())); ?>
        
          <?php endif; ?>
        </div>
      </div>
    </div>
    
  <?php endif; ?>

</div>