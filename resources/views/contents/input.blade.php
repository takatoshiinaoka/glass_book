






<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('めがね登録') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

        
        <form action="{{route('save')}}" method="post" enctype="multipart/form-data">
            @csrf
            何年から何年まで使ったか(空白は現在になります)<br>
            <input class="border py-2 px-3 text-grey-darkest" type="date" name="year_start" id="year_start" required>
            ~
            <input class="border py-2 px-3 text-grey-darkest" type="date" name="year_end" id="year_end"><br>
            世代<br><input class="border py-2 px-3 text-grey-darkest" type="text" name="generation" id="generation" required><br>
            メーカー<br><input class="border py-2 px-3 text-grey-darkest" type="text" name="maker" id="maker" required><br>
            型番<br><input class="border py-2 px-3 text-grey-darkest" type="text" name="model_number" id="model_number" required><br>
            眼鏡のストーリー
            <br>
            <textarea name="content" cols="40" rows="7" required></textarea>
            <br>
            @error('file')
                {{$message}}
                <br>
            @enderror
            <input type="file" name="file" required>
            
            <input type="submit" value="送信">
        </form>
        

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

