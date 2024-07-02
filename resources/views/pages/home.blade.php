@extends('layouts.dashboard', ['title' => 'Inicio'])

@section('content')
    <section id="app-main-home">
        <div class="container">
            <div class="row">
                <h1 id="page-title">Início</h1>
                <p>Olá <strong>{{ decrypt_data(auth()->user()->firstname) }}</strong>, bem-vindo(a) de volta</p>
            </div>
            <div id="app-main-home-numbers" class="row mt-3">
                <section class="app-main-home-card">
                    <div class="row">
                        <h5>
                            <span><i class="ri ri-user-line"></i></span>
                            Clientes
                        </h5>
                        <small>Total de clientes registados</small>
                    </div>
                    <div class="row mt-2">
                        <h1>{{ $customers }}</h1>
                    </div>
                </section>
                <section class="app-main-home-card">
                    <div class="row">
                        <h5>
                            <span><i class="ri ri-mail-line"></i></span>
                            Campanhas
                        </h5>
                        <small>Total de campanhas registas</small>
                    </div>
                    <div class="row mt-2">
                        <h1>{{ $campaigns }}</h1>
                    </div>
                </section>
                <section class="app-main-home-card">
                    <div class="row">
                        <h5>
                            <span><i class="ri ri-chat-1-line"></i></span>
                            Mensagens
                        </h5>
                        <small>Total de mensagens</small>
                    </div>
                    <div class="row mt-2">
                        <h1>{{ $messages }}</h1>
                    </div>
                </section>
            </div>
            <div id="app-main-home-charts" class="row mt-3">
                <section class="app-main-home-card">
                    <div class="row mb-4">
                        <h5>
                            <span><i class="ri ri-smartphone-line"></i></span>
                            SMS enviados
                        </h5>
                        <small>Número de SMS enviados por mês</small>
                    </div>
                    <div class="row">
                        <canvas id="messages-sent-chart" width="800" height="280"></canvas>
                    </div>
                </section>
                <section class="app-main-home-card">
                    <div class="row mb-4">
                        <h5>
                            <span><i class="ri ri-mail-line"></i></span>
                            E-mails enviados
                        </h5>
                        <small>Número de e-mails enviados por mês</small>
                    </div>
                    <div class="row">
                        <canvas id="mails-sent-chart" width="800" height="280"></canvas>
                    </div>
                </section>
            </div>
            <div id="app-main-home-more" class="row mt-3 mb-5">
                <section class="app-main-home-card">
                    <div class="row">
                        <h5>
                            <span><i class="ri-nurse-line"></i></span>
                            Médicos ativos
                        </h5>
                        <small>Número total do médicos online</small>
                    </div>
                    <div class="row mt-4">
                        <canvas id="doctors-sent-chart" width="200" height="200"></canvas>
                    </div>
                </section>
                <section class="app-main-home-card">
                    <div class="row">
                        <h5>
                            <span><i class="ri-calendar-todo-line"></i></span>
                            Próximos aniversários
                        </h5>
                        <small>Aniversários durante os próximos 7 dias</small>
                    </div>
                    <div id="app-main-home-card-birthdays" class="row mt-2">
                        @forelse($birthdays as $birthday)
                            <div class="row">
                                <div class="col-md-1">
                                    <img
                                        src="https://img.freepik.com/premium-vector/portrait-young-man-with-beard-hair-style-male-avatar-vector-illustration_266660-423.jpg?w=2000"/>
                                </div>
                                <div class="col-md-5">
                                    {{ decrypt_data($birthday->name) }}
                                </div>
                                <div class="col-md-4">
                                    {{ date_format_trans($birthday->birthday, true) }}
                                </div>
                            </div>
                        @empty
                            <h6 class="mt-3">Não há aniversários amanhã</h6>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        // Messages Sent Chart
        new Chart(document.getElementById("messages-sent-chart"), {
            type: 'line',
            data: {
                labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                datasets: [{
                    borderWidth: 2,
                    borderSkipped: false,
                    data: [{{ $smsCounterPerMonth }}],
                    borderColor: 'rgba(127,17,224,1)',
                    fill: true,
                    backgroundColor: 'rgba(127,17,224,0.1)'
                }]
            },
            options: {
                animation: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            drawOnChartArea: true,
                            color: (context) => {
                                if (context.index === 0) return '';
                                else return 'rgba(102,102,102, 0)';
                            }
                        },
                        border: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(150,150,150,.2)'
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });

        // Mails sent charts
        new Chart(document.getElementById("mails-sent-chart"), {
            type: 'line',
            data: {
                labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                datasets: [{
                    borderWidth: 2,
                    borderSkipped: false,
                    data: [{{ $mailCounterPerMonth }}],
                    borderColor: "rgba(57, 149, 236, 1)",
                    backgroundColor: "rgba(57, 149, 236, 0.1)",
                    fill: true
                }]
            },
            options: {
                animation: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            drawOnChartArea: true,
                            color: (context) => {
                                if (context.index === 0) return '';
                                else return 'rgba(102,102,102, 0)';
                            }
                        },
                        border: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(150,150,150,.2)'
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });


        // Doctors online
        new Chart(document.getElementById("doctors-sent-chart"), {
            type: 'doughnut',
            data: {
                labels: ["Ativos", "Não ativos"],
                datasets: [{
                    borderWidth: 2,
                    borderSkipped: false,
                    data: [{{ $doctors }}],
                    backgroundColor: [
                        'rgba(46, 204, 113,.85)',
                        'rgba(231, 76, 60,.85)'
                    ],
                }]
            },
            options: {
                animation: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    datalabels: {
                        display: false
                    }
                }
            }
        });
    </script>
@endpush
