import Vue from 'vue';
import SvgIcon from '@/components/Global/SvgIcon';

Vue.component('SvgIcon', SvgIcon);

const requireAll = requireContext => requireContext.keys().map(requireContext);
const req = require.context('./svg', false, /\.svg$/);
requireAll(req);

export default SvgIcon;
