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
        $jsonString = json_encode($dailyMessage);
    @endphp
    <div class="container">
        <div class="row mt-5 d-flex justify-content-center">

            {{-- Back to all---->CAMBIO HREF-ROUTE --}}
            <div class="col-10">
                <div class="text-end">
                    <a href="{{ route('admin.report') }}" class="btn btn-outline-secondary">Back to all reports</a>
                </div>
            </div>
            {{-- Back to all --}}

            {{-- Title ---->CAMBIO <h2> NOME APARTMENT --}}
            <div class="col-12 d-flex justify-content-center">
                <div class="text-center border-bottom border-2 w-75">
                    <h5 class="fs-6 fw-lighter">REPORT</h5>
                    <h2 class="fs-2 fw-bold">{{ $apartment->title }}</h2>
                    <p class="fs-6 fw-light">Here you can see all your graphs</p>
                </div>
            </div>
            {{-- / Title --}}

            {{-- Grafici --}}
            <div class="col-10 ">
                {{-- Message --}}
                <section class="border-bottom border-2 pb-5">
                    <div>
                        <canvas id="msgChart"></canvas>
                    </div>
                </section>
                {{-- View --}}
                <section class="border-bottom border-2 pb-5"">
                    <div>
                        <canvas id="viewChart"></canvas>
                    </div>
                </section>
            </div>
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
                    left: 20,
                    right: 20,
                    bottom: 20,
                    top: 20,
                }

                //DATA MESSAGE
                const dateMessage = {!! json_encode($dailyMessage) !!};
                // const dateMessage = Object.keys(dateMessage);
                const raggruppatiPerMese = {};


                Object.keys(dateMessage).forEach((chiave) => {
                    const data = new Date(chiave);
                    const mese = data.getMonth();

                    if (!raggruppatiPerMese[mese]) {
                        raggruppatiPerMese[mese] = {};
                    }

                    raggruppatiPerMese[mese][chiave] = dateMessage[chiave];
                });

                console.log(raggruppatiPerMese);

                const dataAscisseMsg = [""];
                const dataOrdinateMsg = [15, 10, 5, 2, 20, 30, 40];
                const backgroundColorMsg = ['#ff6385e4'];
                //DATA VIEWS
                const dataAscisseView = ['Lun', 'Mart', 'Mer', 'Gio', 'Ven'];
                const dataOrdinateView = [200, 50, 100, 150, 230, 300, 350];
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
                            color: '#ff6384',
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
