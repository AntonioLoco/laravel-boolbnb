@extends('layouts.admin')

@section('content')
    <div class="container" id="index-report">
        <div class="row d-flex justify-content-center">

            {{-- Title --}}
            <div class="col-12 d-flex justify-content-center">
                <div class="text-center border-bottom border-2 w-75">
                    <h5 class="fs-6 fw-lighter">REPORT</h5>
                    <h2 class="fs-2 fw-bold">All reports</h2>
                    <p class="fs-4 fw-light">Here you can find all your statistic.</p>
                </div>
            </div>
            {{-- / Title --}}

            {{-- Table --}}
            <div class="col-sm-4 col-md-8 mt-5 d-flex justify-content-center">
                <table class="table table-bordered table-md align-middle">
                    <thead>
                        <tr class="bg-light align-middle">
                            <th scope="col" class="text-center">Apartments</th>
                            <th scope="col" class="text-center d-none d-sm-table-cell">Data</th>
                            <th scope="col" class="text-center">See Graphs</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Foreach --}}
                        @foreach ($apartments as $apartment)
                            <tr>
                                <td>
                                    <h5 class="text-center">{{ $apartment->title }}</h5>
                                </td>
                                <td class="pb-0 d-none d-sm-table-cell align-middle">
                                    {{-- Messages --}}
                                    <section class="d-flex border-bottom border-2 ">
                                        <div class="d-flex justify-content-center align-items-center px-2 px-lg-3">
                                            <i class="fa-solid fa-envelope-open-text fa-lg d-none d-lg-block d-md-none"></i>
                                        </div>
                                        <div>
                                            <h5>Total messages received: <strong>
                                                    {{ $apartment->messages->count() }}</strong></h5>
                                            @php
                                                $dailyMessage = [];
                                                foreach ($apartment->messages as $message) {
                                                    if (array_key_exists($message->created_at->toDateString(), $dailyMessage)) {
                                                        $dailyMessage[$message->created_at->toDateString()]++;
                                                    } else {
                                                        $dailyMessage[$message->created_at->toDateString()] = 1;
                                                    }
                                                }
                                            @endphp
                                            {{-- <h5>Daily average:
                                                <strong>
                                                    @if (count($dailyMessage) === 0)
                                                        {{ '0' }}
                                                    @else
                                                        {{ ceil($apartment->messages->count() / count($dailyMessage)) }}
                                                    @endif
                                                </strong>
                                            </h5> --}}
                                        </div>
                                    </section>
                                    {{-- Views --}}
                                    <section class="d-flex align-items-center mt-1">
                                        <div class="d-flex justify-content-center align-items-center px-2 px-lg-3">
                                            <i class="fa-regular fa-eye fa-lg d-none d-lg-block d-md-none "></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">Total views accumulated: <strong>
                                                    {{ $apartment->views->count() }} </strong>
                                            </h5>
                                            @php
                                                $dailyViews = [];
                                                foreach ($apartment->views as $view) {
                                                    if (array_key_exists($view->created_at->toDateString(), $dailyViews)) {
                                                        $dailyViews[$view->created_at->toDateString()]++;
                                                    } else {
                                                        $dailyViews[$view->created_at->toDateString()] = 1;
                                                    }
                                                }
                                            @endphp
                                            {{-- <h5>Daily average:
                                                <strong>
                                                    @if (count($dailyViews) === 0)
                                                        {{ '0' }}
                                                    @else
                                                        {{ ceil($apartment->views->count() / count($dailyViews)) }}
                                                    @endif
                                                </strong>
                                            </h5> --}}
                                        </div>
                                    </section>
                                </td>
                                {{-- Button GRAPHS --> linkare show graph singolo apartamento  --}}
                                <td>
                                    <ul class="w-100 h-100 d-flex align-items-center justify-content-center p-0 m-0">
                                        <li>
                                            <a class="btn btn-outline-dark"
                                                href="{{ route('admin.apartment.report', $apartment->slug) }}">
                                                <i class="fa-solid fa-chart-line"></i>
                                                Graphs
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        {{-- /Foreach --}}

                    </tbody>
                </table>
            </div>
            {{-- Table --}}
        </div>
    </div>
@endsection
