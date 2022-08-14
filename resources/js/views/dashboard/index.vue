<template>
  <div class="admin-overview">
    <analysis-count :items="analysisCount" />
  </div>
</template>

<script>
import AnalysisCount from './components/AnalysisCount';

export default {
  name: 'AdminOverview',
  components: {
    AnalysisCount,
  },
  layout: 'admin',
  middleware: 'auth',
  data: () => ({
    analysisCount: [
      {
        bgColor: '#f39c12',
        icon: 'customers',
        name: 'Customers',
        value: 3,
        route: {
          path: '/',
        },
        desc: '0 Customers in 30 days',
      },
      {
        bgColor: '#00c0ef',
        icon: 'md-contacts',
        name: 'Merchants',
        value: 5,
        route: {
          path: '/',
        },
        desc: '5 Merchants in 30 days',
      },
      {
        bgColor: '#00a65a',
        icon: 'cart',
        name: "TODAY'S TOTAL",
        value: '$0',
        route: {
          path: '/',
        },
        desc: 'No sale Today',
      },
      {
        bgColor: '#dd4b39',
        icon: 'visitor',
        name: 'VISITORS TODAY',
        value: 7,
        route: {
          path: '/',
        },
        desc: '100% Increase in 30 days',
      },
    ],
  }),
};
</script>
