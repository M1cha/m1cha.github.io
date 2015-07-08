<?php $this->layout('layout', ['themecolor'=>'#607D8B']) ?>

<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <?=$this->insert('actionbar')?>
    </header>
    
    <?=$this->insert('navigation_drawer')?>
    
    <main class="mdl-layout__content">
        <a name="top"></a>
        <!-- WELCOME -->
        <div class="welcome-section">
            <div class="welcome-band">
                <div class="welcome-band-text">
                    <div class="mdl-typography--display-2 mdl-typography--font-thin">Welcome</div>
                    <p class="mdl-typography--headline mdl-typography--font-thin">
                        This website is all about me and my projects.
                    </p>
                </div>
            </div>

            <a href="#top-projects">
                <button class="android-fab mdl-button mdl-button--colored mdl-js-button mdl-button--fab mdl-js-ripple-effect">
                    <i class="material-icons">expand_more</i>
                </button>
            </a>
        </div>
        
        <?php foreach($GLOBALS["pagedata"]->projects as $category=>$projects): ?>
            <?php 
                $cards="";
                foreach($projects as $project) {
                    $config = get_object_vars($project);
                    $config["category"] = $category;
                    $cards.=$this->fetch('project-card', $config);
                }

                $this->insert('project-section', ['title'=>$category, 'cards' => $cards]);
            ?>
        <?php endforeach ?>

        <?=$this->insert('footer')?>  
    </main>
</div>
