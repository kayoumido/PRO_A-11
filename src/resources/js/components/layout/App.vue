<template>
    <v-app>
        <v-navigation-drawer
            app
            clipped
            permanent
            expand-on-hover
        >
            <SideBar></SideBar>
        </v-navigation-drawer>

        <v-app-bar app
                   elevate-on-scroll
                   clipped-left
        >
            <v-toolbar-title>Paul</v-toolbar-title>

            <v-spacer></v-spacer>
            <SearchBar></SearchBar>
            <UserTooltip></UserTooltip>
        </v-app-bar>

        <!-- Sizes your content based upon application components -->
        <v-content>

            <!-- Provides the application the proper gutter -->
            <v-container>

                <!-- If using vue-router -->
                <v-row>
                    <v-col>
                        <h1>Titre</h1>
                    </v-col>
                </v-row>
                <v-row>
                    <v-container>
                        <AlertMessage ref="alert"></AlertMessage>
                        <router-view :parentRefs="$refs"></router-view>
                    </v-container>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>
<script>
import SideBar from './SideBar';
import SearchBar from './SearchBar';
import UserTooltip from './UserTooltip';
import AlertMessage from './AlertMessage';

export default {
  components: {
    AlertMessage, UserTooltip, SearchBar, SideBar,
  },
};
</script>
