<template>
    <v-navigation-drawer
        id="app-drawer"
        v-model="inputValue"
        app
        floating
        permanent
        mobile-breakpoint="991"
        width="350"
    >

    <v-list>
        <!-- Finance Center -->
        <v-list-group
          :value="false"
          prepend-icon="mdi-account-circle"
        >
          <template v-slot:activator>
            <v-list-item-title class="item-title">Finance Center</v-list-item-title>
          </template>
          <v-list-group
          :value="false"
          no-action
          sub-group
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>Recharge Management</v-list-item-title>
            </v-list-item-content>
          </template>

            <v-list-item
                    v-for="(link, i) in rechargeManagementLinks"
                    :key="i"
                    :to="link.to"
                    active-class="primary"
                    v-if="userPermission(link.module)"
                    class="v-list-item">
                    <v-list-item-action>
                        <v-icon>{{ link.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-title v-text="link.text" />
                </v-list-item>
        </v-list-group>
        <v-list-group
          :value="false"
          no-action
          sub-group
        >
          <template v-slot:activator>
            <v-list-item-content>
              <v-list-item-title>Withdrawal Management</v-list-item-title>
            </v-list-item-content>
          </template>

            <v-list-item
                    v-for="(link, i) in withdrawalManagementLinks"
                    :key="i"
                    :to="link.to"
                    active-class="primary"
                    v-if="userPermission(link.module)"
                    class="v-list-item">
                    <v-list-item-action>
                        <v-icon>{{ link.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-title v-text="link.text" />
                </v-list-item>
        </v-list-group>
        </v-list-group>

        <!-- Customer Management -->
        <v-list-group
          :value="false"
          prepend-icon="mdi-account-circle"
        >
          <template v-slot:activator>
            <v-list-item-title class="item-title">Customer Management</v-list-item-title>
          </template>
            <v-list-item
                    v-for="(link, i) in customerManagementLinks"
                    :key="i"
                    :to="link.to"
                    active-class="primary"
                    v-if="userPermission(link.module)"
                    class="v-list-item">
                    <v-list-item-action>
                        <v-icon>{{ link.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-title v-text="link.text" />
                </v-list-item>
    </v-list-group>
      </v-list>  
            <!-- <v-list-item
                v-for="(link, i) in links"
                :key="i"
                :to="link.to"
                active-class="primary"
                v-if="userPermission(link.module)"
                class="v-list-item"
            >
                <v-list-item-action>
                    <v-icon>{{ link.icon }}</v-icon>
                </v-list-item-action>
                <v-list-item-title v-text="link.text" />
            </v-list-item>
    </v-list> -->
        <template v-slot:append>
            <v-list dense>
                <v-list-item @click.stop="logout">
                    <v-list-item-action>
                        <v-icon>mdi-exit-to-app</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title class="subtitle-2"
                            >Logout</v-list-item-title
                        >
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </template>
    </v-navigation-drawer>
</template>

<script>
// Utilities
import { mapMutations, mapState } from "vuex";

export default {
    props: {
        opened: {
            type: Boolean,
            default: false
        }
    },
    data: () => ({
        logo: "favicon.ico",
        rechargeManagementLinks: [
            {
                to: "/administrator/offline-deposit-audit",
                icon: "mdi-chart-areaspline",
                text: "Offline Deposit Audit",
                module: "adminFinance"
            },
            {
                to: "/administrator/offline-deposit-record",
                icon: "mdi-chart-areaspline",
                text: "Offline Deposit Record",
                module: "adminFinance"
            },
            {
                to: "/administrator/online-deposit-record",
                icon: "mdi-chart-areaspline",
                text: "Online Deposit Record",
                module: "adminFinance"
            },
            {
                to: "/administrator/currency-transfer-review",
                icon: "mdi-chart-areaspline",
                text: "Currency Transfer Review",
                module: "adminFinance"
            }
        ],

        withdrawalManagementLinks: [
            {
                to: "/administrator/online-withdrawal-audit",
                icon: "mdi-chart-areaspline",
                text: "Online Withdrawal Audit",
                module: "adminFinance"
            },
            {
                to: "/administrator/user-withdrawal-record",
                icon: "mdi-chart-areaspline",
                text: "User Withdrawal Record",
                module: "adminFinance"
            },
            {
                to: "/administrator/quick-selling-record",
                icon: "mdi-chart-areaspline",
                text: "Quick Selling Record",
                module: "adminFinance"
            },
            {
                to: "/administrator/customer-withdrawal-statistics",
                icon: "mdi-chart-areaspline",
                text: "Customer Withdrawal Statistics",
                module: "adminFinance"
            }
        ],

        customerManagementLinks: [
            {
                to: "/administrator/customer-management",
                icon: "mdi-chart-areaspline",
                text: "Customer Management",
                module: "adminFinance"
            },
            {
                to: "/administrator/performance-statistics",
                icon: "mdi-chart-areaspline",
                text: "Performance Statistics",
                module: "adminFinance"
            },
        ],
        userRole: sessionStorage.getItem("user-type")
        // userRole: "HOSPITAL"
    }),
    computed: {
        ...mapState("app", ["color"]),
        inputValue: {
            get() {
                return this.$store.state.app.drawer;
            },
            set(val) {
                this.setDrawer(val);
            }
        },
        items() {
            return this.$t("Layout.View.items");
        }
    },

    methods: {
        ...mapMutations("app", ["setDrawer", "toggleDrawer"]),
        userPermission(module) {
            var modules = {
                adminDashboard: true,
                adminHospital: true,
                adminUser: true,
                adminFinance: true,
            };
            var permissions = {
                ADMINISTRATOR: {
                    ...modules,
                    adminFinance: true,
                },
                
            };
            return permissions[this.userRole][module];
        },

        logout() {
            axios
                .get("/api/v1/logout")
                .then(response => {
                    if (response.data.errors) {
                        this.error = response.data.errors;
                        return;
                    }
                    sessionStorage.clear();
                    this.$router.push("/login");
                })
                .catch(error => {
                    if (error.response.data.message == "Unauthenticated.") {
                        sessionStorage.clear();
                        this.$router.push("/login");
                    }
                });
        }
    }
};
</script>

<style lang="scss">
#app-drawer {
    .v-list__tile {
        border-radius: 4px;

        &--buy {
            margin-top: auto;
            margin-bottom: 17px;
            color:#1f7b70;
        }
    }

    .v-list-item{
        color: black !important;
    }

     .v-list-item--active {
        background-color: #1f7b70;
        color: white !important;
    }
}
</style>
