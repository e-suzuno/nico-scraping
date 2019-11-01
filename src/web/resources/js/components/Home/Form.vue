<template>
    <div class="home-form">

        <div class="form-group">
            <div class="row">
                <label for="title" class="col-sm-3 control-label">検索ワード</label>
                <div class="col-sm-9">
                    <input type="text" name="word" id="word" class="form-control"
                           v-model="internalValue.word"
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
                        <select2 :options="tagOptions" v-model="internalValue.tags" class="form-control" multiple>
                            <option disabled value="0">Select one</option>
                        </select2>
                    </template>
                    <template v-else-if="select_type_toggle == 'checkbox'">
                        <label v-for="option in tagOptions">
                            <input type="checkbox" :id="option.value" v-bind:value="option.id"
                                   v-model="internalValue.tags">
                            {{ option.text }}
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
                        <input type="number" name="story_number_from" id="story_number_from"
                               class="form-control"
                               v-model="internalValue.story_number_from">
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
                               v-model="internalValue.nico_no">
                    </div>
                </template>
                <template v-else-if="nico_no_form_type==2">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="number" name="nico_no_from" id="nico_no_from" class="form-control"
                                   v-model="internalValue.nico_no_from">
                            <div class="input-group-append">
                                <span class="input-group-text">以上</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="number" name="nico_no_to" id="nico_no_to" class="form-control"
                                   v-model="internalValue.nico_no_to">
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
                           v-model="internalValue.comic_update_date_from">
                </div>
                <div class="col-sm-1">
                    ～
                </div>
                <div class="col-sm-3">
                    <input type="date" name="comic_update_date_to" id="comic_update_date_to"
                           class="form-control"
                           v-model="internalValue.comic_update_date_to">
                </div>

            </div>
        </div>


        <!-- タスク追加ボタン -->
        <div class="form-group">
            <div class="row">
                <div class="offset-sm-3 col-sm-3">
                    <select name="tag" v-model="internalValue.order" class='form-control'>
                        <option v-for="option in orderSelectOptions" v-bind:value="option.id">
                            {{ option.name }}
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
</template>


<script>

    import {RepositoryFactory} from '../../repositories/RepositoryFactory';
    import select2 from '../../constants/select2'


    const tagRepository = RepositoryFactory.get('tag');

    const order_select_options = [
        {id: 'comic_update_date_desc', name: '更新順',},
        {id: 'nico_no_desc', name: 'NO 降順',},
        {id: 'story_number_desc', name: '話数多い順',},
        {id: 'updated_at_desc', name: '最終取得順',},
        {id: 'random', name: 'ランダム（仮）'}
    ];


    export default {
        components: {
            'select2': select2,
        },
        created: function () {
            this.$nextTick(function () {
                // DOM が更新された後に呼ぶ
                this.getTagList();
            })
        },
        props: [
            'value',
        ],
        data() {
            return {
                'tags': [],
                'select_type_toggle': "select",
                'nico_no_form_type': 1,
            }
        },
        watch: {},
        computed: {
            // 算出 getter 関数
            tagOptions: function () {
                return this.tags.map(function (domain) {
                    return {id: domain.id, text: domain.label};
                });
            },
            orderSelectOptions: function () {
                return order_select_options;
            },

            internalValue: {
                get () {
                    return this.value
                },
                set (newVal) {
                    if (this.value !== newVal) this.$emit('input', newVal)
                }
            }
        },
        methods: {
            getTagList: function () {

                tagRepository.get().then(response => {
                    console.log(response.data);
                    this.tags = response.data;
                    this.loading = false;
                }).catch(error => {
                    alert("読み込みに失敗しました");
                    // this.$emit('send-error', error);
                })
            },
            initParams: function () {
                this.internalValue = {...this.init};
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
                this.internalValue.nico_no = "";
                this.internalValue.nico_no_from = "";
                this.internalValue.nico_no_to = "";
                return;
            },

            onSearch(){
                this.$emit('onSearch')
            },
            randomSearch() {

                this.internalValue = {
                    'word': "",
                    'tags': [ config.USER_TAG ],
                    'story_number_from': 10,
                    'nico_no_from': '',
                    'nico_no_to': '',
                    'nico_no': '',
                    'order': 'random',
                }

                this.internalValue.story_number_from = Math.floor(Math.random() * 15);
                this.internalValue.nico_no_from = Math.floor(Math.random() * config.MAX_NICO_NO);
                this.internalValue.nico_no_to = this.internalValue.nico_no_from + 1500;

                this.nico_no_form_type = 2;
                this.onSearch();
            }
        }
    }
</script>
