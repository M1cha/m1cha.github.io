<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Michael Zimmermann's Project homepage.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Michael Zimmermann project programming development">
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

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="//storage.googleapis.com/code.getmdl.io/1.1.1/material.blue_grey-orange.min.css" />
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/vendor/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
</head>

<body class="mdl-color-text--grey-700 mdl-base">

    <?=$this->section('content')?>

    <script src="//storage.googleapis.com/code.getmdl.io/1.1.1/material.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/assets/vendor/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <script src="/assets/vendor/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

    <script type="text/javascript">
        $(function() {
            $root = $(".demo-layout");
            if($root.length==0)
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

        $(function() {
      	    $(".fancybox").fancybox();
        });

    </script>
</body>

</html>
