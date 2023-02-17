<?php
$arUrlRewrite=array (
  2 => 
  array (
    'CONDITION' => '#^/service-detail/([^/]+?)/\\??(.*)#',
    'RULE' => 'SECTION_CODE=$1&$2',
    'ID' => 'bitrix:catalog.section',
    'PATH' => '/service-detail/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/detskie-vrachi/([^/]+?)/\\??(.*)#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/detskie-vrachi/section.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/specialists/([^/]+?)/\\??(.*)#',
    'RULE' => 'SECTION_CODE=$1',
    'ID' => '',
    'PATH' => '/specialists/section.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/about/faq/([^/]+?)/\\??(.*)#',
    'RULE' => 'ELEMENT_CODE=$1',
    'PATH' => '/about/faq/index.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/service/([^/]+?)/\\??(.*)#',
    'RULE' => 'SECTION_CODE=$1&$2',
    'ID' => 'bitrix:catalog.section',
    'PATH' => '/service/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/about/([^/]+?)/#',
    'RULE' => 'ELEMENT_CODE=$1',
    'PATH' => '/about/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/about/faq/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/about/faq/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/action/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/action/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
