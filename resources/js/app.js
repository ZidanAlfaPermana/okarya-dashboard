import Compressor from 'compressorjs';
import Chart from 'chart.js/auto';

import './compressor.js';
import './global.js';

window.Chart = Chart;
window.Compressor = Compressor.default || Compressor;
