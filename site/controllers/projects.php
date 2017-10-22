<?php

// This is a controller file that contains the logic for the projects template.
// It consists of a single function that returns an associative array with
// template variables.
//
// Learn more about controllers at:
// https://getkirby.com/docs/developer-guide/advanced/controllers

return function($site, $pages, $page, $args) {

  $perpage  = $page->perpage()->int();
  $articles = $page->children()
                   ->visible()
                   ->flip()
                   ->paginate(($perpage >= 1)? $perpage : 5);

  /*
  // work with the response
      if(is_string($response)) {
        $page = page($response);
        $this->response = static::render($page);
      } else if(is_array($response)) {
        $page = page($response[0]);
        $this->response = static::render($page, $response[1]);
      } else if(is_a($response, 'Page')) {
        $page = $response;
        $this->response = static::render($page);      
      } else if(is_a($response, 'Response')) {
        $page = null;
        $this->response = $response;
      } else {
        $page = null;
        $this->response = null;
      }
  */

  return [
    'uid'   => $args
  ];

};
