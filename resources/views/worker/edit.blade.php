<x-layout.main title="Edit {{ $worker->name }}">
    <div class="w-50">
        <form action="{{ route('workers.update', $worker) }}" method="post">
            @csrf
            @method('patch')
            <x-forms.input name="name" label="Name" :model="$user" placeholder="Name"/>
            <x-forms.input name="surname" label="Surname" :model="$user" placeholder="Surname"/>
            <x-forms.input name="email" label="Email" :model="$user" placeholder="Email"/>
            <x-forms.input name="age" label="Age" :model="$worker" placeholder="Age"/>
            <x-forms.input name="phone" label="Phone" :model="$worker" placeholder="Phone format (8**********)"/>
            <x-forms.textarea name="description" label="Description" :model="$worker" placeholder="Description"/>
            <x-forms.checkbox name="is_married" label="Is married ?" :model="$worker"/>
            <button type="submit" class="w-100 btn btn-success">Update</button>
        </form>
    </div>
</x-layout.main>
