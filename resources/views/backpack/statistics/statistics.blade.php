@extends(backpack_view('blank'))
@section('content')
    <link href="{{ asset('css/statistics.css') }}" rel="stylesheet">
    <div id="app">

    </div>
    @include('backpack.scripts')
    <script src="{{ asset('js/statistics.js') }}"></script>
@endsection
