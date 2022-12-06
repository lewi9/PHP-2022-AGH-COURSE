<x-guest-layout>
    {{-- adapted from resources/views/components/auth-card.blade.php --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <h2>Viewing a book</h2>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @markdown($book->isbn)
            @markdown($book->title)
            @markdown($book->description)
            <a href="/books/{{$book->id}}/edit">Edit</a>
            {{-- created based on https://flowbite.com/docs/typography/links/ --}}
            <a href="/books"
               class="font-medium text-blue-600 dark:text-blue-500 hover:underline mt-8">All comments...</a>
        </div>
    </div>
</x-guest-layout>
