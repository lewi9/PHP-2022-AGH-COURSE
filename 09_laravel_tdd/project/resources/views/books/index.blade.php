<x-guest-layout>
    {{-- adapted from resources/views/components/auth-card.blade.php --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <h2>List of books</h2>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{-- created based on https://flowbite.com/docs/typography/lists/ --}}
            <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                @if (count($books) === 0)
                    No books in database.
                @else
                    <table>
                    @foreach($books as $book)
                            <tr>
                                <td>
                                    @markdown($book->isbn)
                                </td>
                                <td>
                                    @markdown($book->title)
                                </td>
                                <a href="/books/{{$book->id}}">Details</a>
                            </tr>
                    @endforeach
                    </table>
                @endif
                <a href="{{route('books.create')}}">Create new...</a>;
            </dl>
        </div>
    </div>
</x-guest-layout>
