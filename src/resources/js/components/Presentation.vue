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
                    v-if="!user.isSubscribed"
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
  name: 'Presentation',
  data() {
    return {
      isLoaded: false,
      presentation: {},
      user: {
        isSubscribed: false,
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
 
    const apiUrl = `presentations/${this.$route.params.idPresentation}`;
    window.axios
      .get(apiUrl)
      .then((presResponse) => {
        this.presentation = presResponse.data.data;
      })
      .catch(() => {
        this.showMessage('error', 'Oops une erreur est survenue lors du traitement de votre demande');
      });

    // get current user
    window.axios
      .get('/me')
      .then((userResponse) => {
        this.user = userResponse.data.data;
        // check if the user is subscribed
        window.axios
          .get(`/users/${this.user.id}/presentations`)
          .then((subResponse) => {
            subResponse.data.data.forEach((pres) => {
              if (pres.id === this.presentation.id) {
                this.user.isSubscribed = true;
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
        .post(`/presentations/${this.presentation.id}/users/${this.user.id}`)
        .then(() => {
          this.showMessage('success', 'Félicitations vous êtes maintenant inscrit à la présentation');
          this.user.isSubscribed = true;
        })
        .catch(() => {
          this.showMessage('error', 'Oops une erreur c\'est produite lors de l\'inscription');
        });
    },
    unsubscribe() {
      window.axios
        .delete(`/presentations/${this.presentation.id}/users/${this.user.id}`)
        .then(() => {
          this.showMessage('warning', 'Vous n\'êtes plus inscrit a cette présentation');
          this.user.isSubscribed = false;
        })
        .catch(() => {
          this.showMessage('error', 'Oops une erreur c\'est produite lors de la désinscription');
        });
    },
  },

};

</script>
