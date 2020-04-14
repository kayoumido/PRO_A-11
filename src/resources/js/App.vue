<template>
    <div id="app" class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/hello" class="nav-item nav-link">Home</router-link>
                    <router-link to="/authentication" class="nav-item nav-link">Authentication</router-link>
                    <router-link to="/User/edit" class="nav-item nav-link">Modifier mon compte</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {}
</script>
