<x-app-layout>
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
            <div
                class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                    <h6>Sales overview</h6>
                    <p class="leading-normal text-size-sm">
                        <i class="fa fa-arrow-up text-lime-500"></i>
                        <span class="font-semibold">4% more</span> in 2021
                    </p>
                </div>
                <div class="flex-auto p-4">
                    <div>
                        <canvas id="chart-line" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end cards -->
</x-app-layout>
