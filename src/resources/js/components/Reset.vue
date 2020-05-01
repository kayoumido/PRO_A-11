<template>
  <v-container>
    <h2 class="title">Récupération de mot de passe</h2>
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
            @click="reset"
            >
            Envoyer email
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
      window.axios.post(
        '/api/v1/reset', {
          email: this.email,
        },
      ).then(result => {
        this.showMessage('information', 'Un email vous a été envoyé avec les instructions nécessaires');
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
