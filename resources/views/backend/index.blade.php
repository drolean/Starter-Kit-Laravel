@extends('layouts.backend')

@section('titulo')
Dashboard
@endsection

@section('conteudo')
    <div class="main-container">
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card card-inverse bg-info">
                    <div class="box text-center">
                        <h1 class="font-light text-white pb-2">2,064</h1>
                        <h6 class="text-white font-light">Sessions</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card card-primary bg-dark">
                    <div class="box text-center">
                        <h1 class="font-light text-white pb-2">1,738</h1>
                        <h6 class="text-white font-light">Users</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card card-inverse bg-success">
                    <div class="box text-center">
                        <h1 class="font-light text-white pb-2">5963</h1>
                        <h6 class="text-white font-light">Page Views</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card card-inverse bg-warning">
                    <div class="box text-center">
                        <h1 class="font-light text-white pb-2">10%</h1>
                        <h6 class="text-white font-light">Bounce Rate</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class=""><img src="{{ auth()->user()->gravatar }}" alt="user" class="rounded-circle"></div>
                            <div class="pl-20">
                                <h3 class="font-medium">Daniel Kristeen</h3>
                                <h6>UIUX Designer</h6>
                            </div>
                        </div>
                        <div class="row mt-30">
                            <div class="col b-r text-center">
                                <h2 class="font-light">14</h2>
                                <h6>Photos</h6></div>
                            <div class="col b-r text-center">
                                <h2 class="font-light">54</h2>
                                <h6>Videos</h6></div>
                            <div class="col text-center">
                                <h2 class="font-light">145</h2>
                                <h6>Tasks</h6></div>
                        </div>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            Lorem ipsum dolor sit ametetur adipisicing elit, sed do eiusmod tempor incididunt adipisicing elit, sed do eiusmod tempor incididunLorem ipsum dolor sit ametetur adipisicing elit, sed do eiusmod tempor incididuntt
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Feeds</h4>
                        <ul class="feeds">
                            <li>
                                 You have 4 pending tasks. <span class="text-muted">Just Now</span></li>
                            <li>
                                Server #1 overloaded.<span class="text-muted">2 Hours ago</span></li>
                            <li>
                                New order received.<span class="text-muted">31 May</span></li>
                            <li>
                                New user registered.<span class="text-muted">30 May</span></li>
                            <li>
                                New Version just arrived. <span class="text-muted">27 May</span></li>
                            <li>
                                You have 4 pending tasks. <span class="text-muted">Just Now</span></li>
                            <li>
                                New user registered.<span class="text-muted">30 May</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Browser Stats</h4>
                        <table class="table browser m-t-30 no-border">
                            <tbody>
                                <tr>
                                    <td style="width:40px"><img src="/static/img/icos/chrome-logo.png" alt="logo"></td>
                                    <td>Google Chrome</td>
                                    <td class="text-right"><span class="label label-light-info">23%</span></td>
                                </tr>
                                <tr>
                                    <td><img src="/static/img/icos/firefox-logo.png" alt="logo"></td>
                                    <td>Mozila Firefox</td>
                                    <td class="text-right"><span class="label label-light-success">15%</span></td>
                                </tr>
                                <tr>
                                    <td><img src="/static/img/icos/safari-logo.png" alt="logo"></td>
                                    <td>Apple Safari</td>
                                    <td class="text-right"><span class="label label-light-primary">07%</span></td>
                                </tr>
                                <tr>
                                    <td><img src="/static/img/icos/internet-logo.png" alt="logo"></td>
                                    <td>Internet Explorer</td>
                                    <td class="text-right"><span class="label label-light-warning">09%</span></td>
                                </tr>
                                <tr>
                                    <td><img src="/static/img/icos/opera-logo.png" alt="logo"></td>
                                    <td>Opera mini</td>
                                    <td class="text-right"><span class="label label-light-danger">23%</span></td>
                                </tr>
                                <tr>
                                    <td><img src="/static/img/icos/internet-logo.png" alt="logo"></td>
                                    <td>Microsoft edge</td>
                                    <td class="text-right"><span class="label label-light-megna">09%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Registro de Atividades</h5>
                        <div class="table-responsive mt-40">
                            <table class="table stylish-table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Atribuído</th>
                                        <th>Atividade</th>
                                        <th>Descrição</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:50px;"><span class="round">S</span></td>
                                        <td><h6>Sunil Joshi</h6><small class="text-muted">Web Designer</small></td>
                                        <td>Novo item</td>
                                        <td>Batatinha quando nasce espalha rama pelo chao...</td>
                                        <td>01/06/2017 18h32</td>
                                    </tr>
                                    <tr class="active">
                                        <td><span class="round">S</span></td>
                                        <td><h6>Andrew</h6><small class="text-muted">Project Manager</small></td>
                                        <td>Atualizou perfil</td>
                                        <td>Alterou seu sobrenome de "alfaiate" para "engraxate"</td>
                                        <td>01/06/2017 18h32</td>
                                    </tr>
                                    <tr>
                                        <td><span class="round round-success">B</span></td>
                                        <td><h6>Bhavesh patel</h6><small class="text-muted">Developer</small></td>
                                        <td>Solicitou pagamento</td>
                                        <td>Referente ao pedido #0123883 </td>
                                        <td>01/06/2017 18h32</td>
                                    </tr>
                                    <tr>
                                        <td><span class="round round-primary">N</span></td>
                                        <td>
                                            <h6>Nirav Joshi</h6><small class="text-muted">Frontend Eng</small></td>
                                        <td>Novo protocolo</td>
                                        <td>Estou com problema para inserção no sistema...</td>
                                        <td>01/06/2017 18h32</td>
                                    </tr>
                                    <tr>
                                        <td><span class="round round-warning">M</span></td>
                                        <td>
                                            <h6>Micheal Doe</h6><small class="text-muted">Content Writer</small></td>
                                        <td>Respondeu Ticket</td>
                                        <td>Estamos vizualisando o seu problema logo mais entraremos...</td>
                                        <td>01/06/2017 18h32</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quick Report</h5>
                        <div class="d-flex align-items-center flex-row mt-30">
                            <div>
                                <h3 class="mb-0">Segunda-feira</h3><small>10/10/2010</small>
                            </div>
                        </div>
                        <table class="table no-border">
                            <tbody><tr>
                                <td>Wind</td>
                                <td class="font-medium">ESE 17 mph</td>
                            </tr>
                            <tr>
                                <td>Humidity</td>
                                <td class="font-medium">83%</td>
                            </tr>
                            <tr>
                                <td>Pressure</td>
                                <td class="font-medium">28.56 in</td>
                            </tr>
                            <tr>
                                <td>Cloud Cover</td>
                                <td class="font-medium">78%</td>
                            </tr>
                            <tr>
                                <td>Ceiling</td>
                                <td class="font-medium">25760 ft</td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
