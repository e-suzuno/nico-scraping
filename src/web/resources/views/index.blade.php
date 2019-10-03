@extends('layouts/app') @section('content')

    <!--
{{ app(\App\Repositories\NicoComic\NicoComicRepositoryInterface::class)->getMaxNicoNo() }} 番号まで取得してるよ
-->
    <div class="card">
        <div class="card-body">

        {!! Form::open( [ 'route' => 'index', 'method' => 'get' , 'id' => 'create', 'class'=> 'form-horizontal'] ) !!}
        {{ Form::close() }}

        <!-- タスク名 -->

            <div class="form-group">
                <div class="row">
                    <label for="title" class="col-sm-3 control-label">タイトル</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" id="title" class="form-control"
                               v-model="form.title"
                        >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <label for="description" class="col-sm-3 control-label">description</label>
                    <div class="col-sm-9">
                        <input type="text" name="description" id="description" class="form-control"
                               v-model="form.description">
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
                    <label for="story_number_from" class="col-sm-3  control-label">話数制限</label>
                    <div class="col-sm-9">
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
                    <label class="col-sm-3  control-label">ニコのコミック番号</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="number" name="nico_no_from" id="nico_no_from" class="form-control"
                                   v-model="form.nico_no_from">
                            <div class="input-group-append">
                                <span class="input-group-text">以上</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm4">
                        <div class="input-group">
                            <input type="number" name="nico_no_to" id="nico_no_to" class="form-control"
                                   v-model="form.nico_no_to">
                            <div class="input-group-append">
                                <span class="input-group-text">以下</span>
                            </div>
                        </div>
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


                        <a href="/">リセット</a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="card">


        <div class="card-body">
            <div v-show="loading" class="loader">Now loading...</div>
            <div v-show="!loading" class="itemContainer">

                <pagination :data="laravelData" @pagination-change-page="getResults"
                            :limit="4">
                    <span slot="prev-nav">&lt; 前へ</span>
                    <span slot="next-nav">次へ &gt;</span>
                </pagination>

                <span>( 全 @{{ laravelData.total }}件 )</span>

                <nico-comic-list
                    :value="laravelData.data"
                ></nico-comic-list>

                <pagination :data="laravelData" @pagination-change-page="getResults"
                            :limit="4">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </pagination>

            </div>
        </div>
    </div>
@stop


@section('scripts')
    @parent
    <script>
        'use strict';


        const tags = {!! $tagList !!};
        const order_select_options = [
            {id: 'comic_update_date_desc', name: '更新順',},
            {id: 'nico_no_desc', name: 'NO 降順',},
            {id: 'story_number_desc', name: '話数多い順',},
        ];

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
                'tag_options': tag_options,
                'order_select_options': order_select_options,
                'uri': "{{route("search-api")}}",
                'select_type_toggle': "select",
                "form": {
                    'title': "",
                    'description': "",
                    'tags': [],
                    'story_number_from': "",
                    'nico_no_from': '',
                    'nico_no_to': '',
                    'order': 'comic_update_date_desc',
                }
            },
            created: function () {
                this.$nextTick(function () {
                    // DOM が更新された後に呼ぶ
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
                onSearch: function (uri) {
                    this.post(this.uri);
                },
                post: function (uri) {
                    this.loading = true;
                    let params = {...this.form};

                    axios.post(uri, params).then(response => {
                        console.log(response.data);
                        this.laravelData = response.data;
                        this.loading = false;

                    }).catch(error => {
                        7
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
                }
            }
        });


    </script>
@endsection
