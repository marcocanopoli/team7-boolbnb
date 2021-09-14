@extends('layouts.app')
@dump($messages)

@section('content')
    <section class="container">
        <div class="row">
            <h1 class="h1">here a chart js</h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading my-2">Chart Demo</div>
                              <div class="col-lg-8">
                                <canvas id="userChart" class="rounded shadow"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection