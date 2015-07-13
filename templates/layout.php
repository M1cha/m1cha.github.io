<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Michael Zimmermann's Project homepage.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$this->e($GLOBALS["pagedata"]->title)?></title>

    <?php if (isset($themecolor)): ?>
        <meta name="theme-color" content="<?=$themecolor?>">
    <?php endif ?>

    <script src="//crypto-js.googlecode.com/svn/tags/3.1.2/build/components/core-min.js"></script>
    <script src="//crypto-js.googlecode.com/svn/tags/3.1.2/build/components/enc-base64-min.js"></script>
    <script>
        function mx() {
            var ret = "";
            for(var i=arguments.length-1; i>=0; i--) {
                ret+=arguments[i];
            }
            
            return CryptoJS.enc.Base64.parse(ret).toString(CryptoJS.enc.Utf8);
        }
    </script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-35742959-1', 'auto');
      ga('send', 'pageview');

    </script>

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
