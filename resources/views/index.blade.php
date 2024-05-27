<x-layout>

    @if(session()->has('message'))
        <h3>{{ session('message') }}</h3>
    @endif

    <div class="form-wrapper">

        <div class="form-container">

            <form action="{{url('/pets')}}" method="GET">

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


        <div class="form-wrapper">
            <form action="{{ url('/pets/find') }}" method="GET">
                <h1 align="center">Find pet by status</h1>
                <div class="input-container">
                    <div class="input">
                        <select name="pet_status" required="required">
                            <option value="">Select Status</option>
                            <option value="available">Available</option>
                            <option value="pending">Pending</option>
                            <option value="sold">Sold</option>
                        </select>
                        @error('pet_status')
                        <p class="error">{{ $message }}</p>
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
