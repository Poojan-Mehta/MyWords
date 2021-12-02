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
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" value="<?php echo $user['name']; ?>" name="name" required />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" value="<?php echo $user['email']; ?>" name="email" required />
                    </div>
                    
                    <div class="mt-4">
                        <label for="profile_photo">Profile Photo</label><br>
                        <input type="file" name="profile_photo">
                        <div class="mt-2">
                            <img src="{{ asset('img/users/') }}<?php echo '/'.$user['profile_photo']; ?>" width="100" height="100"/>
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
                            {{ __('Save Details') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>
