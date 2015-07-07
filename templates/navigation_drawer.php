<div class="mdl-layout__drawer">
    <span class="mdl-layout-title">mzimmermann.info</span>
    <nav class="mdl-navigation">
        <?php foreach($GLOBALS["pagedata"]->menu as $name=>$link):?>
            <a class="mdl-navigation__link" href="<?=$link?>"><?=$name?></a>
        <?php endforeach ?>
    </nav>
</div>
