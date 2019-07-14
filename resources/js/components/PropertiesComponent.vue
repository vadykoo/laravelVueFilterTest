<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <b-container fluid>
                        <b-row class="my-1">
                            <b-col sm="2">
                                <label for="name">Name:</label>
                            </b-col>
                            <b-col sm="5">
                                <b-form-input id="name" v-model="name" placeholder="Enter property name"></b-form-input>
                            </b-col>
                            <b-col sm="2">
                                <label for="bedrooms">Bedrooms:</label>
                            </b-col>
                            <b-col sm="3">
                                <b-form-input id="bedrooms" type="number" v-model="bedrooms" ></b-form-input>
                            </b-col>
                        </b-row>
                        <b-row class="my-1">
                            <b-col sm="2">
                                <label for="bathrooms">Bathrooms:</label>
                            </b-col>
                            <b-col sm="2">
                                <b-form-input id="bathrooms"  type="number" v-model="bathrooms"></b-form-input>
                            </b-col>
                            <b-col sm="2">
                                <label for="storeys">Storeys:</label>
                            </b-col>
                            <b-col sm="2">
                                <b-form-input id="storeys" type="number" v-model="storeys" ></b-form-input>
                            </b-col>
                            <b-col sm="2">
                                <label for="garages">Garages:</label>
                            </b-col>
                            <b-col sm="2">
                                <b-form-input id="garages" type="number" v-model="garages" ></b-form-input>
                            </b-col>
                        </b-row>
                        <b-row class="my-1">
                            <b-col sm="2">
                                <label for="minPrice">Min Price:</label>
                            </b-col>
                            <b-col sm="4">
                                <b-form-input id="minPricxe" v-model="minPrice"></b-form-input>
                            </b-col>
                            <b-col sm="2">
                                <label for="maxPrice">Max Price:</label>
                            </b-col>
                            <b-col sm="4">
                                <b-form-input id="maxPrice" type="number" v-model="maxPrice" ></b-form-input>
                            </b-col>
                        </b-row>
                    </b-container>
                    <div class="row">
                        <div class="col-lg-12">
                            <b-button class="col-4 float-right" variant="success" v-on:click="fetch"><b-spinner small v-if="spinner" type="grow" label="Spinning"></b-spinner>
                                Search</b-button>
                        </div>
                    </div>
                    <div v-if="spinner">
                        <p class="text-center"><b-spinner type="grow" label="Spinning"></b-spinner>Loading</p>
                    </div>
                    <div v-else-if="properties.length < 1">
                        <p class="text-center">Properties not found</p>
                    </div>
                    <div v-else-if="properties.length > 0">
                        <b-table striped hover :items="properties"></b-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                properties: [],
                spinner: true
            };
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                this.spinner = true;
                axios.get('/api/properties', { params: { name: this.name, bedrooms: this.bedrooms,
                        bathrooms: this.bathrooms, storeys: this.storeys, garages: this.garages,
                        minPrice: this.minPrice, maxPrice: this.maxPrice } })
                    .then(response => {
                        this.properties = response.data
                            this.spinner = false;
                    })
                    .catch(error => {});
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
