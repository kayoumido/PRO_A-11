<template>
  <div id="Authentication">
  
    <p class="title">PAUL</p>
    <form>
      <input type="text" name="email" v-model="input.email" placeholder="Adresse e-mail" />
      <input type="password" name="password" v-model="input.password" placeholder="Mot de passe" />
      <button type="button" v-on:click="login()">Se connecter</button>
      
      <p v-if="isWaiting"> Traitement en cours</p>
      <p v-if="isBlank"> Pas de données</p>
      <p v-if="isIncorect"> Adresse e-mail ou mot de passe incorrect</p>
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
        email: '',
        password: ''
      },
      isBlank: false,
      isIncorect: false,
      isWaiting: false}

  },
  methods: {
    login() {
      if(this.input.email != "" && this.input.password != "") { //if not blank
        //sends credentials to backend for verification
           
        this.isBlank=false;
        this.isWaiting=true;

        axios.post(
          '/api/login',{ // might change, depend of 
            email: this.email,
            password: this.password
          }
              
        )
        .then(function (data){
          // this function is launched after the post request (if I understood this is only when the POST is a success)
          this.$router.replace({name: 'Hello'}); // all routing is handled by vuejs
          console.log(data);
        })
        .catch(function (error){
          console.log(error);
          this.isIncorect = true;
        });

        this.isWaiting=false;

      } else {
        this.isBlank=true;
      }

    },
  }
}
</script>