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
                            loading-text="Fetching deposit list... Please wait"
                            :headers="tableOfflineDepositHeaders"
                            :items="tableDeposits"
                            :search="tableSearch"
                        >
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-toolbar-title class="headline"
                                        >Offline Deposit Audits</v-toolbar-title
                                    >
                                    <div class="flex-grow-1"></div>
                                    <!-- <v-btn
                                        small
                                        @click="formDepositDialog = true"
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
                                    tableDeposits
                                        .map(function(x) {
                                            return x.id;
                                        })
                                        .indexOf(item.id) + 1
                                }}
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <v-btn icon @click="approveDeposit(item)">
                                    <v-icon color="primary">mdi-check</v-icon>
                                </v-btn>
                                <v-btn icon @click="declineDeposit(item)">
                                    <v-icon color="red">mdi-close</v-icon>
                                </v-btn>
                            </template>
                        </v-data-table>
                    </v-container>
                </v-card>
            </v-col>
        </v-row>
        <!-- <v-dialog v-model="formDepositDialog" max-width="800px" persistent>
            <v-card>
                <v-overlay :value="componentOverlay">
                    <v-progress-circular
                        :size="100"
                        :width="5"
                        indeterminate
                    ></v-progress-circular>
                </v-overlay>
                <v-card-title class="headline">
                    {{ formDepositTitle }}
                </v-card-title>
                <v-card-text>
                    <v-row justify="center">
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="
                                    formDepositErrors.user.username
                                "
                                v-model="
                                    editedDepositInformation.user.username
                                "
                                label="Username"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                v-model="
                                    editedDepositInformation.user.password
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
                                :error-messages="formDepositErrors.name"
                                v-model="editedDepositInformation.name"
                                label="Name"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-text-field
                                type="text"
                                :error-messages="formDepositErrors.number"
                                v-model="editedDepositInformation.number"
                                label="Number"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-select
                                :error-messages="formDepositErrors.status"
                                v-model="editedDepositInformation.status"
                                label="Status"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                type="text"
                                :error-messages="formDepositErrors.address"
                                v-model="editedDepositInformation.address"
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
                    <v-btn class="px-12" text @click="closeDepositForm"
                        >Cancel</v-btn
                    >
                    <v-btn class="px-12" @click="saveDeposit" color="primary"
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
            tableDeposits: [],
            formDepositDialog: false,
            formDepositListDialog: false,

            formDepositErrors: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
                lat: 6.9214,
                lng: 122.079
            },

            tableOfflineDepositHeaders: [
                { text: "Serial Number", value: "id" },
                { text: "UID", value: "client.id" },
                { text: "Email", value: "client.email" },
                { text: "Mobile Number", value: "client.mobile_number" },
                { text: "Nickname", value: "client.nickname" },
                { text: "Top-up Account", value: "top_up_account" },
                { text: "Recharge Amount", value: "recharge_amount" },
                { text: "Transaction Type", value: "transaction_type" },
                { text: "Included in Performance", value: "included_in_performance" },
                { text: "Recharge Status", value: "recharge_status" },
                { text: "Account Type", value: "account_type" },
                { text: "IP Address", value: "ip_address" },
                { text: "Submission Time", value: "submission_time" },
                { text: "Response Time", value: "response_time" },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false,
                    align: "center"
                }
            ],

            editedDepositIndex: -1,
            editedDepositInformation: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
                latitude: 6.9214,
                longitude: 122.079
            },
            defaultDepositInformation: {
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
                depositRules: [
                    v => !!v || "Deposit Number is required",
                    v =>
                        (!!v && v.length >= 10) ||
                        "Deposit Number must be 11 characters",
                    v =>
                        (!!v && v.length < 11) ||
                        "Deposit Number must not be more than 11 characters"
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
        formDepositTitle() {
            return this.editedDepositIndex === -1
                ? "New Deposit Audit"
                : "Edit Deposit Audit";
        }
    },

    mounted() {
        this.fetchDeposits();
    },

    methods: {

        fetchDeposits() {
            this.tableLoading = true;
            this.componentOverlay = true;
            axios
                .get("/api/v1/deposits", {
                    params: {
                        status: 'PENDING'
                    }
                })
                .then(response => {
                    this.tableDeposits = response.data.clients;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.componentOverlay = false;
                    this.tableLoading = false;
                });
        },

        approveDeposit(deposit)
        {

                this.editedDepositIndex = this.tableDeposits.indexOf(deposit);
                this.editedDepositInformation = Object.assign({}, deposit);

                
            axios
                .put("/api/v1/deposits/" + this.editedDepositInformation.id, {
                    status: 'APPROVED'
                })
                .then(response => {
                    this.fetchDeposits();
                    swal.fire({
                        position: "top-end",
                        toast: true,
                        type: "success",
                        icon: "success",
                        text: "Successfully Approved",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(error => {
                    this.componentOverlay = false;

                    if (error.response.status == 422) {
                        this.formDepositErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        declineDeposit(deposit)
        {

                this.editedDepositIndex = this.tableDeposits.indexOf(deposit);
                this.editedDepositInformation = Object.assign({}, deposit);

                
            axios
                .put("/api/v1/deposits/" + this.editedDepositInformation.id, {
                    status: 'DISSAPROVED'
                })
                .then(response => {
                    this.fetchDeposits();
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
                        this.formDepositErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },


        saveDeposit() {
            this.componentOverlay = true;
            if (this.editedDepositIndex > -1) {
                this.updateDeposit();
            } else {
                this.createDeposit();
            }
        },

        createDeposit() {
            axios
                .post("/api/v1/offline-deposit-audit", {
                    ..._.omit(this.editedDepositInformation, "user"),
                    ...this.editedDepositInformation.user,
                    password_confirmation: this.editedDepositInformation.user
                        .password
                })
                .then(response => {
                    this.fetchDeposits();
                    this.closeDepositForm();
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
                        this.formDepositErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        editDeposit(deposit) {
            this.editedDepositIndex = this.tableDeposits.indexOf(deposit);
            this.editedDepositInformation = Object.assign({}, deposit);
            this.formDepositDialog = true;
        },

        updateDeposit() {
            axios
                .put("/api/v1/offline-deposit-audit/" + this.editedDepositInformation.id, {
                    ..._.omit(this.editedDepositInformation, "user"),
                    ...this.editedDepositInformation.user,
                    password_confirmation: this.editedDepositInformation.user
                        .password
                })
                .then(response => {
                    this.fetchDeposits();
                    this.closeDepositForm();
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
                        this.formDepositErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        deleteDeposit(deposit) {
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
                            .delete("/api/v1/offline-deposit-audit/" + deposit.id)
                            .then(() => {
                                this.fetchDeposits();
                                this.closeDepositForm();
                                swal.fire(
                                    "Deleted!",
                                    "Deposit has been deleted.",
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

        // closeDepositForm() {
        //     this.formDepositDialog = false;
        //     this.componentOverlay = false;
        //     this.deleteDialog = false;
        //     setTimeout(() => {
        //         this.formDepositErrors = {
        //             name: null,
        //             user: { username: null, password: null }
        //         };
        //         this.editedDepositInformation = Object.assign(
        //             {},
        //             this.defaultDepositInformation
        //         );
        //         this.editedDepositIndex = -1;
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
