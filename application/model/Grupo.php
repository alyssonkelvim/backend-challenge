<?php

 class Grupo{
     
     private $group_id;
     private $title;
     
     function __construct($group_id, $title) {
         $this->group_id = $group_id;
         $this->title = $title;
     }
     
     function getGroup_id() {
         return $this->group_id;
     }

     function getTitle() {
         return $this->title;
     }

     function setGroup_id($group_id) {
         $this->group_id = $group_id;
     }

     function setTitle($title) {
         $this->title = $title;
     }

 }