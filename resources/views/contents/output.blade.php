

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('output') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            
        @foreach ($items as $item)

        <hr>

        @if (isset($item['file_path']))
        <img src="{{asset('storage/' . $item['file_path'])}}" alt="{{asset('storage/' . $item['file_path'])}}">
        @endif
        
        <p>{!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $item['content'])) !!}</p>
        <a href="{{route('detail', ['content_id' => $item['id']])}}">詳細</a>
        <a href="{{route('edit', ['content_id' => $item['id']])}}">編集</a>
        @endforeach


        </div>
      </div>
    </div>
  </div>
</x-app-layout>

