import forEachHtmlNodes from '@inc2734/for-each-html-nodes';

const vlocations = {};

const createVlocation = (homeUrl) => {
  if ( !! vlocations[ homeUrl ] ) {
    return vlocations[ homeUrl ];
  }

  const element = document.createElement('a');
  element.setAttribute('href', homeUrl);
  vlocations[ homeUrl ] = element;
  return element;
};

export function activeMenu(atag, params = {}) {
  if ('undefined' === typeof atag.hostname) {
    return;
  }

  const location = window.location;

  params.home_url = params.home_url || `${location.protocol}//${location.host}`;

  const vlocation = createVlocation(params.home_url);

  const active = (element) => {
    element.parentNode.setAttribute('data-active-menu', 'true');
  };

  const atagPathname     = atag.pathname.replace(/\/$/, '');
  const atagHref         = atag.href.replace(/\/$/, '') + '/';
  const locationHref     = location.href.replace(/\/$/, '') + '/';
  const locationPathname = location.pathname.replace(/\/$/, '');
  const vaPathname       = atagPathname.replace(new RegExp(`^${ vlocation.pathname }`), '');

  const sameUrl  = locationHref === atagHref;
  const childUrl = 0 === locationHref.indexOf(atagHref)
                && 1 < locationPathname.length
                && 1 < atagPathname.length
                && 1 < vaPathname.length;

  if (sameUrl || childUrl) {
    return active(atag);
  }
}
