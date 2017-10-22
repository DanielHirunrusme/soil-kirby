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
      $form->emailAction([
         'to' => 'daniel@halfhalf.us',
         'from' => 'info@example.com',
      ]);
   }

   return compact('form');
};