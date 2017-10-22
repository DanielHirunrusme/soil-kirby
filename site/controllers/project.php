<?php

// This is a controller file that contains the logic for the projects template.
// It consists of a single function that returns an associative array with
// template variables.
//
// Learn more about controllers at:
// https://getkirby.com/docs/developer-guide/advanced/controllers

return function($site, $pages, $page, $args) {

  //print_r($site);
  
  return [
    'uid'   => $args
  ];

};
