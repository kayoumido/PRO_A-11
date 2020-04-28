<template>
  <div>
    <p class="title">PAUL</p>
    <form @submit.prevent="reset" method="post">
      <div class="form-group">
        <input type="text" class="input" name="email" v-model="input.email" placeholder="email" />
      </div>
      <div class="form-group">
        <button type="button" class="button" v-on:click="reset()">Récupérer Mot de passe</button>
      </div>
      <div v-if="isError" class="error">
        <h3>{{ message }}</h3>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Reset',
  data() {
    return {
      input: {
        email: '',
      },
      isError: false,
      message: '',
    };
  },
  methods: {
    reset() {
      if (this.input.email !== '') { // if not blank
        if (this.isEmail(this.input.email)) {
          axios.post(
            '/api/reset', {
              email: this.email,
            },
          ).then((Response) => {
            if (Response.data.passed === true) {
              this.$router.replace({ name: 'Hello' });
            }
          }).catch(() => {
            this.isError = true;
            this.message = 'Une erreur a eu lieu lors de la demande de changement de mot de passe';
          });
        } else {
          this.isError = true;
          this.message = 'Adresse e-mail non valide';
        }
      } else {
        this.isError = true;
        this.message = 'Ils y a des champs vides';
      }
    },
    // check email syntax
    isEmail(inputEmail) {
      const mailFormat = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/;
      return (inputEmail.match(mailFormat));
    },
  },
};
</script>
