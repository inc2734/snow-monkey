'use strict';

import { scrollTop } from './_helper';

const toggleBtn = (btn, timer) => {
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
};

export const PageTopBtn = (btn) => {
  let timer = null;
  window.addEventListener('scroll', () => toggleBtn(btn, timer), false);
};
