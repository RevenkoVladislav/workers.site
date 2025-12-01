<x-layout.main title="Create">
    <div class="w-50">
        <form action="{{ route('workers.store') }}" method="post">
            @csrf
            <x-forms.input name="name" label="Name" placeholder="Name"/>
            <x-forms.input name="surname" label="Surname" placeholder="Surname"/>
            <x-forms.input name="email" label="Email" placeholder="Email"/>
            <x-forms.input name="age" label="Age" placeholder="Age"/>
            <x-forms.input name="phone" label="Phone" placeholder="Phone format (8**********)"/>
            <x-forms.textarea name="description" placeholder="Description" label="Description"/>
            <x-forms.checkbox name="is_married" label="Is married ?"/>
            <button type="submit" class="w-100 btn btn-secondary">Create</button>
        </form>
    </div>
</x-layout.main>
