+++
date = '2026-08-12T15:09:17+02:00'
title = 'Gigabyte Wastes CMOS Batteries'
ShowToc = true
+++

I bought a brand new computer mainboard on May 3rd 2024. It's a B550 AORUS
ELITE AX V2 (Rev. 1.3). In July of 2026 the CMOS battery was completely dead.
Instead of simply replacing it, I investigated the cause of this, because CMOS
batteries shouldn't die after just over 2 years.

# Setup

To figure out how long I can expect a battery to last, you have to measure the
power consumption while its connected and check that against the energy
capacity of the battery.

To do that, I simply connected a Nordic Power Profiler Kit II (PPK2) between
the mainboard and the battery. The PPK2 allows me to measure the CMOS current
consumption during various modes of operation. Please ignore the dust 😉.

{{< fancybox caption="Powered off with AC" src="setup-cmos.jpg" >}}
{{< fancybox caption="Powered off with AC" src="setup-profiler.jpg" >}}

# Powered off without AC

First I disconnected AC (the 230V power plug) and connected the battery.

{{< fancybox caption="Powered off without AC" src="profiler-off-no-ac.png" >}}

That's an average of 9.49uA. While that doesn't sound much, many CR2032
batteries seem to have a capacity of 220mAh. Using the formula
`220 mAh / 0.00949 mA / 24 h / 365 d` we arrive at an estimated battery life of
roughly 2 years and 171 days. If we assume, that my mainboard was in storage
for a couple months before it was shipped to me, this matches my experience
pretty well.

# Powered off with AC

As soon as I connect AC, without actually powering on the computer, the current
consumption drops to 4.63uA. So if we'd keep AC connected all the time, we can
expect a battery life of rougly 5 years and 154 days.

{{< fancybox caption="Powered off with AC" src="profiler-off-with-ac.png" >}}

I can only assume, that this reduced power consumption is an unintended side
effect of Gigabytes hardware design, because if they intended to extend the
life of the CMOS battery while connected to AC, I'd expect to see 0uA.

# Powered on

Next, I measured the current while the computer was powered on and showing the
boot selection menu.

{{< fancybox caption="Powered on" src="profiler-on.png" >}}

Interestingly, with 5.19 uA is a bit higher than while powered off, but still
nowhere near the value I got with AC disconnected. With this, you can expect a
battery life of 4 years and 306 days.

# Powered off with ErP and no AC

Next I enabled [ErP](https://en.wikipedia.org/wiki/Energy-related_products) in
the firmware settings. This setting is intended to reduce AC power consumption
while the device is powered off, but still connected to AC. After turning off
the system, I got the following result:

{{< fancybox caption="Powered off, with ErP, no AC" src="profiler-off-erp-no-ac.png" >}}

That's 4.51uA or 5 years and 207 days. That's expected because, ErP is supposed
to save AC power, not CMOS power. I did not see any difference in the CMOS
current consumption while powered on either.

# Conclusion

If you want the reduce the number of times you have to take out your GPU to
access and replace the CMOS battery, you probably want to keep your computer
connected to AC. As for me, I don't want to do that. Every device I don't use
gets disconnected completely - either using a smart plug or using a switchable
power strip.

In my opinion, even 5 years of CMOS battery life is abysmal and Gigabyte should
have never released a product like that. Some of my Nintendo NES cardridges
also contain CR2032 batteries, which still work after 40 years.
