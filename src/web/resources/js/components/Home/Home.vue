<template>
    <div>


        <div class="card">
            <div class="card-body">

                <nicoComicForm
                    v-model="formData"
                    v-on:onSearch="onSearch"
                >
                </nicoComicForm>
            </div>
        </div>


        <div v-show="loading" class="loader">Now loading...</div>
        <div v-show="!loading" class="itemContainer">
            <span>( 全 {{ laravelData.total }}件 )</span>
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

    </div>
</template>

<script>

    import {RepositoryFactory} from '../../repositories/RepositoryFactory';

    const nicoComicRepository = RepositoryFactory.get('nicoComic');
    const exclusionRepository = RepositoryFactory.get('exclusion');


    import nicoComicForm from './Form';
    import nicoComicList from './nicoComic/nicoComicList'
    import pagination from 'laravel-vue-pagination'


    export default {
        components: {
            'nicoComicForm': nicoComicForm,
            'nico-comic-list': nicoComicList,
            'pagination': pagination
        },
        data() {
            return {
                'user': [],
                'loading': true,
                'laravelData': {},
                "page": 1,
                "init": {},
                "formData": {
                    'word': "",
                    'tags': [config.USER_TAG],
                    'story_number_from': 1,
                    'nico_no': '',
                    'nico_no_from': '',
                    'nico_no_to': '',
                    'comic_update_date_from': '',
                    'comic_update_date_to': '',
                    'order': 'comic_update_date_desc',
                },
            }
        },
        created: function () {
            this.$nextTick(function () {
                // DOM が更新された後に呼ぶ
                this.onSearch();
            })
        },
        methods: {


            onSearch: function () {
                this.page = 1;

                console.log(this.formData);
                this.getNicoComicList();
            },


            getNicoComicList: function () {
                this.loading = true;
                let exclusionList = exclusionRepository.get();

                let params = {
                    ...this.formData,
                    "exclusionList": exclusionList,
                    "page": this.page
                };

                nicoComicRepository.get(params).then(response => {
                    console.log(response.data);
                    this.laravelData = response.data;
                    this.loading = false;

                }).catch(error => {
                    alert("読み込みに失敗しました");
                    // this.$emit('send-error', error);
                })
            },


            getResults(page = 1) {
                this.page = page;
                this.getNicoComicList();
            },

        }
    }


</script>
