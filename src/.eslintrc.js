module.exports = {
  root: true,
  env: {
    browser: true,
    es6: true,
  },
  extends: [
    'plugin:vue/essential',
    'airbnb-base',
  ],
  globals: {
    Atomics: 'readonly',
    SharedArrayBuffer: 'readonly',
  },
  parserOptions: {
    ecmaVersion: 2018,
    sourceType: 'module',
  },
  plugins: [
    'vue',
  ],
  settings: {
    'import/resolver': {
      node: {
        extensions: ['.js', '.vue']
      }
    },
  },
  rules: {
    // don't require .vue extension when importing
    'import/extensions': ['error', 'ignorePackages', {
      vue: 'never',
      js: 'never'
    }],
  },
};
