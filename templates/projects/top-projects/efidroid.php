<?php $this->layout('layout_project', ["project"=>$project, "themecolor"=>"#F57921"]) ?>

<style>
    .demo-header {
        background: #48AC50;
    }
</style>

<ul class="toc">
  <h4>Contents</h4>
  <a href="#goals">Goals</a>
  <a href="#concept">Concept</a>
  <a href="#storagelocation">Storage-Location</a>
  <a href="#uefibootapp">UEFI Boot App</a>
  <a href="#livepatching">Live-Patching</a>
  <a href="#lkl">LKL</a>
  <a href="#finalthoughts">Final thoughts</a>
</ul>

<a name="goals"></a>
<p>
<h4>Goals</h4>
There are many different multiboot solutions out there. Most of them are device-specific and even limited to two or three different ROM's.<br/>
Others work on many devices but require the ROM-developers to include support and workarounds for multibooting.<br/>
<br/>
My goal was to create one, generic multiboot solution that works the same on all supported devices and doesn't need any support by ROM's or Recovery tools.
</p>

<a name="concept"></a>
<p>
<h4>Concept</h4>
I came up with many possible solutions and in fact implemented many of them until I came up with a better idea. I think that the final solution is very flexible and a decent choice.<br/>
I chose to port Intel's opensource UEFI implementation EDKII and use it as a 2ndstage bootloader.<br/>
To overcome hardware differences and prevent having to port all drivers to UEFI I modified Qualcomm's bootloader to provide a driver API which then can be used by UEFI.
This way the UEFI port works on all devices which are supported by the OEM'S stock bootloader without having to port any drivers.<br/>
</p>

<a name="storagelocation"></a>
<p>
<h4>Storage-Location</h4>
Since the stock bootloader can't be replaced for security reasons, EFIDroid needs to be stored somewhere else. I chose to put it on the partitions which usually contain the boot images for Android and Recovery.
This way EFIDroid gets booted in any case and it can then decide what to do.<br/>
<a href="#livepatching">Live-Patching</a> is used to redirect all access to these partitions to loop images on a filesystem during runtime so installers don't need to know about this change.
</p>

<a name="uefibootapp"></a>
<p>
<h4>UEFI Boot App</h4>
UEFI supports running applications and the Code that actually loads the operating system is one too.<br/>
I ported the libaroma graphics framework to UEFI so I can render good-looking user interfaces with Truetype fonts, png graphics and graphical effects like shadows and transparency.<br/>
I also wrote code for locating all bootable images and ROM's which are installed devices so we don't have to generate configs after adding/deleting one like it's usually done on desktop computers running Linux.
Once the app found something bootable it will be shown in a nice menu on the screen and when the user selects something it gets booted using a generic boot library which I've written and which I call 'libboot'.</br>
Putting the actual boot code in a generic library gives you a lot of flexibility so it becomes very easy to add new container formats. Also it's possible to use the same code in different bootloaders and even in a virtual environment on your desktop for testing purposes.<br/>
</p>

<a name="livepatching"></a>
<p>
<h4>Live-Patching</h4>
Since the goal is to not require any multiboot-support by the operating system and recovery tools EFIDroid needs to extract and modify the ramdisk before booting.<br/>
It replaces the init binary which then replaces all mount commands and applies workarounds before running the real init process.
Since these patches are temporary, multibooted ROM's can be copied to/from native installations without having to revert any patches.
</p>

<a name="lkl"></a>
<p>
<h4>LKL</h4>
Since UEFI usually only supports FAT filesystems and EFIDroid needs to be able to load boot images from any linux filesystem I had to find a way to add support for these to UEFI.
While the minimal readonly implementations usually used by bootloader would work, I found them to be quite unstable sometimes and filesystem drivers with write-access would allow for very advanced features like fastboot-flashing to loop files.<br/>
Luckily there already was a project called LKL which aims to compiled the Linux kernel as a library so you can use the drivers in any environment. Once I ported this to UEFI it because quite easy to add support for new filesystems to UEFI. It even supports mounting encrypted partitions.<br/>
</p>

<a name="finalthoughts"></a>
<p>
<h4>Final thoughts</h4>
The solution works pretty good so far but as in all projects there are a few drawbacks.<br/>
One of them is that EFIDroid currently only supports devices with Qualcomm chipsets because it's the only manufacturer providing such complete bootloader source codes.<br/>
Also it's hard to support very complex and device specific hardware like touchscreens and USB-OTG which may seem like a big disadvantage to some users.<br/>
<br/>
Still, compared to most desktop bootloaders EFIDroid is very advanced and users seem to like it.
</p>
<br/>

<ul class="articlenote_forum">
  <h4>Links</h4>
  <a href="http://forum.xda-developers.com/android/software-hacking/efidroid-t3447466" target="_blank">xda-developers</a>
  <span>,&nbsp;</span>
  <a href="https://plus.google.com/communities/114053643671219382368" target="_blank">Google+</a>
</ul>
<br/>
<ul class="articlenote_source">
  <h4>Sourcecode</h4>
  <a href="https://github.com/efidroid" target="_blank">GitHub</a>
</ul>
