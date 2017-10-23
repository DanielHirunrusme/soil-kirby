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
c::set('cache', true);
c::set('thumbs.memory', '512M');

// don't cache the contact page so that the form can POST variables correctly with the Uniform plugin
c::set('cache.ignore', array(
  'contact'
));

// relative links
c::set('panel.stylesheet', 'assets/css/panel.css');

function filteredContent($content){
  $content = str_replace("SO — IL", "<span class='wordmark'>SO<span class='hyphen'>–</span>IL</span>", $content);
  return $content;
}

thumb::$defaults['blurpx'] = 100;

// Shrink large images on upload
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


c::set('routes', array(
  array(
    'pattern' => 'info',
    'action' => function () {
      $page = page('info/about');
      if(!$page) $page = site()->errorPage();
      return site()->visit($page);
     
    }
  ),
  
  array(
    'pattern' => 'info/(:any)',
    'action'  => function($uid) {
      go($uid);
    }
  ),
  array(
    'pattern' => 'projects',
    'action' => function () {
      
      go('projects/selected');
     
    }
  ),
  array(
    'pattern' => 'projects/(:any)',
    'action'  => function($uid) {
      
      $project = page('projects/'.$uid);
      $page = page('projects');
      
      if(!$project) {
      
        s::start();
        s::set('project_link', $uid);
        
        // on category
        foreach($page->builder()->toStructure() as $section) {
          if( urlencode( strtolower( $section->projectcategorytitle() ) ) == $uid) {
            $data = array(
                'uid' => $uid
              );
              
            return array('projects/', $data);
          }
        }
        
        
        
      } else {
        // on project
        $url = page('projects')->url().'/'.s::get('project_link');
        
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
      
      if(!$project) {
        // on category
        foreach($page->builder()->toStructure() as $section) {
          if( urlencode( strtolower( $section->projectcategorytitle() ) ) == $uid) {
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
