<div x-data="{ fullscreenModal: false }" x-init=" $watch('fullscreenModal', function(value){  if(value === true){  document.body.classList.add('overflow-hidden'); }else{  document.body.classList.remove('overflow-hidden');  }})" @keydown.escape="fullscreenModal=false">

  <button @click="fullscreenModal=true" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">Account</button>

  <template x-teleport="body">

      <div
          x-show="fullscreenModal"
          x-transition:enter="transition ease-out duration-100"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in duration-100"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          class="flex fixed inset-0 z-[99] w-screen h-screen bg-white"
          >
          <button @click="fullscreenModal=false" class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-3 mr-3 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
              <span>Close</span>
          </button>
          <div class="relative top-0 bottom-0 right-0 flex-shrink-0 hidden w-1/3 overflow-hidden bg-cover lg:block">
              <a href="#_" class="absolute bottom-0 left-0 z-30 inline-flex items-end mb-4 ml-3 font-sans text-2xl font-extrabold text-left text-white no-underline bg-transparent cursor-pointer group focus:no-underline">
                  <svg class="w-auto h-4 text-white fill-current lg:h-5" viewBox="0 0 355 99" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><path d="M119.1 87V66.4h19.8c34.3 0 34.2-49.5 0-49.5-11 0-22 .1-33 .1v70h13.2zm19.8-32.7h-19.8V29.5h19.8c16.8 0 16.9 24.8 0 24.8zm32.6-30.5c0 9.5 14.4 9.5 14.4 0s-14.4-9.5-14.4 0zM184.8 87V37.5h-12.2V87h12.2zm22.8 0V61.8c0-7.5 5.1-13.8 12.6-13.8 7.8 0 11.9 5.7 11.9 13.2V87h12.2V61.1c0-15.5-9.3-24.2-20.9-24.2-6.2 0-11.2 2.5-16.2 7.4l-.8-6.7h-10.9V87h12.1zm72.1 1.3c7.5 0 16-2.6 21.2-8l-7.8-7.7c-2.8 2.9-8.7 4.6-13.2 4.6-8.6 0-13.9-4.4-14.7-10.5h38.5c1.9-20.3-8.4-30.5-24.9-30.5-16 0-26.2 10.8-26.2 25.8 0 15.8 10.1 26.3 27.1 26.3zM292 56.6h-26.6c1.8-6.4 7.2-9.6 13.8-9.6 7 0 12 3.2 12.8 9.6zm41.2 32.1c14.1 0 21.2-7.5 21.2-16.2 0-13.1-11.8-15.2-21.1-15.8-6.3-.4-9.2-2.2-9.2-5.4 0-3.1 3.2-4.9 9-4.9 4.7 0 8.7 1.1 12.2 4.4l6.8-8c-5.7-5-11.5-6.5-19.2-6.5-9 0-20.8 4-20.8 15.4 0 11.2 11.1 14.6 20.4 15.3 7 .4 9.8 1.8 9.8 5.2 0 3.6-4.3 6-8.9 5.9-5.5-.1-13.5-3-17-6.9l-6 8.7c7.2 7.5 15 8.8 22.8 8.8z" id="a"></path></defs><g fill="none" fill-rule="evenodd"><g fill="currentColor"><path d="M19.742 49h28.516L68 83H0l19.742-34z"></path><path d="M26 69h14v30H26V69zM4 50L33.127 0 63 50H4z"></path></g><g fill-rule="nonzero"><use fill="currentColor" xlink:href="#a"></use><use fill="currentColor" xlink:href="#a"></use></g></g></svg>
                  <span class="flex opacity-90 group-hover:scale-150 group-hover:opacity-100 items-center h-full group-hover:-rotate-6 ease-out duration-500 px-0.5 py-px ml-2 -translate-x-px text-[0.6rem] font-bold leading-none border-[2px] rounded border-white -translate-y-px">UI</span>
              </a>
              <div class="absolute inset-0 z-20 w-full h-full opacity-70 bg-gradient-to-t from-black"></div>
              <img src="https://cdn.devdojo.com/images/may2023/pines-bg-1.png" class="z-10 object-cover w-full h-full" />
          </div>
          <div class="relative flex flex-wrap items-center w-full h-full px-8">

              <div class="relative w-full max-w-sm mx-auto lg:mb-0">
                  <div class="relative text-center">

                      <div class="flex flex-col mb-6 space-y-2">
                          <h1 class="text-2xl font-semibold tracking-tight">Login Account</h1>

                      </div>

                  </div>
              </div>
          </div>
      </div>

  </template>
</div>
