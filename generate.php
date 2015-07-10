<?php
require 'vendor/autoload.php';

// data
$GLOBALS["pagedata"] = json_decode(file_get_contents("data.json"), false);

function makeurlname($name) {
    return str_replace(" ", "-", strtolower($name));
}

function renderTpl($name, $env=[]) {
    ob_start();
    
    $templates = new League\Plates\Engine('templates');
    echo $templates->render($name, $env);
    $content = ob_get_contents();
    ob_end_clean();

    file_put_contents($name.".html", $content);
}

foreach($GLOBALS["pagedata"]->compile_targets as $target) {
    renderTpl($target);
}

@mkdir("projects");
foreach($GLOBALS["pagedata"]->projects as $category=>$projects) {
    $catdir = "projects/".makeurlname($category);
    @mkdir($catdir);
    
    foreach($projects as $project) {
        renderTpl($catdir."/".makeurlname($project->title), ["project"=>$project]);
    }
}

