 window.addEventListener('scroll', () => {
     var element = document.querySelectorAll('.introduction').length ? document.querySelector('.introduction') : document.querySelector('.section-featured')
     if (window.scrollY > Number(getComputedStyle(element).height.replace('px', ''))) {
         document.body.classList.add('has-statamic');
     } else {
         document.body.classList.remove('has-statamic');
     }
 });