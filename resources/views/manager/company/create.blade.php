<x-layout.main title="Create">
    <div class="w-50">
        <form action="{{ route('companies.store') }}" method="post">
            @csrf
            <x-forms.input name="name" label="Name" placeholder="Name"/>
            <x-forms.textarea name="description" placeholder="Description" label="Description"/>
            <button type="submit" class="w-100 btn btn-secondary">Create</button>
        </form>
    </div>
</x-layout.main>
