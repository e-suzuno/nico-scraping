<template>
    <div>
        <header>
            <navbar></navbar>
        </header>

        <div class="container">
            <router-view></router-view>
        </div>

        <footer>
            <div class="container">
                <p class="pull-right">Copyright ©</p>
            </div>
        </footer>
    </div>
</template>




<script>
    import Navbar from './Navbar.vue'

    export default {

        components: {
            'navbar': Navbar
        },

        created() {
        },
        data() {
            return {
            }
        },
        watch: {},
        computed: {},
        methods: {}
    }
</script>
