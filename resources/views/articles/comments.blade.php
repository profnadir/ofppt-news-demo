<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listes des commentaires sur mes articles
        </h2>
    </x-slot>
    <!-- Liste des commentaires -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Commentaires</h2>
                @if ($comments->count() > 0)
                    <ul>
                        @foreach ($comments as $comment)
                            <li class="mb-2">
                                <div class="font-bold">{{ $comment->author }} on <i>
                                <a href="{{ route('articles.show',$comment->article) }}">{{ $comment->article->title }}</a>    
                                </i></div>
                                <div class="text-gray-600">{{ $comment->content }}</div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">Aucun commentaire pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
