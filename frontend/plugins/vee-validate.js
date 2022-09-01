import Vue from 'vue'
import { ValidationProvider, ValidationObserver, extend } from 'vee-validate'
import {
  required,
  alpha,
  email,
  confirmed,
  digits,
  is,
  max,
  min,
  length,
  numeric,
  is_not as isNot,
  ext,
  max_value as maxValue
} from 'vee-validate/dist/rules'

const availableValidationRules = {
  required,
  alpha,
  is,
  email,
  confirmed,
  digits,
  length,
  numeric,
  min,
  max,
  is_not: isNot,
  ext,
  max_value: maxValue
}

for (const keyExtend in availableValidationRules) {
  extend(keyExtend, availableValidationRules[keyExtend])
}
extend('password_strength', (value) => {
  // Minimum eight characters
  // at least 1 letter, 1 number haft-width and special characters optional
  const rule = /^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d!@#$%^&*)(+=._-]{8,}$/
  if (value.match(rule)) {
    return true
  }
})
Vue.component('ValidationProvider', ValidationProvider)
Vue.component('ValidationObserver', ValidationObserver)
