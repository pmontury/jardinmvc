<?php

$routes = array(
   array('home','default','index'),

   array('listelegumes', 'legume', 'listelegumes', array('page')),
   array('addlegume', 'legume', 'addlegume'),
   array('detaillegume', 'legume', 'detaillegume', array('id')),
);
