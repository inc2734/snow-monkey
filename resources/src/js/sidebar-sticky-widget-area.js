import '@inc2734/dispatch-custom-resize-event';
import { getStyle, setStyle, getScrollOffset } from './module/_helper';

const apply = (target) => {
  const isSticky       = 'sticky' === getStyle(target, 'position');
  const targetMargin   = parseInt(getStyle(target, 'margin-top'));
  const offset         = getScrollOffset({ forceDropNav: true });

  const setTopMargin = () => {
    const prev = target.previousElementSibling;
    const measurement = (() => {
      if (prev) {
        const rect = prev.getBoundingClientRect();
        return rect.y + rect.height;
      }
      return target.parentNode.getBoundingClientRect().y;
    })();

    measurement <= offset && setStyle(target, 'top', `${ offset }px`);
  };

  if (! isSticky) {
    window.removeEventListener('scroll', setTopMargin, false);
    setStyle(target, 'top', '');
  } else {
    window.addEventListener('scroll', setTopMargin, false);
  }
};

document.addEventListener(
  'DOMContentLoaded',
  () => {
    const target = document.querySelector('.l-sidebar-sticky-widget-area');
    if (! target) {
      return;
    }

    apply(target);
    window.addEventListener('resize:width', () => apply(target), false);
  },
  false
);
