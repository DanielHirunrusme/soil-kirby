<div class="sticky-container">
  
  <nav class="container sub-nav">
    
   <ul class="inner">
     
     <?php if(!$page->builder()->empty()): ?>
     <?php foreach($page->builder()->toStructure() as $section): ?>
       <?php //print_r($section); ?>
       
       <?php $title = $section->projectcategorytitle(); ?>
       <?php 
       
         $url = urlencode( $title ); 
         $url = str_replace( '+' , '-', $url );
         $url = strtolower( $url );
       ?>
       <li data-title="<?php echo $title; ?>"><a <?php if($uid['uid'] == $url): ?>class="active"<?php endif; ?> href="<?php echo $site->url().'/projects/'.$url; ?>"><?php echo $title; ?></a></li>
       
       <?php //snippet('project/' . $section->_fieldset(), array('data' => $section, 'page' => $page)) ?>
     <?php endforeach ?>
     <?php endif; ?>
     
   </ul>
   <!-- /inner -->
   
  </nav>
  <!-- /sub-nav -->
  
</div>
<!-- /sticky-container -->