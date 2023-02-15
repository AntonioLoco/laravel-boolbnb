@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1>{{ $apartment->title }}</h1>
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
                        <th>{{ $message->fullname }}</th>
                        <th>{{ $message->email }}</th>
                        <td>{{ $message->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
