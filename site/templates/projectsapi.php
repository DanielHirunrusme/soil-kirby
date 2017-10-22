<?php

header('Content-type: application/json; charset=utf-8');


$data = $pages->find('projects')->children()->visible()->flip();
$json = array();

foreach($data as $article) {
  
  if(!$article->featured_video()->empty()) {
    
    $vimeoData = vimeo_data($article->featured_video());
    
    $json[] = array(
      'url'   => (string)$article->url(),
      'video' => (string)$article->featured_video(),
      'data' =>  $vimeoData
    );
  }
  
  

}

echo json_encode($json);

?>