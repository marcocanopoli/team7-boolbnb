@extends('layouts.app')
{{-- @dd($houses) --}}

@section('content')
    <div class="container">
        <h1>Houses</h1>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">title</th>
                    <th scope="col">city</th>
                    <th scope="col">price</th>
                    <th scope="col">visible</th>
                    {{-- <th scope="col">house typ</th> --}}
                    <th colspan="3"></th>
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
                        <td>
                        {{-- @if ($post->category)
                            {{ $post->category->name}}
                        @endif --}}
                        </td>
                        <td>
                        <a class="btn btn-info" href="#">SHOW</a>
                        </td>
                        <td>
                        <a class="btn btn-warning" href="#">EDIT</a>
                        </td>
                        <td>
                        <form action="#" method="POST">
                            @csrf
                            @method('DELETE')
                            {{-- <input class="btn btn-danger" type="submit" onclick="return confirm('Do you want delete this post? this action can\'tn be undone')" value="DELETE"> --}}
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection