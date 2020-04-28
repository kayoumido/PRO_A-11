<template>
  <v-container>
    <v-alert
    v-model="message.show"
    :class="message.type"
    dismissible
    >
      {{ message.content }}
    </v-alert>


    <!-- div v-for="presentation in presentations.data" :key="presentation.id">
      <router-link
        :to="{ name : 'presentation',
              params : { idPresentation : presentation.id,
                         // will help generate url like /presentation/name
                         name : presentation.title,
                       }
              }"
        >
        {{ presentation.title }}
      </router-link>
    </div-->


    <v-list two-line>
      <template v-for="(presentation) in presentations">
        <v-list-item
          :key="presentation.id"
        >
          <v-list-item-content>
            <v-list-item-title v-html="presentation.title"/>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-list>

    <router-view></router-view>
  </v-container>
</template>

<script>

import axios from 'axios';

// set Bearer token in header of the future request
axios.defaults.headers.common = { Authorization: `Bearer ${localStorage.getItem('Authorization-token')}` };

export default {
  name: 'ListPresentations',
  props: ['parent'],
  data() {
    return {
      presentations: [
        { title: 'aaa', id: 1 },
        { title: 'bbb', id: 2 },
        { title: 'cccc', id: 3 },
      ],
      message: {
        show: false,
        content: '',
        type: '',
      },
      loggedUser: {

      },
    };
  },
  beforeMount() {
    // const apiUrl = `/api/v1/users/${this.loggedUser.id}/presentations`;
    const apiUrl = '/api/v1/users/1/presentations';

    // get logged user info
    axios
      .get('/api/v1/me')
      .then((response) => {
        this.loggedUser = response.data.data;
      })
      .catch((error) => {
        this.showMessage('error', `La recupération des donnée utilisateur a échoué: ${error}`);
      });

    if (this.loggedUser === null) {
      return;
    }

    axios
      .get(apiUrl)
      .then((response) => {
        this.presentations = response.data;
        if (this.presentationsIsEmpty()) {
          this.showMessage('info', 'Vous ne vous êtes inscrit à aucune presentation');
        }
      })
      .catch((error) => {
        this.showMessage('error', `La recupération des presentations a échoué: ${error}`);
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
