module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      aspectRatio: {
        '9/16': '9 / 16',
        '3/4': '3 /4',
      },
      colors: {
        'ButtonBase': '#2563EB',
        'HoverGlow': '#161D6F',
        'CalmBlue': '#0D92F4',
        'TeksSecond': '#475569',
        'Border': '#B7B7B7',
      },
    },
  },
  plugins: [
    require('flowbite/plugin')({
      charts: true,
    }),
  ],
}