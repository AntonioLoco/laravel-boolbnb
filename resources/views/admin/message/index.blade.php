@extends('layouts.admin')

@section('content')
    <div id="messages" class="container text-center">
        <div class="btn-back mt-3">
            <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
        <div class="messages__title">
            <p>Here you can view all the messages for:</p>
            <h1>{{ $apartment->title }}</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-9">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages->reverse() as $message)
                            <tr>
                                <td>{{ $message->fullname }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->message }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
