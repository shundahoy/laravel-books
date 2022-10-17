<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="containe mx-auto">
                            <div class="">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="py-3 px-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
                                            <th class="py-3 px-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">名前</th>
                                            <th class="py-3 px-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ステータス</th>
                                            <th class="py-3 px-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">著者</th>
                                            <th class="py-3 px-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">出版</th>
                                            <th class="py-3 px-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">読み終わった日</th>
                                            <th class="py-3 px-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メモ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($books as $book)
                                            <tr>
                                                <td class="py-3 px-1 border-gray-200 border-t-2">{{ $book->id }}</td>
                                                <td class="py-3 px-1 border-gray-200 border-t-2">{{ $book->name }}</td>
                                                <td class="py-3 px-1 border-gray-200 border-t-2">{{ $book->status }}</td>
                                                <td class="py-3 px-1 border-gray-200 border-t-2 text-lg text-gray-900">{{ $book->author }}</td>
                                                <td class="py-3 px-1 border-gray-200 border-t-2 text-lg text-gray-900">{{ $book->publication }}</td>
                                                <td class="py-3 px-1 border-gray-200 border-t-2 text-lg text-gray-900">{{ Carbon\Carbon::parse($book->reade_at)->format('Y年n月j日') }}</td>
                                                <td class="py-3 px-1 border-gray-200 border-t-2 text-lg text-gray-900">{{ Str::limit($book->note,40,$end='...') }}</td>
                                            </tr>
                                        @endforeach
                                        
                                        <!-- <tr>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">Pro</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">25 Mb/s</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">25 GB</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$24</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$24</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$24</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$24</td>
                                        </tr>
                                        <tr>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Exclusive</td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">48 Mb/s</td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">120 GB</td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$72</td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$72</td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$72</td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$72</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                                {{ $books->links() }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>