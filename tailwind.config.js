module.exports = {
  //darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
	fontFamily: {
        sans: ["Roboto Condensed"],
		    serif: ["arial"],
      },
	   fontSize: {
      'txt': ['13px'],
	   },
	  font: {
        sans: ["Roboto Condensed"],
		serif: ["Arial"],
      },
	colors: {
    tgray:'#423333',
    dgray:'#353535',
    lgray:'#d9d9d9',
      greenlightclr: '#8dc83b',
      graydarkclr: '#959595',
      yellowclr:'#fcff00',
	  graylightclr: '#e2e2e2',
    grybclr:'#7e7373',
	  graybdclr: '#BDBDBD',
    graydclr: '#b0b0b0',
	  greendclr: '#0a8043',
      greenclr: '#6ba11f',
      dgreenclr: '#098046',
      greendarkclr: '#16612e',
      grayccc: '#ccc',
      brwnclr: '#433434',
	  lbrwnclr: '#655757',
	  txtclr:'#4f4f4f',
    redclr:'#C61444',
    bgbrwn:'#524242',
    lghtgreen:'#d2e8c7'
    },
	},
  },
  plugins: [
  function ({ addComponents }){
	addComponents({
	".container": {
          maxWidth: "100%",
          "@screen sm": {
            maxWidth: "988px",
          },
          "@screen md": {
            maxWidth: "988px",
          },
          "@screen lg": {
            maxWidth: "988px",
          },
          "@screen xl": {
            maxWidth: "988px",
          },
        },
  ".dashboard-container": {
          maxWidth: "100%",
          "@screen sm": {
            maxWidth: "1120px",
          },
          "@screen md": {
            maxWidth: "1120px",
          },
          "@screen lg": {
            maxWidth: "1120px",
          },
          "@screen xl": {
            maxWidth: "1120px",
          },
  },
  ".admindashboard-container": {
    maxWidth: "100%",
    "@screen sm": {
      maxWidth: "1400px",
    },
    "@screen md": {
      maxWidth: "1400px",
    },
    "@screen lg": {
      maxWidth: "1400px",
    },
    "@screen xl": {
      maxWidth: "1400px",
    },
},      
	".gradient-brown": {
	     background: 'linear-gradient(to bottom,  #524242 0%,#483838 100%)',
	 },
	 ".gradient-green": {
	     background: 'linear-gradient(to bottom,  #337e4a 0%,#07521e 100%)',
	 },
	 ".menu-green": {
	     background: '#89c540',
	 },
   ".greenback": {
    background: '#6ba11f',
   },
	 ".gradient-orange": {
	     background: 'linear-gradient(to bottom,  #eb7134 0%,#f25e13 100%)',
	 },
   ".gradient-lgreen": {
        background: 'linear-gradient(to bottom, #a1d167 0%,#75a53b 100%)',
   },
   ".gradient-whtgry": {
    background: 'linear-gradient(to bottom, #ffffff 0%,#e8e8e8 100%)'
   },
   ".gradient-menu": {
    background: '#347e4b',
    background: '-moz-linear-gradient(top,  #347e4b 0%, #337d4a 43%, #2e7b47 51%, #307846 54%, #287541 62%, #2a7240 67%, #206d39 77%, #1c6432 89%, #16602d 100%)',
    background: '-webkit-linear-gradient(top,  #347e4b 0%,#337d4a 43%,#2e7b47 51%,#307846 54%,#287541 62%,#2a7240 67%,#206d39 77%,#1c6432 89%,#16602d 100%)',
    background: 'linear-gradient(to bottom,  #347e4b 0%,#337d4a 43%,#2e7b47 51%,#307846 54%,#287541 62%,#2a7240 67%,#206d39 77%,#1c6432 89%,#16602d 100%)'
   }

	});
  },
  
  ],
};