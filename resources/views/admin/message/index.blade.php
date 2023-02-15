@extends('layouts.admin')

@section('content')
    <div class="container py-5 text-center">
        <h1>{{ $apartment->title }}</h1>
        <div class="row justify-content-center mt-5">
            <div class="col-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">From</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
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
