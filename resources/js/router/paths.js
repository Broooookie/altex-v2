import Landing from "../components/views/Landing.vue";
import Signin from "../components/views/Signin.vue";
import Signup from "../components/views/Signup.vue";
import Pusher from '../components/views/Pusher.vue';

import AdminScaffold from '../components/views/Administrator/Scaffold.vue'
import AdminOfflineDepositAudit from '../components/views/Administrator/RechargeManagement/OfflineDepositAudit.vue'
import AdminOfflineDepositRecord from '../components/views/Administrator/RechargeManagement/OfflineDepositRecord.vue'
import AdminCurrencyTransferReview from '../components/views/Administrator/RechargeManagement/CurrencyTransferReview.vue'
import AdminOnlineDepositRecord from '../components/views/Administrator/RechargeManagement/OnlineDepositRecord.vue'
import AdminCustomerManagement from '../components/views/Administrator/CustomerManagement/CustomerManagement.vue'
import AdminPerformanceStatistics from '../components/views/Administrator/RechargeManagement/OnlineDepositRecord.vue'

import AdminCustomerWithdrawalStatistics from '../components/views/Administrator/WithdrawalManagement/CustomerWithdrawalStatistics.vue'
import AdminWithdrawalAudit from '../components/views/Administrator/WithdrawalManagement/OnlineWithdrawalAudit.vue'
import AdminQuickSellingRecord from '../components/views/Administrator/WithdrawalManagement/QuickSellingRecord.vue'
import AdminUserWithdrawalRecord from '../components/views/Administrator/WithdrawalManagement/UserWithdrawalRecord.vue'




let adminRoutes = {
  path: "/admin", 
  component: AdminScaffold,
  redirect: "/administrator",
  name: "Components",
  children: [
    // { path: "purchase-histories", name: "Purchase Histories", components: { default: PurchaseHistory }},
    { path: "/administrator/offline-deposit-audit", name: "offline-deposit-audit", components: { default: AdminOfflineDepositAudit }},
    { path: "/administrator/offline-deposit-record", name: "offline-deposit-record", components: { default: AdminOfflineDepositRecord }},
    { path: "/administrator/currency-transfer-review", name: "currency-transfer-review", components: { default: AdminCurrencyTransferReview }},
    { path: "/administrator/online-deposit-record", name: "online-deposit-record", components: { default: AdminOnlineDepositRecord }},
    { path: "/administrator/customer-management", name: "customer-management", components: { default: AdminCustomerManagement }},
    { path: "/administrator/performance-statistics", name: "performance-task", components: { default: AdminPerformanceStatistics }},

    { path: "/administrator/online-withdrawal-audit", name: "online-withdrawal-audit", components: { default: AdminWithdrawalAudit }},
    { path: "/administrator/user-withdrawal-record", name: "user-withdrawal-record", components: { default: AdminUserWithdrawalRecord }},
    { path: "/administrator/quick-selling-record", name: "user-withdrawal-record", components: { default: AdminQuickSellingRecord }},
    { path: "/administrator/customer-withdrawal-statistics", name: "user-withdrawal-record", components: { default: AdminCustomerWithdrawalStatistics }},
    
  ]
};

const routes = [
  {
    path: "/",
    name: "Landing",
    component: Landing,
  },
  {
    path: "/login",
    name: "Signin",
    component: Signin,
  },
  {
    path: "/register",
    name: "Signup",
    component: Signup,
  },
//   subsriberRoutes,

  // Sample Route For Pusher
  {
      path: "/pusher",
      name: "Pusher",
      component: Pusher
  }, 
  adminRoutes,
];

export default routes;
