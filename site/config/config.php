<?php

/*

---------------------------------------
License Setup
---------------------------------------

Please add your license key, which you've received
via email after purchasing Kirby on http://getkirby.com/buy

It is not permitted to run a public website without a
valid license key. Please read the End User License Agreement
for more information: http://getkirby.com/license

*/

c::set('license', 'put your license key here');
c::set('debug', true);
c::set('cache', false);
c::set('thumbs.memory', '512M');

c::set('field.wysiwyg.dragdrop.kirby', true);
c::set('field.wysiwyg.dragdrop.medium', true);

//typography quotes
//c::set('typography.quotes', 'doubleCurled');
c::set('smartypants', true);
c::set('smartypants.attr', 3);
c::set('smartypants.doublequote.open', '“');
c::set('smartypants.doublequote.close', '”');
c::set('smartypants.space.emdash', ' ');
c::set('smartypants.space.endash', ' ');
c::set('smartypants.space.colon', ' ');
c::set('smartypants.space.semicolon', ' ');
c::set('smartypants.space.marks', ' ');
c::set('smartypants.space.frenchquote', ' ');
c::set('smartypants.space.thousand', '');
c::set('smartypants.space.unit', ' ');

// don't cache the contact page so that the form can POST variables correctly with the Uniform plugin
c::set('cache.ignore', array(
  'contact'
));

// relative links
c::set('panel.stylesheet', 'assets/css/panel.css');

function filteredContent($content){
  //$content = str_replace('"','&ldquo;',preg_replace('/(?<=[^A-Z0-9])"/i','&rdquo;',$content));
  
  $content = str_replace("SO — IL", "<span class='wordmark'>SO<span class='hyphen'>–</span>IL</span>", $content);
  
  $content = str_replace("<span class=\"char--caps\">SO</span> – <span class=\"char--caps\">IL</span>", "<span class='wordmark'>SO<span class='hyphen'>–</span>IL</span>", $content);
  
  $pattern = '/\bSO\s?[\-\x{2013}\x{2014}]\s?IL(?!\.org)(?![\-_])\b/u';
  $replacement = '<span class="wordmark">SO<span class="hyphen">&ndash;</span>IL</span>';
  $content = preg_replace($pattern, $replacement, $content);
  
  
  return $content;
}

function makeFootnote($content) {
  
  
  if(is_numeric(substr($content, 0, 1))) {
    $content .= 'yes';
  }
  
  return $content;
}

thumb::$defaults['blurpx'] = 100;

// Shrink large images on upload
/*
kirby()->hook('panel.file.upload', 'shrinkImage');
kirby()->hook('panel.file.replace', 'shrinkImage');
function shrinkImage($file, $maxDimension = 1600) {
  try {
    if ($file->type() == 'image' and ($file->width() > $maxDimension or $file->height() > $maxDimension)) {
      
      // Get original file path
      $originalPath = $file->dir().'/'.$file->filename();
      // Create a thumb and get its path
      $resized = $file->resize($maxDimension,$maxDimension);
      $resizedPath = $resized->dir().'/'.$resized->filename();
      // Replace the original file with the resized one
      copy($resizedPath, $originalPath);
      unlink($resizedPath);
    }
  } catch(Exception $e) {
    return response::error($e->getMessage());
  }
}
*/


function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function checkMobile(){
  if(s::get('device_class') == 'mobile'){
    echo '<script type="text/javascript">var htmlElement = document.querySelector("html"); htmlElement.classList.add("touch");</script>';
  }
}

c::set('routes', array(
  
  array(
    'pattern' => '/',
    'action' => function () {
      checkMobile();
      $page = page('/');
      return site()->visit($page);
    }
  ),
  
  array(
    'pattern' => 'info',
    'action' => function () {
      $page = page('info/about');
      if(!$page) $page = site()->errorPage();
      checkMobile();
      return site()->visit($page);
     
    }
  ),
  
  array(
    'pattern' => 'info/(:any)',
    'action'  => function($uid) {
      checkMobile();
      go($uid);
    }
  ),
  array(
    'pattern' => 'projects',
    'action' => function () {
      checkMobile();
      go('projects/selected');
     
    }
  ),
  array(
    'pattern' => 'projects/(:any)',
    'action'  => function($uid) {
      checkMobile();
      $project = page('projects/'.$uid);
      $page = page('projects');
      
      if(!$project) {
      
        s::start();
        s::set('project_link', $uid);
        //echo 'on category';
        // on category
        foreach($page->builder()->toStructure() as $section) {
          //echo slugify( $section->projectcategorytitle() );
          
          if( slugify( $section->projectcategorytitle() ) == $uid) {
            
            $data = array(
                'uid' => $uid
              );
              
            return array('projects/', $data);
          }
        }
        
        
        
      } else {
        // on project
        $url = page('projects')->url().'/'.s::get('project_link');
        checkMobile();
        //this creates a meta tag so we can cache the entire page while setting the correct link on the close button
        //plugins get loaded in kirby before page cache
        echo '<meta class="project_link" data-url="'.$url.'">';
        return site()->visit($project);
      } 
    }
  ),
  array(
    'pattern' => 'projects/(:any)/(:any)',
    'action'  => function($uid) {
      
      $project = page('projects/'.$uid);
      $page = page('projects');
      checkMobile();
      if(!$project) {
        // on category
        foreach($page->builder()->toStructure() as $section) {
          if( slugify( $section->projectcategorytitle() ) == $uid) {
            $data = array(
                'uid' => $uid
              );
            
            
              
            return array('projects/', $data);
          }
        }
        
      } else {
        // on project
        return site()->visit($project);
      } 
    }
  ),
  array(
    'pattern' => '(:any)',
    'action'  => function($uid) {
      
      $page = page('info/'.$uid);
      checkMobile();
      if(!$page) $page = $uid;
      if(!$page) $page = site()->errorPage();
      
      
      
      return site()->visit($page);

    }
  )
));



/*
  array(
    'pattern' => '(:any)',
    'action'  => function($uid) {

     
      
      

      if(!$page) $page = page('info/' . $uid);
      if(!$page) $page = site()->errorPage();
      
      return site()->visit($page);

    }
  ),
*/





/*

---------------------------------------
Kirby Configuration
---------------------------------------

By default you don't have to configure anything to
make Kirby work. For more fine-grained configuration
of the system, please check out http://getkirby.com/docs/advanced/options

*/
