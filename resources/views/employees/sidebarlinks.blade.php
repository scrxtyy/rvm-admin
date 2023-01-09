@include('components\sidebar\content')

@section('side')
    @foreach ($employees as $index => $link)
        <a href="#">
            RVM {{ $index->id}}
        </a>
    @endforeach
@endsection