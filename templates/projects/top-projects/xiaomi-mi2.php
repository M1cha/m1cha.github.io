<?php $this->layout('layout_project', ["project"=>$project, "themecolor"=>"#F57921"]) ?>

<style>
    .demo-header {
        background: #F57921 url('/assets/images/xiaomi.png') no-repeat left bottom;
        background-size: contain;
    }
</style>

<p>
<h4>Introduction</h4>
The Xiaomi MI2 is a chinese Smartphone made by Xiaomi. This page describes all kind of development I've done for that device.
</p>

<ul class="toc">
  <h4>Contents</h4>
  <a href="#recovery">Recovery</a>
  <a href="#dualboot">Dualboot</a>
  <a href="#kernel">Kernel</a> <!-- hwinfo -->
  <a href="#customroms">Custom ROM's</a>
  <a href="#bootloader">Bootloader</a>
  <a href="#flashtool">Flashtool</a> <!-- partition table -->
  <a href="#miuicamera">MIUICamera</a>
</ul>

<a name="recovery"></a>
<p>
<h4>Recovery</h4>
Normally it’s quite easy to port (CWM) Recovery to a device.
On Mi2 there were many different problems though. One of the biggest one was that the application exited with a Segmentation Fault when using the framebuffer due to some changes the manufacturer applied to header files of the android kernel.<br>
</p>

<p>
At this point it’s Important to know that Xiaomi does not provide kernel sources. After lots of trial and error I’ve found that they changed a struct in the file “linux/fb.h”:

<?php
$geshi = new GeSHi(
  "-	__u32 reserved[4];		/* Reserved for future compatibility */\n".
  "+	__u32 reserved[5];		/* Reserved for future compatibility */", "diff");
$geshi->set_overall_style('font: normal normal 90% monospace; border: 1px solid #d0d0d0; padding: 5px 10px;', false);
echo $geshi->parse_code();
?>
This caused a crash because the userspace application didn't allocate enough memory for the struct and the kernel kept writing in arbitrary memory.
</p>

<p>
The next problem was that the screen did show random black and white pixels instead of the correct image.
Thanks to reverse engineering the binary of stock recovery and the tool “strace” which shows kernel calls I figured out that I need to enable vsync using a Qualcomm specific IOCTL.
<?php
$geshi = new GeSHi("if(ioctl(gr_fb_fd, MSMFB_OVERLAY_VSYNC_CTRL, &enabled)<0) {\n".
"  perror(\"Enable vsync failed\");\n".
"}", "c");
$geshi->set_overall_style('font: normal normal 90% monospace; border: 1px solid #d0d0d0; padding: 5px 10px;', false);
echo $geshi->parse_code();
?>
Once that was done CWM Recovery was fully functional.
</p>

<a name="dualboot"></a>
<p>
<h4>Dualboot</h4>
Another speciality about the Xiaomi MI2 is that it natively supports dualboot.<br>
It's quite limited though because it's not meant to install two totally different operating system. Xiaomi uses it to make updating the device more safe by installing the update to the inactive bootmode(either system0 or system1) and then tell the bootloader to boot this one instead from now on. This way updates can be installed while using the device(without booting into recovery mode first) and you're safe when the update fails for some reason<br>
</p>

<p>
This however, isn't the way the community wants to use Dualboot.<br>
Instead they want to install two totally independent ROM's. It requires some hacks to achieve this because there's just one partition for user data - which are not compatible across Android ROM's or versions.<br>
This hack turned out to be quite easy though because you can just trick both Recovery and Android into using (different) sub-directories of the data partition.<br>
After fully integrating support for this feature which I called TrueDualBoot(TDB) into CWM recovery it got quite easy to install two different Android ROM's on this device.
</p>

<a name="kernel"></a>
<p>
<h4>Kernel</h4>
Like I've already mentioned, Xiaomi doesn't publish kernel sources despite it's GNU GPL license.<br>
That's why I had to start reverse engineering it. It took me weeks just to get the LCD screen working. Luckily, one of Xiaomi's developers showed up and convinced the company to release most of the kernel sources for this devices. Even though I got pretty far already there are some giant drivers like camera and audio which would have been very hard to reverse engineer.<br>
</p>

<a name="customroms"></a>
<p>
<h4>Custom ROM's</h4>
Once the kernel was up and running I ported, maintained, and got official support for the ROM's <a href="http://download.cyanogenmod.org/?device=aries" target="_blank">CyanogenMod 11</a>, <a href="https://s.basketbuild.com/devs/pacman/aries" target="_blank">PAC-ROM 4.4</a>, <a href="https://github.com/TEAM-Gummy/android_device_xiaomi_aries" target="_blank">Gummy</a> and <a href="https://github.com/omnirom/android_device_xiaomi_aries" target="_blank">OMNI 4.4</a>.<br>
This was an intensive but very fun task. Unfortunately I couldn't continue porting the very latest Android versions because of my lack of time and my interest in other projects.
</p>

<a name="bootloader"></a>
<p>
<h4>Bootloader</h4>
While trying to improve the Dualboot situation of the Xiaomi MI2 I discovered my great interest in bootloader development.<br>
I started by porting and improving Qualcomm's opensource version of <a href="https://www.codeaurora.org/cgit/quic/la/kernel/lk/?h=master" target="_blank">LK (LittleKernel)</a>.
And by improving I mean creating a simple UI and adding tons of features as you can see in this screenshot:
You can see the result in this screenshot: <br>
<a class="fancybox" rel="group" href="/uploads/g4a_lk.png"><img src="/uploads/g4a_lk_small.png" alt="G4A LK Bootloader"/></a>
<br>
Later, I replaced this project with the more advanced and multi-platform solution <a href="/projects/top-projects/efidroid.html">EFIDroid</a>.
</p>

<a name="flashtool"></a>
<p>
<h4>Flashtool</h4>
All the time when messing with the bootloader I had to use a windows machine to restore my phone when I rendered my device unbootable again.<br>
When I saw that there's a tool named 'qdload.pl' which basically is a very basic reverse engineered version of the Qualcomm flashtool I decided to invest further to create a complete flashtool for linux.<br>
<br>
Qualcomm uses two XML files called rawprogram.xml and patch0.xml. After lots of thinking and testing I managed to understand the meaning of these files and wrote some python scripts to use these XML files to flash a ROM to the device.<br>
When I realized that these files are just auto generated by a tool called 'ptool.py' I reverse engineered the files my writing my own 'partition.xml' until the results matched.<br>
<br>
Everything packed together in a nice tool - Miflash4Linux was born. Additionally I added a simple script to generate the factory images which can be flashed to the device so I can provide my own, minified versions. Also this is used to change the partition table to improve the storage space usage.
</p>

<a name="miuicamera"></a>
<p>
<h4>MIUI Camera</h4>
On the forums I read that there's a strong need for using Xiaomi's stock camera app 'MIUI Camera' on custom ROM's due to it's special features like slow motion and improved picture quality.<br>
So I decided to make this app work on any Android ROM. The main problem with MIUI Apps on other ROM's is the use of custom internal framework functions and missing parts of the MIUI UI theme.<br>
<br>
The high number of downloads(more than 11.000) told me that people really needed it - and I have it installed all the time too.
</p>

<ul class="articlenote_forum">
  <h4>Forum</h4>
  <a href="http://xiaomi.eu/community/forums/xiaomi-mi2-s.101/" target="_blank">Xiaomi.eu</a>
  <span>,&nbsp;</span>
  <a href="http://forum.xda-developers.com/mi-2/" target="_blank">xda-developers</a>
</ul>
<br/>
<ul class="articlenote_source">
  <h4>Sourcecode</h4>
  <a href="https://github.com/grub4android/lk" target="_blank">LK</a>
  <span>,&nbsp;</span>
  <a href="https://github.com/M1cha/aries-image-builder" target="_blank">Flashtool</a>
  <span>,&nbsp;</span>
  <a href="https://github.com/M1cha/miui_packages_apps_Camera" target="_blank">MIUI Camera</a>
</ul>
