/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/*.{php,html,js}", "./dump/*.{html,js}" ],
  corePlugins:{
    preflight: false,
  },
  prefix: 'tw-',
  theme: {
    extend: {
      colors: {
        'primary': '#12171e',
      },
      padding: {
        '20px': '20px',
      }
    },
  },
  plugins: [],
}

