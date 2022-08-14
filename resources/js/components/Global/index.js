import Vue from 'vue';
import TargetLayout from './Target';

// Components that are registered globally.
[
  TargetLayout,
].forEach(component => {
  Vue.component(component.name, component);
});
