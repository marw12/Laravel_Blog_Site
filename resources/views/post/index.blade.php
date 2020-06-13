@extends('layout')

@section('content')

    @forelse ($posts as $p)

        <p>
            <h3><a href="{{ route('post.show', ['post' => $p->id]) }}">{{ $p->title }}</a></h3>
            <a href="{{ route('post.edit', ['post'=>$p->id]) }}" class="btn btn-primary">
               Edit
            </a>

            <form method="POST" action="{{ route('post.destroy', ['post'=>$p->id]) }}" class="fm-inline">
                @csrf
                @method('DELETE')

                <input type="submit" value="Delete!" class="btn btn-danger"/>
            </form>
            
        </p>

        @empty
        <p>No Blog Posts Yet!</p>
        
    @endforelse

@endsection