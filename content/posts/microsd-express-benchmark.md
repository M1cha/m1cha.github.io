+++
date = '2025-05-17T16:01:42+02:00'
title = 'microSD Express Benchmarks'
ShowToc = true
+++

In a [previous post]({{< relref "a-microsd-express-card-in-an-m2-slot" >}}) I
explained how I managed to connect microSD Express cards as PCIe NVMe devices
to a computer's M.2 slot. This eliminates possible overhead and bias of USB
adapters. Additionally, it allows extracting additional information via the NVMe
interface. So let's do some benchmarks ⏱️.

I tested the following cards:
- 1TB Lexar® PLAY PRO (LX1TB71)
- 256GB ADATA Premier Extreme (SD71)
- 256GB Sandisk (ST25671_WDC/SDSQXFN)

They all support PCIe Gen3x1 which supports a maximum theoretical transfer speed
of 985MB/s per direction.

# Test method

I used
[cdm_fio.sh](https://gist.github.com/dullage/7e7f7669ade208885314f83b1b3d6999/d5cd2f3dc558578fc009dae38f2a58762ec84531)
on Fedora 42 for these tests, which replicates what CrystalDiskMark does on
Windows. Configuration:
- Size = 1024m
- Loops = 5
- Write Only Zeroes = 0

All cards were formatted with the exFAT filesystem. Unless noted otherwise, all
tests were done using active cooling of the card itself to prevent thermal
throttling.

# Test results

The start of each card's section also contains a list with possibly interesting
information extracted from the NVMe interface.

## 1TB Lexar® PLAY PRO (LX1TB71)

I don't own this card myself and had a friend test this for me on a different
machine but using the same operating system and script.

- **Firmware revision**: `X0705A`.
- **Temperature Threshold (TMPTH)**: 83°C/181°F/356K
- **Thermal Management Temperature 1 (TMT1)**: 81°C/177°F/354K
- **Thermal Management Temperature 2 (TMT2)**: 85°C/185°F/358K

With active cooling. 20°C idle, up to 41°C during test.

{{< plotly >}}
{
  "common_data": {
    "y": [
      "RND4K Q8T8 Write",
      "RND4K Q8T8 Read",
      "RND4K Q32T1 Write",
      "RND4K Q32T1 Read",
      "RND4K Q1T1 Write",
      "RND4K Q1T1 Read",
      "SEQ32M Q32T1 Write",
      "SEQ32M Q32T1 Read",
      "SEQ512K Q1T1 Write",
      "SEQ512K Q1T1 Read",
      "SEQ1G Q1T1 Write",
      "SEQ1G Q1T1 Read"
    ]
  },
  "data": [
    {
      "x": [ 266, 332, 226, 398, 140, 20, 285, 745, 223, 482, 280, 737 ],
      "name": "Test 10",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 256, 330, 248, 438, 144, 24, 288, 764, 260, 483, 323, 752 ],
      "name": "Test 9",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 383, 426, 533, 466, 159, 36, 627, 751, 416, 491, 605, 743 ],
      "name": "Test 8",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 514, 299, 225, 402, 139, 21, 285, 760, 225, 485, 281, 755 ],
      "name": "Test 7",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 233, 325, 223, 397, 140, 24, 286, 755, 225, 488, 280, 763 ],
      "name": "Test 6",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 261, 436, 403, 466, 155, 21, 328, 750, 253, 454, 322, 747 ],
      "name": "Test 5",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 284, 319, 278, 466, 149, 24, 348, 749, 273, 485, 362, 742 ],
      "name": "Test 4",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 300, 356, 311, 463, 148, 30, 398, 758, 299, 492, 392, 736 ],
      "name": "Test 3",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 339, 426, 536, 467, 158, 37, 625, 711, 437, 485, 595, 718 ],
      "name": "Test 2",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 534, 428, 534, 463, 157, 33, 627, 713, 430, 491, 597, 745 ],
      "name": "Test 1",
      "type": "bar",
      "orientation": "h"
    }
  ],
  "layout": {
    "margin": { "t": 0, "l": 125, "b": 60 },
    "xaxis": { "ticksuffix": " MB/s", "range": [0, 900] },
    "legend": { "traceorder": "reversed" },
    "autosize": true,
    "height": 600
  },
  "config": {
    "responsive": true
  }
}
{{< /plotly  >}}

With passive cooling. 20°C idle, up to 82°C during test.

{{< plotly >}}
{
  "common_data": {
    "y": [
      "RND4K Q8T8 Write",
      "RND4K Q8T8 Read",
      "RND4K Q32T1 Write",
      "RND4K Q32T1 Read",
      "RND4K Q1T1 Write",
      "RND4K Q1T1 Read",
      "SEQ32M Q32T1 Write",
      "SEQ32M Q32T1 Read",
      "SEQ512K Q1T1 Write",
      "SEQ512K Q1T1 Read",
      "SEQ1G Q1T1 Write",
      "SEQ1G Q1T1 Read"
    ]
  },
  "data": [
    {
      "x": [ 243, 306, 247, 338, 122, 18, 312, 552, 254, 366, 308, 505 ],
      "name": "Test 10",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 394, 354, 408, 360, 140, 29, 492, 571, 411, 374, 480, 544 ],
      "name": "Test 9",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 382, 243, 171, 316, 109, 16, 235, 552, 190, 347, 231, 538 ],
      "name": "Test 8",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 324, 282, 229, 343, 120, 20, 308, 578, 238, 330, 286, 523 ],
      "name": "Test 7",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 324, 356, 363, 360, 132, 15, 234, 541, 190, 342, 231, 506 ],
      "name": "Test 6",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 199, 262, 172, 315, 109, 18, 235, 530, 192, 372, 232, 531 ],
      "name": "Test 5",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 239, 355, 406, 360, 141, 18, 263, 542, 219, 319, 250, 478 ],
      "name": "Test 4",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 211, 261, 224, 344, 122, 22, 313, 574, 264, 343, 318, 558 ],
      "name": "Test 3",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 357, 246, 172, 316, 110, 18, 234, 663, 210, 407, 242, 690 ],
      "name": "Test 2",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 418, 370, 515, 464, 154, 20, 278, 738, 224, 455, 281, 747 ],
      "name": "Test 1",
      "type": "bar",
      "orientation": "h"
    }
  ],
  "layout": {
    "margin": { "t": 0, "l": 125, "b": 15 },
    "xaxis": { "ticksuffix": " MB/s", "range": [0, 900] },
    "legend": { "traceorder": "reversed" },
    "autosize": true,
    "height": 600
  },
  "config": {
    "responsive": true
  }
}
{{< /plotly  >}}

## 256GB ADATA Premier Extreme (SD71)

- **Firmware revision:** `W0926A`
- **Temperature Threshold (TMPTH)**: 83°C/181°F/356K
- **Thermal Management Temperature 1 (TMT1)**: 81°C/177°F/354K
- **Thermal Management Temperature 2 (TMT2)**: 85°C/185°F/358K

With active cooling. 30°C idle, up to 55°C during test.

{{< plotly >}}
{
  "common_data": {
    "y": [
      "RND4K Q8T8 Write",
      "RND4K Q8T8 Read",
      "RND4K Q32T1 Write",
      "RND4K Q32T1 Read",
      "RND4K Q1T1 Write",
      "RND4K Q1T1 Read",
      "SEQ32M Q32T1 Write",
      "SEQ32M Q32T1 Read",
      "SEQ512K Q1T1 Write",
      "SEQ512K Q1T1 Read",
      "SEQ1G Q1T1 Write",
      "SEQ1G Q1T1 Read"
    ]
  },
  "data": [
    {
      "x": [ 252, 205, 191, 250, 88, 19, 289, 761, 247, 513, 288, 771 ],
      "name": "Test 10",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 271, 275, 323, 316, 180, 12, 374, 770, 335, 516, 372, 768 ],
      "name": "Test 9",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 426, 210, 245, 251, 166, 10, 291, 763, 251, 514, 287, 772 ],
      "name": "Test 8",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 282, 315, 345, 405, 181, 14, 452, 772, 356, 515, 424, 676 ],
      "name": "Test 7",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 289, 323, 285, 318, 174, 12, 384, 777, 330, 523, 383, 768 ],
      "name": "Test 6",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 444, 220, 269, 264, 169, 10, 320, 764, 273, 526, 337, 763 ],
      "name": "Test 5",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 307, 457, 493, 463, 193, 33, 618, 774, 449, 531, 611, 757 ],
      "name": "Test 4",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 496, 456, 492, 463, 193, 33, 620, 761, 453, 530, 610, 758 ],
      "name": "Test 3",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 497, 459, 493, 463, 192, 34, 617, 765, 454, 529, 598, 749 ],
      "name": "Test 2",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 497, 456, 489, 465, 193, 38, 619, 768, 453, 512, 614, 750 ],
      "name": "Test 1",
      "type": "bar",
      "orientation": "h"
    }
  ],
  "layout": {
    "margin": { "t": 0, "l": 125, "b": 60 },
    "xaxis": { "ticksuffix": " MB/s", "range": [0, 900] },
    "legend": { "traceorder": "reversed" },
    "autosize": true,
    "height": 600
  },
  "config": {
    "responsive": true
  }
}
{{< /plotly  >}}

With passive cooling. 30°C idle, up to 83°C during test.

{{< plotly >}}
{
  "common_data": {
    "y": [
      "RND4K Q8T8 Write",
      "RND4K Q8T8 Read",
      "RND4K Q32T1 Write",
      "RND4K Q32T1 Read",
      "RND4K Q1T1 Write",
      "RND4K Q1T1 Read",
      "SEQ32M Q32T1 Write",
      "SEQ32M Q32T1 Read",
      "SEQ512K Q1T1 Write",
      "SEQ512K Q1T1 Read",
      "SEQ1G Q1T1 Write",
      "SEQ1G Q1T1 Read"
    ]
  },
  "data": [
    {
      "x": [ 314, 171, 235, 250, 165, 11, 217, 491, 188, 516, 193, 465 ],
      "name": "Test 10",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 262, 156, 173, 227, 162, 10, 207, 450, 170, 532, 207, 451 ],
      "name": "Test 9",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 219, 273, 369, 313, 186, 36, 461, 526, 371, 566, 420, 692 ],
      "name": "Test 8",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 387, 174, 225, 232, 164, 11, 234, 560, 212, 510, 229, 562 ],
      "name": "Test 7",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 206, 164, 175, 229, 158, 11, 184, 499, 177, 517, 200, 508 ],
      "name": "Test 6",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 207, 260, 275, 271, 173, 11, 311, 756, 280, 507, 322, 742 ],
      "name": "Test 5",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 425, 199, 252, 285, 172, 11, 285, 748, 264, 507, 307, 747 ],
      "name": "Test 4",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 400, 205, 244, 265, 169, 12, 290, 763, 249, 520, 289, 760 ],
      "name": "Test 3",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 340, 212, 255, 292, 170, 11, 310, 761, 260, 511, 313, 766 ],
      "name": "Test 2",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 389, 413, 478, 454, 193, 36, 619, 777, 444, 516, 610, 775 ],
      "name": "Test 1",
      "type": "bar",
      "orientation": "h"
    }
  ],
  "layout": {
    "margin": { "t": 0, "l": 125, "b": 15 },
    "xaxis": { "ticksuffix": " MB/s", "range": [0, 900] },
    "legend": { "traceorder": "reversed" },
    "autosize": true,
    "height": 600
  },
  "config": {
    "responsive": true
  }
}
{{< /plotly  >}}

## 256GB Sandisk (ST25671_WDC/SDSQXFN)

I only have two documented test runs for this card because I bricked it using
a faulty firmware update before I had the idea to do multiple test runs. I'll
update this if/once I have received a replacement. The brick was my fault and
should not be a consideration when buying this card.

Firmware revision: `RO157S2P`.

With unknown mixed methods.

{{< plotly >}}
{
  "common_data": {
    "y": [
      "RND4K Q8T8 Write",
      "RND4K Q8T8 Read",
      "RND4K Q32T1 Write",
      "RND4K Q32T1 Read",
      "RND4K Q1T1 Write",
      "RND4K Q1T1 Read",
      "SEQ32M Q32T1 Write",
      "SEQ32M Q32T1 Read",
      "SEQ512K Q1T1 Write",
      "SEQ512K Q1T1 Read",
      "SEQ1G Q1T1 Write",
      "SEQ1G Q1T1 Read"
    ]
  },
  "data": [
    {
      "x": [ 302, 423, 598, 409, 201, 13, 653, 831, 517, 559, 650, 803 ],
      "name": "Test 2",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [ 662, 422, 657, 413, 201, 13, 645, 836, 520, 557, 648, 834 ],
      "name": "Test 1",
      "type": "bar",
      "orientation": "h"
    }
  ],
  "layout": {
    "margin": { "t": 0, "l": 125, "b": 60 },
    "xaxis": { "ticksuffix": " MB/s", "range": [0, 900] },
    "legend": { "traceorder": "reversed" },
    "autosize": true,
    "height": 600
  },
  "config": {
    "responsive": true
  }
}
{{< /plotly  >}}


## Comparison Of Averages

For every card, this shows the average speed of all runs of the subtest.

{{< plotly >}}
{
  "common_data": {
    "y": [
      "RND4K Q8T8 Write",
      "RND4K Q8T8 Read",
      "RND4K Q32T1 Write",
      "RND4K Q32T1 Read",
      "RND4K Q1T1 Write",
      "RND4K Q1T1 Read",
      "SEQ32M Q32T1 Write",
      "SEQ32M Q32T1 Read",
      "SEQ512K Q1T1 Write",
      "SEQ512K Q1T1 Read",
      "SEQ1G Q1T1 Write",
      "SEQ1G Q1T1 Read"
    ],
    "textposition": "outside",
    "texttemplate": "%{x}",
    "outsidetextfont": {
        "weight": 1000
    }
  },
  "data": [
    {
      "x": [482, 422, 628, 411, 201, 13, 649, 834, 518, 558, 649, 818],
      "name": "Sandisk",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [376, 338, 362, 366, 173, 22, 458, 768, 360, 521, 452, 753],
      "name": "ADATA",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [337, 368, 352, 443, 149, 27, 410, 746, 304, 484, 404, 744],
      "name": "Lexar",
      "type": "bar",
      "orientation": "h"
    }
  ],
  "layout": {
    "margin": { "t": 0, "l": 125, "b": 60 },
    "xaxis": { "ticksuffix": " MB/s", "range": [0, 900] },
    "legend": { "traceorder": "reversed" },
    "autosize": true,
    "width": 800,
    "height": 500
  },
  "config": {
    "responsive": true
  }
}
{{< /plotly  >}}

## Comparison Of Worsts

For every card, this shows the slowest speed of all runs of the subtest.

{{< plotly >}}
{
  "common_data": {
    "y": [
      "RND4K Q8T8 Write",
      "RND4K Q8T8 Read",
      "RND4K Q32T1 Write",
      "RND4K Q32T1 Read",
      "RND4K Q1T1 Write",
      "RND4K Q1T1 Read",
      "SEQ32M Q32T1 Write",
      "SEQ32M Q32T1 Read",
      "SEQ512K Q1T1 Write",
      "SEQ512K Q1T1 Read",
      "SEQ1G Q1T1 Write",
      "SEQ1G Q1T1 Read"
    ],
    "textposition": "outside",
    "texttemplate": "%{x}",
    "outsidetextfont": {
        "weight": 1000
    }
  },
  "data": [
    {
      "x": [302, 422, 598, 409, 201, 13, 645, 831, 517, 557, 648, 803],
      "name": "Sandisk",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [252, 205, 191, 250, 88, 10, 289, 761, 247, 512, 287, 676],
      "name": "ADATA",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [233, 299, 223, 397, 139, 20, 285, 711, 223, 454, 280, 718],
      "name": "Lexar",
      "type": "bar",
      "orientation": "h"
    }
  ],
  "layout": {
    "margin": { "t": 0, "l": 125, "b": 60 },
    "xaxis": { "ticksuffix": " MB/s", "range": [0, 900] },
    "legend": { "traceorder": "reversed" },
    "autosize": true,
    "width": 800,
    "height": 500
  },
  "config": {
    "responsive": true
  }
}
{{< /plotly  >}}

## Comparison Of Bests

For every card, this shows the fastest speed of all runs of the subtest.

{{< plotly >}}
{
  "common_data": {
    "y": [
      "RND4K Q8T8 Write",
      "RND4K Q8T8 Read",
      "RND4K Q32T1 Write",
      "RND4K Q32T1 Read",
      "RND4K Q1T1 Write",
      "RND4K Q1T1 Read",
      "SEQ32M Q32T1 Write",
      "SEQ32M Q32T1 Read",
      "SEQ512K Q1T1 Write",
      "SEQ512K Q1T1 Read",
      "SEQ1G Q1T1 Write",
      "SEQ1G Q1T1 Read"
    ],
    "textposition": "outside",
    "texttemplate": "%{x}",
    "outsidetextfont": {
        "weight": 1000
    }
  },
  "data": [
    {
      "x": [662, 423, 657, 413, 201, 13, 653, 836, 520, 559, 650, 834],
      "name": "Sandisk",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [497, 459, 493, 465, 193, 38, 620, 777, 454, 531, 614, 772],
      "name": "ADATA",
      "type": "bar",
      "orientation": "h"
    },
    {
      "x": [534, 436, 536, 467, 159, 37, 627, 764, 437, 492, 605, 763],
      "name": "Lexar",
      "type": "bar",
      "orientation": "h"
    }
  ],
  "layout": {
    "margin": { "t": 0, "l": 125, "b": 60 },
    "xaxis": { "ticksuffix": " MB/s", "range": [0, 900] },
    "legend": { "traceorder": "reversed" },
    "autosize": true,
    "width": 800,
    "height": 500
  },
  "config": {
    "responsive": true
  }
}
{{< /plotly  >}}

# Conclusion

All cards are very close in performance and nowhere near saturating the PCIe
interface. The ADATA usually seems to be slightly faster than the Lexar. Looking
at the [Comparison Of Bests](#comparison-of-bests), the Sandisk seems to be WAY
faster in some cases, but further tests are needed to see if that holds on
average. If it does, I'd probably recommend the Sandisk. But with numbers that
close, you should probably just use the one you think lasts the longest or the
one which has the best warranty.

What I find most suspicious is that `RND4K Q1T1 Read`s are so low for the
Sandisk card. It may just be a fluke due to the low number of tests though, so
it needs more testing.

## Nintendo Switch 2

So what does this mean for Nintendo Switch 2? I'm not a game developer, but I'd
expect the console to do large sequential reads most of the time. Let's assume
you need to load 10GB during the loading screen and compare worst- and best-
case reading speeds. At 600MB/s this would take 16.667 seconds. At 800MB/s this
would take 12.5 seconds. If the gap was actually that high, this 4 second
difference would certainly be noticeable, but in reality the gap is probably
much smaller.

Large writes will probably only happen while downloading or moving games. Your
internet speed won't be able to saturate the write speed of any of
those cards, but you might notice a decent difference when moving games from
internal storage to the microSD Express card if the Sandisk is actually as fast
at writing as it seems. The difference between ADATA and Lexar is much smaller.

Anyways, whatever card you get, enjoy playing your games on Nintendo Switch 2
🎮.

You can find raw data of these cards on
[GitHub](https://github.com/M1cha/sdexpress-research).
