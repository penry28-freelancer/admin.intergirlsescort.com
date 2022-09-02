import { view } from '@/utils/helpers';

export const constantsRoutes = [
  // Overview
  {
    path: '/dashboard',
    name: 'dashboard.index',
    component: view('dashboard'),
  },
  // Auth Routes
  {
    path: '/login',
    name: 'auth.login',
    component: view('auth/Login'),
  },
  {
    path: '/reset-password',
    name: 'auth.reset-password',
    component: view('auth/VerifyEmailForm'),
  },
  {
    path: '/reset-password/:token',
    name: 'auth.reset-password.token',
    component: view('auth/ResetPasswordForm'),
  },
  {
    path: '/auth/profile',
    name: 'auth.profile',
    component: view('profile'),
  },
  // Location
  {
    path: '/location/country-group',
    name: 'location.country-group.index',
    component: view('countryGroup'),
  },
  {
    path: '/location/country',
    name: 'location.country.index',
    component: view('country'),
  },
  {
    path: '/location/city',
    name: 'location.city.index',
    component: view('city'),
  },
  // Service
  {
    path: '/escort/service',
    name: 'escort.service.index',
    component: view('service'),
  },
  // Utilities
  {
    path: '/utility/faq',
    name: 'utility.faq.index',
    component: view('faq'),
  },
  // Error Routes
  {
    path: '/401',
    name: 'error.401',
    component: view('error/Error401'),
  },
  {
    path: '/404',
    name: 'error.404',
    component: view('error/Error404'),
  },
  {
    path: '/500',
    name: 'error.500',
    component: view('error/Error500'),
  },
  // Base Routes
  { path: '/', name: 'baseURI', redirect: '/login' },
];
