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
                    <td>{{$pet['name'] ?? '---'}}</td>
                    <td>{{$pet['category']['name'] ?? '---'}}</td>
                    <td>{{$pet['status'] ?? '---'}}</td>
                    <td class="actionButtonsContainer">
                        <a class="actionButton button" href="/pets/edit/{{$pet['id']}}">Edit</a>
{{--                        <a class="actionButton" href="/pets/1/edit">Delete</a>--}}
                        <form action="/pets/{{$pet['id']}}" method="POST" style="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="actionButton button buttonDelete">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>


    @endif

</x-layout>

<style>
    .button {
        margin-top: 0px;
        height: inherit;
        font-weight: 200;
        font-family: "Agency FB";
    }

    .button:hover {
        transition: 1.5s;
        transform: scale(0.96); /* scale button to 96% of its original size */
        color: black;
        cursor: pointer;
    }

    .buttonDelete {
        background-color: orangered;
    }

</style>
