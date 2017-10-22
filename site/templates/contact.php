<?php snippet('header') ?>

<?php snippet('submenu') ?>

<main class="content main" role="main">
    
  <div class="content-inner">
    
    <div class="block">
      
      <div class="text">
        
        <div class="inner">
          
          <h1><span class="wordmark">SO<span class="hyphen">–</span>IL</span> Office Ltd.</h1>
          <article>
          <?php if(!$page->office()->empty()): ?>
            <div>
              <?php echo $page->office()->kt(); ?>
            </div>
          <?php endif; ?>
          
          <?php if(!$page->emails()->empty()): ?>
            <div>
              <?php echo $page->emails()->kt(); ?>
            </div>
          <?php endif; ?>
          </article>
        
          <h1>Communications</h1>
          <article>
            <?php if(!$page->social()->empty()): ?>
              <div>
                <?php echo $page->social()->kt(); ?>
              </div>
            <?php endif; ?>
            
            <div class="newsletter" data-module-init="newsletter">
              <a class="show-newsletter-form">Newsletter</a>
              <form method="post" target="_blank" class="newsletter-form" action="http://so-il.us2.list-manage.com/subscribe/post?u=aabb4402aba8a410426a8fe2b&amp;id=064bfe0b3d">
                <div class="input-group">
                  <!--<label>Email</label>-->
                  <div class="input-wrapper"><input type="text" name="EMAIL" placeholder="Email:"></div>
                </div>
                <div class="input-group">
                  <!--<label>First Name</label>-->
                  <div class="input-wrapper"><input type="text" name="FNAME" placeholder="First Name:"></div>
                </div>
                <div class="input-group">
                  <!--<label>Last Name</label>-->
                  <div class="input-wrapper"><input type="text" name="LNAME" placeholder="Last Name:"></div>
                </div>
                <input type="submit" class="submit" />
              </form>
            </div>
            <!-- /newsletter -->
            
          </article>
          
          <h1>Contact Form</h1>
          <article class="contact-article">
            
            <form action="<?php echo $page->url() ?>" method="POST">
               <input name="email" type="text" placeholder="Name:": value="<?php echo $form->old('name'); ?>">
               <input name="email" type="email" placeholder="Email:": value="<?php echo $form->old('email'); ?>">
               <textarea rows="5" placeholder="Message:" name="message"><?php echo $form->old('message'); ?></textarea>
               <?php echo csrf_field(); ?>
               <?php echo honeypot_field(); ?>
               <input type="submit" value="Submit">
            </form>
            <?php if ($form->success()): ?>
               Success!
            <?php else: ?>
               <?php snippet('uniform/errors', ['form' => $form]); ?>
            <?php endif; ?>
            <!-- /form -->
            
          </article>
        
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