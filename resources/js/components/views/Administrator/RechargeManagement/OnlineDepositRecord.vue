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
                            loading-text="Fetching certificates list... Please wait"
                            :headers="tableTransferHeaders"
                            :items="tableCurrencyTransfers"
                            :search="tableSearch"
                        >
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-toolbar-title class="headline"
                                        >Currency Transfer Certificates</v-toolbar-title
                                    >
                                    <div class="flex-grow-1"></div>
                                    <!-- <v-btn
                                        small
                                        @click="formTransferDialog = true"
                                        color="primary"
                                    >
                                        <v-icon small left
                                            >mdi-plus-circle</v-icon
                                        >
                                        Add Offline 
                                    </v-btn> -->
                                </v-toolbar>
                            </template>
                            <template v-slot:item.id="{ item }">
                                {{
                                    tableCurrencyTransfers
                                        .map(function(x) {
                                            return x.id;
                                        })
                                        .indexOf(item.id) + 1
                                }}
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <v-btn icon @click="editTransfer(item)">
                                    <v-icon>mdi-pencil</v-icon>
                                </v-btn>
                                <v-btn icon @click="deleteTransfer(item)">
                                    <v-icon>mdi-delete</v-icon>
                                </v-btn>
                            </template>
                        </v-data-table>
                    </v-container>
                </v-card>
            </v-col>
        </v-row>
        <!-- <v-dialog v-model="formTransferDialog" max-width="800px" persistent>
            <v-card>
                <v-overlay :value="componentOverlay">
                    <v-progress-circular
                        :size="100"
                        :width="5"
                        indeterminate
                    ></v-progress-circular>
                </v-overlay>
                <v-card-title class="headline">
                    {{ formTransferTitle }}
                </v-card-title>
                <v-card-text>
                    <v-row justify="center">
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="
                                    formTransferErrors.user.username
                                "
                                v-model="
                                    editedTransferInformation.user.username
                                "
                                label="Username"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                v-model="
                                    editedTransferInformation.user.password
                                "
                                label="Password"
                                id="password"
                                name="password"
                                prepend-icon="fa-lock"
                                :append-icon="
                                    visible ? 'mdi-eye-off' : 'mdi-eye'
                                "
                                @click:append="visible = !visible"
                                :rules="rules.passwordRules"
                                :type="visible ? 'text' : 'password'"
                                @keydown.enter="login()"
                            />
                        </v-col>
                    </v-row>
                    <v-row justify="center">
                        <v-col cols="12" md="4">
                            <v-text-field
                                type="text"
                                :error-messages="formTransferErrors.name"
                                v-model="editedTransferInformation.name"
                                label="Name"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-text-field
                                type="text"
                                :error-messages="formTransferErrors.number"
                                v-model="editedTransferInformation.number"
                                label="Number"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-select
                                :error-messages="formTransferErrors.status"
                                v-model="editedTransferInformation.status"
                                label="Status"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                type="text"
                                :error-messages="formTransferErrors.address"
                                v-model="editedTransferInformation.address"
                                label="Address"
                            />
                        </v-col>
                    </v-row>
                    <v-row
                        ><v-col cols="12">
                            
                    </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="px-12" text @click="closeTransferForm"
                        >Cancel</v-btn
                    >
                    <v-btn class="px-12" @click="saveTransfer" color="primary"
                        >Save</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog> -->
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            componentOverlay: false,
            // profileId: sessionStorage.getItem("profile-id"),
            tableLoading: true,
            tableSearch: null,
            searchInput: "",
            visible: false,
            tableCurrencyTransfers: [],
            formTransferDialog: false,
            formTransferListDialog: false,

            formTransferErrors: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
                lat: 6.9214,
                lng: 122.079
            },

            tableTransferHeaders: [
                { text: "Serial Number", value: "id" },
                { text: "UID", value: "client.uid" },
                { text: "Email", value: "email" },
                { text: "Mobile Number", value: "mobile_number" },
                { text: "State", value: "" },
                { text: "Picture", value: "" },
                { text: "Remarks", value: "" },
                { text: "Upload Time", value: "" },
                { text: "Handler", value: "" },
                { text: "Processing Time", value: "" },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false,
                    align: "center"
                }
            ],

            editedTransferIndex: -1,
            editedTransferInformation: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
                latitude: 6.9214,
                longitude: 122.079
            },
            defaultTransferInformation: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
                latitude: 6.9214,
                longitude: 122.079
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
        formTransferTitle() {
            return this.editedTransferIndex === -1
                ? "New Transfer"
                : "Edit Transfer";
        }
    },

    mounted() {
        this.fetchCurrencyTransfers();
    },

    methods: {

        fetchCurrencyTransfers() {
            this.tableLoading = true;
            this.componentOverlay = true;
            axios
                .get("/api/v1/offline-currency-transfer")
                .then(response => {
                    this.tableCurrencyTransfers = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.componentOverlay = false;
                    this.tableLoading = false;
                });
        },

        saveTransfer() {
            this.componentOverlay = true;
            if (this.editedTransferIndex > -1) {
                this.updateTransfer();
            } else {
                this.createTransfer();
            }
        },

        createTransfer() {
            axios
                .post("/api/v1/offline-currency-transfer", {
                    ..._.omit(this.editedTransferInformation, "user"),
                    ...this.editedTransferInformation.user,
                    password_confirmation: this.editedTransferInformation.user
                        .password
                })
                .then(response => {
                    this.fetchCurrencyTransfers();
                    this.closeTransferForm();
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
                        this.formTransferErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        editTransfer(currencyTransfer) {
            this.editedTransferIndex = this.tableCurrencyTransfers.indexOf(currencyTransfer);
            this.editedTransferInformation = Object.assign({}, currencyTransfer);
            this.formTransferDialog = true;
        },

        updateTransfer() {
            axios
                .put("/api/v1/offline-currency-transfer/" + this.editedTransferInformation.id, {
                    ..._.omit(this.editedTransferInformation, "user"),
                    ...this.editedTransferInformation.user,
                    password_confirmation: this.editedTransferInformation.user
                        .password
                })
                .then(response => {
                    this.fetchCurrencyTransfers();
                    this.closeTransferForm();
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
                        this.formTransferErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        deleteTransfer(currencyTransfer) {
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
                            .delete("/api/v1/offline-currency-transfer/" + currencyTransfer.id)
                            .then(() => {
                                this.fetchCurrencyTransfers();
                                this.closeTransferForm();
                                swal.fire(
                                    "Deleted!",
                                    "Transfer has been deleted.",
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

        // closeTransferForm() {
        //     this.formTransferDialog = false;
        //     this.componentOverlay = false;
        //     this.deleteDialog = false;
        //     setTimeout(() => {
        //         this.formTransferErrors = {
        //             name: null,
        //             user: { username: null, password: null }
        //         };
        //         this.editedTransferInformation = Object.assign(
        //             {},
        //             this.defaultTransferInformation
        //         );
        //         this.editedTransferIndex = -1;
        //     }, 500);
        // },
    },
    beforeRouteEnter (to, from, next) {
        if(sessionStorage.getItem('user-type') != "ADMINISTRATOR"){
          return next('/')
        }
        next();
    }
};

</script>
