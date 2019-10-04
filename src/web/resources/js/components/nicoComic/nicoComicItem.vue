<template>

    <div class="nico-comic-list__item">

        <div class="nico-comic-list__item__title">
            <a :href="data.url">[ {{data.nico_no}} ]
                {{data.title}}
            </a>
        </div>
        <div class="nico-comic-list__item__update_at">
            最終確認：{{data.updated_at}}
        </div>
        <div class="nico-comic-list__item__tags">
            <template v-for="(tag , tagindex) in data.has_tags">
                <span :class="`nico-comic-list__item__tag badge ` + tag_class(tag) ">{{ tag.label }}</span>
            </template>
            <span @click="pushFavorite()" class="btn-outline-success">＋お気に入り</span>
        </div>
        <div class="nico-comic-list__item__info">
            <span class="badge badge-primary badge-pill">{{data.story_number}}話</span>
            [ <span class="comic_start_date">{{data.comic_start_date}}</span> => <span
            class="comic_update_date">{{data.comic_update_date}}</span> ]
        </div>
        <div class="nico-comic-list__item__description">
            {{data.description}}
        </div>
        <div class="nico-comic-list__item__update-speed">
            更新頻度:{{data.update_speed}}
        </div>
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
                data : this.item,
            }
        },
        watch: {
            item: function (val) {
                this.data = val;
            },
        },
        methods: {
            tag_class(tag) {
                if (tag.tag_type_id == 4) {
                    return "badge-success";
                }
                if (tag.tag_type_id == 3) {
                    return "badge-info";
                }
                return "badge-secondary";
            },
            pushFavorite() {
                let params = {
                    "no": this.data.nico_no,
                    "tag_id": config.FAVORITE_TAG_ID,
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
