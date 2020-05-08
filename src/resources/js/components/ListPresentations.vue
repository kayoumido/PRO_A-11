<template>
  <v-container>
    <v-alert
    v-model="message.show"
    :class="message.type"
    dismissible
    >
      {{ message.content }}
    </v-alert>

      <v-row align="center">
      <v-card
        class="mx-auto"
        max-width="400"
        tile
      >
          <v-card-title>User {{loggedUser.fname}}</v-card-title>
        <v-list>
          <v-subheader>Presentations</v-subheader>
            <v-list-item
              v-for="(presentation) in presentations"
              :key="presentation.id"
              inactive
            >
              <v-list-item-content>
                <v-list-item-title v-html="presentation.title"></v-list-item-title>
              </v-list-item-content>

              <v-list-item-action>
                <v-btn icon @click.prevent="goToPresentation(presentation.id)">
                  <v-icon color="grey lighten-1">mdi-information</v-icon>
                </v-btn>
              </v-list-item-action>

              <v-list-item-action>
                <v-btn small color="error">
                  quitter
                </v-btn>
              </v-list-item-action>

            </v-list-item>
        </v-list>
      </v-card>
    </v-row>

  </v-container>
</template>

<script>
export default {
  data() {
    return {
      presentations: [],
      message: {
        show: false,
        content: '',
        type: '',
      },
      inactive: true,
    };
  },
  beforeMount() {
    this.setLoggedUser()
      .then(() => {
        const apiUrl = `/users/${this.loggedUser.id}/presentations`;

        window.axios
          .get(apiUrl)
          .then((responsePresentation) => {
            this.presentations = responsePresentation.data;

            if (this.presentationsIsEmpty()) {
              this.showMessage('info', 'Vous ne vous êtes inscrit à aucune presentation');
            }
          })
          .catch((error) => {
            this.showMessage('error', `La recupération des presentations a échoué: ${error}`);
          });
      });
  },
  methods: {
    presentationsIsEmpty() {
      return (this.presentations.length === 0);
    },
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
    goToPresentation(id) {
      this.$router.push({
        name: 'Présentation',
        params: { idPresentation: id },
      });
    },
  },
};

</script>
