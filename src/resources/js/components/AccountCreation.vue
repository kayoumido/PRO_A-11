<template>
    <div class="container">
            <h2> {{ greetings }} </h2>
            <form class="form-group" @submit.prevent="onSubmit">
            <div class="ui input">
                <label for="fistname" > Username : </label>
                <input id="name" v-model="firstname" required>
            </div>

            <div class="ui input">
                <label for="lastname"> password : </label>
                <input id="name" v-model="lastname" required>
            </div>
            <div class="ui input">
                <label for="lastname"> password confirmation : </label>
                <input id="name" v-model="lastname" required>
            </div>

            
            <div class="ui primary button">
                <input type="submit" value="Submit">  
            </div>

            
        </form>
            

    </div>
</template>

<script>
    export default {
        data() {
            return {
                greetings: 'Please fill the followings',
                firstname: null,
                lastname: null,
            }
            
        },
        methods: {
                OnSubmit () {
                    let newAccount = {
                        firstname: this.firstname,
                        lastname: this.lastname
                    }
                }
        }
    };
</script>