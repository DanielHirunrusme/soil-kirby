<?php snippet('header') ?>
<?php snippet('submenu') ?>

<main class="content main news" role="main">
    
  <div class="content-inner">
    
    <div class="block">
      
      <div class="text">
        
        <div class="inner">
          

            <?php foreach($page->children()->sortBy('date', 'desc') as $subpage): ?>
            <article class="article">
              
              
                
              <h1><?php echo html($subpage->date('F j, Y')) ?><br><?php echo filteredContent($subpage->title()) ?></h1>
  
              
             <?php if($image = $subpage->coverimage()->toFile()): ?>
               <figure>
                 <img src="<?= $image->url() ?>" alt="" />
                 
                 <?php if($caption = $subpage->coverimagecaption()): ?>
                   <figcaption><?= filteredContent($caption->kt()) ?></figcaption>
                 <?php endif; ?>
               </figure>
             <?php endif ?>
             
             
              <?= filteredContent($subpage->text()->kt()) ?>
              
              
              
                <?php foreach($subpage->documents()->filterBy('extension', 'pdf') as $pdf): ?>
                <p>
                  <a href="<?php echo $pdf->url() ?>" target="_blank">
                    Full Press Release
                  </a>
                </p>
                <?php endforeach ?>
                
                
            </article>
            <!-- /article -->
            <?php endforeach ?>
          
        
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