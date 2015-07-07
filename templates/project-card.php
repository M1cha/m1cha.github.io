<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
    <a href="<?="projects/".makeurlname($category)."/".makeurlname($title).".html"?>">
        <?php if (isset($image)): ?>
            <div class="mdl-card__media" style="background-color:<?=$this->e(isset($headercolor)?$headercolor:"white")?>">
                <img src="<?=$this->e($image)?>">
            </div>
        <?php else: ?>
            <div class="mdl-card__media" style="background-color:#000; color:white;">
                <p><?=$this->e($headertext)?></p>
            </div>
        <?php endif ?>
    </a>
    <div class="mdl-card__title">
        <h4 class="mdl-card__title-text"><?=$this->e($title)?></h4>
    </div>
    <div class="mdl-card__supporting-text">
        <span class="mdl-typography--font-light mdl-typography--subhead"><?=$this->e($description)?></span>
    </div>
    <div class="mdl-card__actions">
        <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="<?="projects/".makeurlname($category)."/".makeurlname($title).".html"?>">
               More
               <i class="material-icons">chevron_right</i>
             </a>
    </div>
</div>
