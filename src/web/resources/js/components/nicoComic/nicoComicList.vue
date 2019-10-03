<template>
    <ul class="nico-comic-list">
        <li v-for="(item ,key) in value">
            <nico-comic-item
                :item="item"></nico-comic-item>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "nicoComicList",
        props: [
            'value',
        ],
        data() {
            return {}
        },
        methods: {}
    }
</script>

<style scoped>

</style>
