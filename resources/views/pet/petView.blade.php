<x-layout>
    <h1>pet view</h1>

    @if(isset($errorMessage))
        <div class="error">
            Error: {{ $errorMessage }}
        </div>
    @endif

    @if(isset($pet))

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
                <tr>
                    <td>{{$pet['id']}}</td>
                    <td>{{$pet['name']}}</td>
                    <td>{{$pet['category']['name']}}</td>
                    <td>{{$pet['status']}}</td>
                    <td class="actionButtonsContainer">
                        <a class="actionButton" href="/pets/1/edit">Edit</a>
                        <a class="actionButton" href="/pets/1/edit">Delete</a>
{{--                        <form action="/pets/1" method="POST" style="display: inline;">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit">Delete</button>--}}
{{--                        </form>--}}
                    </td>
                </tr>
            </tbody>
        </table>


    @endif

</x-layout>
