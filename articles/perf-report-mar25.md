---
id: perf-report-mar25
cover: https://block1a.onrender.com/assets/spark.jpg
title: Monthly Server Performance Report - March 2025
subtitle: A Smooth Month with Fewer Lag Spikes and Optimized Gameplay
date: March 8, 2025
author: Igarashi Ame
tag: Tech
tag-col: text-red-500
spotlight: false
---

Greetings, players!

Over the past month, we've made some significant strides in improving server performance, and I’m here to give you a quick update on how things are running. From smoother gameplay to reduced lag spikes, we’ve been hard at work ensuring that your time on the server remains as enjoyable as possible.

Here’s a breakdown of what we’ve achieved. (Warning: It's super technical).

-Ame

<br>

#### TPS (Ticks per Second)

 Minecraft server ideally runs at 20 TPS, meaning everything is happening in real time with no delay. When TPS drops, actions like mining, mob movement, redstone circuits, and chunk loading become noticeably laggy. Last month, we saw frequent dips to around 15-16 TPS, and in the worst cases, it went down to 8.5 TPS. After several rounds of profiling and adjustments, our average TPS for March increased to a near-perfect 19.8, with lows rarely falling under 17. This drastic improvement means a lot less rubber-banding, smoother interactions with mobs and items, and more reliable redstone behavior. The percentage of uptime spent below 18 TPS has dropped from 38% in March to under 5% in March—an impressive leap.<br>

![TPS Graph](assets/graphc1-perf-mar25.jpg)

These changes led to a 35–50% drop in average tick durations in affected regions, significantly raising server-wide TPS and ensuring consistent real-time performance.

![TPS and MSPT](https://spark.lucko.me/docs/assets/images/tps-and-mspt-4dc0077033c91cda5a1ab9657b406255.png)

<div class="bg-[#1A212B] p-4 rounded-lg">
    <span class="text-gray-300"><span class="text-white font-bold">Average TPS:</span> 19.8 (up from 15.6 last month)</span><br>
    <span class="text-gray-300"><span class="text-white font-bold">Peak TPS Drops:</span> Rarely below 18</span><br>
    <span class="text-gray-300"><span class="text-white font-bold">Lowest TPS Recorded:</span> 17.2 (down from 8.5 in March)</span><br>
</div>

#### Tick Duration

We noticed in February that tick durations were regularly exceeding 90ms, and in extreme cases going over 150ms—this translated to severe lag spikes that interrupted gameplay. In March, with optimized entity handling and plugin load reductions, we brought the average tick duration down to 55ms, and peaks rarely exceeded 90ms. Spark’s flamegraph visualization helped us pinpoint which events (like mob explosions or chunk generation) were spiking tick times, allowing us to apply targeted fixes. As a result, gameplay is now more consistent, even when multiple players are online.

![Flame Graph](https://spark.lucko.me/docs/assets/images/viewer-flame-cf468508f086393c3f3432c4409d70ee.png)

<div class="bg-[#1A212B] p-4 rounded-lg">
    <span class="text-gray-300"><span class="text-white font-bold">Average Tick Duration:</span> 55ms (down from 90ms in March)</span><br>
    <span class="text-gray-300"><span class="text-white font-bold">Peak Tick Duration:</span> 90ms (down from 150ms in March)</span><br>
    <span class="text-gray-300"><span class="text-white font-bold">Improvement:</span> Reduced lag spikes during busy server events and high player activity.</span>
</div>

#### Memory and Garbage Collection

In Februray, we observed frequent GC pauses, some lasting over 150ms, which interrupted gameplay unexpectedly. To solve this, we adjusted our JVM flags and increased allocated memory from 6GB to 8GB. We also tuned how and when GC cycles are triggered. With these changes, average GC pause times dropped from 60ms to just 20ms, and peak pauses rarely cross 50ms anymore. This means no more random “hiccups” while exploring or fighting mobs, and overall memory management has become far more efficient.

![Tick Monitor](https://spark.lucko.me/docs/assets/images/finding-lag-tickmonitor-demo-432333175992bbf2938f6d92f7d9999b.png)

<div class="bg-[#1A212B] p-4 rounded-lg">
    <span class="text-gray-300"><span class="text-white font-bold">Average Memory Usage:</span> 5.4 GB (up from 4.9 GB)</span><br>
    <span class="text-gray-300"><span class="text-white font-bold">GC pauses:</span> Significantly reduced with an average of 20ms per pause (down from 60ms)</span><br>
    <span class="text-gray-300"><span class="text-white font-bold">Peak GC Pause:</span> 50ms (down from 150ms)</span>
</div>

#### Entitly and Chunk Performance

Last month, our average entity count per active chunk was over 500, and some mob farms had peaks of 650+ entities in one space. We identified chunk-heavy zones and applied optimizations like tweaking the mob cap, enforcing stricter despawn rules, and reducing chunk load radius during idle times. 

![Tickes in Profiler](https://spark.lucko.me/docs/assets/images/ticks-in-profiler-9309c0852f4aaf9212874a989a648968.png)

<div class="bg-[#1A212B] p-4 rounded-lg">
    <span class="text-gray-300"><span class="text-white font-bold">Average Entity Load per Chunk</span> 280 (down from 500+ last month)</span><br>
    <span class="text-gray-300"><span class="text-white font-bold">Peak Entity Load:</span> 350 entities (down from 600)</span><br>
    <span class="text-gray-300"><span class="text-white font-bold">Chunk Load Under Stress:</span> 12-15 chunks (down from 20+)</span>
</div>

This brought the average entity count down to 280 per chunk, and reduced extreme mob concentrations. Now, players can build and farm without dragging down server performance, and teleporting between regions feels much smoother.

#### Thank You for Your Support

We want to extend a huge thank you to all of our players for their patience and continued support. Your feedback has been instrumental in helping us fine-tune the server and provide the best experience possible. We’re excited to see where the next month takes us!