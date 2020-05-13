<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
      <v-text-field
            v-model="updatePresentationInfo.title"
            :rules="titleRules"
            label="Titre"
      />

      <v-text-field
            v-model="updatePresentationInfo.date"
            label="Date"
      />

      <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="submitChange"
            >
            Appliquer
      </v-btn>
    </v-form>
</template>

<script>
  let alert = {};
  export default {
    props: ['parentRefs'],
    data() {
      return {
        valid: true,
        titleRules: [
          (v) => v === '' || (v && v.length <= 20) || 'Le titre doit contenir moins de 20 caractères',
        ],
        updatePresentationInfo: {
          date: new Date(),
          title: '',
       },
      };
    },
    beforeMount() {    
      alert = this.parentRefs.alert;
    },
    methods: {
      submitChange() {
        const data = this.getDataToSend();
        const apiUrl = `presentations/${this.$route.params.idPresentation}`;

        // Check if the object is Empty
        if (Object.keys(data).length === 0) {
          alert.showMessage('error', 'Vous devez remplir au moins un champs');
          return;
        }

        // sends credentials to backend
        window.axios.put(apiUrl, data)
        .then((response) => {
          alert.showMessage('success', 'Les informations de la présentation ont été modifiés');
          this.cleanForm();
         })
        .catch((error) => {
        alert.showMessage('error', `Nous n'avons pas réussi à appliqurer les changements`);
        });
      },
      /**
       * Prepare the data object for sending to the backend
       * add a key only if the field is not empty
       */
      getDataToSend() {
        const data = {};
        // we add the key and value if user has change the field
        if (!this.isEmpty(this.updatePresentationInfo.title)) {
          data.title = this.updatePresentationInfo.title;
        }
        if (!this.isEmpty(this.updatePresentationInfo.date)) {
          data.date = this.updatePresentationInfo.date;
        }

        return data;
      },
      cleanForm() {
        this.updateUserInfo.title = '';
        this.updateUserInfo.date = '';
      },
      isEmpty(textInput) {
        return (textInput === '');
      },
    },
  };
</script>
