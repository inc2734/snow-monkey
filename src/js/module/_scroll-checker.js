export function scrollChecker(target) {
  const pageStart = document.getElementById('page-start');
  if (! pageStart) {
    return;
  }

  if ('undefined' === typeof IntersectionObserver) {
    return;
  }

  const options = {
    root: null,
    rootMargin: "0px",
    threshold: 0,
  };

  const toggle   = (isIntersecting) => target.setAttribute('data-scrolled', ! isIntersecting);
  const callback = (entries) => entries.forEach(entry => toggle(entry.isIntersecting));
  const observer = new IntersectionObserver(callback, options);
  observer.observe(pageStart);
}
