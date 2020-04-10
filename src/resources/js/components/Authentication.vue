<template>
  <div id="app">
  
    <p class="title">PAUL</p>
    <form>
      <input type="text" name="username" v-model="input.username" placeholder="Nom d'utilisateur" />
      <input type="password" name="password" v-model="input.password" placeholder="Mot de passe" />
      <button type="button" v-on:click="login()">Se connecter</button>
      <button type="button" v-on:click="loginMockup()">Mockup Account</button>
      
      <p v-if="isBlank"> Pas de données</p>
      <p v-if="isIncorect"> Nom ou mot de passe incorrect</p>
    </form>
    

  </div>
</template>

<script>
    import axios from 'axios'
    import router from '../routes'

    export default {
    name : 'Authentication',
    props:['data'],
    data () {
        return{
          input: {
              username: '',
              password: ''
          },
          darkBlue: '#5F74E8',
          lightBlue: '#69A7FF',
          isBlank: false,
          isIncorect: false}

    },
    methods: {
      login() {
         if(this.input.username != "" && this.input.password != "") { //if not blank
            //sends credentials to backend for verification
            
            axios.post(
              '/login',{
                  username: this.username,
                  password: this.password
              }
              
            )
            .then(function (data){
              // this function is launched after the post request
              console.log(data);

              
            })
            .catch(function (error){
              console.log(error);
            });

            this.isBlank=false;

         } else {
           this.isBlank=true;
         }

      },
      loginMockup(){
        this.input.username = 'MockupAccount';
        this.setCorrect();
      },

      setIncorect() {
        this.isIncorect = true; //doesnt seem well designed
      },
      setCorrect(){
        this.$emit('login-successfull',this.input.username); // should we send the password, or should we already implement some security
        this.$router.replace({name: 'Hello'}); // once logged in, go back to home (change this Hello with Home when the time is right)
      }

    }
  }
</script>