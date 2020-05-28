<template>
    <div>
        <AppTitle></AppTitle>
        <v-row
            align="center"
            justify="center"
            class="my-5"
        >
            <v-col
                cols="12"
                sm="8"
                md="4">
                <v-card
                    class="elevation-12 pa-4">
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>
                            <CustomFont>
                                Connexion
                            </CustomFont>
                        </v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form
                            ref="form"
                            v-model="valid"
                            @submit.prevent="login">
                            <v-text-field
                                v-model="input.email"
                                :rules="[rules.required, rules.email]"
                                type="text"
                                required
                                label="Adresse email"
                            />


                            <v-text-field
                                v-model="input.password"
                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="showPassword ? 'text' : 'password'"
                                :rules="[rules.required]"
                                label="Mot de passe"
                                @click:append="showPassword = !showPassword"
                                required
                            />
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                            text
                            small
                            color="secondary"
                            href="/reset"
                        >
                            Mot de passe oublié?
                        </v-btn>
                        <v-btn
                            text
                            small
                            color="secondary"
                            href="/creer-compte"
                        >
                            Nouveau compte
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="primary"
                            @click="login"
                        >
                            Se connecter
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import AppTitle from './layout/AppTitle';
import CustomFont from './layout/CustomFont';

export default {
  components: { CustomFont, AppTitle },
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
