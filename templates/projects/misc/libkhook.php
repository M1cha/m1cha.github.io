<?php $this->layout('layout_project', ["project"=>$project, 'themecolor'=>'#253036']) ?>

<p>
<h3>Introduction</h3>
/dev/mem is a virtual device on UNIX operating systems that allows you to read/write from physical memory.<br>
It's not that useful for priviglege escalation because you need to be root to use this device.<br>
Also, on many mobile devices it's either completely disabled or restricted by only allowing access to memory regions outside the kernel space.<br>
</p>

<p>
The reason why I wrote khook was that it's a great opportunity to learn sth. about hardware components like the MMU and to develop a library which makes loading code into kernel space easy as pie.<br>
libkhook was developed for the ARM architecture but with software abstractions to allow adding support for other architectures in future.
</p>

<h3>The hack</h3>
<p>
First we need to get the kernel's physical and virtual address range to be able to convert addresses.<br>
The physical one can be read from /proc/iomem while the virtual one can be read from /proc/kallsyms.<br>
/proc/kallsyms can be used to get virtual addresses from any exported symbol. The symbol name of the kernel base is '_text'.<br>
</p>

<h4>Syscall table</h4>
<p>
Another useful thing we can find in /proc/kallsyms is the kernel's system call table(SCT).<br>
The SCT is a flat table that holds information about calls, a userspace application can send to the kernel.<br>
Using the SCT the kernel can translate the number of such a system call to a function to execute to.<br>
The SCT's symbol name is 'sys_call_table'.<br>
<br>
Once we have the SCT's address we can map it with readwrite access into our hacks's process using /dev/mem.<br>
</p>

<h4>Running assembler in kernel space</h4>
<p>
Using the SCT we can run small assembler applications in kernel space.<br>
To do so, we obtain a syscall function's address (I used uname), copy the code at it's location, run the syscall, and restore the function's code.<br>
You need to be very careful when doing this, because the function should not be used by any other program in the meantime, and the code of the function you want to copy into kernel space needs to be smaller than the one you want to overwite so you don't overwrite anything else.<br>
</p>

<h4>TTBR1</h4>
<p>
The TTBR1(Translation Table Base Register 1) is a register of the ARM architecture that's used by UNIX systems to hold the address of the kernel's MMU translation table.<br>
This way we can translate any virtual address to a physical address - even if it's outside the static kernel range(i.e. addresses produced by kmalloc).<br>
<br>
The TTBR1 register can only be read from the kernel's privileged mode. That's why we have to use the code injection method I explained in the former paragraph.<br>
</p>

<h4>Kernel space memory allocation</h4>
<p>
Next, we need to allocate memory in kernel space to be able execute code of any size.<br>
We can use kmalloc for allocating data memory, but we need executable memory to actually execute the code<br>
To archieve this we can use the function '__vmalloc_node_range'. On ARM this function allows executable allocations between 0xbf000000 and 0xbfe00000.<br>
Usually this is used to allocate memory for Loadable Kernel Modules (LKM). The good thing is, that this memory range is available even if LKM are disabled.<br>
</p>

<h4>Loading Binaries into kernel</h4>
<p>
At this point, we have everything we need to load code into kernel space and actually ruu it.<br>
Another thing that would be useful is loading relocatable and dynamically linkable binaries so you aren't limited to relative addresses and you can use internal (exported or not) kernel functions without knowing their addresses at compile time<br>
Since this is not an easy task I searched for a easily adaptable solution that already exists which I did.<br>
The Bootloader GRUB supports loading modules from a filesystem. They compile the C code to relocatable ELF binaries and relocate and link them at runtime.<br>
Additionally this code was kinda easy to port to my hack's UNIX C environment.<br>
And that's pretty much it. Now we can load ELF binaries from disk, allocate executable kernel memory, copy the code to that location, relocate it to the proper address, and link all kernel functions visible in /proc/kallsyms.<br>    
</p>

<h3>Summary</h3>
<p>
As you saw the hack has a few requirements. We need to be root, need a unprotected /dev/mem device, and /proc/kallsyms needs to be enabled.<br>
But if that's the case you can easily load (custom) kernel modules - even if the kernel has LKM disabled.<br>
To protect yourself against this, just enable 'CONFIG_STRICT_DEVMEM' and disable 'CONFIG_KALLSYMS' in your kernel config.
</p>