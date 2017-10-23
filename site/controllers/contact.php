<?php

use Uniform\Form;

return function ($site, $pages, $page) {
   $form = new Form([
     'name' => [
         'rules' => ['required'],
         'message' => 'Please enter your name',
      ],
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
         'subject' => '[Form Submission] '.$form->data('name').' | '.$form->data('email').'',
      ]);
   }

   return compact('form');
};