<template>
    <v-row
        align="center"
        justify="center"
        class="ma-4">
        <span
            class="text-center display-4"
            style="color: #5BDC8E;"
        >
            <CustomFont>
                Paul.
            </CustomFont>
        </span>
    </v-row>
</template>

<script>
import CustomFont from './CustomFont';

export default {
  name: 'AppTitle',
  components: { CustomFont },
};
</script>

<style scoped>

</style>
