const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
      './assets/**/*.css',
      './assets/**/*.js',
      './templates/**/*.php',
  ],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    colors: {
        gray: colors.blueGray,
        white: colors.white,
        primary: {
            50: '#DAFAF4',
            100: '#A2F2E2',
            200: '#6AEBD1',
            300: '#32E3C0',
            400: '#1CCFAB',
            500: '#1ABC9C',
            600: '#16A286',
            700: '#117964',
            800: '#0B5143',
            900: '#062821'
        },
        secondary: {
            50: '#C9D5E2',
            100: '#A6BACE',
            200: '#7090B0',
            300: '#496785',
            400: '#354B61',
            500: '#2C3E50',
            600: '#253444',
            700: '#1C2733',
            800: '#131A22',
            900: '#090D11'
        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
