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
                            :headers="tablePerformanceHeaders"
                            :items="tablePerformances"
                            :search="tableSearch"
                        >
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-toolbar-title class="headline"
                                        >Currency Performance Certificates</v-toolbar-title
                                    >
                                    <div class="flex-grow-1"></div>
                                    <!-- <v-btn
                                        small
                                        @click="formPerformanceDialog = true"
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
                                    tablePerformances
                                        .map(function(x) {
                                            return x.id;
                                        })
                                        .indexOf(item.id) + 1
                                }}
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <v-btn icon @click="editPerformance(item)">
                                    <v-icon>mdi-pencil</v-icon>
                                </v-btn>
                                <v-btn icon @click="deletePerformance(item)">
                                    <v-icon>mdi-delete</v-icon>
                                </v-btn>
                            </template>
                        </v-data-table>
                    </v-container>
                </v-card>
            </v-col>
        </v-row>
        <!-- <v-dialog v-model="formPerformanceDialog" max-width="800px" persistent>
            <v-card>
                <v-overlay :value="componentOverlay">
                    <v-progress-circular
                        :size="100"
                        :width="5"
                        indeterminate
                    ></v-progress-circular>
                </v-overlay>
                <v-card-title class="headline">
                    {{ formPerformanceTitle }}
                </v-card-title>
                <v-card-text>
                    <v-row justify="center">
                        <v-col cols="12" md="6">
                            <v-text-field
                                type="text"
                                :error-messages="
                                    formPerformanceErrors.user.username
                                "
                                v-model="
                                    editedPerformanceInformation.user.username
                                "
                                label="Username"
                            />
                        </v-col>
                        <v-col cols="12" md="6">
                            <v-text-field
                                v-model="
                                    editedPerformanceInformation.user.password
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
                                :error-messages="formPerformanceErrors.name"
                                v-model="editedPerformanceInformation.name"
                                label="Name"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-text-field
                                type="text"
                                :error-messages="formPerformanceErrors.number"
                                v-model="editedPerformanceInformation.number"
                                label="Number"
                            />
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-select
                                :error-messages="formPerformanceErrors.status"
                                v-model="editedPerformanceInformation.status"
                                label="Status"
                            />
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                type="text"
                                :error-messages="formPerformanceErrors.address"
                                v-model="editedPerformanceInformation.address"
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
                    <v-btn class="px-12" text @click="closePerformanceForm"
                        >Cancel</v-btn
                    >
                    <v-btn class="px-12" @click="savePerformance" color="primary"
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
            tablePerformances: [],
            formPerformanceDialog: false,
            formPerformanceListDialog: false,

            formPerformanceErrors: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
                lat: 6.9214,
                lng: 122.079
            },

            tablePerformanceHeaders: [
                { text: "Role", value: "role" },
                { text: "Email", value: "email" },
                { text: "UID", value: "id" },
                { text: "Nickname", value: "nickname" },
                { text: "Currency", value: "coin.name" },
                { text: "Deposit", value: "deposit" },
                { text: "withdrawal", value: "withdrawal" },
                { text: "Performance Coin", value: "" },
                { text: "Commission", value: "" },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false,
                    align: "center"
                }
            ],

            editedPerformanceIndex: -1,
            editedPerformanceInformation: {
                name: null,
                address: null,
                number: null,
                user: { username: null, password: null },
                latitude: 6.9214,
                longitude: 122.079
            },
            defaultPerformanceInformation: {
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
        formPerformanceTitle() {
            return this.editedPerformanceIndex === -1
                ? "New Performance"
                : "Edit Performance";
        }
    },

    mounted() {
        this.fetchPerformances();
    },

    methods: {

        fetchPerformances() {
            this.tableLoading = true;
            this.componentOverlay = true;
            axios
                .get("/api/v1/performance-statistics")
                .then(response => {
                    this.tablePerformances = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.componentOverlay = false;
                    this.tableLoading = false;
                });
        },

        savePerformance() {
            this.componentOverlay = true;
            if (this.editedPerformanceIndex > -1) {
                this.updatePerformance();
            } else {
                this.createPerformance();
            }
        },

        createPerformance() {
            axios
                .post("/api/v1/performance-statistics", {
                    ..._.omit(this.editedPerformanceInformation, "user"),
                    ...this.editedPerformanceInformation.user,
                    password_confirmation: this.editedPerformanceInformation.user
                        .password
                })
                .then(response => {
                    this.fetchPerformances();
                    this.closePerformanceForm();
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
                        this.formPerformanceErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        editPerformance(currencyPerformance) {
            this.editedPerformanceIndex = this.tablePerformances.indexOf(currencyPerformance);
            this.editedPerformanceInformation = Object.assign({}, currencyPerformance);
            this.formPerformanceDialog = true;
        },

        updatePerformance() {
            axios
                .put("/api/v1/performance-statistics/" + this.editedPerformanceInformation.id, {
                    ..._.omit(this.editedPerformanceInformation, "user"),
                    ...this.editedPerformanceInformation.user,
                    password_confirmation: this.editedPerformanceInformation.user
                        .password
                })
                .then(response => {
                    this.fetchPerformances();
                    this.closePerformanceForm();
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
                        this.formPerformanceErrors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
                .finally(() => {});
        },

        deletePerformance(currencyPerformance) {
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
                            .delete("/api/v1/performance-statistics/" + currencyPerformance.id)
                            .then(() => {
                                this.fetchPerformances();
                                this.closePerformanceForm();
                                swal.fire(
                                    "Deleted!",
                                    "Performance has been deleted.",
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

        // closePerformanceForm() {
        //     this.formPerformanceDialog = false;
        //     this.componentOverlay = false;
        //     this.deleteDialog = false;
        //     setTimeout(() => {
        //         this.formPerformanceErrors = {
        //             name: null,
        //             user: { username: null, password: null }
        //         };
        //         this.editedPerformanceInformation = Object.assign(
        //             {},
        //             this.defaultPerformanceInformation
        //         );
        //         this.editedPerformanceIndex = -1;
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
