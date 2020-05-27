<template>
    <v-form
        ref="form"
        v-model="valid"
        @submit.prevent="login"
    >

        <v-text-field
            v-model="input.email"
            :rules="[rules.required, rules.email]"
            required
            label="Adresse email"
        />


        <v-text-field
            v-model="input.password"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :type="showPassword ? 'text' : 'password'"
            :rules="[rules.required]"
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
import { mapActions } from 'vuex';

export default {
  data() {
    return {
      // vuetify
      valid: true, // if a rules is not fully satisfied this will disable submit button
      rules: {
        required: (v) => !!v || 'Champ requis',
        email: (v) => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v) || 'Addresse email invalide',
      },
      showPassword: false,

      input: {
        email: '',
        password: '',
      },
    };
  },
  methods: {
    ...mapActions({
      signIn: 'auth/signIn',
    }),
    login() {
      this.signIn(this.input)
        .then(() => {
          this.$emit('success', 'Authentifié');
          this.$router.replace('/');
        })
        .catch(() => {
          this.$emit('error', 'Adresse email ou mot de passe incorrect');
        });
    },
  },
};
</script>
