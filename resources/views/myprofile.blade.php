<x-app-layout>
    
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Profile') }}
            </h2>
        </x-slot>
        <div class="flex justify-center mt-5">
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <form method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name"><b>Name</b></label>
                        <input name="name" id="name" class="border-2 w-full p-4 rounded-lg @error('name')
                        border-red-500
                    @enderror" value="<?php echo $user['name']; ?>" placeholder="John doi.">
                        
                        @error('name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>                   

                    <div class="mb-4">
                        <label for="email"><b>Email</b></label>
                        <input name="email" id="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email')
                        border-red-500
                    @enderror" value="<?php echo $user['email']; ?>" readonly>
                        
                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mt-4">
                        <label for="profile_photo">Profile Photo</label><br>
                        <input type="file" name="profile_photo">
                        <div class="mt-2">
                            <img src="{{ asset('img/users/') }}<?php echo '/'.$user['profile_photo']; ?>" width="75" height="75"/>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="cover_photo">Cover Photo</label><br>
                        <input type="file" name="cover_photo">
                        <div class="mt-2">
                            <img src="{{ asset('img/users/') }}<?php echo '/'.$user['cover_photo']; ?>" width="200" height="50"/>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">                      

                        <x-button class="ml-4">
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>
