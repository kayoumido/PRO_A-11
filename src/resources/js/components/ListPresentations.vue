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
        <v-list
          shaped="shaped"
        >
          <v-subheader>Presentations</v-subheader>
          <v-list-item-group v-model="presentations" color="primary">
            <v-list-item
              v-for="(presentation) in presentations.data"
              :key="presentation.id"
              @click="goToPresentation(presentation.id)"
            >
              <v-list-item-content>
                <v-list-item-title v-html="presentation.title"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-card>
    </v-row>

  </v-container>
</template>

<script>
export default {
  name: 'ListPresentations',
  data() {
    return {
      presentations: [],
      message: {
        show: false,
        content: '',
        type: '',
      },
      loggedUser: {},
    };
  },
  beforeMount() {
    // set Bearer token in header of the future request
    window.axios.defaults.headers.common = { Authorization: `Bearer ${localStorage.getItem('Authorization-token')}` };

    // get logged user info
    window.axios
      .get('/api/v1/me')
      .then((response) => {
        this.loggedUser = response.data;

        if (this.loggedUser === null) {
          return;
        }

        const idUser = this.loggedUser.data.id;

        // For testing with a different User ID
        // const idUser = 1;

        const apiUrl = `/api/v1/users/${idUser}/presentations`;

        // eslint-disable-next-line no-undef
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
      })
      .catch((error) => {
        this.showMessage('error', `La recupération des donnée utilisateur a échoué: ${error}`);
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
        name: 'presentation',
        params: { idPresentation: id },
      });
    },
  },
};

</script>
