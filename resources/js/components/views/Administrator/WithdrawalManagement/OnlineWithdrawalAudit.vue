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
                            loading-text="Fetching withdrawal list... Please wait"
                            :headers="tableOfflineWithdrawalHeaders"
                            :items="tableWithdrawals"
                            :search="tableSearch"
                        >
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-toolbar-title class="headline"
                                        >Online Withdrawal Audits</v-toolbar-title
                                    >
                                    <div class="flex-grow-1"></div>
                                    <!-- <v-btn
                                        small
                                        @click="formWithdrawalDialog = true"
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
                                    tableWithdrawals
                                        .map(function(x) {
                                            return x.id;
                                        })
                                        .indexOf(item.id) + 1
                                }}
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <v-btn icon @click="approveWithdrawal(item)">
                                    <v-icon color="primary">mdi-arrow-right-bold</v-icon>
                                </v-btn>
                                <v-btn icon @click="declineWithdrawal(item)">
                                    <v-icon color="red">mdi-arrow-left-bold</v-icon>
                                </v-btn>
                            </template>
                        </v-data-table>
                    </v-container>
                </v-card>
            </v-col>
        </v-row>
        <!-- <v-dialog v-model="formWithdrawalDialog" max-width="800px" persistent>
            <v-card>
                <v-overlay :value="componentOverlay">
                    <v-progress-circular
                        :size="100"
                        :width="5"
                        indeterminate
                    ></v-progress-circular>
                </v-overlay>
                <v-card-title class="headline">
                    {{ formWithdrawalTitle }}
                </v-card-title>
                <v-card-text>
                    <v-row justify="center">
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="
                                    formWithdrawalErrors.user.username
                                "
                                v-model="
                                    editedWithdrawalInformation.user.username
                                "
                                label="Username"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                v-model="
                                    editedWithdrawalInformation.user.password
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
                                :error-messages="formWithdrawalErrors.name"
                                v-model="editedWithdrawalInformation.name"
                                label="Name"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-text-field
                                type="text"
                                :error-messages="formWithdrawalErrors.number"
                                v-model="editedWithdrawalInformation.number"
                                label="Number"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-select
                                :error-messages="formWithdrawalErrors.status"
                                v-model="editedWithdrawalInformation.status"
                                label="Status"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                type="text"
                                :error-messages="formWithdrawalErrors.address"
                                v-model="editedWithdrawalInformation.address"
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
                    <v-btn class="px-12" text @click="closeWithdrawalForm"
                        >Cancel</v-btn
                    >
                    <v-btn class="px-12" @click="saveWithdrawal" color="primary"
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
            tableWithdrawals: [],
            formWithdrawalDialog: false,
            formWithdrawalListDialog: false,

            formWithdrawalErrors: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
                lat: 6.9214,
                lng: 122.079
            },

            tableOfflineWithdrawalHeaders: [
                { text: "Serial Number", value: "id" },
                { text: "UID", value: "client.id" },
                { text: "Email", value: "client.email" },
                { text: "Mobile Number", value: "client.mobile_number" },
                { text: "Chain Name", value: "bchain_name" },
                { text: "Withdrawal Address", value: "withdraw_address" },
                { text: "Withdrawal Amount", value: "withdraw_amount" },
                { text: "Miner Fee", value: "miner_fee" },
                { text: "Actual Arrival Quantity", value: "arrival_quantity" },
                { text: "Status", value: "state" },
                { text: "Application Time", value: "application_time" },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false,
                    align: "center"
                }
            ],

            editedWithdrawalIndex: -1,
            editedWithdrawalInformation: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
                latitude: 6.9214,
                longitude: 122.079
            },
            defaultWithdrawalInformation: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
            },


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
                withdrawRules: [
                    v => !!v || "Withdrawal Number is required",
                    v =>
                        (!!v && v.length >= 10) ||
                        "Withdrawal Number must be 11 characters",
                    v =>
                        (!!v && v.length < 11) ||
                        "Withdrawal Number must not be more than 11 characters"
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
        formWithdrawalTitle() {
            return this.editedWithdrawalIndex === -1
                ? "New Withdrawal Audit"
                : "Edit Withdrawal Audit";
        }
    },

    mounted() {
        this.fetchWithdrawals();
    },

    methods: {

        fetchWithdrawals() {
            this.tableLoading = true;
            this.componentOverlay = true;
            axios
                .get("/api/v1/withdrawals", {
                    params: {
                        status: 'ONHOLD'
                    }
                })
                .then(response => {
                    this.tableWithdrawals = response.data.withdraw;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.componentOverlay = false;
                    this.tableLoading = false;
                });
        },

        approveWithdrawal(withdraw)
        {

                this.editedWithdrawalIndex = this.tableWithdrawals.indexOf(withdraw);
                this.editedWithdrawalInformation = Object.assign({}, withdraw);

                
            axios
                .put("/api/v1/withdrawals/" + this.editedWithdrawalInformation.id, {
                    status: 'PROCEED'
                })
                .then(response => {
                    this.fetchWithdrawals();
                    swal.fire({
                        position: "top-end",
                        toast: true,
                        type: "success",
                        icon: "success",
                        text: "Successfully Proceeded",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(error => {
                    this.componentOverlay = false;

                    if (error.response.status == 422) {
                        this.formWithdrawalErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        declineWithdrawal(withdraw)
        {

                this.editedWithdrawalIndex = this.tableWithdrawals.indexOf(withdraw);
                this.editedWithdrawalInformation = Object.assign({}, withdraw);

                
            axios
                .put("/api/v1/withdrawals/" + this.editedWithdrawalInformation.id, {
                    status: 'RETURN'
                })
                .then(response => {
                    this.fetchWithdrawals();
                    swal.fire({
                        position: "top-end",
                        toast: true,
                        type: "success",
                        icon: "success",
                        text: "Successfully dissaproved",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(error => {
                    this.componentOverlay = false;

                    if (error.response.status == 422) {
                        this.formWithdrawalErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },


        saveWithdrawal() {
            this.componentOverlay = true;
            if (this.editedWithdrawalIndex > -1) {
                this.updateWithdrawal();
            } else {
                this.createWithdrawal();
            }
        },

        createWithdrawal() {
            axios
                .post("/api/v1/offline-withdraw-audit", {
                    ..._.omit(this.editedWithdrawalInformation, "user"),
                    ...this.editedWithdrawalInformation.user,
                    password_confirmation: this.editedWithdrawalInformation.user
                        .password
                })
                .then(response => {
                    this.fetchWithdrawals();
                    this.closeWithdrawalForm();
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
                        this.formWithdrawalErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        editWithdrawal(withdraw) {
            this.editedWithdrawalIndex = this.tableWithdrawals.indexOf(withdraw);
            this.editedWithdrawalInformation = Object.assign({}, withdraw);
            this.formWithdrawalDialog = true;
        },

        updateWithdrawal() {
            axios
                .put("/api/v1/offline-withdraw-audit/" + this.editedWithdrawalInformation.id, {
                    ..._.omit(this.editedWithdrawalInformation, "user"),
                    ...this.editedWithdrawalInformation.user,
                    password_confirmation: this.editedWithdrawalInformation.user
                        .password
                })
                .then(response => {
                    this.fetchWithdrawals();
                    this.closeWithdrawalForm();
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
                        this.formWithdrawalErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        deleteWithdrawal(withdraw) {
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
                            .delete("/api/v1/offline-withdraw-audit/" + withdraw.id)
                            .then(() => {
                                this.fetchWithdrawals();
                                this.closeWithdrawalForm();
                                swal.fire(
                                    "Deleted!",
                                    "Withdrawal has been deleted.",
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

        // closeWithdrawalForm() {
        //     this.formWithdrawalDialog = false;
        //     this.componentOverlay = false;
        //     this.deleteDialog = false;
        //     setTimeout(() => {
        //         this.formWithdrawalErrors = {
        //             name: null,
        //             user: { username: null, password: null }
        //         };
        //         this.editedWithdrawalInformation = Object.assign(
        //             {},
        //             this.defaultWithdrawalInformation
        //         );
        //         this.editedWithdrawalIndex = -1;
        //     }, 500);
        // },
    },
    beforeRouteEnter (to, from, next) {
        if(sessionStorage.getItem('user-type') != "ADMINISTRATOR"){
          return next('/')
        }
        next();
    },
    
};

</script>
