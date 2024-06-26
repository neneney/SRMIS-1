/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/*.{php, html, js}", "./dump/*.{html, js}" ],
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
      },
      gridTemplateColumns:{
        'custom1' : '1fr',
        'custom2' : '1fr 1fr',
        'custom3' : '1fr 1fr 1fr'
      },
  },
  plugins: [require("daisyui")],

  daisyui: {
    themes: false, // false: only light + dark | true: all themes | array: specific themes like this ["light", "dark", "cupcake"]
    darkTheme: "dark", // name of one of the included themes for dark mode
    base: true, // applies background color and foreground color for root element by default
    styled: true, // include daisyUI colors and design decisions for all components
    utils: true, // adds responsive and modifier utility classes
    prefix: "daisy-", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
    logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
    themeRoot: ":root", // The element that receives theme color CSS variables
  },

}
}