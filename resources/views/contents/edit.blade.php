<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('めがね編集') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            
        <p>投稿ID: {{$item['id']}}</p>
        @if (isset($item['file_path']))
        <img src="{{asset('storage/' . $item['file_path'])}}" alt="{{asset('storage/' . $item['file_path'])}}">
        @endif
        <form action="{{route('update')}}" method="post">
          @csrf
            <input class="border py-2 px-3 text-grey-darkest invisible" type="text" name="id" value="{{$item['id']}}" id="id">
            <input class="border py-2 px-3 text-grey-darkest invisible" type="text" name="file_path" value="{{$item['file_path']}}" id="file_path">
            <input class="border py-2 px-3 text-grey-darkest invisible" type="text" name="name" value="{{$item['name']}}" id="name">
            <br>
            何年から何年まで使ったか<br>
            <input class="border py-2 px-3 text-grey-darkest" type="date" name="year_start" value="{{$item['year_start']}}" id="year_start">
            <input class="border py-2 px-3 text-grey-darkest" type="date" name="year_end" value="{{$item['year_end']}}" id="year_end"><br>
            世代<br><input class="" type="text" name="generation" value="{{$item['generation']}}" id="generation"><br>
            メーカー<br><input class="border py-2 px-3 text-grey-darkest" type="text" name="maker" value="{{$item['maker']}}" id="maker"><br>
            型番<br><input class="border py-2 px-3 text-grey-darkest" type="text" name="model_number" value="{{$item['model_number']}}" id="model_number"><br>
            眼鏡のストーリー
            <textarea name="content" cols="40" rows="7">{{$item['content']}}</textarea>
            <br>
            
            <input type="submit" value="送信">
        </form>

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

