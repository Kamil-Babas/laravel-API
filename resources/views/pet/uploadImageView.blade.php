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

                <form action="{{url("/pets/upload-image")}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <h1 align="center">Upload image</h1>

                    <div class="input-container">

                        <input type="hidden" name="id" value="{{$pet['id']}}">

                        <div class="input">

                            <input id="additionalInput" placeholder="Additional data" name="additional_data">

                            @error('additional_data')
                            <p class="error">{{$message}}</p>
                            @enderror

                        </div>

                        <div class="input">

                            <input type="file" id="fileInput" name="file">

                            @error('file')
                            <p class="error">{{$message}}</p>
                            @enderror

                        </div>


                        <div>
                            <button class="loginButton">Upload</button>
                        </div>

                    </div>

                </form>

            </div>

        </div>


    @endif


</x-layout>

<style>
    input[type="file"] {
        background-color: darkgray;
    }

    .form-wrapper {
        height: 300px;
    }

    input {
        text-align: center;
    }

</style>
