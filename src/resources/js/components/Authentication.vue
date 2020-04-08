<template>
  <div id="app">
  
    <p class="title">PAUL</p>
    <form>
      <input type="text" name="username" v-model="input.username" placeholder="Nom d'utilisateur" />
      <input type="password" name="password" v-model="input.password" placeholder="Mot de passe" />
      <button type="button" v-on:click="login()">Se connecter</button>
      
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
              '/login',
              this.$input // to reformat if needed
            )
            .then(function (data){
              // this function is launched after the post request
              console.log(data);

              
            })
            .catch(function (error){
              console.log(error);
            });

         } else {
           this.isBlank=true;
         }

      },

      setIncorect() {
        this.isIncorect = true;
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
  background-color: #000000;
  color: white;
  width: 409px;
  height: 99px;
  font-family: Roboto;
  font-size: 36px;
  border-radius: 5px;
}

.row {
  padding: 10px;
  display: flex;
  width: 100%;
}

</style>