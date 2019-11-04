import Vue from 'vue';

Vue.filter('currency', value => {
  if (!value) value = 0;
  return `$ ${value.toLocaleString('de', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`;
});

Vue.filter('zerofill', value => {
  if(!value) value = "";
  return value.toString().padStart(10, '0');
});