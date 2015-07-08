<?php $this->layout('layout_project', ["project"=>$project, "themecolor"=>"#000000"]) ?>

<style>
    .demo-header {
        background-color: transparent;
        background: url('/assets/images/multiboot.png') bottom / cover;
    }
</style>

<p>Normally, Android devices only have&nbsp;Dual-boot. This is realized with a kernel-mod which means you need an unlocked device to use it. I also saw some projects where you can boot a rom with an update-package through recovery.</p>
<p>However, I wanted to have a Multiboot-solution which works on my defy which has an locked bootloader. You should can install your rom’s as usual inside recovery and you should have a nice menu to select the system you want to boot.</p>
<p>First, I needed to find a way to boot android from&nbsp;file-system&nbsp;images which are located on sdcard. This was the easiest part. Here is an diagram which shows you how it generally works:</p>
<p>
    <img src="/assets/images/multiboot_defy_diagram.png" width="370" height="486">
</p>
<p>As you can see it just mounts the sdcard and does create and configure loop devices for every partition of the real NAND. After the kernel-module is loaded, all file-access to the original&nbsp;partitions&nbsp;will be redirected to the loop-devices. The last step is to mount the new system partition. In fact, it moves the mount-point of the original system-partition to another location because on defy it’s already in use at this stage.</p>
<p>When this is done, we can continue with normal 2ndInit. For those of you who don’t know, bootmenu is a program on “Motorola Defy” which halts the execution of the init-process and can execute 2ndInit to allow booting a custom rom. It does also provide useful tools like recovery or overclock-settings.</p>
<p>The most work was to fix compatibility with some rom’s which caused problems with some mods. Since version 0.7 Multiboot is fully integrated into <a title="Touchbootmenu" href="/projects/misc/defy-bootmenu.html">Touch bootmenu</a>.</p>
<p>All information about multiboot(download, changelog, source) can be found here:
    <br>
    <a href="http://forum.xda-developers.com/showthread.php?t=1364659" target="_blank">http://forum.xda-developers.com/showthread.php?t=1364659</a></p>
