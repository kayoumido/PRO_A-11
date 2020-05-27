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
                        <v-toolbar-title>Modifier la présentation</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form
                            ref="form"
                            v-model="valid"
                            lazy-validation
                        >
                            <v-text-field
                                v-model="form.title"
                                :rules="titleRules"
                                label="Titre"
                            />

                            <v-datetime-picker
                                label="Date et Heure"
                                v-model="form.date"
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
                            @click="$router.back()"
                        >
                            Annuler
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="success"
                            @click="submitChange"
                        >
                            Modifier
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import dateFormat from 'dateformat';

export default {
  data() {
    return {
      valid: true,
      titleRules: [
        (v) => !!v || 'Vous devez renseigner un titre',
        (v) => (v && v.length <= 20) || 'Le titre doit contenir moins de 20 caractères',
      ],
      form: {
        date: '',
        title: '',
      },
    };
  },
  beforeMount() {
    window.axios.get(`presentations/${this.$route.params.idPresentation}`)
      .then((response) => {
        this.form.title = response.data.title;
        this.form.date = dateFormat(response.data.date, 'yyyy-mm-dd HH:MM');
      })
      .catch(() => {
        this.$emit('error', 'Une erreur est survenue lors du traitement de votre demande');
      });
  },
  methods: {
    submitChange() {
      const apiUrl = `presentations/${this.$route.params.idPresentation}`;

      // if (this.$refs.form.validate()) {
      //   this.$emit('error', 'Vous devez renseigner une date');
      //   return;
      // }

      // sends credentials to backend
      window.axios.put(apiUrl, {
        title: this.form.title,
        date: dateFormat(this.form.date, 'yyyy-mm-dd HH:MM'),
      })
        .then((response) => {
          this.$emit('success', 'Les informations de la présentation ont été modifiées');
          this.form.title = response.data.title;
          this.form.date = dateFormat(response.data.date, 'yyyy-mm-dd HH:MM');
        })
        .catch(() => {
          this.$emit('error', 'Nous n\'avons pas réussi à appliquer les changements');
        });
    },
  },
};
</script>
