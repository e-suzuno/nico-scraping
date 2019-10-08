@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    <p>
                        一回に取得する件数：{{ config('my-app.nico-scraping-count')}}
                    </p>
                    <p>
                        現在のスレイピング最終ＮＯ：{{$scraping_num }}
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
