import { bodyConfig } from '@/utils/helpers';

export const state = {
  locale: bodyConfig('locale'),
};

export const getters = {
  locale: state => state.locale,
};
