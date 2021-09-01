@extends('layouts.app')
{{-- @dd($houses) --}}

@section('content')
    <div class="container">

        @if (session('deleted'))
            <div class="alert alert-success my-alert">
                La struttura <strong>'{{ session('deleted') }}'</strong> è stata eliminata con successo!
            </div>
        @endif

        <div class="d-flex my-4">
            <h1>Houses</h1> 
            <a class="btn btn-primary align-self-center mx-4" href="{{route('admin.houses.create')}}">Aggiungi una struttura</a>
        </div>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>City</th>
                    <th>Price</th>
                    <th>Visible</th>
                    {{-- <th scope="col">house typ</th> --}}
                    <th colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($houses as $house)
                    <tr>
                        <td>{{ $house->id }}</td>
                        <td>{{ $house->title }}</td>
                        <td>{{ $house->city }}</td>
                        <td>&euro;{{ $house->price }}</td>
                        <td>{{ $house->visible }}</td>
                        {{-- <td> --}}
                        {{-- @if ($post->category)
                            {{ $post->category->name}}
                        @endif --}}
                        {{-- </td> --}}
                        <td>
                        <a class="btn btn-info" href="{{route('admin.houses.show', $house)}}">SHOW</a>
                        </td>
                        <td>
                        <a class="btn btn-warning" href="{{route('admin.houses.edit', $house)}}">EDIT</a>
                        </td>
                        <td>
                        <form action="{{route('admin.houses.show', $house->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" onclick="return confirm('Do you want delete this post? this action can\'tn be undone')" value="DELETE">
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection