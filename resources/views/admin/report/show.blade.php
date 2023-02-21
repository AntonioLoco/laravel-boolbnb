@extends('layouts.admin')

@section('content')
    @php
        $dailyMessage = [];
        foreach ($apartment->messages as $message) {
            if (array_key_exists($message->created_at->toDateString(), $dailyMessage)) {
                $dailyMessage[$message->created_at->toDateString()]++;
            } else {
                $dailyMessage[$message->created_at->toDateString()] = 1;
            }
        }
        
        // Crea un array vuoto per i mesi
        $arrayMesi = [];
        
        // Itera sull'array di date e valori
foreach ($dailyMessage as $data => $valore) {
    // Converti la data in timestamp Unix
    $timestamp = strtotime($data);
    // Ottieni il mese corrispondente al timestamp
    $mese = date('Y-m', $timestamp);
    // Aggiungi il valore al mese corrispondente nell'array dei mesi
            if (isset($arrayMesi[$mese])) {
                $arrayMesi[$mese] += $valore;
            } else {
                $arrayMesi[$mese] = $valore;
            }
        }
        
        $dailyViews = [];
        foreach ($apartment->views as $view) {
            if (array_key_exists($view->created_at->toDateString(), $dailyViews)) {
                $dailyViews[$view->created_at->toDateString()]++;
            } else {
                $dailyViews[$view->created_at->toDateString()] = 1;
            }
        }
        
        // Crea un array vuoto per i mesi
        $arrayViewsMesi = [];
        
        // Itera sull'array di date e valori
foreach ($dailyViews as $data => $valore) {
    // Converti la data in timestamp Unix
    $timestamp = strtotime($data);
    // Ottieni il mese corrispondente al timestamp
    $mese = date('Y-m', $timestamp);
    // Aggiungi il valore al mese corrispondente nell'array dei mesi
            if (isset($arrayViewsMesi[$mese])) {
                $arrayViewsMesi[$mese] += $valore;
            } else {
                $arrayViewsMesi[$mese] = $valore;
            }
        }
    @endphp
    <div class="container">
        <div class="row mt-5 d-flex justify-content-center">

            {{-- Back to all---->CAMBIO HREF-ROUTE --}}
            <div class="col-10">
                <div class="text-center text-sm-end">
                    <a href="{{ route('admin.report') }}" class="btn btn-outline-secondary">Back to all reports</a>
                </div>
            </div>
            {{-- Back to all --}}

            {{-- Title ---->CAMBIO <h2> NOME APARTMENT --}}
            <div class="col-12 d-flex justify-content-center mt-5">
                <div class="text-center border-bottom border-2 w-75">
                    <h5 class="fs-6 fw-lighter">REPORT</h5>
                    <h2 class="fs-2 fw-bold">{{ $apartment->title }}</h2>
                    <p class="fs-6 fw-light">Here you can see all your graphs</p>
                </div>
            </div>
            {{-- / Title --}}

            {{-- Grafici --}}
            {{-- Message --}}
            <section class="pb-5">
                <div class="chart-box">
                    <canvas class="chart" id="msgChart"></canvas>
                </div>
            </section>
            {{-- View --}}
            <div class="col-10 border-bottom"></div>
            <section>
                <div class='chart-box'>
                    <canvas id="viewChart"></canvas>
                </div>
            </section>

            {{-- / Grafici --}}

            {{-- Script --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script type="text/javascript">
                let chartMsg = document.getElementById('msgChart').getContext('2d');
                let chartView = document.getElementById('viewChart').getContext('2d');

                //COMMON
                Chart.defaults.borderColor = '#c9cbcf'; //color griglia
                Chart.defaults.color = '#000'; //color text
                Chart.defaults.font.size = 16; //font size
                Chart.defaults.font.family = 'Poppins'; //font family
                let paddingLayout = {
                    left: 0,
                    right: 0,
                    bottom: 0,
                    top: 0,
                }

                //DATA MESSAGE
                const dateMessage = {!! json_encode($arrayMesi) !!};
                const numMessage = [];
                const dateOfMessage = Object.keys(dateMessage);

                const maxDateMessage = new Date(Math.max(...dateOfMessage.map(d => new Date(`${d}-01`).getTime())));
                const minDateMessage = new Date(Math.min(...dateOfMessage.map(d => new Date(`${d}-01`).getTime())));
                const numYearsMessage = maxDateMessage.getFullYear() - minDateMessage.getFullYear() + 1;

                for (let y = 0; y < numYearsMessage; y++) {
                    const year = minDateMessage.getFullYear() + y;
                    const startMonth = y === 0 ? minDateMessage.getMonth() : 0;
                    const endMonth = y === numYearsMessage - 1 ? maxDateMessage.getMonth() : 11;

                    for (let m = startMonth; m <= endMonth; m++) {
                        const newDateString = `${year}-${String(m + 1).padStart(2, '0')}`;
                        if (!dateOfMessage.includes(newDateString)) {
                            dateOfMessage.push(newDateString);
                        }
                    }
                }

                dateOfMessage.sort();

                dateOfMessage.forEach(chiave => {
                    if (dateMessage[chiave]) {
                        numMessage.push(dateMessage[chiave]);
                    } else {
                        numMessage.push(0);
                    }
                });

                const dataAscisseMsg = dateOfMessage;
                const dataOrdinateMsg = [...numMessage, 10];
                const backgroundColorMsg = ['#D61C4E'];


                //DATA VIEWS

                const dateViews = {!! json_encode($arrayViewsMesi) !!};
                const numViews = [];
                const dateOfViews = Object.keys(dateViews);

                const maxDate = new Date(Math.max(...dateOfViews.map(d => new Date(`${d}-01`).getTime())));
                const minDate = new Date(Math.min(...dateOfViews.map(d => new Date(`${d}-01`).getTime())));
                const numYears = maxDate.getFullYear() - minDate.getFullYear() + 1;

                for (let y = 0; y < numYears; y++) {
                    const year = minDate.getFullYear() + y;
                    const startMonth = y === 0 ? minDate.getMonth() : 0;
                    const endMonth = y === numYears - 1 ? maxDate.getMonth() : 11;

                    for (let m = startMonth; m <= endMonth; m++) {
                        const newDateString = `${year}-${String(m + 1).padStart(2, '0')}`;
                        if (!dateOfViews.includes(newDateString)) {
                            dateOfViews.push(newDateString);
                        }
                    }
                }

                dateOfViews.sort();

                dateOfViews.forEach(chiave => {
                    if (dateViews[chiave]) {
                        numViews.push(dateViews[chiave]);
                    } else {
                        numViews.push(0);
                    }
                });

                const dataAscisseView = dateOfViews;
                const dataOrdinateView = [...numViews, 10];
                const backgroundColorView = ['#4bc0c0'];


                //OBJECT MESSAGE 
                const dataMsg = {
                    labels: dataAscisseMsg,
                    datasets: [{
                        label: 'Messages', //label della legenda
                        backgroundColor: backgroundColorMsg,
                        borderWidth: .3,
                        borderColor: '#000',
                        data: dataOrdinateMsg,
                        //hoverBorderWidth - hoverBorderColor
                    }]
                };

                const optionsMsg = {
                    responsive: true,
                    maintainAspectRatio: false,
                    // transitions: {
                    //     show: {
                    //         animations: {
                    //             x: {
                    //                 from: 0
                    //             },
                    //             y: {
                    //                 from: 0
                    //             }
                    //         }
                    //     },
                    // }
                    layout: {
                        padding: paddingLayout,
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        //Title
                        title: {
                            display: true,
                            text: 'Messages',
                            color: '#D61C4E',
                            font: {
                                size: 22,
                            },
                            padding: {
                                top: 10,
                                bottom: 5
                            }
                        },
                        //Subtitle
                        subtitle: {
                            display: true,
                            text: 'Here there are all your messages records',
                            color: '#000',
                            font: {
                                size: 14,
                                style: 'italic'
                            },
                            padding: {
                                bottom: 15,
                            }
                        },
                    }
                }

                //OBJECT VIEWS
                const dataView = {
                    labels: dataAscisseView,
                    datasets: [{
                        label: 'Views',
                        backgroundColor: backgroundColorView,
                        borderWidth: .3,
                        borderColor: '#000',
                        data: dataOrdinateView,
                    }]
                };
                const optionsView = {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: paddingLayout,
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        //Title
                        title: {
                            display: true,
                            text: 'Views',
                            color: '#4bc0c0',
                            font: {
                                size: 22,
                            },
                            padding: {
                                top: 10,
                                bottom: 5
                            }
                        },
                        //Subtitle
                        subtitle: {
                            display: true,
                            text: 'Here there are all your views record',
                            color: '#000',
                            font: {
                                size: 14,
                                style: 'italic'
                            },
                            padding: {
                                bottom: 15,
                            }
                        },
                    }
                };

                // CREAZIONE GRAFICI
                let newChartMsg = new Chart(chartMsg, {
                    type: 'bar',
                    data: dataMsg,
                    options: optionsMsg
                });
                let newChartView = new Chart(chartView, {
                    type: 'line',
                    data: dataView,
                    options: optionsView
                });
            </script>
        </div>
    </div>
@endsection
