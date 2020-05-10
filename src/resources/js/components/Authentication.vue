<template>
    <v-form
        ref="form"
        v-model="valid"
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
            label="Mot de passe"
            class="input-group--focused"
            @click:append="showPassword = !showPassword"
            required
        />

        <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="login"
        >
            Se connecter
        </v-btn>

    </v-form>
</template>

<script>
let alert = {};
export default {
  props: ['parentRefs'],
  data() {
    return {
      // vuetify
      valid: true, // if a rules is not fully satisfied this will disable submit button
      passwordRules: [
        (v) => !!v || 'Un mot de passe est necessaire',
      ],
      emailRules: [
        (v) => (!!v && /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v)) || 'une addresse email valide est necessaire',
      ],
      showPassword: false,

      input: {
        email: '',
        password: '',
      },
    };
  },
  beforeMount() {
    // this.setLoggedUser();
    alert = this.parentRefs.alert;
  },
  methods: {
    login() {
      // sends credentials to backend for verification

      const data = this.input;

      window.axios.post(
        '/login', data,
      )
        .then((response) => {
          if (response.data.token_type === 'Bearer') {
            const token = response.data.access_token;
            localStorage.setItem('Authorization-token', token); // store the token in localstorage
            alert.showMessage('success', 'Authentifié');
            this.$router.replace({ name: 'Hello' }); // all routing is handled by vuejs, should be changed for the final home route
          } else {
            alert.showMessage('error', 'Réponse du serveur inatendue');
          }
        })
        .catch(() => {
          alert.showMessage('error', 'Adresse email ou mot de passe incorrect');
        });
    },
  },
};
</script>
