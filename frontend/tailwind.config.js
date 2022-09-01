module.exports = {
  theme: {
    extend: {
      colors: {
        primary: {
          900: '#160647',
          700: '#862ADE',
          600: '#6D44FF',
          500: '#8B6BFF',
          100: '#9C94B0',
        },
        gray: {
          100: '#F5F4F7',
        }
      }
    }
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
