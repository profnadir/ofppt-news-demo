<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 mb-4">
                    <h2 class="text-xl font-bold">{{ $product->title }}</h2>
                    <p class="text-gray-700 mt-2">{{ $product->description }}</p>
                    <p class="mt-4 text-gray-500">Prix: {{ $product->price }}</p>
                    <div class="mt-4">
                        <span class="text-gray-500">Catégories:</span>
                        @foreach($product->categories as $category)
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des commentaires -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Commentaires</h2>
                @if ($product->comments->count() > 0)
                    <ul>
                        @foreach ($product->comments as $comment)
                            <li class="mb-2">
                                <div class="font-bold">{{ $comment->author }}</div>
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

    <!-- Formulaire pour ajouter un commentaire -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Ajouter un commentaire</h2>
                <form method="POST" action="{{ route('products.comments.store',$product) }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Contenu:</label>
                        <textarea name="content" id="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="author" class="block text-gray-700 text-sm font-bold mb-2">Author:</label>
                        <input type="text" name="author" id="author" value="{{ old('author') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('author')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo disabled:opacity-25 transition ease-in-out duration-150">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
