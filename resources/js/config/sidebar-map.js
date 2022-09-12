module.exports = [
  {
    name: 'Dashboard',
    icon: 'dashboard',
    route: 'dashboard.index',
    access: 'admin',
  },
  // Location
  {
    name: 'Location',
    icon: 'add-address',
    access: 'admin',
    children: [
      {
        name: 'Group',
        icon: 'angle-double-right',
        route: 'location.country-group.index',
        access: 'common',
      },
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
  // Escort
  {
    name: 'Escort',
    icon: 'add-address',
    access: 'admin',
    children: [
      {
        name: 'Service',
        icon: 'angle-double-right',
        route: 'escort.service.index',
        access: 'common',
      },
      {
        name: 'Tour',
        icon: 'angle-double-right',
        route: 'escort.tour.index',
        access: 'common',
      },
      {
        name: 'Club',
        icon: 'angle-double-right',
        route: 'escort.club.index',
        access: 'common',
      },
    ],
  },
  // Utilities
  {
    name: 'Utilities',
    icon: 'add-address',
    access: 'admin',
    children: [
      {
        name: 'Faq',
        icon: 'angle-double-right',
        route: 'utility.faq.index',
        access: 'common',
      },
      {
        name: 'Page Content',
        icon: 'angle-double-right',
        route: 'utility.page-content.index',
        access: 'common',
      },
      {
        name: 'Advertise',
        icon: 'angle-double-right',
        route: 'utility.advertise.index',
        access: 'common',
      },
    ],
  },

  // Support Desk
  {
    name: 'Support Desk',
    icon: 'add-address',
    access: 'admin',
    children: [
      {
        name: 'Escort Review',
        icon: 'angle-double-right',
        route: 'support.escort-review.index',
        access: 'common',
      },
      {
        name: 'Agency Review',
        icon: 'angle-double-right',
        route: 'support.agency-review.index',
        access: 'common',
      },
      {
        name: 'Contact',
        icon: 'angle-double-right',
        route: 'support.contact.index',
        access: 'common',
      },
      {
        name: 'Affilate',
        icon: 'angle-double-right',
        route: 'support.affilate.index',
        access: 'common',
      },
    ],
  },

  // User
  {
    name: 'User',
    icon: 'add-address',
    access: 'admin',
    children: [
      {
        name: 'Account Agency',
        icon: 'angle-double-right',
        route: 'user.account-agency.index',
        access: 'common',
      },
      {
        name: 'Account Club',
        icon: 'angle-double-right',
        route: 'user.account-club.index',
        access: 'common',
      },
      {
        name: 'Account Member',
        icon: 'angle-double-right',
        route: 'user.account-member.index',
        access: 'common',
      },
    ],
  },
];
