@extends('layout')

@section('content')
    <form method="POST" action="{{ route('post.store') }}">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control"/>
        </div>
        
        <div class="form-group">
            <label>Content</label>
            <input type="text" name="content" value="{{ old('content') }}" class="form-control"/>
        </div>

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
            
        @endif

        <button type="submit" class="btn btn-primary">Create!</button>
    </form>
@endsection