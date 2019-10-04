<template>
    <span :class="`nico-comic-list__item__tag badge ` + tag_class() ">{{ tag.label }}</span>
</template>

<script>
    export default {
        name: "Tag",
        props: [
            'tag',
        ],
        methods: {
            tag_class() {
                if (this.tag.id == 15) {
                    return "badge-complete";
                }
                if (this.tag.tag_type_id == 4) {
                    return "badge-success";
                }
                if (this.tag.tag_type_id == 3) {
                    return "badge-info";
                }

                if (this.tag.tag_type_id == 100) {
                    return "badge-official-comic";
                }
                return "badge-secondary";
            },
        }
    }
</script>

<style scoped>

</style>
