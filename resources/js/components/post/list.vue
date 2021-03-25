<template>
    <div class="posts">
        <v-card>
            <v-card-title>Post List</v-card-title>
            <v-btn color="primary mr-4 float-right" to="/post/add" dark class="mb-2">
                Add
            </v-btn>
            <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="posts"
                :search="search"
            >
             <template v-slot:item.cover_image="{ item }">
                    <img
                        :src="'./storage/' + item.cover_image"
                        width="80px"
                        height="80px"
                    />
                </template>
                <template v-slot:item.actions="{ item }">
                   
                    <v-icon small class="mr-2" @click="editItem(item)">
                        mdi-pencil
                    </v-icon>
                    
                </template>
                <template v-slot:no-data>
                    <v-btn color="primary" @click="initialize">
                        Reset
                    </v-btn>
                </template>
            </v-data-table>
        </v-card>
        
    </div>
</template>

<script>
export default {
    name: "posts",
    data() {
        return {
            posts: [],
            headers: [
                { text: "Id", value: "id" },
                { text: "Title", value: "title" },
                { text: "Cover image", value: "cover_image" },
                { text: "Actions", value: "actions", sortable: false }
            ],
            search: ""
        };
    },
    methods: {
        async initialize() {
           await  axios
                .get("/app/post")
                .then(response => {
                    this.posts = response.data;
                })
                .catch(err => {
                    this.$toasted.show("Server Error!");
                });
        },
        editItem(item) {
            this.$router.push("/post/edit/" + item.id);
        },
       
    },
    created() {
        this.initialize();
    }
};
</script>
