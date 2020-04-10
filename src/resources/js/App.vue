<template>
    <div id="app" class="container">
        <div class="container">
            <p v-if="isLogged">{{username}}</p>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/hello" class="nav-item nav-link">Home</router-link>
                    <router-link to="/authentication" class="nav-item nav-link" >Authentication</router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view @login-successfull="updateLogin"></router-view>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data () {
            return{
                username: "",
                isLogged: false
            }

        },
        methods:{
            updateLogin(username){
                this.username=username;
                this.isLogged =true;
            }
        }
    }
</script>
