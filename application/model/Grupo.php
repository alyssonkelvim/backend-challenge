<?php

 class Grupo{
     private $id;
     private $group_id;
     private $title;
     
     function __construct($id, $group_id, $title) {
         $this->id = $id;
         $this->group_id = $group_id;
         $this->title = $title;
     }
     function getId() {
         return $this->id;
     }

     function getGroup_id() {
         return $this->group_id;
     }

     function getTitle() {
         return $this->title;
     }

     function setId($id) {
         $this->id = $id;
     }

     function setGroup_id($group_id) {
         $this->group_id = $group_id;
     }

     function setTitle($title) {
         $this->title = $title;
     }



 }