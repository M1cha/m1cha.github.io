<?php $this->layout('layout_project', ["project"=>$project]) ?>

<style>
    .demo-header {
        background-color: transparent;
        background: url('/assets/images/lktris.png') center bottom;
        text-shadow: 1px 1px 0px rgba(0, 0, 0, 1);
    }
</style>

<p>LKTris is a small game I developed for a university project
    <br>The game itself isn't any special. It's just a simple Tetris implementation
    <br>The interesting part is that this game was developed in pure C without any underlying operating system
</p>
<p>I developed this for my smartphone 'Xiaomi MI2' and used the manufacturers bootloader as a code base.
    <br>This bootloader supports all I needed: Display, volume/power buttons and (optionally) thread support.
</p>
<p><a href="/uploads/lktris-doc.pdf" target="_blank">Project documentation</a>
    <br><a href="http://github.com/M1cha/lktris" target="_blank">Source code</a>
</p>
