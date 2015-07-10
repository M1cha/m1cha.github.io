<?php
$env = [];
if(isset($themecolor))
   $env['themecolor'] = $themecolor;

$env['title'] = $project->title;
$env['description'] = $project->description;

$this->layout('layout_article', $env);
?>

<?=$this->section('content')?>