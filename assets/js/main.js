/**
* Template Name: Gp
* Updated: May 30 2023 with Bootstrap v5.3.0
* Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {

 



  "use strict";

  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/662c9ab1a0c6737bd1315f1b/1hsf3oi4e';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
  
  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100 && !selectHeader.classList.contains('header-scrolled')) {
        selectHeader.classList.add('header-scrolled')
      } else if (window.scrollY <= 100 && selectHeader.classList.contains('header-scrolled')) {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
  });

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true);

  /**
   * Scrool with ofset on links with a class name .scrollto
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true);

  /**
   * Scroll with ofset on page load with hash links in the url
   */
  window.addEventListener('load', () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });

  /**
   * Preloader
   */
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }
  
  /**
   * Clients Slider
   */
  // new Swiper('.clients-slider', {
  //   speed: 400,
  //   loop: true,
  //   autoplay: {
  //     delay: 5000,
  //     disableOnInteraction: false
  //   },
  //   slidesPerView: 'auto',
  //   pagination: {
  //     el: '.swiper-pagination',
  //     type: 'bullets',
  //     clickable: true
  //   },
  //   breakpoints: {
  //     320: {
  //       slidesPerView: 2,
  //       spaceBetween: 40
  //     },
  //     480: {
  //       slidesPerView: 3,
  //       spaceBetween: 60
  //     },
  //     640: {
  //       slidesPerView: 4,
  //       spaceBetween: 80
  //     },
  //     992: {
  //       slidesPerView: 6,
  //       spaceBetween: 120
  //     }
  //   }
  // });
  
  /**
   * Portfolio Slider
   */
  const portfoliosWrappers = ['.portfolio-slider-arranges', '.portfolio-slider-products', '.portfolio-slider-homestages' ]
  
  portfoliosWrappers.forEach(portfolioWrapper => {
    new Swiper(portfolioWrapper, {
      speed: 400,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false
      },
      slidesPerView: 'auto',
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
      },
      breakpoints: {
        320: {
          slidesPerView: 2,
          spaceBetween: 10
        },
        480: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        640: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 40
        }
      }
    });
  })
  

  /**
   * Porfolio isotope and filter
   */
  // window.addEventListener('load', () => {
  //   let portfolioContainer = select('.portfolio-container');
  //   if (portfolioContainer) {
  //     let portfolioIsotope = new Isotope(portfolioContainer, {
  //       itemSelector: '.portfolio-item'
  //     });
  //
  //     let portfolioFilters = select('#portfolio-flters li', true);
  //
  //     on('click', '#portfolio-flters li', function(e) {
  //       e.preventDefault();
  //       portfolioFilters.forEach(function(el) {
  //         el.classList.remove('filter-active');
  //       });
  //       this.classList.add('filter-active');
  //
  //       portfolioIsotope.arrange({
  //         filter: this.getAttribute('data-filter')
  //       });
  //       portfolioIsotope.on('arrangeComplete', function() {
  //         AOS.refresh()
  //       });
  //     }, true);
  //   }
  //
  // });

  /**
   * Initiate portfolio lightbox
   */
  GLightbox({
    selector: '.portfolio-lightbox'
  });

  /**
   * Portfolio details slider
   */
  // new Swiper('.portfolio-details-slider', {
  //   speed: 400,
  //   loop: true,
  //   autoplay: {
  //     delay: 5000,
  //     disableOnInteraction: false
  //   },
  //   pagination: {
  //     el: '.swiper-pagination',
  //     type: 'bullets',
  //     clickable: true
  //   }
  // });

  /**
   * Testimonials slider
   */
  // new Swiper('.testimonials-slider', {
  //   speed: 600,
  //   loop: true,
  //   autoplay: {
  //     delay: 5000,
  //     disableOnInteraction: false
  //   },
  //   slidesPerView: 'auto',
  //   pagination: {
  //     el: '.swiper-pagination',
  //     type: 'bullets',
  //     clickable: true
  //   }
  // });

  /**
   * Animation on scroll
   */
  // window.addEventListener('load', () => {
  //   setTimeout(() => {
  //     AOS.init({
  //       duration: 1000,
  //       easing: "ease-in-out",
  //       once: true,
  //       mirror: false
  //     });
  //   }, 2000);
  // });

  /**
   * Initiate Pure Counter
   */
  new PureCounter();
  
  /**
   * Funkcja do przewinięcia diva na środek ekranu na podstawie ID z URL
   */
  function scrollToMiddleOfSection() {
    let hash = window.location.hash.substr(1); // Pobierz wartość hasha z URL
    let section = document.getElementById(hash);
    if (section) {
      let windowHeight = window.innerHeight;
      let sectionHeight = section.clientHeight;

      // Calculate the scroll position to center the section
      let scrollPosition = section.offsetTop + sectionHeight + windowHeight / 2;

      // Use scrollIntoView with behavior: 'smooth'
      window.scrollTo({ top: scrollPosition, behavior: "smooth" });
    }
  }

  /**
   * Wywołaj funkcję przy ładowaniu strony
   */
  window.onload = scrollToMiddleOfSection;

  /**
   * Image reveal on hover
   */
  document.getElementById("imageContainer").addEventListener("mousemove", function (e) {
    const rect = e.target.getBoundingClientRect(); // Pobieramy informacje o położeniu obrazu
    const mouseX = e.clientX - rect.left; // Obliczamy pozycję X względem lewej krawędzi obrazu
    const imageWidth = e.target.offsetWidth; // Szerokość obrazu
    const percentage = (mouseX / imageWidth) * 100;
    this.style.setProperty("--mx", percentage + "%");
  });
  
  /**
   * Inject vendors.min.css file into the head of the document on window load
   */
  window.onload = function() {
    let link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '/assets/build/vendors.min.css';
    document.head.appendChild(link);
  };
  
  
})()
