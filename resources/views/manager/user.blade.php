<x-layouts.manager>
    <x-slot name="breadcrumbs">
        <li>User</li>
    </x-slot>

    <article class="space-y-4">
        <section class="flex justify-end">
            <a href="{{ route('manager.user.create') }}" class="btn btn-sm">
                <x-heroicon-m-user-plus class="w-5" />
                <span>Create</span>
            </a>
        </section>
        <section>
            <div class="overflow-x-auto">
                <table class="table table-xs table-zebra">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender->name }}</td>
                                <td>
                                    <div class="join">
                                        <a href="{{ route('manager.user.edit', $user) }}"
                                            class="btn btn-xs btn-square btn-ghost join-item">
                                            <x-heroicon-s-pencil-square class="w-5" />
                                        </a>
                                        <button class="btn btn-xs btn-square btn-ghost join-item">
                                            <x-heroicon-s-trash class="w-5" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </article>

</x-layouts.manager>
