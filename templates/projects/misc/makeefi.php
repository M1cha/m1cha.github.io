<?php $this->layout('layout_project', ["project"=>$project, 'themecolor'=>'#253036']) ?>

<p>
<h4>Why?</h4>
EDKII is a complicated build environment. Especially when cross-compiling you need to pass many flags to their build tool.
And even when you've done that already you still need to create/use a DSC file and add all your modules and libraries to that.
Compared to a simple 'make' this can be very annoying.<br/>
<br/>
There's already a project called GNU-EFI which basically aim's to do the same as MakeEFI by providing a minimal set of libraries and Makefiles to compile your application using GNU tools.<br/>
The problem with that is that - while it's a good idea at first - it makes things very complicated. For example you need relatively big Makefiles which grow even more if you want to support more than one architecture. Also you only have access to a very limited set of functions and header files. If you want to use many EFI protocols or just need a good set of library functions you are on your own.<br/>
<br/>
What I noticed after working with EDKII for a long time is that once you set up your projects, things actually become very easy - imo easier than anything GNU-EFI does. You have a inf file for your module where you can list your source files, put your compiler flags and reference other libraries. So if the only problem with EDKII is the setup, why not just simplifying that part - that's where MakeEFI comes in.
</p>

<p>
<h4>How?</h4>
bundled with MakeEFI is a script that creates a 'mini' version of EDKII which doesn't contain any of the platform support packages and with precompiled versions of the "BaseTools" so you don't have to do that either. The resulting directory is just about 100MB in size and can be easily made available via a package manager so you don't have to tell MakeEFI where to find EDKII every time you want to build something.<br/>
Also, MakeEFI automatically detects the version and architecture of the compiler in use and passes the correct flags to EDKII during compilation. It even supports the CROSS_COMPILE environment variable to compile for other architectures like ARM without any additional hurdles.<br/>
Finally, MakeEFI allows to generate the DSC file using a template shipped with our 'mini' EDKII so you can compile modules directly without writing a DSC file first with all the libraries you want to use.
</p>

<p>
<h4>Example</h4>
<?php
$geshi = new GeSHi(
  "makeefi .. default Main/Main.inf", "plain");
$geshi->set_overall_style('font: normal normal 90% monospace; border: 1px solid #d0d0d0; padding: 5px 10px;', false);
echo $geshi->parse_code();
?>
This is what a very simple example command looks like. It's similar to cmake in the sense that it puts the built files in the current directory and that you specify the path to the source directory. 'default' refers to the DSC template used. You can also pass a path if you want to use your own. Main/Main.inf is the path to the module to compile relative to the source directory.<br/>
<br/>
As you can see MakeEFI makes compiling UEFI modules very simple while giving you access to EDKII's powerful build system and the full set of libraries and header files.
</p>

<ul class="articlenote_source">
  <h4>Sourcecode</h4>
  <a href="https://github.com/M1cha/edk2-linux-toolchain" target="_blank">GitHub</a>
  <span>,&nbsp;</span>
  <a href="https://aur.archlinux.org/packages/edk2-linux-toolchain" target="_blank">AUR Package</a>
</ul>
