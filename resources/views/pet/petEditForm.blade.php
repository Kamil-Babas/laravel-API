<x-layout>

    @if(isset($errorMessage))
        <div class="error">
            Error: {{ $errorMessage }}
        </div>
    @endif


    @if(isset($pet))
        <h2>Pet id: {{$pet['id']}}</h2>

            <div class="form-wrapper">

                <div class="form-container">

                    <form action="{{url(route('edit-pet'))}}" method="POST">
                        @Method("PUT")
                        @csrf

                        <h1 align="center">Edit pet {{ $pet['id'] }}</h1>

                        <div class="input-container">

                            <input type="hidden" name="id" value="{{$pet['id']}}">

                            <div class="input">
                                <label for="categoryName">Category name</label>
                                <input id="categoryName" name="category_name" placeholder="Category Name" value="{{ $pet['category']['name'] ?? '' }}">

                                @error('category_name')
                                    <p class="error">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="input">
                                <label for="name1">Name</label>
                                <input id="name1" name="name" placeholder="Name" required="required" value="{{ $pet['name'] ?? ''}}">

                                @error('name')
                                    <p class="error">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="input">
                                <label for="photos">PhotoUrls</label>
                                <input id="photos" name="photoUrls" required="required" placeholder="Add photo urls | split them by ';' sign" value="{{ isset($pet['photoUrls']) ? implode(';', $pet['photoUrls']) : '' }}">

                                @error('photoUrls')
                                <p class="error">{{$message}}</p>
                                @enderror
                            </div>

                            <div>
                                <button class="loginButton">Edit</button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>


        @endif

</x-layout>


<style>
    .form-wrapper {
        height: 500px;
    }

    input {
        margin-top: 2px;
    }

</style>
