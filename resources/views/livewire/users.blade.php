<div class="max-w-6xl mx-auto my-16">
    <h5 class="text-center text-5xl font-bold py-3">
        Users
    </h5>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 p-2">
        @foreach($users as $key => $user)
            <div class="bg-white w-full border border-gray-200 rounded-lg p-5 shadow">
                <div class="flex flex-col items-center pb-10">
                    <img src="https://picsum.photos/500/500?random={{$key}}" alt="image"
                         class="size-24 mb-2.5 rounded-full shadow-lg"/>
                    <h5 class="mb-1 text-xl font-medium text-gray-900">
                        {{ $user->name }}
                    </h5>
                    <span class="text-sm text-gray-500">
                    {{ $user->email }}
                </span>
                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <x-primary-button>
                            Add Friend
                        </x-primary-button>
                        <x-secondary-button wire:click="message({{$user->id}})">
                            Message
                        </x-secondary-button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
