<template>
  <v-container>
    <p class="title">PAUL</p>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
      <v-text-field
            v-model="input.password"
            :append-icon="showPassword ? 'midi-eye' : 'mdi-eye-off'"
            :type="showPassword ? 'test' : 'password'"
            required
            label="Mot de passe"
      />

      <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="resetPassword"
            >
            Changer mot de passe
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
  name: 'ResetPassword',
  data() {
    return {
      token: null,
      // vuetify
      valid: true,
      showPassword: false,
      message: {
        show: false,
        content: '',
        type: '',
      },
      input: {
        password: '',
      },
    };
  },
  methods: {
    resetPassword() {
        window.axios.post(
          '/api/v1/reset-password', {
            token: this.$route.params.token,
            password: this.password,
          },
        ).then(result => {
          this.$router.push({ name: 'Authentification' })
        }, error => {
          this.showMessage('error', 'Une erreur a eu lieu lors de la demande de changement de mot de passe');
        });
    },
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
  },
};
</script>
