<template>
    <ul class="nico-comic-list">
        <li v-for="(item ,key) in value">
            <nico-comic-item
                :item="item"
                :user="user"></nico-comic-item>
        </li>
    </ul>
</template>

<script>

    import nicoComicItem from './nicoComicItem'
    export default {
        name: "nicoComicList",
        components: {
            'nico-comic-item': nicoComicItem,
        },
        props: [
            'value',
            'user',
        ],
        data() {
            return {}
        },
        methods: {}
    }
</script>

<style scoped>

</style>
