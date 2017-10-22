<div class="container">
  <div class="inner">
  
  <?php $index = 0; ?>
  <?php foreach($page->builder()->toStructure() as $section): ?>
    <?php snippet('project/' . $section->_fieldset(), array('data' => $section, 'page' => $page, 'index' => $index)) ?>
  
  <?php $index++; ?>
  <?php endforeach ?>
  
  
  </div>
  <!-- /inner -->
</div>
<!-- /container -->