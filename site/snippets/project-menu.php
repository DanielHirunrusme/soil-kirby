<nav class="navigation main-nav project-nav" role="navigation">
  <ul class="inner">
    <?php if($page->template() != 'writing'):?>
      <li>
        <a data-blur="content" class="images-btn active ignore-slideshow" href="<?= $page->url() ?>/images">Images</a>
      </li>
    <li>
      <a data-blur="content" class="overview-btn ignore-slideshow" href="<?= $page->url() ?>/overview">Overview</a>
    </li>
   
    <?php endif; ?>
    
    <?php if(!$page->project_pdf()->empty()): ?>
      <li>
        <?php $pdf = (string)$page->project_pdf(); ?>
        <a data-blur="content" class="download-pdf-btn ignore-slideshow" href=" <?php echo $page->files()->get($pdf)->url() ?>" target="_blank">Download PDF</a>
      </li>
    <?php endif; ?>
  </ul>
  

  <?php
  $project_session = s::get('project_link');
  $project_link =  $project_session != null ? $site->url().'/projects/'.$project_session : $site->url().'/projects/';
  
  ?>
  
  
  <a data-blur="content"  class="close ignore-slideshow" href="<?php echo $project_link; ?>"><i></i></a>
</nav>