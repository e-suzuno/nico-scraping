<template>
    <div class="exclusion-item" v-show="show">


        <div v-show="loading" class="loader"></div>
        <div v-show="!loading" class="itemContainer">
            <span>
                {{this.data.title}}
            </span>
            <button class="btn btn-danger" @click="exclusionReturn">
                除去
            </button>
        </div>
    </div>
</template>

<script>

    import {RepositoryFactory} from '../../repositories/RepositoryFactory';

    const exclusionRepository = RepositoryFactory.get('exclusion');
    const nicoComicRepository = RepositoryFactory.get('nicoComic');


    export default {
        props: ["id", "index"],
        data() {
            return {
                "show": true,
                "loading": false,
                "data": [],
            }
        },
        watch: {
            id: (newId) => {
                this.getData();
            }
        },
        created: function () {
            this.$nextTick(function () {
                this.getData();
            })
        },
        computed: {},
        methods: {
            getData() {
                this.loading = true;
                nicoComicRepository.show(this.id).then(response => {
                    this.data = response.data;
                    this.loading = false;
                    this.$emit('loadingComplete', true)
                }).catch(error => {
                    alert("読み込みに失敗しました");
                    // this.$emit('send-error', error);
                })

            },
            exclusionReturn() {
                this.show = false;
                this.$emit('exclusionReturn', this.data.nico_no)
            }
        }
    }
</script>
