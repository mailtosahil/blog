<template>
    <validation-observer ref="observer" v-slot="{ invalid }">
        <form @submit.prevent="handleSubmit" method="POST" refs="form">
            <validation-provider
                v-slot="{ errors }"
                name="Title"
                rules="required|min:3|max:255"
            >
                <v-text-field
                    v-model="form.title"
                    :counter="255"
                    :error-messages="errors"
                    label="Title"
                    required
                ></v-text-field>
            </validation-provider>
            
            <v-btn
                class="mr-4 primary"
                type="submit"
                :disabled="invalid"
                :loading="loading"
            >
                Submit
            </v-btn>
        </form>
    </validation-observer>
</template>

<script>
export default {
    data: () => ({
        valid: true,
        form: {
            title: ""
        },
        media: "",
        loading: false
    }),

    methods: {
        imageSelect(e) {
            this.media = e.target.files[0];
        },
        async handleSubmit() {
            this.loading = true;
            this.$refs.observer.validate();
            const formData = new FormData();
            for (var key in this.form) {
                formData.append(key, this.form[key]);
            }
            formData.append("cover_image", this.media);
            formData.append("_method", 'put');
            await axios
                .post("/app/post/" + this.$route.params.id, formData)
                .then(response => {
                    this.loading = false;
                    const responseData = response.data;
                    this.$toasted.show("Updated.");
                })
                .catch(err => {
                    const response = err.response;
                    this.loading = false;
                    if (response.status == 422) {
                        let msg = "Please check your validation!";
                        if (response.data) {
                            for (var prop in response.data.errors) {
                                this.$toasted.show(response.data.errors[prop]);
                            }
                        }
                    } else {
                        this.$toasted.show("Please try again later!");
                    }
                });
        },
        async getData(id) {
            await axios
                .get("/app/post/" + id)
                .then(response => {
                    const data = response.data;
                    if (data.title) {
                        this.form.title = data.title;
                    } else {
                        this.$toasted.show("Server Error!");
                    }
                })
                .catch(err => {
                    this.$toasted.show("Server Error!");
                });
        }
    },
    created() {
        this.getData(this.$route.params.id);
    }
};
</script>

<style></style>
