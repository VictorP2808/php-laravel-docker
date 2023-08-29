<x-layout>
    <div class="p-6">
        <h1 class="text-2xl font-semibold mb-4">Manage Users</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left">Name</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="py-2 px-4">{{ $user->first_name }}</td>
                            <td class="py-2 px-4">{{ $user->email }}</td>
                            <td class="py-2 px-4 text-center">
                                <form action="{{ route('delete.user', ['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
