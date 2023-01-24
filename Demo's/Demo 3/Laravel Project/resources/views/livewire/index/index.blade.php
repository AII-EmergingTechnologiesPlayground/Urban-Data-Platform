<div>
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="grid grid-flow-col gap-3">
        <div class="col-span-4 flex items-center justify-center">
            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden my-4">
                <div class="flex items-center px-6 py-3 bg-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                      </svg>

                    <h1 class="mx-3 text-white font-semibold text-lg">Lamp</h1>
                </div>
                <div class="py-4 px-6">
                    <p class="py-2 text-lg text-gray-700">Druk op de knop om het licht te schakelen</p>
                    <div class="flex items-center mt-4 text-gray-700">
                        <button type="button" wire:click="toggleLight()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{($toggle) ? "Aan" : "Uit"}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-4 flex items-center justify-center">
            <div class="max-w-sm bg-white shadow-lg rounded-lg overflow-hidden my-4">
                <div class="flex items-center px-6 py-3 bg-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                      </svg>

                    <h1 class="mx-3 text-white font-semibold text-lg">Deurbel</h1>
                </div>
                <div class="py-4 px-6">
                    <p class="py-2 text-lg text-gray-700">Druk op de knop om aan te bellen</p>
                    <div class="flex items-center mt-4 text-gray-700">
                        <button type="button" wire:click="ringBell()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Bel aan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
