<x-layout>

    <div class="form-wrapper">

        <div class="form-container">

            <form action="{{url('/pets')}}" method="Get">

{{--                @csrf--}}
                <h1 align="center">Find pet by ID</h1>

                <div class="input-container">

                    <div class="input">
                        <input name="pet_id" required="required" placeholder="Enter ID">

                        @error('pet_id')
                        <p class="error">{{$message}}</p>
                        @enderror
                    </div>

                    <div>
                        <button class="loginButton">Find</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

</x-layout>
