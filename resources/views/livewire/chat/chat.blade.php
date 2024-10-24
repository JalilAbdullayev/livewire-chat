<main class="fixed h-full flex bg-white border lg:shadow-sm overflow-hidden inset-0 lg:top-16 lg:inset-x-2 m-auto
lg:h-[90%] rounded-t-lg">
    <section class="max-lg:hidden flex relative w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full
    border">
        <livewire-chat.chat-list :selected="$selected" :query="$query"/>
    </section>
    <section class="grid w-full border-l h-full relative overflow-y-auto contain-content">
        <livewire-chat.chat-box :selected="$selected"/>
    </section>
</main>
