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
    icon: 'angle-double-right',
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
    icon: 'angle-double-right',
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
    ],
  },
  // Users
  {
    name: 'Users',
    icon: 'angle-double-right',
    access: 'admin',
    children: [
      {
        name: 'Escort',
        icon: 'angle-double-right',
        route: 'user.escort.index',
        access: 'common',
      },
    ],
  },
  // Utilities
  {
    name: 'Utilities',
    icon: 'angle-double-right',
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
    icon: 'angle-double-right',
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
    icon: 'angle-double-right',
    access: 'admin',
    children: [
      {
        name: 'Escort',
        icon: 'angle-double-right',
        route: 'user.escort.index',
        access: 'common',
      },
      {
        name: 'Agency',
        icon: 'angle-double-right',
        route: 'user.agency.index',
        access: 'common',
      },
      {
        name: 'Club',
        icon: 'angle-double-right',
        route: 'user.club.index',
        access: 'common',
      },
      {
        name: 'Member',
        icon: 'angle-double-right',
        route: 'user.member.index',
        access: 'common',
      },
    ],
  },

  // Report
  {
    name: 'Report',
    icon: 'angle-double-right',
    access: 'admin',
    children: [
      {
        name: 'Client Report',
        icon: 'angle-double-right',
        route: 'report.client-report.index',
        access: 'common',
      },
      {

        name: 'Escost Report',
        icon: 'angle-double-right',
        route: 'report.escost-report.index',
        access: 'common',
      },
      {
        name: 'Agency Report',
        icon: 'angle-double-right',
        route: 'report.agency-report.index',
        access: 'common',
      },
    ],
  },

  // Appearance
  {
    name: 'Appearance',
    icon: 'angle-double-right',
    access: 'admin',
    children: [
      {
        name: 'Club Banner',
        icon: 'angle-double-right',
        route: 'appearance.club-banner.index',
        access: 'common',
      },
    ],
  },
];
