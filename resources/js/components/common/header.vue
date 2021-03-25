<template>
    <div>
        <v-navigation-drawer v-model="drawer" app clipped color="primary" dark>
            <v-list dense>
                <v-list-item href="/">
                    <v-list-item-action>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Back to Home Page</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item
                    v-for="menu in mainItems"
                    link
                    :to="menu.link"
                    :key="menu.id"
                >
                    <v-list-item-action>
                        <v-icon>{{ menu.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{ menu.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item href="/logoutuser">
                    <v-list-item-action>
                        <v-icon>mdi-logout</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app clipped-left color="primary" dark>
            <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
            ></v-app-bar-nav-icon>
            <v-toolbar-title>Blog</v-toolbar-title>
        </v-app-bar>
    </div>
</template>

<script>
export default {
    props: {
        source: String
    },
    data: () => ({
        drawer: null,

        mainItems: [
            {
                id: "1",
                title: "Dashboard",
                link: "/home",
                icon: "mdi-view-dashboard"
            },
            { id: "2", title: "Post List", link: "/posts", icon: "mdi-buffer" }
        ]
    }),
    created() {
        // this.$vuetify.theme.dark = true;
    }
};
</script>

<style>
.container-fluid {
    padding-left: 0px;
    padding-right: 0px;
}
</style>
