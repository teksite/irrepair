/** @type {import('tailwindcss').Config} */
export default {
  content: [
      './resources/views/**/*.blade.php',
      "./resources/**/*.js",
      './Modules/*/resources/views/**/*.blade.php',
      './Modules/*/resources/assets/**/*.js'
  ],
  theme: {
    extend: {
        keyframes: {
            marquee: {
                '0%': {
                    transform: 'translateX(0)'
                },
                '100%': {
                    transform: 'translateX(-100%)'
                },
            },
        },
        animation: {
            'marquee': 'marquee 20s linear infinite',
        },
        backgroundImage: {
            'admin-1': "url('/public/admin/images/admin-1.jpg')",
            'back-1': "url('/public/admin/images/background-1.jpg')",
            'panel-header':"url('/public/admin/images/background-1.jpg')",
            'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',

            'no-access-video': "url('/public/admin/images/digital-wave.jpg')",

            'theme-1': "url('/public/uploads/images/site/background-1.png')",
            'theme-2': "url('/public/uploads/images/site/background-2.png')",
            'theme-3': "url('/public/uploads/images/site/background-3.png')",
            'theme-4': "url('/public/uploads/images/site/background-4.svg')",
            'theme-5': "url('/public/uploads/images/site/grid-background.png')",
            'theme-6': "url('/public/uploads/images/site/background-6.jpg')",
            'theme-7': "url('/public/uploads/images/site/background-7.jpg')",
            'theme-8': "url('/public/uploads/images/site/grid-background-2.png')",


        },
        aspectRatio: {
            '4/1': '4/1',
            '2/1': '2 / 1',
            '1/4': '1 / 4',
            '3/1': '3 / 1',
            '3/2': '3 / 2',
            '2/3': '2 / 3',
            '1/3': '1 / 3'
        },
        minHeight: {
            '1/2': '50%',
            'screen-1/4': '20vh',
            'screen-1/3': '33vh',
            'screen-2/3': '66vh',
            'screen-1/2': '50vh',
            'screen-3/4': '75vh'
        },
        height: {
            '1/2': '50%',
            'screen-1/4': '20vh',
            'screen-1/2': '50vh',
            'screen-1/3': '33vh',
            'screen-2/3': '66vh',
            'screen-3/4': '75vh'
        },
        fontFamily: {
            'artin': ['artin', 'Vazirmatn', 'sans-serif'],
            'vazir': ['Vazirmatn', 'sans-serif']
        },
        colors: {
            primary: {
                50: '#e9f7ff',
                100: '#cddfe9',
                200: '#b2c6d2',
                300: '#96aebc',
                400: '#7b95a6',
                500: '#5f7d90',
                600: '#446479',
                700: '#284c63',
                800: '#213e50',
                900: '#19303e',
                950: '#12222b',
            },
            secondary: {
                50: '#defcfc',
                100: '#c7e8e8',
                200: '#b0d3d4',
                300: '#99bfc0',
                400: '#81abad',
                500: '#6a9799',
                600: '#538285',
                700: '#3c6e71',
                800: '#2d5456',
                900: '#1f3b3c',
                950: '#102121',
            }
        },
    },
  },
  plugins: [],
}

