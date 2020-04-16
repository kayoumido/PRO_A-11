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
      message: '',
      token: 0
    }


  },
  methods: {
    login() {
      if(this.input.email !== '' && this.input.password !== '') { //if not blank
        //sends credentials to backend for verification

        if(!this.validateEmail(this.input.email)){
          this.message='Addresse e-mail non valide';
          this.isMessage=true;
          return;
        }

        const data = this.input;


        axios.post(
          '/api/login',data
        )
        .then(response => { //this seems incompatible with the #42 back end auth
          
          if(response.data.passed === true){
            this.message='Authentifié'
            this.isMessage=true;
            //this.$router.replace({name: 'Hello'}); // all routing is handled by vuejs, should be changed for the final home route
          } else {
            this.mailPasswordError();
          }
          

        })
        .catch(error => {
          this.mailPasswordError();
        });


      } else { //is blank
        this.message='Veuillez remplir tous les champs';
        this.isMessage=true;
      }

    },
    /**
    * Return a boolean value if the input mail match the regex
    * source : https://www.w3resource.com/javascript/form/email-validation.php
    **/ 
    validateEmail(inputMail) {
      const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
      return (inputMail.match(mailformat));
      
    },

    mailPasswordError(){
      this.message='Mot de passe ou email incorrect';
      this.isMessage=true;
    },
  }
};
</script>