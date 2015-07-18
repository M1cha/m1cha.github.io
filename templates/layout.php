<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Michael Zimmermann's Project homepage.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$this->e($GLOBALS["pagedata"]->title)?></title>

    <link rel="stylesheet" href="//storage.googleapis.com/code.getmdl.io/1.0.0/material.blue_grey-orange.min.css" />
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>

    <?=$this->section('content')?>

    <script src="//storage.googleapis.com/code.getmdl.io/1.0.0/material.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $root = $('main');
            $('a[href*=#]:not([href=#])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $root.animate({
                            scrollTop: $root.scrollTop() + target.offset().top - $root.offset().top
                        }, 1000);
                        return false;
                    }
                }
            });
        });

    </script>
</body>

</html>
