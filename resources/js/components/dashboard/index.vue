<template>
    <div class="dashboard">
        <v-row>
            <v-col lg="4">
                <v-card max-width="344" outlined color="primary">
                    <v-list-item three-line>
                        <v-list-item-content>
                            <div class="overline mb-4 white--text">
                                Total Posts
                            </div>
                        </v-list-item-content>
                        <v-list-item-avatar
                            tile
                            size="80"
                            class="white--text"
                            >{{ totalPosts }}</v-list-item-avatar
                        >
                    </v-list-item>

                    <v-card-actions>
                        <v-btn
                            to="/posts"
                            outlined
                            rounded
                            text
                            class="white--text"
                        >
                            More
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    name: "overviews",
    data() {
        return {
            totalPosts: 0
        };
    },
    methods: {
        async initialize() {
            await axios
                .get("/app/dashboard")
                .then(response => {
                    const data = response.data;
                    this.totalPosts = data.totalPosts;
                })
                .catch(err => {
                    this.$toasted.show("Server Error!");
                });
        }
    },
    created() {
        this.initialize();
    }
};
</script>
