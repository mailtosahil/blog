<template>
    <v-app  >
        <Header></Header>
        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import Header from "./common/header";
export default {
    components: {
        Header
    }
};
</script>

<style>

</style>
