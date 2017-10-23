<?php

use Uniform\Form;

return function ($site, $pages, $page) {
   $form = new Form([
      'email' => [
         'rules' => ['required', 'email'],
         'message' => 'Email is required',
      ],
      'message' => [],
   ]);

   if (r::is('POST')) {
      
     $to = $site->email()->isNotEmpty() ? $site->email() : 'daniel@halfhalf.us';
     
      $form->emailAction([
         'to' => $to,
         'from' => 'info@so-il.org',
      ]);
   }

   return compact('form');
};