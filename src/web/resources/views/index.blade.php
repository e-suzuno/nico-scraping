@extends('layouts/app') @section('content')

    <!--
{{ app(\App\Repositories\NicoComic\NicoComicRepositoryInterface::class)->getMaxNicoNo() }} 番号まで取得してるよ
-->
    <div class="card">
        <div class="card-body">

        {!! Form::open( [ 'route' => 'index', 'method' => 'get' , 'id' => 'create', 'class'=> 'form-horizontal'] ) !!}

        <!-- タスク名 -->

            <div class="form-group">
                <div class="row">
                    <label for="title" class="col-sm-3 control-label">タイトル</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" id="title" class="form-control"
                               value="{{ $title ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="description" class="col-sm-3 control-label">description</label>
                    <div class="col-sm-9">
                        <input type="text" name="description" id="description" class="form-control"
                               value="{{ $description ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="tags" class="col-sm-3 control-label">タグリスト</label>
                    <div class="col-sm-9">
                        <select name="tags[]" class="select_tags" multiple>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="story_number_from" class="col-sm-3  control-label">話数制限</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="number" name="story_number_from" id="story_number_from" class="form-control"
                                   value="{{ $story_number_from ?? '' }}">
                            <div class="input-group-append">
                                <span class="input-group-text">話以上</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3  control-label">ニコのコミック番号</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="number" name="nico_no_from" id="nico_no_from" class="form-control"
                                   value="{{ $nico_no_from ?? '' }}">
                            <div class="input-group-append">
                                <span class="input-group-text">以上</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm4">
                        <div class="input-group">
                            <input type="number" name="nico_no_to" id="nico_no_to" class="form-control"
                                   value="{{ $nico_no_to ?? '' }}">
                            <div class="input-group-append">
                                <span class="input-group-text">以下</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- タスク追加ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">


                    {!! Form::select('order', [
                        'comic_update_date_desc' => '更新順',
                        'nico_no_desc' => 'NO 降順',
                        'story_number_desc' => '話数多い順',
                        ]    , $order ?? "") !!}


                    <button type="submit" class="btn btn-info">
                        <i class="fa fa-btn fa-plus"></i> 検索
                    </button>

                    <a href="/">リセット</a>


                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>


    <div class="card">


        <div class="card-body">

            ( 全{{ $nicoComics->total() }}件 )
            {{$nicoComics->appends(Request::all())->links()}}

            <ul class="nicoComicList">
                @foreach($nicoComics as $nicoComic)
                    <li class="nicoComicList__item">
                        <div class="nicoComicList__item__title">
                            <a href="{{ comic_url($nicoComic->nico_no) }}"> >>> </a>
                            {{$nicoComic->title}}
                        </div>
                        <div class="nicoComicList__item__update_at">
                            最終確認：{{$nicoComic->updated_at->format("Y年m月d日")}}
                        </div>
                        <div class="nicoComicList__item__tags">
                            @foreach($nicoComic->hasTags()  as $tag)
                                <span class="badge badge-secondary">{{ $tag->label }}</span>
                            @endforeach
                        </div>
                        <div class="nicoComicList__item__info">
                            <span class="badge badge-primary badge-pill">{{$nicoComic->story_number}}話</span>
                            [ <span class="comic_start_date">{{$nicoComic->comic_start_date}}</span> => <span
                                class="comic_update_date">{{$nicoComic->comic_update_date}}</span> ]
                        </div>
                        <div class="nicoComicList__item__description">
                            {{$nicoComic->description}}
                        </div>

                    </li>
                @endforeach
            </ul>


            {{$nicoComics->appends(Request::all())->links()}}
        </div>
    </div>
@stop

@section('scripts')
    @parent
    <script>
        'use strict';

        const tagIds = {!! json_encode( $tags ?? [] )  !!};
        const tags = {!! $tagList !!};

        $(function () {
            $('.select_tags').select2({
                width: "100%",
                data: tags.map(function (domain) {
                        return {id: domain.id, text: domain.label};
                    }
                )
            }).val(tagIds).trigger('change');
        });
    </script>
@endsection
