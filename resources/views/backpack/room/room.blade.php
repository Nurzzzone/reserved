@extends(backpack_view('blank'))
@section('content')
    <link href="{{ asset('css/room.css') }}" rel="stylesheet">
    <div id="app">
        <div class="room">

        </div>
    </div>
    @include('backpack.scripts')
    <script src="{{ asset('js/room.js') }}" type="module"></script>
@endsection
