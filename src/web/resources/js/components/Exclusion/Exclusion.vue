<template>
    <div class="exclusion">
        <div class="card">
            <div class="card-header">
                除外リスト
            </div>
            <div class="card-body">
                <p>
                    現在の合計除外リスト： {{ exclusionList.length }}件
                </p>
                <button class="btn btn-danger" @click="remove()">除外リストをクリアする</button>
            </div>
        </div>
    </div>
</template>

<script>

    import {RepositoryFactory} from '../../repositories/RepositoryFactory';
    const exclusionRepository = RepositoryFactory.get('exclusion');


    export default {

        data() {
            return {
                'exclusionList': exclusionRepository.get(),
            }
        },

        created: function () {
            this.$nextTick(function () {

            })
        },

        computed: {},
        methods: {
            remove() {
                if (confirm("除外リストをクリアしますか？") === true) {
                    exclusionRepository.destroy();
                    this.exclusionList = exclusionRepository.get();
                    alert("除外リストをクリアしました。");
                }
            },

        }
    }
</script>
