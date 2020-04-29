<template>

 <v-container>
     <v-alert
    v-model="message.show"
    :class="message.type"
    dismissible
    >
      {{ message.content }}
    </v-alert>

      <v-card
      class="mx-auto"
      max-width="344"
      >
      <v-list-item three-line>
        <v-list-item-content>
          <v-list-item-title class="headline mb-1">
            Titre : {{ presentation.data.title }}
          </v-list-item-title>
          <v-list-item-subtitle>
            Date: {{ presentation.data.date }}
          </v-list-item-subtitle>
        </v-list-item-content>

      </v-list-item>

    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

axios.defaults.headers.common = { Authorization: `Bearer ${localStorage.getItem('Authorization-token')}` };

export default {
  name: 'Presentation',
  data() {
    return {
      presentation: {
        data: {},
      },
      polls: [],
      // object for message management
      message: {
        show: false,
        content: '',
        type: '',
      },
    };
  },
  beforeMount() {
    // take the param in vu-route in presentation/{idPresentation}

    const apiUrl = `api/v1/presentations/${this.$route.params.idPresentation}`;

    axios
      .get(apiUrl)
      .then((response) => {
        this.presentation = response.data;
      })
      .catch((error) => {
        this.showMessage('error', `erreur lors de l'envoie des donnée ${error}`);
      });
  },
  methods: {
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
  },

};

</script>
