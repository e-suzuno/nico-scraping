<template>
    <div class="exclusion">
        <div class="card">
            <div class="card-header">
                除外リスト
            </div>
            <div class="card-body">
                <p>除外リスト</p>

                <div v-show="exclusionList.length  !== loadingCompleteCount">
                    読み込み中
                </div>
                <div v-show="exclusionList.length  === loadingCompleteCount">
                    <button class="btn btn-danger" @click="remove()">除外リストをクリアする</button>
                    <p>
                        現在の合計除外リスト： {{ exclusionListCount }}件
                    </p>
                    <ul class="nico-comic-list">
                        <li v-for="(id ,index) in list" style="padding:3px; border-bottom: 1px solid #ccc;">
                            <exclusion-item
                                :id="id"
                                :index="index"
                                v-on:exclusionReturn="exclusionReturn"
                                v-on:loadingComplete="loadingCompleteReturn"
                            ></exclusion-item>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

    import {RepositoryFactory} from '../../repositories/RepositoryFactory';

    const exclusionRepository = RepositoryFactory.get('exclusion');

    import ExclusionItem from "./ExclusionItem"

    export default {
        components: {
            'exclusion-item': ExclusionItem,
        },
        data() {
            return {
                'exclusionList': exclusionRepository.get(),
                'exclusionListCount': 0,
                'loadingCompleteCount': 0,
            }
        },

        created: function () {
            this.$nextTick(function () {
                this.exclusionListCount = this.exclusionList.length;
            })
        },
        watch: {
            exclusionList: () => {

            }
        },
        computed: {
            list: function () {
                return this.exclusionList;
            }
        },
        methods: {
            remove() {
                if (confirm("除外リストをクリアしますか？") === true) {
                    exclusionRepository.destroy();
                    this.exclusionList = exclusionRepository.get();
                    alert("除外リストをクリアしました。");
                }
            },
            exclusionReturn(nico_no) {
                if (confirm("除外リストから外しますか？") === true) {
                    exclusionRepository.splice(nico_no);
                    alert("検索に復帰しました。");
                    this.exclusionListCount--;
                }
            },
            loadingCompleteReturn() {
                this.loadingCompleteCount++;
            }
        }
    }
</script>
