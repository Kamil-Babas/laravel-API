<x-layout>

    @if(isset($errorMessage))
        <div class="error">
            Error: {{ $errorMessage }}
        </div>
    @endif

    <div class="form-wrapper">

        <div class="form-container">

            <form action="{{url('/pets/add')}}" method="POST">
                @csrf

                <h1 align="center">Create pet</h1>

                <div class="input-container">

                    <div class="input">
                        <label for="categoryName">Category name</label>
                        <input id="categoryName" name="category_name" placeholder="Category Name">

                        @error('category_name')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="name1">Name</label>
                        <input id="name1" name="name" placeholder="Name" required="required">

                        @error('name')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="input">
                        <label for="photos">PhotoUrls</label>
                        <input id="photos" name="photoUrls" required="required" placeholder="Add photo urls | split them by ';' sign">

                        @error('photoUrls')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="input">
                        <select id="statusInput" name="status">
                            <option value="">Select Status</option>
                            <option value="available">Available</option>
                            <option value="pending">Pending</option>
                            <option value="sold">Sold</option>
                        </select>
                    </div>

                    <div>
                        <button class="loginButton">Create</button>
                    </div>
                </div>

            </form>

        </div>

    </div>
</x-layout>

<style>
    .form-wrapper {
        height: 400px;
    }

    input {
        margin-top: 2px;
    }

    select {
        margin-top: 1.5rem;
    }

</style>
