import Vue from 'vue';

Vue.filter('currency', value => {
  return value.toLocaleString('es', {minimumFractionDigits: 2, maximumFractionDigits: 2});
});