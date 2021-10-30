<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('編集') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            
        <p>投稿ID: {{$item['id']}}</p>
        <form action="{{route('update')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$item['id']}}">
            <textarea name="content" cols="30" rows="10">{{$item['content']}}</textarea>
            <input type="submit" value="送信">
        </form>
        <p>投稿時間: {{$item['created_at']}}</p>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

