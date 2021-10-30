<?php
// var_dump($items);
// exit();
?>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('めがね一覧') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            
        @foreach ($items->unique('id') as $item)

        <hr>

        @if (isset($item->file_path))
        <img src="{{asset('storage/' . $item->file_path)}}" alt="{{asset('storage/' . $item->file_path)}}">
        @endif
        
        <p>名前: {{$item->name}} ({{$item->generation}}代目)</p>
        <a href="{{route('detail_public', ['content_id' => $item->id])}}">詳細</a>
        <hr>
        @endforeach


        </div>
      </div>
    </div>
  </div>
</x-app-layout>

