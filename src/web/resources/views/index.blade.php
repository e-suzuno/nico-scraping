@extends('layouts/app') @section('content')


    <div class="card">
        <div class="card-body">

        {!! Form::open( [ 'route' => 'index', 'method' => 'get' , 'id' => 'create', 'class'=> 'form-horizontal'] ) !!}
        {{ Form::close() }}

        <!-- タスク名 -->

            <div class="form-group">
                <div class="row">
                    <label for="title" class="col-sm-3 control-label">検索ワード</label>
                    <div class="col-sm-9">
                        <input type="text" name="word" id="word" class="form-control"
                               v-model="form.word"
                        >
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <label for="tags" class="col-sm-3 control-label">
                        タグリスト
                        <br>
                        <a href="#" @click="tagSelectTypeToggle()">選択タイプの変更</a>
                    </label>

                    <div class="col-sm-9">
                        <template v-if="select_type_toggle == 'select'">
                            <select2 :options="tag_options" v-model="form.tags" class="form-control" multiple>
                                <option disabled value="0">Select one</option>
                            </select2>
                        </template>
                        <template v-else-if="select_type_toggle == 'checkbox'">
                            <label v-for="option in tag_options">
                                <input type="checkbox" :id="option.value" v-bind:value="option.id" v-model="form.tags">
                                @{{ option.text }}
                            </label>
                        </template>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="story_number_from" class="col-sm-3  control-label">掲載数</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="number" name="story_number_from" id="story_number_from" class="form-control"
                                   v-model="form.story_number_from">
                            <div class="input-group-append">
                                <span class="input-group-text">話以上</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">
                        コミック番号
                        <a href="#" @click="nicoNoFormType()">指定変更</a>
                    </label>
                    <template v-if="nico_no_form_type==1">
                        <div class="col-sm-3">
                            <input type="number" name="nico_no" id="nico_no" class="form-control"
                                   v-model="form.nico_no">
                        </div>
                    </template>
                    <template v-else-if="nico_no_form_type==2">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="number" name="nico_no_from" id="nico_no_from" class="form-control"
                                       v-model="form.nico_no_from">
                                <div class="input-group-append">
                                    <span class="input-group-text">以上</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="number" name="nico_no_to" id="nico_no_to" class="form-control"
                                       v-model="form.nico_no_to">
                                <div class="input-group-append">
                                    <span class="input-group-text">以下</span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <label class="col-sm-3 control-label">
                        最終更新日時
                    </label>

                    <div class="col-sm-3">
                        <input type="date" name="comic_update_date_from" id="comic_update_date_from"
                               class="form-control"
                               v-model="form.comic_update_date_from">
                    </div>
                    <div class="col-sm-1">
                        ～
                    </div>
                    <div class="col-sm-3">
                        <input type="date" name="comic_update_date_to" id="comic_update_date_to"
                               class="form-control"
                               v-model="form.comic_update_date_to">
                    </div>

                </div>
            </div>


            <!-- タスク追加ボタン -->
            <div class="form-group">
                <div class="row">
                    <div class="offset-sm-3 col-sm-3">
                        <select name="tag" v-model="form.order" class='form-control'>
                            <option v-for="option in order_select_options" v-bind:value="option.id">
                                @{{ option.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-info" @click="onSearch">
                            <i class="fa fa-btn fa-plus"></i> 検索
                        </button>


                        <button class="btn btn-warning" @click="initParams">
                            リセット
                        </button>

                        <button class="btn btn-dark" @click="randomSearch">
                            <i class="fa fa-btn fa-plus"></i> ランダムサーチ
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div v-show="loading" class="loader">Now loading...</div>
    <div v-show="!loading" class="itemContainer">
        <span>( 全 @{{ laravelData.total }}件 )</span>
        <pagination :data="laravelData" @pagination-change-page="getResults"
                    :limit="3">
            <span slot="prev-nav">&lt&lt</span>
            <span slot="next-nav">&gt;&gt;</span>
        </pagination>
        <div class="card">
            <div class="card-body">
                <nico-comic-list
                    :value="laravelData.data"
                    :user="user"
                ></nico-comic-list>
            </div>
        </div>

        <pagination :data="laravelData" @pagination-change-page="getResults"
                    :limit="3">
            <span slot="prev-nav">&lt&lt</span>
            <span slot="next-nav">&gt;&gt;</span>
        </pagination>

    </div>

@stop


@section('scripts')
    @parent
    <script>
        'use strict';


        const tags = {!! json_encode($tagList) !!};
        const order_select_options = [
            {id: 'comic_update_date_desc', name: '更新順',},
            {id: 'nico_no_desc', name: 'NO 降順',},
            {id: 'story_number_desc', name: '話数多い順',},
            {id: 'update_speed_asc', name: '更新頻度早い順',},
        ];

            @guest
        const user = Object.freeze( {!! new \App\Models\User() !!});
            @else
        const user = Object.freeze( {!! \Illuminate\Support\Facades\Auth::user() !!} );
            @endguest



        const tag_options = tags.map(function (domain) {
                return {id: domain.id, text: domain.label};
            }
            );


        var local = new Vue({
            components: {},
            el: '#app',
            data: {
                'loading': true,
                'laravelData': {},
                'user': user,
                'tag_options': tag_options,
                'order_select_options': order_select_options,
                'uri': "{{route("search-api")}}",
                'select_type_toggle': "select",
                'nico_no_form_type': 1,
                "form": {
                    'word': "",
                    'tags': [],
                    'story_number_from': 1,
                    'nico_no': '',
                    'nico_no_from': '',
                    'nico_no_to': '',
                    'comic_update_date_from': '',
                    'comic_update_date_to': '',
                    'order': 'comic_update_date_desc',
                },
                "init": {},
            },
            created: function () {
                this.$nextTick(function () {
                    // DOM が更新された後に呼ぶ
                    this.init = {...this.form};
                    this.onSearch();
                })
            },
            computed: {
                pages() {
                    let start = _.max([this.current_page - 2, 1])
                    let end = _.min([start + 5, this.last_page + 1])
                    start = _.max([end - 5, 1])
                    return _.range(start, end)
                },
            },
            methods: {
                onSearch: function () {
                    this.post(this.uri);
                },
                initParams: function () {
                    this.form = {...this.init};
                },
                post: function (uri) {
                    this.loading = true;

                    let exclusionList = exclusionStore.getExclusionList();

                    let params = {
                        ...this.form,
                        "exclusionList": exclusionList
                    };


                    axios.post(uri, params).then(response => {
                        console.log(response.data);
                        this.laravelData = response.data;
                        this.loading = false;

                    }).catch(error => {
                        alert("読み込みに失敗しました");
                        // this.$emit('send-error', error);
                    })
                },
                getResults(page = 1) {
                    let uri = this.uri + "?page=" + page;
                    this.post(uri);
                },
                tagSelectTypeToggle() {
                    if (this.select_type_toggle == "select") {
                        this.select_type_toggle = "checkbox";
                    } else if (this.select_type_toggle == "checkbox") {
                        this.select_type_toggle = "select";
                    }
                },
                nicoNoFormType() {
                    if (this.nico_no_form_type == 2) {
                        this.nico_no_form_type = 1;
                    } else if (this.nico_no_form_type == 1) {
                        this.nico_no_form_type = 2;
                    }
                    this.form.nico_no = "";
                    this.form.nico_no_from = "";
                    this.form.nico_no_to = "";
                    return;
                },

                // おすすめ検索（謎）
                recommendedSearch() {
                    this.form = {
                        'word': "-艦これ -艦娘 -艦隊これくしょん -けもフレ -東方 -FGO",
                        'tags': [ {{\App\Constants\TagConstant::USER}}],
                        'story_number_from': 10,
                        'nico_no_from': '',
                        'nico_no_to': '',
                        'nico_no': '',
                        'order': 'comic_update_date_desc',
                    }
                    this.onSearch();
                },
                randomSearch() {
                    this.form = {
                        'word': "",
                        'tags': [ {{\App\Constants\TagConstant::USER}}],
                        'story_number_from': 10,
                        'nico_no_from': '',
                        'nico_no_to': '',
                        'nico_no': '',
                        'order': 'comic_update_date_desc',
                    }

                    this.form.story_number_from = Math.floor(Math.random() * 26);
                    this.form.nico_no_from = Math.floor(Math.random() * {{ $nicoComicMaxNicoNo+1 }});
                    this.form.nico_no_to = this.form.nico_no_from + 1000;


                    this.onSearch();
                },

            }
        });


    </script>
@endsection
