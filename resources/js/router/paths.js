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
