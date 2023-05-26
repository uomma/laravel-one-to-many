@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center justify-content-between p-43
        ">
            <h3>Lista post</h3>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Crea</a>
        </div>

        @if (@session('message'))
            <div class="alert alert.success">
                {{ @session('message') }}
            </div>
        @endif
        <div class="row justify-content-between">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">title</th>
                        <th scope="col">slug</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>
                                <ul class="list-unstyled d-flex justify-content-end">
                                    <li><a href="{{ route('admin.posts.show', $post->slug) }}"
                                            class="btn btn-primary m-1">show</a></li>
                                    <li><a href="{{ route('admin.posts.edit', $post->slug) }}"
                                            class="btn btn-info m-1">edit</a></li>
                                    <li>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger  m-1">delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
