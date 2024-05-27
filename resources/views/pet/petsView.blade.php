<x-layout>

    @if(isset($errorMessage))
        <div class="error">
            Error: {{ $errorMessage }}
        </div>
    @endif

    @if(isset($pets) && count($pets) > 0)
        <table id="myTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pets as $pet)
                <tr>
                    <td>{{ $pet['id'] }}</td>
                    <td>{{ $pet['name'] ?? '---' }}</td>
                    <td>{{ $pet['category']['name'] ?? '---' }}</td>
                    <td>{{ $pet['status'] ?? '---' }}</td>
                    <td class="actionButtonsContainer">
                        <a class="actionButton button" target="_blank" href="/pets/{{ $pet['id'] }} ">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No pets found.</p>
    @endif
</x-layout>
