<template>
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
                v-if="isPresenter()"
                color="error"
                @click.prevent="delPresentation(presentation.id)">
                  Supprimer
                </v-btn>
                <v-btn
                    v-else-if="!isSubscribed"
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
</template>

<script>
let alert = {};
export default {
  props: ['parentRefs'],
  data() {
    return {
      isLoaded: false,
      isSubscribed: false,
      presentation: {},
      polls: [],
    };
  },
  watch: {
    /* For search presentation issue, watcher will look for route alteration
     * and launch code if there is. (eg. if we push the same route with other params)
     */
    $route() {
      this.getPresentation(this.$route.params.idPresentation);
    },
  },
  beforeMount() {
    alert = this.parentRefs.alert;
    this.getPresentation(this.$route.params.idPresentation);
    this.setLoggedUser()
      .then(() => {
        window.axios
          .get(`/users/${this.loggedUser.id}/presentations`)
          .then((subResponse) => {
            subResponse.data.forEach((pres) => {
              if (pres.id === this.presentation.id) {
                this.isSubscribed = true;
              }
            });
            this.isLoaded = true;
          });
      });
  },
  methods: {
    subscribe() {
      window.axios
        .post(`/presentations/${this.presentation.id}/users/${this.loggedUser.id}`)
        .then(() => {
          alert.showMessage('success', 'Félicitations vous êtes maintenant inscrit à la présentation');
          this.isSubscribed = true;
        })
        .catch(() => {
          alert.showMessage('error', 'Oops une erreur c\'est produite lors de l\'inscription');
        });
    },
    unsubscribe() {
      window.axios
        .delete(`/presentations/${this.presentation.id}/users/${this.loggedUser.id}`)
        .then(() => {
          alert.showMessage('warning', 'Vous n\'êtes plus inscrit a cette présentation');
          this.isSubscribed = false;
        })
        .catch(() => {
          alert.showMessage('error', 'Oops une erreur c\'est produite lors de la désinscription');
        });
    },
    getPresentation(id) {
      alert = this.parentRefs.alert;
      const apiUrl = `/presentations/${id}`;
      window.axios
        .get(apiUrl)
        .then((presResponse) => {
          this.presentation = presResponse.data;
        })
        .catch(() => {
          alert.showMessage('error', 'Oops une erreur est survenue lors du traitement de votre demande');
        });
    },
    isPresenter() {
      return (this.presentation.auth_user_role === 'presenter');
    },
    delPresentation(id) {
      const apiUrl = `/presentations/${id}`;

      window.axios.delete(apiUrl)
        .then(() => {
          alert.showMessage('success', 'La presentation à été supprimé correctement');
          this.$router.push('/presentations');
        })
        .catch(() => {
          alert.showMessage('error', 'La tentative de suppression a échoué');
        });
    },
  },

};

</script>
