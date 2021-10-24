






<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('input') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

        
        <form action="{{route('save')}}" method="post" enctype="multipart/form-data">
            @csrf
            <textarea name="content" cols="30" rows="10"></textarea>
            
            <br>
            @error('file')
                {{$message}}
                <br>
            @enderror
            <input type="file" name="file">
            
            <input type="submit" value="送信">
        </form>
        

        </div>
      </div>
    </div>
  </div>
</x-app-layout>

