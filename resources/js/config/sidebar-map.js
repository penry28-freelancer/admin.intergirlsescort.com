module.exports = [
  {
    name: 'Dashboard',
    icon: 'dashboard',
    route: 'dashboard.index',
    access: 'admin',
  },
  {
    name: 'Location',
    icon: 'add-address',
    access: 'admin',
    children: [
      {
        name: 'Country',
        icon: 'angle-double-right',
        route: 'location.country.index',
        access: 'common',
      },
      {
        name: 'City',
        icon: 'angle-double-right',
        route: 'location.city.index',
        access: 'common',
      },
    ],
  },
];
