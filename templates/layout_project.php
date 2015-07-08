<?php
$env = [];
if(isset($themecolor))
   $env['themecolor'] = $themecolor;

$this->layout('layout', $env);
?>

<link rel="stylesheet" href="/assets/css/project.css">

<div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout">
    <header class="demo-header mdl-layout__header mdl-layout__header--scroll">
        <a href="/"><div class="mdl-layout__drawer-button"><i class="material-icons">arrow_back</i></div></a>
        <div class="header-gradient">
            <?=$this->insert('actionbar')?>

            <div class="mdl-layout__header-row" style="padding-left: 20px;">
                <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
                <!-- Title -->
                <h2><?=$this->e($project->title)?></h2>
            </div>

            <div class="mdl-layout__header-row" style="padding-left: 20px;">
                <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
                <!-- Description -->
                <h4><?=$this->e($project->description)?></h4>
            </div>
        </div>
    </header>

    <main class="demo-main mdl-layout__content">
        <a name="top"></a>
        
        <div class="demo-container mdl-grid">
            <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
            <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
                <?=$this->section('content')?>
            </div>
        </div>
        
        <?=$this->insert('footer')?>
    </main>
</div>