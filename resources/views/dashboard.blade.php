<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}

        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">


        <h4>phoros in the system</h4>  <table class="table table-auto" style="width: 100%;text-align: left">
            <thead>
                <th>photo</th>
                <th>caption</th>
                <th>likes</th>
                <th>comments</th>
            </thead>
            <tbody>
                @foreach($posts as $pst)
                <tr>
                    <td>{{ $pst->photo}}</td>
                    <td>{{$pst->caption}}</td>
                    <td><!--this button on click will hit the likes route and increment the likes remmber that you will have to use the relationships eg $mv->genre->genre_name for both likes and comments--> <x-jet-button class="ml-4">
                    {{ __('Like Photo') }}
                </x-jet-button>{{$pst->likes}}</td>
                    <td>{{$pst->comments}}<div>
                        <!--I will create a new form that will have the route that will be hit on submission of the comment-->
               <x-jet-label for="caption" value="{{ __() }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="caption" :value="old('caption')" required autofocus  />
                <x-jet-button class="ml-4">
                    {{ __('submit comment') }}
                </x-jet-button>
            </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
         
        
        
                
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8" >
               <!-- <x-jet-welcome/>-->
               <h4>Add Phoros</h4>

        <form method="POST" action="{{ route('create_post')}}">
            @csrf
             
            <div class="mt-4">
                <x-jet-label for="photo" value="{{ __('Photo') }}" />
                <x-jet-input id="fileToUpload" class="block mt-1 w-full" type="file" name="fileToUpload" required  />
            </div>



            <div>
                <x-jet-label for="caption" value="{{ __('Caption') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="caption" :value="old('caption')" required autofocus />
            </div>

            
            

            
            <div class="flex items-center justify-end mt-4">
               
                <x-jet-button class="ml-4">
                    {{ __('Upload Photo') }}
                </x-jet-button>
            </div>
        </form>
            </div>
        </div>
    </div>
</x-app-layout>
