<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <h2>Editing a book</h2>
        <form method="PATCH" action="/books/{{$book->id}}">
            @csrf

            <div>
                <x-input-label for="id" :value="__('Id')" />
                <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{$book->id}}" readonly/>
                <x-input-error :messages="$errors->get('id')" class="mt-2" />
            </div>
            <!-- Name -->s
            <div>
                <x-input-label for="isbn" :value="__('Isbn')" />
                <x-text-input id="isbn" class="block mt-1 w-full" type="text" name="isbn" value="{{$book->isbn}}" required autofocus />
                <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$book->title}}" required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />

                <x-text-input id="description" class="block mt-1 w-full"
                              type="text"
                              name="description"
                              value="{{$book->description}}"
                              required />

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Update') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
