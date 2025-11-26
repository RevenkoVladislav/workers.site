<x-layout.main title="Create">
    <form action="" method="post">
        @csrf
        <x-forms.input name="name" label="Name"/>
        <x-forms.input name="surname" label="Surname"/>
        <x-forms.input name="email" label="Email"/>
        <x-forms.input name="age" label="Age"/>
        <x-forms.input name="phone" label="Phone"/>
        <x-forms.input name="description" label="Description"/>

        <button type="submit" class="btn btn-secondary">Create</button>
    </form>
</x-layout.main>
