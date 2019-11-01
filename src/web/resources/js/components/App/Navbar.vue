<template>
    <div>
        <header>
            <!-- As a link -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">



                <router-link to="/" class="navbar-brand">静画掘り出し君　てすとばん</router-link>



                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <router-link to="/" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/about" class="nav-link">about</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/exclusion" class="nav-link">exclusion</router-link>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                    </ul>

                </div>
            </nav>
        </header>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        methods: {
        },
    }
</script>
