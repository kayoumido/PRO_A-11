<template>
  <div>
    <p class="title">PAUL</p>
    <form @submit.prevent="register" method="post">
      <div class="form-group">
        <input type="text" class="input" name="lname" v-model="input.lname" placeholder="Nom" />
      </div>
      <div class="form-group">
        <input type="text" class="input" name="fname" v-model="input.fname" placeholder="Prénom" />
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
      
      <div v-if="isError" class="error"> 
        <h3>{{ message }}</h3>
      </div>
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
              lname: '',
              fname: '',
              email: '',
              password: '',
              passwordConfirm: ''
          },
      isError: false,
      message: ''};
    },
    methods: {
      register() {
         if (this.isFieldsEmpty()){ //if not blank
            if (this.isPasswordConfirmMatchPassword()){ //if password is different of comfirm password
                //sends credentials to backend 
                axios.post(
                '/api/register',{
                    lname: this.lname,
                    fname: this.fname,
                    email: this.email,
                    password: this.password
                }).then(Response => {
                  if(Response.data.passed === true){
                    this.$router.replace({name: 'Hello'});
                  }else{
                    this.isError = true;
                    this.message = 'Cette adresse mail est déjà utilisé';
                  }
                }).catch(error => {
                  this.isError = true;
                  this.message = 'Une erreur a eu lieu lors de la création du compte';
                });
                
            } else {
                this.isError = true;
                this.message = 'Les mots de passe sont différents';
            }
         } else {
           this.isError = true;
           this.message = 'Ils y a des champs vides';
         }
      },
      //check if both password are the same
      isPasswordConfirmMatchPassword(){
        return (this.input.password === this.input.passwordConfirm);
      },
      //check if an input is empty
      isFieldsEmpty(){
        return (this.input.lname !== '' && this.input.fname !== '' && this.input.email !== '' && this.input.password !== '' && this.input.passwordConfirm !== '');
      },
    }
  }
</script>