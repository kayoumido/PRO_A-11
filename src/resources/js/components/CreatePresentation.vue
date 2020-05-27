<template>
    <v-container
        fluid>
        <v-row
            align="center"
            justify="center"
            class="my-5"
        >
            <v-col>
                <v-card
                    class="elevation-12 pa-4">
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Nouvelle présentation</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form
                            ref="form"
                            v-model="valid"
                            lazy-validation
                        >
                            <v-text-field
                                v-model="dataForm.title"
                                :counter="20"
                                :rules="titleRules"
                                label="Titre"
                                required
                            />

                            <v-datetime-picker
                                label="Date et Heure"
                                v-model="dataForm.date"
                                :rules="dateRules"
                                clearText="annuler"
                            >
                                <template slot="dateIcon">
                                    <v-icon>mdi-calendar</v-icon>
                                </template>
                                <template slot="timeIcon">
                                    <v-icon>mdi-clock</v-icon>
                                </template>
                            </v-datetime-picker>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                            text
                            small
                            color="error"
                            href="/presentations"
                        >
                            Annuler
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="success"
                            @click="createPresentation()"
                        >
                            Créer
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import dateFormat from 'dateformat';
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      valid: true,
      titleRules: [
        (v) => !!v || 'Vous devez renseigner un titre',
        (v) => (v && v.length <= 20) || 'Le Nom doit contenir moins de 20 caractères',
      ],
      dateRules: [
        (v) => !!v || 'Vous devez renseigner une date',
      ],
      dataForm: {
        date: new Date(),
        title: '',
      },
    };
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  methods: {
    createPresentation() {
      const apiUrl = `/users/${this.user.id}/presentations`;

      // force date validation
      if (!this.$refs.form.validate()) {
        return;
      }

      // send http request with axios and catch response or error
      window.axios.post(apiUrl, {
        title: this.dataForm.title,
        date: dateFormat(this.dataForm.date, 'yyyy-mm-dd HH:MM'),
      })
        .then((response) => {
          this.$emit('success', `La présentation ${response.data.title} a été correctement créée`);
          this.$refs.form.reset();
          this.$router.push({
            name: 'Présentation',
            params: { idPresentation: response.data.id },
          });
        })
        .catch(() => {
          this.$emit('error', 'erreur lors de l\'envoie des données');
        });
    },
  },
};
</script>
