<?php $this->layout('layout_project', ["project"=>$project, 'themecolor'=>'#253036']) ?>

<p>On Motorola Defy a userspace application called “bootmenu” is used to intercept boot process and allow loading custom recovery and roms.
    <br> The UI of this application copied from “Clockworkmod Recovery” and does not provide touch functionality.</p>
<p>That’s why I rewrote the whole UI to change that. I added a more touch-friendly UI and added touch support to input handling.</p>
<p>Later when the goal of this project was reached I’ve completely integrated this into <a title="MultiBoot" href="/projects/misc/defy-multiboot.html">Multiboot</a> to provide easy-to-use Multiboot features.</p>

<ul class="articlenote_forum">
  <h4>Forum</h4>
  <a href="http://forum.xda-developers.com/showthread.php?t=1601270" target="_blank">xda-developers</a>
</ul>
<br/>
<ul class="articlenote_source">
  <h4>Sourcecode</h4>
  <a href="https://github.com/M1cha/android_external_bootmenu" target="_blank">GitHub</a>
</ul>
