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
                            loading-text="Fetching Customer's list... Please wait"
                            :headers="tableCustomerHeaders"
                            :items="tableCustomers"
                            :search="tableSearch"
                        >
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-toolbar-title class="headline"
                                        >Customers</v-toolbar-title
                                    >
                                    <div class="flex-grow-1"></div>
                                    <!-- <v-btn
                                        small
                                        @click="formCustomerDialog = true"
                                        color="primary"
                                    >
                                        <v-icon small left
                                            >mdi-plus-circle</v-icon
                                        >
                                        Add Offline 
                                    </v-btn> -->
                                </v-toolbar>
                            </template>
                            <!-- <template v-slot:item.id="{ item }">
                                {{
                                    tableCustomers
                                        .map(function(x) {
                                            return x.id;
                                        })
                                        .indexOf(item.id) + 1
                                }}
                            </template> -->
                            <template v-slot:item.actions="{ item }">
                                <v-btn icon @click="editCustomer(item)">
                                    <v-icon>mdi-pencil</v-icon>
                                </v-btn>
                                <v-btn icon @click="fetchAssets(item)">
                                    <v-icon>mdi-bitcoin</v-icon>
                                </v-btn>
                                <v-btn icon @click="addRecharge(item)">
                                    <v-icon>mdi-cash</v-icon>
                                </v-btn>
                                <v-btn icon @click="deleteCustomer(item)">
                                    <v-icon>mdi-delete</v-icon>
                                </v-btn>
                            </template>
                        </v-data-table>
                    </v-container>
                </v-card>
            </v-col>
        </v-row>
        <!-- <v-dialog v-model="formCustomerDialog" max-width="800px" persistent>
            <v-card>
                <v-overlay :value="componentOverlay">
                    <v-progress-circular
                        :size="100"
                        :width="5"
                        indeterminate
                    ></v-progress-circular>
                </v-overlay>
                <v-card-title class="headline">
                    {{ formCustomerTitle }}
                </v-card-title>
                <v-card-text>
                    <v-row justify="center">
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="
                                    formCustomerErrors.user.username
                                "
                                v-model="
                                    editedCustomerInformation.user.username
                                "
                                label="Username"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                v-model="
                                    editedCustomerInformation.user.password
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
                                :error-messages="formCustomerErrors.name"
                                v-model="editedCustomerInformation.name"
                                label="Name"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-text-field
                                type="text"
                                :error-messages="formCustomerErrors.number"
                                v-model="editedCustomerInformation.number"
                                label="Number"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-select
                                :error-messages="formCustomerErrors.status"
                                v-model="editedCustomerInformation.status"
                                label="Status"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                type="text"
                                :error-messages="formCustomerErrors.address"
                                v-model="editedCustomerInformation.address"
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
                    <v-btn class="px-12" text @click="closeCustomerForm"
                        >Cancel</v-btn
                    >
                    <v-btn class="px-12" @click="saveCustomer" color="primary"
                        >Save</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog> -->

        <!-- For Editing -->
        <v-dialog v-model="formCustomerDialog" max-width="800px" persistent>
            <v-card>
                <v-overlay :value="componentOverlay">
                    <v-progress-circular
                        :size="100"
                        :width="5"
                        indeterminate
                    ></v-progress-circular>
                </v-overlay>
                <v-card-title class="headline">
                    {{ formCustomerTitle }}
                </v-card-title>
                <v-card-text>
                    <v-row justify="center">
                        <!-- <v-col cols="12" md="6">
                            <v-text-field
                                v-model="
                                    editedCustomerInformation.user.password
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
                            />
                        </v-col> -->
                    </v-row>
                    
                    <v-row justify="center">
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="
                                    formCustomerErrors.user.username
                                "
                                v-model="
                                    editedCustomerInformation.user.username
                                "
                                label="Username"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="formCustomerErrors.nickname"
                                v-model="editedCustomerInformation.nickname"
                                label="Nickname"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="formCustomerErrors.number"
                                v-model="editedCustomerInformation.mobile_number"
                                label="Mobile Number"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-select
                                :error-messages="formCustomerErrors.status"
                                v-model="editedCustomerInformation.status"
                                :items="item_status"
                                item-text="name"
                                item-value="value"
                                label="Status"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="formCustomerErrors.address"
                                v-model="editedCustomerInformation.referal_email"
                                label="Referal Email"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-select
                                :error-messages="formCustomerErrors.status"
                                v-model="editedCustomerInformation.withdraw_transfer_status"
                                :items="item_withdraw_and_transfer"
                                item-text="name"
                                item-value="value"
                                label="Withdraw and Transfer Status"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-select
                                :error-messages="formCustomerErrors.status"
                                v-model="editedCustomerInformation.membership_level"
                                :items="item_membership_level"
                                item-text="name"
                                item-value="value"
                                
                                label="Membership Level"
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
                    <v-btn class="px-12" text @click="closeCustomerForm"
                        >Cancel</v-btn
                    >
                    <v-btn class="px-12" @click="saveCustomer" color="primary"
                        >Save</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="formRechargeDialog" max-width="800px" persistent>
            <v-card>
                <v-overlay :value="componentOverlay">
                    <v-progress-circular
                        :size="100"
                        :width="5"
                        indeterminate
                    ></v-progress-circular>
                </v-overlay>
                <v-card-title class="headline">
                    Recharge
                </v-card-title>
                <v-card-text>
                    <v-row justify="center">
                        <!-- <v-col cols="12" md="6">
                            <v-text-field
                                v-model="
                                    editedCustomerInformation.user.password
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
                            />
                        </v-col> -->
                    </v-row>
                    
                    <v-row justify="center">

                        <v-col cols="12" md="6">
                            <v-select
                                :error-messages="formRechargeErrors.coin"
                                v-model="defaultRechargeInformation.coin"
                                :items="itemCoins"
                                item-text="name"
                                item-value="id"
                                label="Select Coin"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-select
                                :error-messages="formRechargeErrors.included_in_performance"
                                v-model="defaultRechargeInformation.transaction_type"
                                :items="item_transaction_type"
                                item-text="name"
                                item-value="value"
                                label="Transaction Type"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-select
                                :error-messages="formRechargeErrors.included_in_performance"
                                v-model="defaultRechargeInformation.included_in_performance"
                                :items="item_ip"
                                item-text="name"
                                item-value="value"
                                label="Included in Performance"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="number"
                                :error-messages="formRechargeErrors.amountRule"
                                :rules="rules.amountRules"
                                v-model="defaultRechargeInformation.amount"
                                label="Amount"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            />
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="px-12" text @click="closeCustomerForm"
                        >Cancel</v-btn
                    >
                    <v-btn class="px-12" @click="saveRecharge" color="primary"
                        >Save</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-dialog v-model="formAssetsDialog" max-width="1200px" persistent>
            <v-card>
                <v-overlay :value="componentOverlay">
                    <v-progress-circular
                        :size="100"
                        :width="5"
                        indeterminate
                    ></v-progress-circular>
                </v-overlay>
                <v-card-title class="headline">
                    Customer Asset
                </v-card-title>
                <v-card-text>            
                        <v-container>
                            <v-data-table
                                :loading="tableLoading"
                                loading-text="Fetching Customer Asset's list... Please wait"
                                :headers="tableCustomerAssetsHeaders"
                                :items="tableAssets"
                                :search="tableSearch"
                            >
                                <template v-slot:top>
                                    <v-toolbar flat>
                                        <v-toolbar-title class="headline"
                                            >Customers</v-toolbar-title
                                        >
                                        <div class="flex-grow-1"></div>
                                        <!-- <v-btn
                                            small
                                            @click="formCustomerDialog = true"
                                            color="primary"
                                        >
                                            <v-icon small left
                                                >mdi-plus-circle</v-icon
                                            >
                                            Add Offline 
                                        </v-btn> -->
                                    </v-toolbar>
                                </template>
                                <!-- <template v-slot:item.id="{ item }">
                                    {{
                                        tableCustomers
                                            .map(function(x) {
                                                return x.id;
                                            })
                                            .indexOf(item.id) + 1
                                    }}
                                </template> -->
                                <template v-slot:item.actions="{ item }">
                                   
                                </template>
                            </v-data-table>
                        </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="px-12" text @click="closeCustomerForm"
                        >Close</v-btn
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
            tableCustomers: [],
            itemCoins: [],
            tableAssets: [],
            formCustomerDialog: false,
            formRechargeDialog: false,
            formCustomerListDialog: false,
            formAssetsDialog: false,

            formCustomerErrors: {
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

            item_status: [
                {'name': 'USABLE', 'value' : 'USABLE'},
                {'name': 'FREEZE_ACCOUNT', 'value' : 'FREEZE_ACCOUNT'},
            ],

            item_withdraw_and_transfer: [
                {'name': 'ALLOWED', 'value' : 'ALLOWED'},
                {'name': 'NOT_ALLOWED', 'value' : 'NOT_ALLOWED'},
            ],

            item_coin: [
                {'name': 'USDT', 'value' : 'USDT'},
            ],

            item_transaction_type: [
                {'name': 'RECHARGE', 'value' : 'RECHARGE'},
                {'name': 'DEDUCTION', 'value' : 'DEDUCTION'},
            ],

            item_ip: [
                {'name': 'YES', 'value' : 'YES'},
                {'name': 'NO', 'value' : 'NO'},
            ],

            item_membership_level: [
                {'name': 'VIP1', 'value' : 'VIP1'},
                {'name': 'VIP2', 'value' : 'VIP2'},
                {'name': 'VIP3', 'value' : 'VIP3'},
                {'name': 'VIP4', 'value' : 'VIP4'},
                {'name': 'VIP5', 'value' : 'VIP5'},
                {'name': 'VIP6', 'value' : 'VIP6'},
                {'name': 'VIP7', 'value' : 'VIP7'},
                {'name': 'VIP8', 'value' : 'VIP8'},
                {'name': 'VIP9', 'value' : 'VIP9'},
                {'name': 'VIP10', 'value' : 'VIP10'},
            ],

            tableCustomerHeaders: [
                { text: "Serial Number", value: "id" },
                { text: "UID", value: "id" },
                { text: "Nickname", value: "nickname" },
                { text: "Email", value: "email" },
                { text: "Nickname", value: "nickname" },
                { text: "Mobile Number", value: "mobile_number" },
                { text: "Mode of Verification", value: "" },
                { text: "Miner Level", value: "member_miner_level" },
                { text: "Referral Email", value: "referal_email" },
                { text: "Referal UID", value: "client_referal_id" },
                { text: "Withdrawal and Transfer", value: "withdraw_transfer_status" },
                { text: "Status", value: "status" },
                { text: "Aggreed to contract Agreement", value: "agree_to_contract_agreement" },
                { text: "Online Status", value: "" },
                { text: "Registered IP", value: "registered_ip" },
                { text: "Last Login IP", value: "last_logined_ip" },
                { text: "Current Login IP", value: "current_logined_ip" },
                { text: "Registered Source", value: "registered_source" },
                { text: "Number of Logins", value: "number_of_logins" },
                { text: "Queue", value: "queue" },
                { text: "Date Created", value: "created_at" },

                {
                    text: "Actions",
                    value: "actions",
                    sortable: false,
                    
                }
            ],

            tableCustomerAssetsHeaders: [
                { text: "Role", value: "client.role" },
                { text: "Email", value: "client.email" },
                { text: "UID", value: "client.id" },
                { text: "Currency", value: "coin.name" },
                { text: "Balance", value: "wallet_balance" },
                { text: "Restricted Withdraw Amount", value: "restricted_with_withdraw_amount" },
                { text: "Freeze", value: "freeze" },
                { text: "Credit", value: "credit" },
                { text: "Billing", value: "billing" },
                { text: "Wallet Address", value: "address" },
                

            ],

            editedCustomerIndex: -1,
            editedCustomerInformation: {
                name: null,
                email: null,
                mobile_number:null,
                email: null,
                nickname: null,
                role: null,
                withdraw_transfer_status: null,
                membership_level: null,
                user: { username: null, password: null },

            },
            defaultCustomerInformation: {
                name: null,
                email: null,
                mobile_number:null,
                referal_email: null,
                nickname: null,
                role: null,
                withdraw_and_transfer_status: null,
                membership_level: null,
                user: { username: null, password: null },
            },

            defaultRechargeInformation: {
                account_type: null,
                item_status: null,
                item_account_type: null,
                coin: null,
                transaction_type: null,
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
        formCustomerTitle() {
            return this.editedCustomerIndex === -1
                ? "New Customer"
                : "Edit Customer";
        }
    },

    mounted() {
        this.fetchCustomers();
        this.fetchCoins();
    },

    methods: {

        fetchCustomers() {
            this.tableLoading = true;
            this.componentOverlay = true;
            axios
                .get("/api/v1/clients")
                .then(response => {
                    this.tableCustomers = response.data.clients;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.componentOverlay = false;
                    this.tableLoading = false;
                });
        },

        fetchCoins() {
            axios
                .get("/api/v1/coins")
                .then(response => {
                    this.itemCoins = response.data.coins;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.componentOverlay = false;
                    this.tableLoading = false;
                });
        },

        fetchAssets(customer)
        {
            this.editedCustomerIndex = this.tableCustomers.indexOf(customer);
            this.editedCustomerInformation = Object.assign({}, customer);
            axios
                .get("/api/v1/wallets", {
                    params: {
                       client_id: this.editedCustomerInformation.id
                    }
                })
                .then(response => {
                    this.tableAssets = response.data.assets
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.componentOverlay = false;
                    this.tableLoading = false;
                });

                this.formAssetsDialog = true
        },

        saveCustomer() {
            this.componentOverlay = true;
            if (this.editedCustomerIndex > -1) {
                this.updateCustomer();
            } else {
                this.createCustomer();
            }
        },

        saveRecharge()
        {
            this.componentOverlay = true;
            this.createDeposit();
        },

        createDeposit()
        {
            axios
                .post("/api/v1/deposits", {
                   client_id: this.editedCustomerInformation.id,
                   coin_id: this.defaultRechargeInformation.coin,
                   transaction_type: this.defaultRechargeInformation.transaction_type,
                   included_in_performance: this.defaultRechargeInformation.included_in_performance,
                   recharge_amount: this.defaultRechargeInformation.amount,
                   account_type : this.editedCustomerInformation.membership_level
                })
                .then(response => {
                    this.fetchCustomers();
                    this.closeCustomerForm();
                    swal.fire({
                        position: "top-end",
                        toast: true,
                        type: "success",
                        icon: "success",
                        text: "Deposit Successfully Requested",
                        showConfirmButton: false,
                        timer: 1500
                    });
                })
                .catch(error => {
                    this.componentOverlay = false;

                    if (error.response.status == 422) {
                        this.formCustomerErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        createCustomer() {
            axios
                .post("/api/v1/clients", {
                    ..._.omit(this.editedCustomerInformation, "user"),
                    ...this.editedCustomerInformation.user,
                    password_confirmation: this.editedCustomerInformation.user
                        .password
                })
                .then(response => {
                    this.fetchCustomers();
                    this.closeCustomerForm();
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
                        this.formCustomerErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        editCustomer(customer) {
            this.editedCustomerIndex = this.tableCustomers.indexOf(customer);
            this.editedCustomerInformation = Object.assign({}, customer);
            this.formCustomerDialog = true;
        },

        addRecharge(customer)
        {
            this.editedCustomerIndex = this.tableCustomers.indexOf(customer);
            this.editedCustomerInformation = Object.assign({}, customer);
            this.formRechargeDialog = true;
        },

        updateCustomer() {
            axios
                .put("/api/v1/clients/" + this.editedCustomerInformation.id, {
                    ..._.omit(this.editedCustomerInformation, "user"),
                    ...this.editedCustomerInformation.user,
                    password_confirmation: this.editedCustomerInformation.user
                        .password
                })
                .then(response => {
                    this.fetchCustomers();
                    this.closeCustomerForm();
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
                        this.formCustomerErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        deleteCustomer(customer) {
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
                            .delete("/api/v1/clients/" + customer.id)
                            .then(() => {
                                this.fetchCustomers();
                                this.closeCustomerForm();
                                swal.fire(
                                    "Deleted!",
                                    "Customer has been deleted.",
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

        closeCustomerForm() {
            this.formCustomerDialog = false;
            this.formRechargeDialog = false
            this.formAssetsDialog = false
            this.componentOverlay = false;
            this.deleteDialog = false;
            setTimeout(() => {
                this.formCustomerErrors = {
                    name: null,
                    user: { username: null, password: null }
                };
                this.editedCustomerInformation = Object.assign(
                    {},
                    this.defaultCustomerInformation
                );
                this.editedCustomerIndex = -1;
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
