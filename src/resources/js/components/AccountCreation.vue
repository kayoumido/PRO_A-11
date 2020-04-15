<template>
  <div>
    <p class="title">PAUL</p>
    <form @submit.prevent="register" method="post">
      <div class="form-group">
        <input type="text" class="input" name="username" v-model="input.username" placeholder="Nom d'utilisateur" />
      </div>
      <div class="form-group">
        <input type="email" class="input" name="email" v-model="input.email" placeholder="email" />
      </div>
      <div class="form-group">
        <input type="password" class="input" name="password" v-model="input.password" placeholder="Mot de passe" />
      </div>
      <div class="form-group">
        <input type="password" class="input" name="passwordConfirm" v-model="input.passwordConfirm" placeholder="Confirmer mot de passe" />
      </div>
      <div class="form-group">
        <button type="button" class="button" v-on:click="register()">Créer compte</button>
      </div>
      
      <p v-if="isBlank"> Manque des informations</p>
      <p v-if="isIncorect"> mot de passe différent</p>
    </form>
  </div>
</template>

<script>
    import axios from 'axios'
    import router from '../routes'

    export default {
    name : 'Register',
    data () {
        return{
          input: {
              username: '',
              email: '',
              password: '',
              passwordConfirm: ''
          },
      isBlank: false,
      isIncorect: false}

    },
    methods: {
      register() {
         if (this.isFieldsEmpty()){ //if not blank
            if (this.isPasswordConfirmMatchPassword()){ //if password is different of comfirm password
                //sends credentials to backend 
                axios.post(
                '/api/register',{
                    name: this.username,
                    email: this.email,
                    password: this.password
                });
                this.$router.replace({name: 'Hello'});
            } else {
                this.isIncorect = true;
                this.isBlank = false;
            }
         } else {
           this.isBlank=true;
         }
      },
      //check if both password are the same
      isPasswordConfirmMatchPassword(){
        return (this.input.password === this.input.passwordConfirm);
      },
      //check if an input is empty
      isFieldsEmpty(){
        return (this.input.username != "" && this.input.email != "" && this.input.password != "" && this.input.passwordConfirm != "");
      },
    }
  }
</script>