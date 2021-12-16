require('./bootstrap');



//Datatables
window.JSZip = require( "jszip" );
require( 'pdfmake' );
require( 'datatables.net-bs4' );
require( 'datatables.net-autofill-bs4' );
require( 'datatables.net-buttons-bs4' );
require( 'datatables.net-buttons/js/buttons.colVis.js' );
require( 'datatables.net-buttons/js/buttons.html5.js' );
require( 'datatables.net-buttons/js/buttons.print.js' );
require( 'datatables.net-colreorder-bs4' );
require( 'datatables.net-fixedcolumns-bs4' );
require( 'datatables.net-fixedheader-bs4' );
require( 'datatables.net-keytable-bs4' );
require( 'datatables.net-responsive-bs4' );
require( 'datatables.net-rowgroup-bs4' );
require( 'datatables.net-rowreorder-bs4' );
require( 'datatables.net-scroller-bs4' );
require( 'datatables.net-searchbuilder-bs4' );
require( 'datatables.net-searchpanes-bs4' );
require( 'datatables.net-select-bs4' );
// require( 'datatables.net-staterestore-bs4' );

var pdfMake = require('pdfmake/build/pdfmake.js');
var pdfFonts = require('pdfmake/build/vfs_fonts.js');
pdfMake.vfs = pdfFonts.pdfMake.vfs;

//Feather Icons
const feather = require('feather-icons');
feather.replace;
