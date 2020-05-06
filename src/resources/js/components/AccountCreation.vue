<template>
  <v-container>
    <h2 class="title">Inscription</h2>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
      <v-alert
            v-model="message.show"
            :class="message.type"
            dismissible
            >
            {{ message.content }}
        </v-alert>
      <v-text-field
            v-model="input.fname"
            :rules="fnameRules"
            required
            label="Prénom"
      />

      <v-text-field
            v-model="input.lname"
            :rules="lnameRules"
            required
            label="Nom"
      />

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

      <v-text-field
            v-model="input.passwordConfirm"
            :append-icon="showPasswordConfirm ? 'mdi-eye' : 'mdi-eye-off'"
            :type="showPasswordConfirm ? 'text' : 'password'"
            @click:append="showPasswordConfirm = !showPasswordConfirm"
            required
            label="Confirmation de mot de passe"
      />

      <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="register"
            >
            Créer compte
      </v-btn>
    </v-form>
  </v-container>
</template>

<script>

export default {
  name: 'Register',
  data() {
    return {
      // vuetify
      valid: true,
      fnameRules: [
        (v) => !!v || 'Un prénom est nécessaire',
      ],
      lnameRules: [
        (v) => !!v || 'Un nom de famille est nécessaire',
      ],
      emailRules: [
        (v) => (!!v && /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v)) || 'Adresse e-mail non valide',
      ],
      passwordRules: [
        (v) => !!v || 'Un mot de passe est nécessaire',
      ],
      showPassword: false,
      showPasswordConfirm: false,
      message: {
        show: false,
        content: '',
        type: '',
      },

      input: {
        fname: '',
        lname: '',
        email: '',
        password: '',
      },
    };
  },
  methods: {
    register() {
      if (this.isPasswordConfirmMatchPassword()) {
      // sends credentials to backend
        window.axios.post(
          '/register', {
            fname: this.input.fname,
            lname: this.input.lname,
            email: this.input.email,
            password: this.input.password,
          },
        ).then((response) => {
          if (response.data.token_type === 'Bearer') {
            const token = response.data.access_token;
            localStorage.setItem('Authorization-token', token);
            this.showMessage('success', 'Authentifié');
            this.$router.push({ name: 'Hello' });
          } else {
            this.showMessage('error', 'Réponse du serveur inatendue');
          }
        }).catch((error) => {
          this.showMessage('error', `Erreur de type : ${error}`);
        });
      } else {
        this.showMessage('error', 'Les mots de passe sont différents');
      }
    },
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
    // check if both password are the same
    isPasswordConfirmMatchPassword() {
      return (this.input.password === this.input.passwordConfirm);
    },
  },
};
</script>
