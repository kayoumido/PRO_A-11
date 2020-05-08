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
    </v-form>
  </v-container>
</template>

<script>
let alert = {};
export default {
  name: 'Reset',
  props: ['parentRefs'],
  data() {
    return {
      // vuetify
      valid: true,
      emailRules: [
        (v) => (!!v && /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v)) || 'Adresse e-mail non valide',
      ],
      input: {
        email: '',
      },
    };
  },
  beforeMount() {
    alert = this.parentRefs.alert;
  },
  methods: {
    reset() {
      window.axios.post(
        '/password/send-reset-email', {
          email: this.input.email,
        },
      ).then(() => {
        alert.showMessage('information', 'Un email vous a été envoyé avec les instructions nécessaires');
      })
        .catch((error) => {
          alert.showMessage('error', `Erreur de type : ${error}`);
        });
    },
  },
};
</script>
