<template>

    <div class="nico-comic-list__item">

        <template v-if="this.exclusion">
            除外されました。
        </template>
        <template v-else>
            <div class="nico-comic-list__item__title">
                <a :href="data.url"
                   target="_blank"
                   rel="noopener">[ {{data.nico_no}} ]
                    {{data.title}}
                </a>
                <button @click="pushFavorite()" type="button" class="btn btn-success rounded-circle p-0"
                        style="width: 1.1rem;height: 1.1rem;font-size: 0.5rem;">＋</button>
                <button @click="addExclusionList()" type="button" class="btn btn-danger rounded-circle p-0"
                         style="width: 1.1rem; height: 1.1rem;font-size: 0.5rem;">‐</button>
            </div>
            <div class="nico-comic-list__item__update_at">
                最終確認：{{data.updated_at}}
            </div>
            <div class="nico-comic-list__item__tags">
                <template v-for="(tag , tagindex) in data.has_tags">
                    <nico-comic-tag :tag="tag"></nico-comic-tag>
                </template>
            </div>
            <div class="nico-comic-list__item__info">
                <span class="badge badge-primary badge-pill">{{data.story_number}}話</span>
                [ <span class="comic_start_date">{{data.comic_start_date}}</span> => <span class="comic_update_date">{{data.comic_update_date}}</span> ]
            </div>
            <div class="nico-comic-list__item__description">
                {{data.description}}
            </div>
            <div class="nico-comic-list__item__update-speed">
                更新頻度:{{data.update_speed}}
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        name: "nicoComicItem",
        props: [
            'item',
        ],
        data() {
            return {
                data: this.item,
                exclusion: false,
            }
        },
        watch: {
            item: function (val) {
                this.data = val;
                this.exclusion = false;
            },
        },
        methods: {
            addExclusionList() {
                //除外
                if (confirm("除外しますか？") === true) {
                    alert("除外リストに追加しました。");
                    exclusionStore.addExclusionList(this.data.nico_no);
                    this.exclusion = true;
                }
            },
            pushFavorite() {
                let params = {
                    "no": this.data.nico_no,
                };
                axios.post(config.ADD_TAG_URL, params).then(response => {
                    console.log(response.data);
                    this.data = response.data.item;
                }).catch(error => {
                    alert("読み込みに失敗しました");
                })

            }

        }
    }
</script>

<style scoped>

</style>
