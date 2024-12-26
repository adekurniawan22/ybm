@extends('layout.main')
@section('content')
    <main class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route(session()->get('role') . '.dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="text-dark">Dashboard</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        @php
            $dashboardItems = [
                [
                    'title' => 'Proposal',
                    'value' => $jumlahProposal,
                    'icon' => 'bi bi-file-earmark-text',
                ],
                [
                    'title' => 'ZIS',
                    'value' => $jumlahZis,
                    'icon' => 'bi bi-hand-thumbs-up',
                ],
                [
                    'title' => 'Mitra',
                    'value' => $jumlahMitra,
                    'icon' => 'bi bi-person-lines-fill',
                ],
            ];
        @endphp

        <div class="row">
            @foreach ($dashboardItems as $item)
                <div class="col-xl-4 col-md-6">
                    <div class="card radius-10 bg-purple-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-dark">Jumlah {{ $item['title'] }}</p>
                                    <h4 class="my-1 text-dark">{{ $item['value'] }}</h4>
                                </div>
                                <div class="text-dark ms-auto font-35">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
