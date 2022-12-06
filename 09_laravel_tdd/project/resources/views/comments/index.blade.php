<x-guest-layout>
    {{-- adapted from resources/views/components/auth-card.blade.php --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <h1>Comments</h1>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{-- created based on https://flowbite.com/docs/typography/lists/ --}}
            <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                @foreach($comments as $comment)
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                        <a href="{{ route('comments.show', $comment) }}">{{ $comment->title }}</a>
                    </dt>
                    <dd class="text-lg font-semibold">
                         @markdown($comment->text)
                    </dd>
                </div>
                @endforeach
            </dl>
        </div>
    </div>
</x-guest-layout>
