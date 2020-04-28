<template>
  <v-container>
    <v-alert
    v-model="message.show"
    :class="message.type"
    dismissible
    >
      {{ message.content }}
    </v-alert>

    <v-list two-line>
      <template v-for="(presentation) in presentations.data">
        <v-list-item
          :key="presentation.id"
        >
          <v-list-item-content>
            <v-list-item-title v-html="presentation.title"/>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-list>
  </v-container>
</template>

<script>
import axios from 'axios';

// set Bearer token in header of the future request
axios.defaults.headers.common = { Authorization: `Bearer ${localStorage.getItem('Authorization-token')}` };

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
    // get logged user info
    axios
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

        axios
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
  },
};

</script>
