<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
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
            @click="createAccount"
            >
            Créer compte
      </v-btn>
    </v-form>
</template>

<script>
import { mapActions } from 'vuex';

export default {
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

      input: {
        fname: '',
        lname: '',
        email: '',
        password: '',
      },
    };
  },
  methods: {
    ...mapActions({
      register: 'auth/register',
    }),
    createAccount() {
      this.register(this.input)
        .then(() => {
          this.$emit('success', 'Compte créé avec succés');
          this.$router.push('/');
        }).catch(() => {
          this.$emit('error', 'Une erreur est surevenue lors de la création de compte');
        });
    },
    // check if both password are the same
    isPasswordConfirmMatchPassword() {
      return (this.input.password === this.input.passwordConfirm);
    },
  },
};
</script>
