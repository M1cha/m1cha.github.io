<?php
require 'vendor/autoload.php';

// data
$GLOBALS["pagedata"] = json_decode(file_get_contents("data.json"), false);

function str2mx($str) {
    $ret = "<script type=\"text/javascript\">document.write(mx(";
    $b64 = array_reverse(str_split(base64_encode($str)));
    
    $c = 0;
    foreach($b64 as $char) {
        if($c!=0)
            $ret.=", ";
        
        $ret.="'".$char."'";
        
        $c++;
    }
    
    $ret.="));</script>";
    
    return $ret;
}

function protectedMail($mail) {
    $ret="";
    
    $arr = explode("@", $mail);
    $ret.=str2mx($arr[0]);
    $ret.=" <img src=\"/assets/images/a_mx_t.png\"/> ";
    
    $arr = explode(".", $arr[1]);
    $ret.=str2mx($arr[0]);
    $ret.='<div style="width:2px;height:2px;background-color:#424242;margin:0 1px;padding:0;display:inline-block;"></div>';
    $ret.=str2mx($arr[1]);
    
    return $ret;
}

function makeurlname($name) {
    return str_replace(" ", "-", strtolower($name));
}

function renderTpl($name, $env=[]) {
    ob_start();
    
    $templates = new League\Plates\Engine('templates');
    echo $templates->render($name, $env);
    $content = ob_get_contents();
    ob_end_clean();

    file_put_contents("out/".$name.".html", $content);
}

@mkdir("out");
foreach($GLOBALS["pagedata"]->compile_targets as $target) {
    renderTpl($target);
}

@mkdir("out/projects");
foreach($GLOBALS["pagedata"]->projects as $category=>$projects) {
    $catdir = "projects/".makeurlname($category);
    @mkdir("out/".$catdir);
    
    foreach($projects as $project) {
        renderTpl($catdir."/".makeurlname($project->title), ["project"=>$project]);
    }
}

