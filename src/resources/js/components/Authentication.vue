<template>
  <div class="Container">
  
    <h2>Authentification</h2>

    <div v-if="isMessage">
      <h3>{{ message }}</h3>
    </div>

    <form @submit.prevent="login()">
      <label for="EnterEMail">
        <input id="EnterEMail" type="text" v-model="input.email" placeholder="Adresse e-mail" />
      </label>

      <label for="EnterPassword">
        <input id="EnterPassword" type="password" v-model="input.password" placeholder="Mot de passe" />
      </label>

      <input type="submit" value="Se connecter"/>
      

    </form>
    

  </div>
</template>

<script>
  import axios from 'axios'
  import router from '../routes'

  export default {
  name : 'Authentication',
  props:['parent'], //for future use (can't log in if already logged in, will reroute to home)
  data () {
    return{
      input: {
        email: '',
        password: ''
      },
      isMessage: false,
      message: ''
    }


  },
  methods: {
    login() {
      if(this.input.email != "" && this.input.password != "") { //if not blank
        //sends credentials to backend for verification

        if(!this.validateEmail(this.input.email)){
          message='Addresse e-mail non valide';
          this.isMessage=true;
          return;
        }

        axios.post(
          '/api/login',{ // might change, depend of back end route
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


      } else { //is blank
        this.message='Veuillez remplir tous les champs'
        this.isMessage=true;
      }

    },
    /**
    * Return a boolean value if the input mail match the regex
    * source : https://www.w3resource.com/javascript/form/email-validation.php
    **/ 
    validateEmail(inputMail) {
      const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
      return (inputMail.match(mailformat))
      
    },
  }
};
</script>