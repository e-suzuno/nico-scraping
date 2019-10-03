<template>

    <div class="nico-comic-list__item">

        <div class="nico-comic-list__item__title">
            <a :href="item.url">[ {{item.nico_no}} ]
                {{item.title}}
            </a>
        </div>
        <div class="nico-comic-list__item__update_at">
            最終確認：{{item.updated_at}}
        </div>
        <div class="nico-comic-list__item__tags">
            <template v-for="(tag , tagindex) in item.has_tags">
                <span class="nico-comic-list__item__tag badge badge-secondary">{{ tag.label }}</span>
            </template>
        </div>
        <div class="nico-comic-list__item__info">
            <span class="badge badge-primary badge-pill">{{item.story_number}}話</span>
            [ <span class="comic_start_date">{{item.comic_start_date}}</span> => <span
            class="comic_update_date">{{item.comic_update_date}}</span> ]

        </div>
        <div class="nico-comic-list__item__description">
            {{item.description}}
        </div>
        <div class="nico-comic-list__item__update-speed">
            更新頻度:{{item.update_speed}}
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
            return {}
        },
        methods: {}
    }
</script>

<style scoped>

</style>
