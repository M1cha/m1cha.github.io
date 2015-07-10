<?php
$env = [];
if(isset($themecolor))
   $env['themecolor'] = $themecolor;

$this->layout('layout', $env);
?>

<link rel="stylesheet" href="/assets/css/article.css">

<?php if(!isset($description)):?>
<style>
.demo-main {
    margin-top: -26vh;
}
    
.demo-header .header-gradient {
    background: none;
    filter: none;
}
</style>
<?php endif ?>

<div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout">
    <header class="demo-header mdl-layout__header mdl-layout__header--scroll">
        <a href="/"><div class="mdl-layout__drawer-button"><i class="material-icons">arrow_back</i></div></a>
        <div class="header-gradient">
            <?=$this->insert('actionbar')?>

            <?php if(isset($title) && isset($description)):?>
                <div class="mdl-layout__header-row" style="padding-left: 20px;">
                    <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
                    <!-- Title -->
                    <h2><?=$this->e($title)?></h2>
                </div>

                <div class="mdl-layout__header-row" style="padding-left: 20px;">
                    <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
                    <!-- Description -->
                    <h4><?=$this->e($description)?></h4>
                </div>
            <?php endif ?>
        </div>
    </header>

    <main class="demo-main mdl-layout__content">
        <a name="top"></a>
        
        <div class="demo-container mdl-grid">
            <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
            <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
                <?php if(isset($title)):?>
                    <h3><?=$this->e($title)?></h3>
                <?php endif ?>
                <?=$this->section('content')?>
            </div>
        </div>
        
        <?=$this->insert('footer')?>
    </main>
</div>