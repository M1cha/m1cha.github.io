<div class="mdl-layout__header-row">
    <!-- Title -->
    <span class="mdl-layout-title">Michael Zimmermann</span>
    <!-- Add spacer, to align navigation to the right -->
    <div class="mdl-layout-spacer"></div>
    <!-- Navigation. We hide it in small screens. -->
    <nav class="mdl-navigation mdl-layout--large-screen-only">
        <?php foreach($GLOBALS["pagedata"]->menu as $name=>$link):?>
            <a class="mdl-navigation__link" href="<?=$link?>"><?=$name?></a>
        <?php endforeach ?>
    </nav>
</div>
