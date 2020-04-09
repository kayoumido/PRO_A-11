<template>
  <div id="app">
  
    <p class="title">PAUL</p>
    <form @submit="register" method="post">
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
      darkBlue: '#5F74E8',
      lightBlue: '#69A7FF',
      isBlank: false,
      isIncorect: false}

    },
    methods: {
      register() {
         if (this.isFieldsEmpty()){ //if not blank
            if (this.isPasswordConfirmMatchPassword()){ //if password is different of comfirm password
                //sends credentials to backend 
                axios.post(
                '/register',{
                    name: this.username,
                    email: this.email,
                    password: this.password
                })
                .then(function (data){
                // this function is launched after the post request
                console.log(data);
                })
                .catch(function (error){
                console.log(error);
                });

                this.$router.replace({name: 'login'});
            } else {
                this.isIncorect = true;
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

<style scoped>

.title{
  margin: auto;
  font-family: Roboto;
  font-size: 64px;
  line-height: 200px;
  text-align: center;

  color: #8575FF;
}


.button {
  margin: auto;
  border: none;
  background-color: #5F74E8;
  color: white;
  width: 405px;
  height: 100px;
  font-family: Roboto;
  font-size: 36px;
  border-radius: 5px;
}

.form-group{
    margin: auto;
    width: 400px;
    height: 100;
}

.input, textarea{
    width: 400px;
    height: 100;
    background-color: #69A7FF;
}

</style>