'use strict';

import { scrollTop } from './_helper';

let timer = null;

export function pageTopBtn(btn) {
  clearTimeout(timer);

  timer = setTimeout(
    () => {
      const oldAriaHidden = btn.getAttribute('aria-hidden');
      const newAriaHidden = 500 > scrollTop() ? 'true' : 'false';
      if (oldAriaHidden !== newAriaHidden) {
        btn.setAttribute('aria-hidden', newAriaHidden);
      }
    },
    500
  );
}
