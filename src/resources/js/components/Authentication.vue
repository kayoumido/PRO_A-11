<template>
    <v-container>

        <h2>Authentification</h2>

        <v-alert
            v-model="message.show"
            :class="message.type"
            dismissible
        >
            {{ message.content }}
        </v-alert>

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
                label="Mot de passe"
                value=""
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


    </v-container>
</template>

<script>
import axios from 'axios';
// import router from '../routes';

export default {
  name: 'Authentication',
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
      // object for message management
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
    login() {
      if (this.input.email !== '' && this.input.password !== '') { // if not blank
        // sends credentials to backend for verification

        const data = this.input;

        axios.post(
          '/api/v1/login', data,
        )
          .then((response) => {
            if (response.data.token_type === 'Bearer') {
              const token = response.data.access_token;
              localStorage.setItem('Authorization-token', token); // store the token in localstorage
              this.showMessage('success', 'Authentifié');
            } else {
              this.showMessage('error', 'Réponse du serveur inatendue');
            }
          })
          .catch((error) => {
            this.showMessage('error', `erreur de type: ${error}`);
          });
      } else { // is blank
        this.showMessage('error', 'Veuillez remplir tous les champs');
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
