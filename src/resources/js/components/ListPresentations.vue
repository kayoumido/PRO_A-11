<template>
    <v-row align="center">
      <v-card
        class="mx-auto"
        max-width="400"
        tile
      >
        <v-list>
            <v-list-item
              v-for="(presentation) in presentations"
              :key="presentation.id"
              inactive
            >
              <v-list-item-content>
                <v-list-item-title v-html="presentation.title"></v-list-item-title>
              </v-list-item-content>

              <v-list-item-action v-if="presentation.auth_user_role === 'presenter'">
                <v-btn icon @click.prevent="goToPresentationEdit(presentation.id)">
                  <v-icon color="grey lighten-1">mdi-pencil-outline</v-icon>
                </v-btn>
              </v-list-item-action>

              <v-list-item-action>
                <v-btn icon @click.prevent="goToPresentation(presentation.id)">
                  <v-icon color="grey lighten-1">mdi-information</v-icon>
                </v-btn>
              </v-list-item-action>

              <v-list-item-action>
                <v-btn small color="info">
                  quitter
                </v-btn>
              </v-list-item-action>
            </v-list-item>
        </v-list>
      </v-card>
    </v-row>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  data() {
    return {
      presentations: [],
    };
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },
  beforeMount() {
    const apiUrl = `/users/${this.user.id}/presentations`;

    window.axios
      .get(apiUrl)
      .then((responsePresentation) => {
        this.presentations = responsePresentation.data;

        if (this.presentationsIsEmpty()) {
          this.$emit('info', 'Vous ne vous êtes inscrit à aucune presentation');
        }
      })
      .catch(() => {
        this.$emit('error', 'La recupération des presentations a échoué');
      });
  },
  methods: {
    presentationsIsEmpty() {
      return (this.presentations.length === 0);
    },
    goToPresentation(id) {
      this.$router.push({
        name: 'Présentation',
        params: { idPresentation: id },
      });
    },
    goToPresentationEdit(id) {
      this.$router.push({
        name: 'Edition de présentation',
        params: { idPresentation: id },
      });
    },
  },
};

</script>
