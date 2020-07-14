module.exports = {
  root: true,
  env: {
    node: true
  },
  'extends': [
    'plugin:vue/essential',
    'eslint:recommended'
  ],
  parserOptions: {
    parser: 'babel-eslint'
  },
  rules: {
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    "vue/return-in-computed-property": ["error", {
      "treatUndefinedAsUnspecified": true
    }],
    'vue/no-parsing-error': [2, { "x-invalid-end-tag": false }]
  }
}
