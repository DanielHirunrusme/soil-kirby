<div class="inner">
  
  <?php if (!$page->client()->empty()): ?>
    <h4>Client</h4>
    <p><?php echo $page->client(); ?></p>
  <?php endif; ?>
  <!-- /client -->
  
  <?php if (!$page->location()->empty()): ?>
    <h4>Location</h4>
    <p><?php echo $page->location(); ?></p>
  <?php endif; ?>
  <!-- /location -->
  
  <?php if (!$page->program()->empty()): ?>
    <h4>Program</h4>
    <p><?php echo $page->program(); ?></p>
  <?php endif; ?>
  <!-- /program -->
  
  <?php if (!$page->area_meters()->empty() && !$page->area_feet()->empty()): ?>
    <h4>Area</h4>
    <p><?php echo $page->area_meters(); ?> m² / <?php echo $page->area_feet(); ?> sf</p>
  <?php endif; ?>
  <!-- /area -->
  
  <?php if (!$page->status()->empty()): ?>
    <h4>Status</h4>
    <?php echo $page->status()->kt(); ?>
  <?php endif; ?>
  <!-- /status -->
  
  <?php if (!$page->team()->empty()): ?>
    <h4>Team</h4>
    <?php echo $page->team()->kt(); ?>
  <?php endif; ?>
  <!-- /team -->
  
  <?php if (!$page->collaborators()->empty()): ?>
    <h4>Collaborators</h4>
    <div class="indent"><?php echo filteredContent($page->collaborators()->kt()); ?></div>
  <?php endif; ?>
  <!-- /collab -->
  
  <?php if (!$page->misc()->empty()): ?>
    <?php foreach($page->misc()->toStructure() as $misc):?>
      <h4><?= $misc->misc_title();?></h4>
      <div class="indent"><?= filteredContent($misc->misc_text()->kt());?></div>
    <?php endforeach; ?>
  <?php endif; ?>
  <!-- /misc -->
  
</div>
<!-- /inner -->