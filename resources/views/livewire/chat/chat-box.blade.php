<div class="w-full overflow-hidden">
    <div class="border-b flex flex-col overflow-y-scroll grow h-full">
        <header class="sticky w-full inset-x-0 flex py-[5px] top-0 z-10 bg-white border-b">
            <div class="flex w-full items-center px-2 lg:px-4 gap-2 md:gap-5">
                <a href="" class="shrink-0 lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                    </svg>
                </a>
                <div class="shrink-0">
                    <x-avatar class="size-9 lg:size-11"/>
                </div>
                <h6 class="font-bold truncate">
                    {{ $selected->getReceiver()->name }}
                </h6>
            </div>
        </header>
        <main
            class="flex flex-col gap-3 p-2.5 overflow-y-auto flex-grow overscroll-contain overflow-x-hidden w-full my-auto">
            <div @class(['max-w-[85%] md:max-w-[78%] gap-2 flex w-auto relative mt-2'])>
                <div @class(['shrink-0'])>
                    <x-avatar/>
                </div>
                <div @class(['flex flex-wrap text-[15px] rounded-xl p-2.5 flex flex-col text-black bg-[#F6F6F8FB]',
                'rounded-bl-none border border-gray-200/40' => false, 'rounded-br-none bg-blue-500/80 text-white' => true])>
                    <p class="whitespace-normal truncate text-sm md:text-base tracking-wide lg:tracking-normal">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eum id incidunt quas! Accusantium
                        animi, aspernatur beatae commodi cupiditate error harum praesentium reiciendis suscipit vitae?
                        Assumenda enim laboriosam nemo tempore!
                    </p>
                    <div class="ml-auto flex gap-2">
                        <p @class(['text-xs', 'text-gray-500' => false, 'text-white' => true])>
                            5:25am
                        </p>
                        <div>
                        <span @class(['text-gray-500'])>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 viewBox="0 0 16 16">
                                  <path
                                      d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"/>
                                  <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708"/>
                            </svg>
                        </span>
                            {{--<span @class(['text-gray-500'])>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     viewBox="0 0 16 16">
                                      <path
                                          d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                                </svg>
                            </span>--}}
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="shrink-0 z-10 bg-white inset-x-0">
            <div class="p-2 border-t">
                <form method="POST" autocapitalize="off">
                    @csrf
                    <input type="hidden" autocomplete="off" class="hidden"/>
                    <div class="grid grid-cols-12">
                        <input type="text" autocomplete="off" autofocus placeholder="Write your message here"
                               maxlength="1700" class="col-span-10 bg-gray-100 border-0 outline-0 focus:border-0
                           focus:ring-0 hover:ring-0 rounded-lg focus:outline-none"/>
                        <button type="submit" class="col-span-2">
                            Send
                        </button>
                    </div>
                </form>
                @error('body')
                <p>
                    {{ $message }}
                </p>
                @enderror
            </div>
        </footer>
    </div>
</div>
