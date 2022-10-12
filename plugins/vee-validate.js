import { extend } from "vee-validate";
import * as rules from "vee-validate/dist/rules";
import { messages } from 'vee-validate/dist/locale/tr.json';

Object.keys(rules).forEach(rule => {
    extend(rule, {
        ...rules[rule], // copies rule configuration
        message: messages[rule] // assign message
    });
});