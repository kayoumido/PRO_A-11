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
          <v-list-item-title class="headline mb-1">Titre : {{ presentation.data.title }}</v-list-item-title>
          <v-list-item-subtitle>identifiant: {{ presentation.data.id }}</v-list-item-subtitle>
        </v-list-item-content>

        <v-list-item-avatar
          tile
          size="80"
          color="grey"
        ></v-list-item-avatar>
      </v-list-item>

      <v-card-actions>
        <v-btn text>Bouton</v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Presentation',
  props: ['idPresentation'], // we can send the id of the presentation through props
  data() {
    return {
      presentation: {
        // data: {
        //   title: 'test',
        //   id: 1,
        // },
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
    // const apiUrl = `api/v1/presentations/${idPresentation}`;
    const apiUrl = 'api/v1/presentations/1';

    axios
      .get(apiUrl)
      .then((response) => {
        this.presentation = response.data;
      })
      .catch((error) => {
        this.isError = true;
        this.message = `erreur lors de l'envoie des donnée ${error}`;
      });
  },
};

</script>
