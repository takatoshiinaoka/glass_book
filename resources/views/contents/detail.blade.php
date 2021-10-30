
<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('めがね詳細l') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            
        
        @if (isset($item['file_path']))
        <img src="{{asset('storage/' . $item['file_path'])}}" alt="{{asset('storage/' . $item['file_path'])}}">
        @endif
        
        <p>投稿ID : {{$item['id']}}</p>
        <p>名前   :  {{$item['name']}}({{$item->generation}}代目)</p>
        <p>year   :    {{$item['year_start']}} ~ {{$item['year_end']}}</p>
        <p>maker  : {{$item['maker']}}</p>
        <p>型番   : {{$item['model_number']}}</p>
        <br>
        <p>メガネのストーリー:<br>  {!! nl2br(preg_replace('/(https?:\/\/[^\s]*)/', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $item['content'])) !!}</p>
        <a href="{{route('edit', ['content_id' => $item['id']])}}">編集</a>
        <form action="{{route('delete')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$item['id']}}">
            <input type="submit" value="削除">
        </form>



        </div>
      </div>
    </div>
  </div>
</x-app-layout>

