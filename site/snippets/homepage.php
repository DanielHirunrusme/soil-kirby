<div class="content project-images" data-module-init="homepage">
<?php
// find the homepage projects from the relationship module
$pArr = explode(", ", $page->featured_projects());
foreach($pArr as &$p) { $p = 'projects/'.$p; }
$projects = $pages->find($pArr);
?>
<div class="inner">

<?php if(count($projects) > 1): ?>
  <?php $index = 0; ?>
  <?php foreach($projects as $key=>$project): ?>
    
    <?php if( $project->template() == 'project'): ?>

        <?php snippet('showcase-project', array('project' => $project, 'index' => $index)); ?>

    <?php endif; ?>
    
  <?php $index++; ?>
  <?php endforeach; ?>
<?php endif;?>

</div>

</div>