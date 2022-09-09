<template>
    <v-container fluid>
        <!-- <v-overlay :value="componentOverlay">
            <v-progress-circular
                :size="100"
                :width="5"
                indeterminate
            ></v-progress-circular>
        </v-overlay> -->
        <v-row justify-center wrap>
            <v-col md10>
                <v-card class="elevation-9 ma-4">
                    <v-container>
                        <v-data-table
                            :loading="tableLoading"
                            loading-text="Fetching Coin's list... Please wait"
                            :headers="tableCoinHeaders"
                            :items="tableCoins"
                            :search="tableSearch"
                        >
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-toolbar-title class="headline"
                                        >Coins</v-toolbar-title
                                    >
                                    <div class="flex-grow-1"></div>
                                    <v-btn
                                        small
                                        @click="formCoinDialog = true"
                                        color="primary"
                                    >
                                        <v-icon small left
                                            >mdi-plus-circle</v-icon
                                        >
                                        Add Coin 
                                    </v-btn>
                                </v-toolbar>
                            </template>
                            <!-- <template v-slot:item.id="{ item }">
                                {{
                                    tableCoins
                                        .map(function(x) {
                                            return x.id;
                                        })
                                        .indexOf(item.id) + 1
                                }}
                            </template> -->
                            <template v-slot:item.logo="{ item }">
                                <v-img
                                    max-height="50"
                                    max-width="50"
                                    :src="item.image"
                                    contain
                                ></v-img>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <v-btn icon @click="editCoin(item)">
                                    <v-icon>mdi-pencil</v-icon>
                                </v-btn>
                            </template>
                        </v-data-table>
                    </v-container>
                </v-card>
            </v-col>
        </v-row>
        <v-dialog v-model="formCoinDialog" max-width="800px" persistent>
            <v-card>
                <v-overlay :value="componentOverlay">
                    <v-progress-circular
                        :size="100"
                        :width="5"
                        indeterminate
                    ></v-progress-circular>
                </v-overlay>
                <v-card-title class="headline">
                    {{ formCoinTitle }}
                </v-card-title>
                <v-card-text>
                    <v-row justify-center>
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="formCoinErrors.name"
                                v-model="editedCoinInformation.name"
                                label="Currency Name"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-file-input outlined v-model="image_name" small-chips accept="image/png, image/jpeg, image/bmp" placeholder="Pick an image" label="Image" @change="image_upload"></v-file-input>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="px-12" text @click="closeCoinForm"
                        >Cancel</v-btn
                    >
                    <v-btn class="px-12" @click="saveCoin" color="primary"
                        >Save</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            componentOverlay: false,
            // profileId: sessionStorage.getItem("profile-id"),
            tableLoading: true,
            tableSearch: null,
            searchInput: "",
            visible: false,
            image_name: null,
            image_data: null,
            tableCoins: [],
            itemCoins: [],
            tableAssets: [],
            formCoinDialog: false,
            formRechargeDialog: false,
            formCoinListDialog: false,
            formAssetsDialog: false,

            formCoinErrors: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
            },

            formRechargeErrors: {
                coin: null, 
                account_type: null,
                included_in_performance: null,
                amount: null,
            },

            tableCoinHeaders: [  
                { text: "UID", value: "id" },
                { text: "Currency", value: "name" },
                { text: "logo", value: "logo" },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false,
                    
                }
                

            ],

            editedCoinIndex: -1,
            editedCoinInformation: {
                name: null,
                image_data: null,

            },
            defaultCoinInformation: {
                name: null,
                image_data: null,
            },
            //Google Maps Variables

            rules: {
                required: [
                    v => !!v || "Field is required",
                    v =>
                        (!!v && v.length <= 255) ||
                        " Field should not be more than 255 characters"
                ],
                emailRules: [
                    v => !!v || "E-mail is required",
                    v =>
                        /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
                        "E-mail must be valid",
                    v =>
                        (!!v && v.length <= 255) ||
                        "E-mail must not be more than 255 characters"
                ],
                mobileRules: [
                    v => !!v || "Mobile Number is required",
                    v =>
                        (!!v && v.length >= 10) ||
                        "Mobile Number must be 11 characters",
                    v =>
                        (!!v && v.length < 11) ||
                        "Mobile Number must not be more than 11 characters"
                ],

                amountRules: [
                    v => !!v || "Amount is required",
                ],

               
                passwordRules: [
                    v => !!v || "Password is required",
                    v =>
                        (!!v && v.length >= 8) ||
                        "Password must be more than 8 characters"
                ]
            }
        };
    },

    computed: {
        formCoinTitle() {
            return this.editedCoinIndex === -1
                ? "New Coin"
                : "Edit Coin";
        }
    },

    mounted() {
        this.fetchCoins();
        this.fetchCoins();
    },

    methods: {

        fetchCoins() {
            axios
                .get("/api/v1/coins")
                .then(response => {
                    this.tableCoins = response.data.coins;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.componentOverlay = false;
                    this.tableLoading = false;
                });
        },


        saveCoin() {
            this.componentOverlay = true;
            if (this.editedCoinIndex > -1) {
                this.updateCoin();
            } else {
                this.createCoin();
            }
        },

        saveRecharge()
        {
            this.componentOverlay = true;
            this.createDeposit();
        },

        image_upload() {
          try {
              let reader = new FileReader()
              reader.onload = () => {
                  this.image_data = reader.result
              }
              reader.readAsDataURL(this.image_name)
          } catch (error) {
              this.image_name = null
              this.image_data = null
          }
        },

        createCoin() {
            axios
                .post("/api/v1/coins", {
                    ..._.omit(this.editedCoinInformation, "user"),
                    ...this.editedCoinInformation.user,
                    image: this.image_data,
                })
                .then(response => {
                    this.fetchCoins();
                    this.closeCoinForm();
                    swal.fire({
                        position: "top-end",
                        toast: true,
                        type: "success",
                        icon: "success",
                        text: "Successfully Created",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(error => {
                    this.componentOverlay = false;

                    if (error.response.status == 422) {
                        this.formCoinErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        editCoin(coin) {
            this.editedCoinIndex = this.tableCoins.indexOf(coin);
            this.editedCoinInformation = Object.assign({}, coin);
            this.formCoinDialog = true;
        },

        addRecharge(coin)
        {
            this.editedCoinIndex = this.tableCoins.indexOf(coin);
            this.editedCoinInformation = Object.assign({}, coin);
            this.formRechargeDialog = true;
        },

        updateCoin() {
            axios
                .put("/api/v1/coins/" + this.editedCoinInformation.id, {
                    ..._.omit(this.editedCoinInformation, "user"),
                    ...this.editedCoinInformation.user,
                    image: this.image_data,
                })
                .then(response => {
                    this.fetchCoins();
                    this.closeCoinForm();
                    swal.fire({
                        position: "top-end",
                        toast: true,
                        type: "success",
                        icon: "success",
                        text: "Successfully Updated",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(error => {
                    this.componentOverlay = false;

                    if (error.response.status == 422) {
                        this.formCoinErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        deleteCoin(coin) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            })
                .then(result => {
                    if (result.value) {
                        axios
                            .delete("/api/v1/coins/" + coin.id)
                            .then(() => {
                                this.fetchCoins();
                                this.closeCoinForm();
                                swal.fire(
                                    "Deleted!",
                                    "Coin has been deleted.",
                                    "success"
                                );
                            })
                            .catch(error => {
                                swal.fire(
                                    "Failed!",
                                    "There was something wrong.",
                                    "warning"
                                );
                                this.error = response.data.errors;
                                if (
                                    error.response.data.message ==
                                    "Unauthenticated."
                                ) {
                                    sessionStorage.clear();
                                    this.$router.push("/login");
                                }
                                return;
                            });
                    }
                })
                .catch(() => {
                    swal("Failed!", "There was something wrong.", "warning");
                });
        },

        closeCoinForm() {
            this.formCoinDialog = false;
            this.formRechargeDialog = false
            this.formAssetsDialog = false
            this.componentOverlay = false;
            this.deleteDialog = false;
            setTimeout(() => {
                this.formCoinErrors = {
                    name: null,
                    user: { username: null, password: null }
                };
                this.editedCoinInformation = Object.assign(
                    {},
                    this.defaultCoinInformation
                );
                this.editedCoinIndex = -1;
            }, 500);
        },
    },
    beforeRouteEnter (to, from, next) {
        if(sessionStorage.getItem('user-type') != "ADMINISTRATOR"){
          return next('/')
        }
        next();
    }
};

</script>
