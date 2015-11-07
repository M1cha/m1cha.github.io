<?php $this->layout('layout_project', ["project"=>$project, "themecolor"=>"#000000"]) ?>

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

<ul class="articlenote_doc">
  <h4>Documentation</h4>
  <a href="/uploads/lktris-doc.pdf" target="_blank">PDF file</a>
</ul>
<br/>
<ul class="articlenote_source">
  <h4>Sourcecode</h4>
  <a href="https://github.com/M1cha/lktris" target="_blank">GitHub</a>
</ul>
