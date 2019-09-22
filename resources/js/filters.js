import Vue from 'vue';

Vue.filter('currency', value => {
  if (!value) value = 0;
  return value.toLocaleString('es', {minimumFractionDigits: 2, maximumFractionDigits: 2});
});

Vue.filter('zerofill', value => {
  if(!value) value = "";
  return value.toString().padStart(10, '0');
});