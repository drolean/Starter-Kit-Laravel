@extends('layouts.backend')

@section('titulo')
Server Status
@endsection

@section('conteudo')
    <div class="main-container">
        <div class="row">
            <!-- System Information -->
            <div class="col-lg-4 mb-3">
                <div class="card ">
                    <h6 class="card-header">
                        System Information
                    </h6>

                    <div class="card-blaock">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>hostname</em></p>
                                    <p><strong>{{ gethostname() }}</strong></p>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>os</em></p>
                                    <p><strong>{{ $ServerInfo['NAME'] . ' ' . $ServerInfo['VERSION'] }}</strong></p>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>kernel</em></p>
                                    <p><strong>{{ \ServerInfo::getKernelVersion() }}</strong></p>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>uptime</em></p>
                                    <p><strong>{{ \ServerInfo::getUptime()->diffForHumans() }}</strong></p>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>last_boot</em></p>
                                    <p><strong>{{ \ServerInfo::getUptime()->toCookieString() }}</strong></p>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>server_date</em></p>
                                    <p><strong>{{ \Carbon\Carbon::now()->toCookieString() }}</strong></p>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- Last Login -->
            <div class="col-lg-4 mb-3">
                <div class="card ">
                    <h6 class="card-header">
                        Information
                    </h6>

                    <div class="card-blaock">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>php</em></p>
                                    <p><strong>{{ phpversion() }}</strong></p>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>mysql</em></p>
                                    <p><strong>{{ \ServerInfo::getMysqlVersion() }}</strong></p>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>nginx</em></p>
                                    <p><strong>{{ $_SERVER['SERVER_SOFTWARE'] }}</strong></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Memory -->

            </div>

            <div class="col-lg-4 mb-3">
                <div class="card">
                    <h6 class="card-header">
                        Ping
                    </h6>

                    <div class="card-blaock">
                        <ul class="list-group list-group-flush">
                        @foreach($Ping as $key => $ping)
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <p><em>{{ $key }}</em></p>
                                    <p><strong>{{ $ping }} ms</strong></p>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop