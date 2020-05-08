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
            Titre : {{ presentation.title }}
          </v-list-item-title>
          <v-list-item-subtitle>
            Date: {{ presentation.date }}
          </v-list-item-subtitle>
            <v-list-item-action v-if="isLoaded">
                <v-btn
                    v-if="!loggedUser.isSubscribed"
                    @click="subscribe"
                    color="primary"
                    >
                    S'inscrire
                </v-btn>
                <v-btn
                    v-else
                    @click="unsubscribe"
                    color="error">
                    Se désincrire
                </v-btn>
            </v-list-item-action>
        </v-list-item-content>

      </v-list-item>

    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      isLoaded: false,
      presentation: {},
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
    const apiUrl = `presentations/${this.$route.params.idPresentation}`;
    window.axios
      .get(apiUrl)
      .then((presResponse) => {
        this.presentation = presResponse.data;
      })
      .catch(() => {
        this.showMessage('error', 'Oops une erreur est survenue lors du traitement de votre demande');
      });
    this.setLoggedUser()
      .then(() => {
        window.axios
          .get(`/users/${this.loggedUser.id}/presentations`)
          .then((subResponse) => {
            this.loggedUser.isSubscribed = false;
            subResponse.data.forEach((pres) => {
              if (pres.id === this.presentation.id) {
                this.loggedUser.isSubscribed = true;
              }
            });
            this.isLoaded = true;
          });
      });
  },
  methods: {
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
    subscribe() {
      window.axios
        .post(`/presentations/${this.presentation.id}/users/${this.loggedUser.id}`)
        .then(() => {
          this.showMessage('success', 'Félicitations vous êtes maintenant inscrit à la présentation');
          this.loggedUser.isSubscribed = true;
        })
        .catch(() => {
          this.showMessage('error', 'Oops une erreur c\'est produite lors de l\'inscription');
        });
    },
    unsubscribe() {
      window.axios
        .delete(`/presentations/${this.presentation.id}/users/${this.loggedUser.id}`)
        .then(() => {
          this.showMessage('warning', 'Vous n\'êtes plus inscrit a cette présentation');
          this.loggedUser.isSubscribed = false;
        })
        .catch(() => {
          this.showMessage('error', 'Oops une erreur c\'est produite lors de la désinscription');
        });
    },
  },

};

</script>
