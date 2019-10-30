'use strict';

import forEachHtmlNodes from '@inc2734/for-each-html-nodes';
import { initWpawPickupSlider } from './module/_wpaw-pickup-slider';

const canvases = document.querySelectorAll('.wpaw-pickup-slider__canvas');
forEachHtmlNodes(canvases, (canvas) => initWpawPickupSlider(canvas));
