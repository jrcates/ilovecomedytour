<?php $d = formatShowDate($date); ?>
<div class="flex flex-col items-center flex-shrink-0">
  <div class="border border-black rounded-[5px] pt-2 pb-1 px-4 text-center cc-date-badge bg-white">
    <div class="text-sm font-bold text-black leading-none"><?= htmlspecialchars($d['weekday']) ?></div>
    <div class="text-4xl font-black leading-none text-black my-1"><?= $d['day'] ?></div>
    <div class="text-sm font-bold text-black leading-none"><?= htmlspecialchars($d['month']) ?></div>
  </div>
  <div class="bg-black text-white text-xs px-3 py-1 mt-1 font-medium rounded-[5px] tracking-wide w-full text-center"><?= htmlspecialchars($d['time']) ?></div>
</div>
