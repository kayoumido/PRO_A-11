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
                <router-view></router-view>
            </v-container>
        </v-content>
    </v-app>
</template>
<script>
    import SideBar from "./SideBar";
    import SearchBar from "./SearchBar";
    import UserTooltip from "./UserTooltip";

    export default {
        components: {UserTooltip, SearchBar, SideBar},
    }
</script>
