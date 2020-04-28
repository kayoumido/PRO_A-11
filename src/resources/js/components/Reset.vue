<template>
  <v-container>
    <p class="title">PAUL</p>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
      <v-text-field
            v-model="input.email"
            :rules="emailRules"
            required
            label="Adresse email"
      />

      <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="login"
            >
            Se conecter
      </v-btn>
      <v-alert
            v-model="message.show"
            :class="message.type"
            dismissible
            >
            {{ message.content }}
      </v-alert>
    </v-form>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Reset',
  data() {
    return {
      // vuetify
      valid: true,
      emailRules: [
        (v) => (!!v && /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v)) || 'Adresse e-mail non valide',
      ],
      message: {
        show: false,
        content: '',
        type: '',
      },
      input: {
        email: '',
      },
    };
  },
  methods: {
    reset() {
      if (this.input.email !== '') { // if not blank
        axios.post(
          '/api/reset', {
            email: this.email,
          },
        ).then((Response) => {
          if (Response.data.passed === true) {
            this.$router.replace({ name: 'Test' });
          }
        }).catch(() => {
          this.showMessage('error', 'Une erreur a eu lieu lors de la demande de changement de mot de passe');
        });
      } else {
        this.showMessage('error', 'Ils y a des champs vides');
      }
    },
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
  },
};
</script>
