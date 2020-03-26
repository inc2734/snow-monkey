'use strict';

import '@inc2734/dispatch-custom-resize-event';
import addCustomEvent from '@inc2734/add-custom-event';

import {
  setStyle,
} from './_helper';

export function stickyHeader(contents, marginTop) {
  setStyle(contents, 'marginTop', marginTop());
  addCustomEvent(window, 'afterStickyHeaderSetting');
}
