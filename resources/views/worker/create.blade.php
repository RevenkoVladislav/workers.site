<x-layout.main title="Create">
    <div class="w-50">
        <form action="" method="post">
            @csrf
            <x-forms.input name="name" label="Name"/>
            <x-forms.input name="surname" label="Surname"/>
            <x-forms.input name="email" label="Email"/>
            <x-forms.input name="age" label="Age"/>
            <x-forms.input name="phone" label="Phone"/>
            <x-forms.textarea name="description" label="Description"/>
            <x-forms.checkbox name="is_married" label="is_married"/>
            <button type="submit" class="w-100 btn btn-secondary">Create</button>
        </form>
    </div>
</x-layout.main>
