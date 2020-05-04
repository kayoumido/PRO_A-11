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

      <v-text-field
            v-model="input.password"
            :append-icon="showPassword ? 'midi-eye' : 'mdi-eye-off'"
            :type="showPassword ? 'test' : 'password'"
            :rules="passwordRules"
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

export default {
  name: 'ResetPassword',
  data() {
    return {
      token: null,
      // vuetify
      valid: true,
      emailRules: [
        (v) => (!!v && /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v)) || 'Adresse e-mail non valide',
      ],
      passwordRules: [
        (v) => !!v || 'Un mot de passe est nécessaire',
      ],
      showPassword: false,
      message: {
        show: false,
        content: '',
        type: '',
      },
      input: {
        email: '',
        password: '',
      },
    };
  },
  methods: {
    resetPassword() {
      window.axios.post(
        '/api/v1/password/reset', {
          token: this.$route.params.token,
          email: this.input.email,
          password: this.input.password,
        },
      ).then(() => {
        this.$router.push({ name: 'Authentification' });
      })
        .catch((error) => {
          this.showMessage('error', `Erreur de type : ${error}`);
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
