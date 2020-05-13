<template>
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
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :type="showPassword ? 'text' : 'password'"
            :rules="passwordRules"
            @click:append="showPassword = !showPassword"
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
    </v-form>
</template>

<script>
let alert = {};
export default {
  props: ['parentRefs'],
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
      input: {
        email: '',
        password: '',
      },
    };
  },
  beforeMount() {
    alert = this.parentRefs.alert;
  },
  methods: {
    resetPassword() {
      window.axios.post(
        '/password/reset', {
          token: this.$route.params.token,
          email: this.input.email,
          password: this.input.password,
        },
      ).then(() => {
        this.$router.push({ name: 'Authentification' });
      })
        .catch((error) => {
          alert.showMessage('error', `Erreur de type : ${error}`);
        });
    },
  },
};
</script>
