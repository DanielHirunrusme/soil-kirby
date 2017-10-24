<div class="showcase-caption writing-caption text">
  
  
  <p>
    <span class="project-name"><?= filteredContent( $project->title()->smartypants() ); ?><?php if(!$project->publication()->empty()): ?>, <?= $project->publication()->smartypants() ?><?php if($project->date()!= null): ?>, <?= $project->date('F j, Y') ?><?php endif; ?><?php endif; ?>
    </span>
  </p>
  
  
</div>

<p class="text desktop-text">
  <?php

  
  $content = substr($project->text()->smartypants(), 0, 505);
  $pos = strrpos($content, " ");
  if ($pos>0) {
  $content = substr($content, 0, $pos);
  $content .= ' [..]';
  }
  echo $content;
  
  ?>
</p>

<p class="text mobile-landscape-text">
  <?php

  
  $content = substr($project->text()->smartypants(), 0, 300);
  $pos = strrpos($content, " ");
  if ($pos>0) {
  $content = substr($content, 0, $pos);
  $content .= ' [..]';
  }
  echo $content;
  
  ?>
</p>


<p class="text mobile-portrait-text">
  <?php

  
  $content = substr($project->text()->smartypants(), 0, 200);
  $pos = strrpos($content, " ");
  if ($pos>0) {
  $content = substr($content, 0, $pos);
  $content .= ' [..]';
  }
  echo $content;
  
  ?>
</p>