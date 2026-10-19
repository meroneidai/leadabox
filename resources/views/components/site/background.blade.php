{{-- Fixed ambient background: aurora blobs, grid floor and film grain. --}}
<div class="pointer-events-none fixed inset-0 z-0 overflow-hidden noise" aria-hidden="true">
    <div class="absolute inset-0 bg-ink-950"></div>

    <div class="absolute -top-[25%] start-[-10%] h-[70vmax] w-[70vmax] rounded-full opacity-60 blur-[120px] animate-aurora"
         style="background: radial-gradient(circle at 30% 30%, #2d6cff 0%, transparent 60%);"></div>

    <div class="absolute top-[10%] end-[-15%] h-[60vmax] w-[60vmax] rounded-full opacity-50 blur-[130px] animate-aurora"
         style="background: radial-gradient(circle at 60% 40%, #7b2dff 0%, transparent 62%); animation-delay: -6s;"></div>

    <div class="absolute bottom-[-20%] start-[25%] h-[55vmax] w-[55vmax] rounded-full opacity-35 blur-[140px] animate-aurora"
         style="background: radial-gradient(circle at 50% 50%, #22d3ee 0%, transparent 65%); animation-delay: -12s;"></div>

    <div class="absolute inset-0 grid-floor opacity-70"></div>

    <div class="absolute inset-0" style="background: radial-gradient(ellipse 100% 60% at 50% 0%, transparent 30%, #0b0e1f 85%);"></div>
</div>
