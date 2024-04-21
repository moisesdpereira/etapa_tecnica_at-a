<x-guest-layout>
    <form method="POST" action="{{ route('user.update', ['user' => $user]) }}">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="name" :value="__('Departament')" />
            <x-select id="department" name="department" :options="$department" :selected="$user->department_id" />
        </div>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Atualizar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
