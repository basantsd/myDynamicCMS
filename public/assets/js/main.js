(function ($) {
  "use strict";
  /*=================================
      JS Index Here
  ==================================*/
  /*
    01. On Load Function
    02. Preloader
    03. Mobile Menu Active
    04. Sticky fix
    05. Scroll To Top
    06. Set Background Image
    07. Hero Slider Active 
    08. Global Slider
    09. Ajax Contact Form
    10. Popup Sidemenu   
    11. Magnific Popup
    12. Section Position
    13. Filter
    14. One Page Nav
    15. WOW.js Animation
  */
  /*=================================
      JS Index End
  ==================================*/
  /*

  /*---------- 01. On Load Function ----------*/
  $(window).on('load', function () {
    $('.preloader').fadeOut();
  });



  /*---------- 02. Preloader ----------*/
  if ($('.preloader').length > 0) {
    $('.preloaderCls').each(function () {
      $(this).on('click', function (e) {
        e.preventDefault();
        $('.preloader').css('display', 'none');
      })
    });
  };



  /*---------- 03. Mobile Menu Active ----------*/
  $.fn.vsmobilemenu = function (options) {
    var opt = $.extend({
      menuToggleBtn: '.vs-menu-toggle',
      bodyToggleClass: 'vs-body-visible',
      subMenuClass: 'vs-submenu',
      subMenuParent: 'vs-item-has-children',
      subMenuParentToggle: 'vs-active',
      meanExpandClass: 'vs-mean-expand',
      appendElement: '<span class="vs-mean-expand"></span>',
      subMenuToggleClass: 'vs-open',
      toggleSpeed: 100,
    }, options);

    return this.each(function () {
      var menu = $(this); // Select menu

      // Menu Show & Hide
      function menuToggle() {
        menu.toggleClass(opt.bodyToggleClass);

        // collapse submenu on menu hide or show
        var subMenu = '.' + opt.subMenuClass;
        $(subMenu).each(function () {
          if ($(this).hasClass(opt.subMenuToggleClass)) {
            $(this).removeClass(opt.subMenuToggleClass);
            $(this).css('display', 'none')
            $(this).parent().removeClass(opt.subMenuParentToggle);
          };
        });
      };

      // Class Set Up for every submenu
      menu.find('li').each(function () {
        var submenu = $(this).find('ul');
        submenu.addClass(opt.subMenuClass);
        submenu.css('display', 'none');
        submenu.parent().addClass(opt.subMenuParent);
        submenu.prev('a').append(opt.appendElement);
        submenu.next('a').append(opt.appendElement);
      });

      // Toggle Submenu
      function toggleDropDown($element) {
        if ($($element).next('ul').length > 0) {
          $($element).parent().toggleClass(opt.subMenuParentToggle);
          $($element).next('ul').slideToggle(opt.toggleSpeed);
          $($element).next('ul').toggleClass(opt.subMenuToggleClass);
        } else if ($($element).prev('ul').length > 0) {
          $($element).parent().toggleClass(opt.subMenuParentToggle);
          $($element).prev('ul').slideToggle(opt.toggleSpeed);
          $($element).prev('ul').toggleClass(opt.subMenuToggleClass);
        };
      };

      // Submenu toggle Button
      var expandToggler = '.' + opt.meanExpandClass;
      $(expandToggler).each(function () {
        $(this).on('click', function (e) {
          e.preventDefault();
          toggleDropDown($(this).parent());
        });
      });

      // Menu Show & Hide On Toggle Btn click
      $(opt.menuToggleBtn).each(function () {
        $(this).on('click', function () {
          menuToggle();
        })
      })

      // Hide Menu On out side click
      menu.on('click', function (e) {
        e.stopPropagation();
        menuToggle()
      })

      // Stop Hide full menu on menu click
      menu.find('div').on('click', function (e) {
        e.stopPropagation();
      });

    });
  };

  $('.vs-menu-wrapper').vsmobilemenu();


  /*---------- 04. Sticky fix ----------*/
  var lastScrollTop = '';
  var scrollToTopBtn = '.scrollToTop';

  function stickyMenu($targetMenu, $toggleClass, $parentClass) {
    var st = $(window).scrollTop();
    var height = $targetMenu.css('height');
    $targetMenu.parent().css('min-height', height);
    if ($(window).scrollTop() > 800) {
      $targetMenu.parent().addClass($parentClass);

      if (st > lastScrollTop) {
        $targetMenu.removeClass($toggleClass);
      } else {
        $targetMenu.addClass($toggleClass);
      };
    } else {
      $targetMenu.parent().css('min-height', '').removeClass($parentClass);
      $targetMenu.removeClass($toggleClass);
    };
    lastScrollTop = st;
  };
  $(window).on("scroll", function () {
    stickyMenu($('.sticky-active'), "active", "will-sticky");
    if ($(this).scrollTop() > 500) {
      $(scrollToTopBtn).addClass('show');
    } else {
      $(scrollToTopBtn).removeClass('show');
    }
  });


  /*---------- 05. Scroll To Top ----------*/
  $(scrollToTopBtn).each(function () {
    $(this).on('click', function (e) {
      e.preventDefault();
      console.log('scroll to top clicked')
      $('html, body').animate({
        scrollTop: 0
      }, 1000);
      return false;
    });
  })


  /*---------- 06.Set Background Image ----------*/
  if ($('[data-bg-src]').length > 0) {
    $('[data-bg-src]').each(function () {
      var src = $(this).attr('data-bg-src');
      $(this).css('background-image', 'url(' + src + ')');
      $(this).removeAttr('data-bg-src').addClass('background-image');
    });
  };


  /*----------- 07. Hero Slider Active ----------*/
  $('.vs-hero-carousel').each(function () {
    var vsHslide = $(this);

    // Get Data From Dom
    var d  = (data) => {
      return vsHslide.data(data);
    }

    vsHslide.on('sliderDidLoad', function (event, slider) { 
      var customNav = '.ls-custom-dot';
      var navDom = 'data-slide-go';
      var currentSlide = slider.slides.current.index; // current Slide index 
      var i = 1;
      // Set Attribute 
      $(customNav).each(function () {
        $(this).attr(navDom, i)
        i++
        // On Click Thumb, Change slide
        $(this).on('click', function (e) {
          e.preventDefault();
          var target = $(this).attr(navDom);
          vsHslide.layerSlider(parseInt(target));
        })
      });

      // custom arrow js
      setTimeout(() => {
        vsHslide.find(".ls-custom-arrow").each(function () {
          $(this).on("click", function (e) {
            e.preventDefault();
            var gotarget = $(this).attr("data-change-slide");
            vsHslide.layerSlider(gotarget);
          });
        });
      }, 1000);

      // Add class To current Thumb
      var currentNav = customNav + '[' + navDom + '="' + currentSlide + '"';
      $(currentNav).addClass('active');
    }).on('slideChangeDidComplete', function (event, slider) {
      var currentActive = slider.slides.current.index; // After change Current Index
      var currentNav = '.ls-custom-dot[data-slide-go="' + currentActive + '"';
      $(currentNav).addClass('active')
        .siblings().removeClass('active');
    });

    vsHslide.layerSlider({
      allowRestartOnResize: true,
      maxRatio: (d('maxratio') ? d('maxratio') : 1),
      type: (d('slidertype') ? d('slidertype') : 'responsive'),
      pauseOnHover: (d('pauseonhover') ? true : false),
      navPrevNext: (d('navprevnext') ? true : false),
      hoverPrevNext: (d('hoverprevnext') ? true : false),
      hoverBottomNav: (d('hoverbottomnav') ? true : false),
      navStartStop: (d('navstartstop') ? true : false),
      navButtons: (d('navbuttons') ? true : false),
      loop: ((d('loop') === false) ? false : true),
      autostart: (d('autostart') ? true : false),
      height: (d('height') ? d('height') : 1080),
      responsiveUnder: (d('responsiveunder') ? d('responsiveunder') : 1220),
      layersContainer: (d('container') ? d('container') : 1220),
      showCircleTimer: (d('showcircletimer') ? true : false),
      skinsPath: 'layerslider/skins/',
      globalBGColor: d('ls-bg') ? d('ls-bg') : false,
      globalBGImage: d('ls-bg-img') ? d('ls-bg-img') : false,
      thumbnailNavigation: ((d('thumbnailnavigation') === false) ? false : true)
    });
  });



  /*----------- 08. Global Slider ----------*/
  $('.vs-carousel').each(function () {
    var vsSlide = $(this);

    // Collect Data 
    var d =  (data)=>{
      return vsSlide.data(data);
    }

    // Custom Arrow Button
    var prevButton = '<button type="button" class="slick-prev"><i class="' + d('prev-arrow') + '"></i></button>',
      nextButton = '<button type="button" class="slick-next"><i class="' + d('next-arrow') + '"></i></button>';

    // Function For Custom Arrow Btn 
    $('[data-slick-next]').each(function () {
      $(this).on('click', function (e) {
        e.preventDefault()
        $($(this).data('slick-next')).slick('slickNext');
      })
    })

    $('[data-slick-prev]').each(function () {
      $(this).on('click', function (e) {
        e.preventDefault()
        $($(this).data('slick-prev')).slick('slickPrev');
      })
    })

    // Check for arrow wrapper
    if (d('arrows') == true) {
      if (!vsSlide.closest('.arrow-wrap').length) {
        vsSlide.closest('.container').parent().addClass('arrow-wrap')
      }
    }


    vsSlide.slick({
      dots: (d('dots') ? true : false),
      fade: (d('fade') ? true : false),
      arrows: (d('arrows') ? true : false),
      speed: (d('speed') ? d('speed') : 1000),
      asNavFor: (d('asnavfor') ? d('asnavfor') : false),
      autoplay: ((d('autoplay') == false) ? false : false),
      infinite: ((d('infinite') == false) ? false : true),
      slidesToShow: (d('slide-show') ? d('slide-show') : 1),
      adaptiveHeight: (d('adaptive-height') ? true : false),
      centerMode: (d('center-mode') ? true : false),
      autoplaySpeed: (d('autoplay-speed') ? d('autoplay-speed') : 8000),
      centerPadding: (d('center-padding') ? d('center-padding') : '0'),
      focusOnSelect: (d('focuson-select') ? true : false),
      pauseOnFocus: (d('pauseon-focus') ? true : false),
      pauseOnHover: (d('pauseon-hover') ? true : false),
      variableWidth: (d('variable-width') ? true : false),
      vertical: (d('vertical') ? true : false),
      verticalSwiping: (d('vertical') ? true : false),
      prevArrow: (d('prev-arrow') ? prevButton : '<button type="button" class="slick-prev"><i class="fal fa-long-arrow-left"></i></button>'),
      nextArrow: (d('next-arrow') ? nextButton : '<button type="button" class="slick-next"><i class="fal fa-long-arrow-right"></i></button>'),
      rtl: ($('html').attr('dir') == 'rtl') ? true : false,
      responsive: [{
          breakpoint: 1600,
          settings: {
            arrows: (d('xl-arrows') ? true : false),
            dots: (d('xl-dots') ? true : false),
            slidesToShow: (d('xl-slide-show') ? d('xl-slide-show') : d('slide-show')),
            centerMode: (d('xl-center-mode') ? true : false),
            centerPadding: 0
          }
        }, {
          breakpoint: 1400,
          settings: {
            arrows: (d('ml-arrows') ? true : false),
            dots: (d('ml-dots') ? true : false),
            slidesToShow: (d('ml-slide-show') ? d('ml-slide-show') : d('slide-show')),
            centerMode: (d('ml-center-mode') ? true : false),
            centerPadding: 0
          }
        }, {
          breakpoint: 1200,
          settings: {
            arrows: (d('lg-arrows') ? true : false),
            dots: (d('lg-dots') ? true : false),
            slidesToShow: (d('lg-slide-show') ? d('lg-slide-show') : d('slide-show')),
            centerMode: (d('lg-center-mode') ? d('lg-center-mode') : false),
            centerPadding: 0
          }
        }, {
          breakpoint: 992,
          settings: {
            arrows: (d('md-arrows') ? true : false),
            dots: (d('md-dots') ? true : false),
            slidesToShow: (d('md-slide-show') ? d('md-slide-show') : 1),
            centerMode: (d('md-center-mode') ? d('md-center-mode') : false),
            centerPadding: 0
          }
        }, {
          breakpoint: 767,
          settings: {
            arrows: (d('sm-arrows') ? true : false),
            dots: (d('sm-dots') ? true : false),
            slidesToShow: (d('sm-slide-show') ? d('sm-slide-show') : 1),
            centerMode: (d('sm-center-mode') ? d('sm-center-mode') : false),
            centerPadding: 0
          }
        }, {
          breakpoint: 576,
          settings: {
            arrows: (d('xs-arrows') ? true : false),
            dots: (d('xs-dots') ? true : false),
            slidesToShow: (d('xs-slide-show') ? d('xs-slide-show') : 1),
            centerMode: (d('xs-center-mode') ? d('xs-center-mode') : false),
            centerPadding: 0
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

  });


  /*----------- 09. Ajax Contact Form ----------*/
  function ajaxContactForm (selectForm) {
    var form = selectForm;
    var invalidCls = 'is-invalid';
    var $email = '[name="email"]';
    var $validation = '[name="name"],[name="email"],[name="subject"],[name="message"]'; // Must be use (,) without any space
    var formMessages = $(selectForm).next('.form-messages');

    function sendContact() {
      var formData = $(form).serialize();
      var valid;
      valid = validateContact();
      if (valid) {
        jQuery.ajax({
          url: $(form).attr('action'),
          data: formData,
          type: "POST"
        })
        .done(function (response) {
          // Make sure that the formMessages div has the 'success' class.
          formMessages.removeClass('error');
          formMessages.addClass('success');
          // Set the message text.
          formMessages.text(response);
          // Clear the form.
          $(form + ' input:not([type="submit"]),' + form + ' textarea').val('');
        })
        .fail(function (data) {
          // Make sure that the formMessages div has the 'error' class.
          formMessages.removeClass('success');
          formMessages.addClass('error');
          // Set the message text.
          if (data.responseText !== '') {
            formMessages.html(data.responseText);
          } else {
            formMessages.html('Oops! An error occured and your message could not be sent.');
          }
        });
      };
    };

    function validateContact() {
      var valid = true;
      var formInput;
      function unvalid($validation) {
        $validation = $validation.split(',')
        for (var i = 0; i < $validation.length; i++) {
          formInput = form + ' ' + $validation[i];
          if (!$(formInput).val()) {
            $(formInput).addClass(invalidCls)
            valid = false;
          } else {
            $(formInput).removeClass(invalidCls)
            valid = true;
          };
        };
      };
      unvalid($validation);

      if (!$(form +' '+ $email).val() || !$(form +' '+ $email).val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
        $(form + ' ' + $email).addClass(invalidCls)
        valid = false;
      } else {
        $(form + ' ' + $email).removeClass(invalidCls)
        valid = true;
      };
      return valid;
    };

    $(form).on('submit', function (element) {
      element.preventDefault();
      sendContact();
    });
  }

  ajaxContactForm('.ajax-contact');
  ajaxContactForm('.ajax-contact2');
  ajaxContactForm('.ajax-contact3');




  /*---------- 10. Popup Sidemenu ----------*/
  function popupSideMenu($sideMenu, $sideMunuOpen, $sideMenuCls, $toggleCls) {
    // Sidebar Popup
    $($sideMunuOpen).on('click', function (e) {
      e.preventDefault();
      $($sideMenu).addClass($toggleCls);
    });
    $($sideMenu).on('click', function (e) {
      e.stopPropagation();
      $($sideMenu).removeClass($toggleCls)
    });
    var sideMenuChild = $sideMenu + ' > div';
    $(sideMenuChild).on('click', function (e) {
      e.stopPropagation();
      $($sideMenu).addClass($toggleCls)
    });
    $($sideMenuCls).on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $($sideMenu).removeClass($toggleCls);
    });
  };
  popupSideMenu('.sidemenu-wrapper', '.sideMenuToggler', '.sideMenuCls', 'show');


  /*----------- 11. Magnific Popup ----------*/
  /* magnificPopup img view */
  $('.popup-image').magnificPopup({
    type: 'image',
    gallery: {
      enabled: true
    }
  });

  /* magnificPopup video view */
  $('.popup-video').magnificPopup({
    type: 'iframe'
  });


  /*---------- 12. Section Position ----------*/
  // Interger Converter
  function convertInteger(str) {
    return parseInt(str, 10)
  }

  $.fn.sectionPosition = function (mainAttr, posAttr, getPosValue) {
    $(this).each(function () {
      var section = $(this);

      function setPosition() {
        var sectionHeight = Math.floor(section.height() / 2), // Main Height of section
          posValue = convertInteger(section.attr(getPosValue)), // positioning value
          posData = section.attr(mainAttr), // how much to position
          posFor = section.attr(posAttr), // On Which section is for positioning 
          parentPT = convertInteger($(posFor).css('padding-top')), // Default Padding of  parent
          parentPB = convertInteger($(posFor).css('padding-bottom')); // Default Padding of  parent

        if (posData === 'top-half') {
          $(posFor).css('padding-bottom', parentPB + sectionHeight + 'px');
          section.css('margin-top', "-" + sectionHeight + 'px');
        } else if (posData === 'bottom-half') {
          $(posFor).css('padding-top', parentPT + sectionHeight + 'px');
          section.css('margin-bottom', "-" + sectionHeight + 'px');
        } else if (posData === 'top') {
          $(posFor).css('padding-bottom', parentPB + posValue + 'px');
          section.css('margin-top', "-" + posValue + 'px');
        } else if (posData === 'bottom') {
          $(posFor).css('padding-top', parentPT + posValue + 'px');
          section.css('margin-bottom', "-" + posValue + 'px');
        }
      }
      setPosition(); // Set Padding On Load
    })
  }

  var postionHandler = '[data-sec-pos]';
  if ($(postionHandler).length) {
    $(postionHandler).imagesLoaded(function () {
      $(postionHandler).sectionPosition('data-sec-pos', 'data-pos-for', 'data-pos-amount');
    });
  }


  /*----------- 13. Filter ----------*/
  $('.filter-active, .filter-active2').imagesLoaded(function () {
    var $filter = '.filter-active',
      $filter2 = '.filter-active2',
      $filterItem = '.filter-item',
      $filterMenu = '.filter-menu-active';

    if ($($filter).length > 0) {
      var $grid = $($filter).isotope({
        itemSelector: $filterItem,
        filter: '*',
        masonry: {
          // use outer width of grid-sizer for columnWidth
          columnWidth: 1
        }
      });
    };

    if ($($filter2).length > 0) {
      var $grid = $($filter2).isotope({
        itemSelector: $filterItem,
        filter: '*',
        masonry: {
          // use outer width of grid-sizer for columnWidth
          columnWidth: $filterItem
        }
      });
    };
    
    // Menu Active Class 
    $($filterMenu).on('click', 'button', function (event) {
      event.preventDefault();
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({
        filter: filterValue
      });
      $(this).addClass('active');
      $(this).siblings('.active').removeClass('active');
    });
  });


  /*----------- 14. One Page Nav ----------*/
  function onePageNav(element) {
    if ($(element).length > 0) {
      $(element).each(function () {
        $(this).find('a').each(function () {
          $(this).on('click', function (e) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
              e.preventDefault();
              event.preventDefault();
              $('html, body').stop().animate({
                scrollTop: target.offset().top - 10
              }, 1000);
            };
          });
        });
      })
    }
  };
  onePageNav('.onepage-nav, .main-menu, .vs-mobile-menu');
  
  
  
  
  /*----------- 15. WOW.js Animation ----------*/
  var wow = new WOW({
    boxClass: 'wow', // animated element css class (default is wow)
    animateClass: 'wow-animated', // animation css class (default is animated)
    offset: 0, // distance to the element when triggering the animation (default is 0)
    mobile: false, // trigger animations on mobile devices (default is true)
    live: true, // act on asynchronously loaded content (default is true)
    scrollContainer: null, // optional scroll container selector, otherwise use window,
    resetAnimation: false, // reset animation on end (default is true)
  });
  wow.init();


  /*----------- 15. Indicator Position ----------*/
  function setPos (element) {
    var indicator = element.siblings('.indicator'),
    btnWidth = element.css('width'),
    btnHiehgt = element.css('height'),
    btnLeft = element.position().left,
    btnTop = element.position().top;
    element.addClass('active').siblings().removeClass('active');      
    indicator.css({
      left: btnLeft + 'px',
      top: btnTop + 'px',
      width: btnWidth,
      height: btnHiehgt,
    })
  };

  $('.login-tab a').each(function(){
    var link = $(this);
    if (link.hasClass('active')) setPos(link);  
    link.on('mouseover', function(){
      setPos($(this));        
    });
  })



  /*----------- 16. Color Plate Js ----------*/
  if ($('.vs-color-plate').length) {
    var oldValue = $('#plate-color').val();
    $('#plate-color').on('change', function(e) {
      var color = e.target.value;
      $('body').css('--theme-color', color)
    });
    
    $('#plate-reset').on('click', function(){
      $('body').css('--theme-color', '');
      $('#plate-color').val(oldValue);
    })

    $('#plate-toggler').on('click', function(){
      $('.vs-color-plate').toggleClass('open');
    });
  }
  
  



})(jQuery);
// ----------------anjani-js-by-font-size:increase and decrease---------------

var $affectedElements = $("p, h1, h2, h3, h4, h5, h6 ,span, a, td"); // Can be extended, ex. $("div, p, span.someClass")

// Storing the original size in a data attribute so size can be reset
$affectedElements.each( function(){
  var $this = $(this);
  $this.data("orig-size", $this.css("font-size") );
});

$("#btn-increase").click(function(){
  changeFontSize(1);
})

$("#btn-decrease").click(function(){
  changeFontSize(-1);
})

$("#btn-origs").click(function(){
  $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , $this.data("orig-size") );
   });
})

function changeFontSize(direction){
    $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , parseInt($this.css("font-size"))+direction );
    });
}
// -------------language-btn-design---------------
function Util() {};
Util.hasClass = function(el, className) {
    if (el.classList) return el.classList.contains(className);
    else return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
};
Util.addClass = function(el, className) {
    var classList = className.split(' ');
    if (el.classList) el.classList.add(classList[0]);
    else if (!Util.hasClass(el, classList[0])) el.className += " " + classList[0];
    if (classList.length > 1) Util.addClass(el, classList.slice(1).join(' '));
};
Util.removeClass = function(el, className) {
    var classList = className.split(' ');
    if (el.classList) el.classList.remove(classList[0]);
    else if (Util.hasClass(el, classList[0])) {
        var reg = new RegExp('(\\s|^)' + classList[0] + '(\\s|$)');
        el.className = el.className.replace(reg, ' ');
    }
    if (classList.length > 1) Util.removeClass(el, classList.slice(1).join(' '));
};
Util.toggleClass = function(el, className, bool) {
    if (bool) Util.addClass(el, className);
    else Util.removeClass(el, className);
};
Util.setAttributes = function(el, attrs) {
    for (var key in attrs) {
        el.setAttribute(key, attrs[key]);
    }
};
Util.getChildrenByClassName = function(el, className) {
    var children = el.children,
        childrenByClass = [];
    for (var i = 0; i < el.children.length; i++) {
        if (Util.hasClass(el.children[i], className)) childrenByClass.push(el.children[i]);
    }
    return childrenByClass;
};
Util.is = function(elem, selector) {
    if (selector.nodeType) {
        return elem === selector;
    }
    var qa = (typeof(selector) === 'string' ? document.querySelectorAll(selector) : selector),
        length = qa.length,
        returnArr = [];
    while (length--) {
        if (qa[length] === elem) {
            return true;
        }
    }
    return false;
};
Util.setHeight = function(start, to, element, duration, cb) {
    var change = to - start,
        currentTime = null;
    var animateHeight = function(timestamp) {
        if (!currentTime) currentTime = timestamp;
        var progress = timestamp - currentTime;
        var val = parseInt((progress / duration) * change + start);
        element.style.height = val + "px";
        if (progress < duration) {
            window.requestAnimationFrame(animateHeight);
        } else {
            cb();
        }
    };
    element.style.height = start + "px";
    window.requestAnimationFrame(animateHeight);
};
Util.scrollTo = function(final, duration, cb) {
    var start = window.scrollY || document.documentElement.scrollTop,
        currentTime = null;
    var animateScroll = function(timestamp) {
        if (!currentTime) currentTime = timestamp;
        var progress = timestamp - currentTime;
        if (progress > duration) progress = duration;
        var val = Math.easeInOutQuad(progress, start, final - start, duration);
        window.scrollTo(0, val);
        if (progress < duration) {
            window.requestAnimationFrame(animateScroll);
        } else {
            cb && cb();
        }
    };
    window.requestAnimationFrame(animateScroll);
};
Util.moveFocus = function(element) {
    if (!element) element = document.getElementsByTagName("body")[0];
    element.focus();
    if (document.activeElement !== element) {
        element.setAttribute('tabindex', '-1');
        element.focus();
    }
};
Util.getIndexInArray = function(array, el) {
    return Array.prototype.indexOf.call(array, el);
};
Util.cssSupports = function(property, value) {
    if ('CSS' in window) {
        return CSS.supports(property, value);
    } else {
        var jsProperty = property.replace(/-([a-z])/g, function(g) {
            return g[1].toUpperCase();
        });
        return jsProperty in document.body.style;
    }
};
Util.extend = function() {
    var extended = {};
    var deep = false;
    var i = 0;
    var length = arguments.length;
    if (Object.prototype.toString.call(arguments[0]) === '[object Boolean]') {
        deep = arguments[0];
        i++;
    }
    var merge = function(obj) {
        for (var prop in obj) {
            if (Object.prototype.hasOwnProperty.call(obj, prop)) {
                if (deep && Object.prototype.toString.call(obj[prop]) === '[object Object]') {
                    extended[prop] = extend(true, extended[prop], obj[prop]);
                } else {
                    extended[prop] = obj[prop];
                }
            }
        }
    };
    for (; i < length; i++) {
        var obj = arguments[i];
        merge(obj);
    }
    return extended;
};
if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
}
if (!Element.prototype.closest) {
    Element.prototype.closest = function(s) {
        var el = this;
        if (!document.documentElement.contains(el)) return null;
        do {
            if (el.matches(s)) return el;
            el = el.parentElement || el.parentNode;
        } while (el !== null && el.nodeType === 1);
        return null;
    };
}
if (typeof window.CustomEvent !== "function") {
    function CustomEvent(event, params) {
        params = params || {
            bubbles: false,
            cancelable: false,
            detail: undefined
        };
        var evt = document.createEvent('CustomEvent');
        evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
        return evt;
    }
    CustomEvent.prototype = window.Event.prototype;
    window.CustomEvent = CustomEvent;
}
Math.easeInOutQuad = function(t, b, c, d) {
    t /= d / 2;
    if (t < 1) return c / 2 * t * t + b;
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
};
/**/
(function() {
	var LanguagePicker = function(element) {
		this.element = element;
		this.select = this.element.getElementsByTagName('select')[0];
		this.options = this.select.getElementsByTagName('option');
		this.selectedOption = getSelectedOptionText(this);
		this.pickerId = this.select.getAttribute('id');
		this.trigger = false;
		this.dropdown = false;
		this.firstLanguage = false;
		// dropdown arrow inside the button element
		this.svgPath = '<svg viewBox="0 0 16 16"><polygon points="3,5 8,11 13,5 "></polygon></svg>';
		initLanguagePicker(this);
		initLanguagePickerEvents(this);
	};

	function initLanguagePicker(picker) {
		// create the HTML for the custom dropdown element
		picker.element.insertAdjacentHTML('beforeend', initButtonPicker(picker) + initListPicker(picker));
		
		// save picker elements
		picker.dropdown = picker.element.getElementsByClassName('language-picker__dropdown')[0];
		picker.firstLanguage = picker.dropdown.getElementsByClassName('language-picker__item')[0];
		picker.trigger = picker.element.getElementsByClassName('language-picker__button')[0];
	};

	function initLanguagePickerEvents(picker) {
		// make sure to add the icon class to the arrow dropdown inside the button element
		Util.addClass(picker.trigger.getElementsByTagName('svg')[0], 'icon');
		// language selection in dropdown
		// ⚠️ Important: you need to modify this function in production
		initLanguageSelection(picker);

		// click events
		picker.trigger.addEventListener('click', function(){
			toggleLanguagePicker(picker, false);
		});
	};

	function toggleLanguagePicker(picker, bool) {
		var ariaExpanded;
		if(bool) {
			ariaExpanded = bool;
		} else {
			ariaExpanded = picker.trigger.getAttribute('aria-expanded') == 'true' ? 'false' : 'true';
		}
		picker.trigger.setAttribute('aria-expanded', ariaExpanded);
		if(ariaExpanded == 'true') {
			picker.firstLanguage.focus(); // fallback if transition is not supported
			picker.dropdown.addEventListener('transitionend', function cb(){
				picker.firstLanguage.focus();
				picker.dropdown.removeEventListener('transitionend', cb);
			});
		}
	};

	function checkLanguagePickerClick(picker, target) { // if user clicks outside the language picker -> close it
		if( !picker.element.contains(target) ) toggleLanguagePicker(picker, 'false');
	};

	function moveFocusToPickerTrigger(picker) {
		if(picker.trigger.getAttribute('aria-expanded') == 'false') return;
		if(document.activeElement.closest('.language-picker__dropdown') == picker.dropdown) picker.trigger.focus();
	};

	function initButtonPicker(picker) { // create the button element -> picker trigger
		// check if we need to add custom classes to the button trigger
		var customClasses = picker.element.getAttribute('data-trigger-class') ? ' '+picker.element.getAttribute('data-trigger-class') : '';
	
		var button = '<button class="language-picker__button'+customClasses+'" aria-label="'+picker.select.value+' '+picker.element.getElementsByTagName('label')[0].innerText+'" aria-expanded="false" aria-contols="'+picker.pickerId+'-dropdown">';
		button = button + '<span aria-hidden="true" class="language-picker__label language-picker__flag language-picker__flag--'+picker.select.value+'"><em>'+picker.selectedOption+'</em>';
		button = button +picker.svgPath+'</span>';
		return button+'</button>';
	};

	function initListPicker(picker) { // create language picker dropdown
		var list = '<div class="language-picker__dropdown" aria-describedby="'+picker.pickerId+'-description" id="'+picker.pickerId+'-dropdown">';
		list = list + '<p class="sr-only" id="'+picker.pickerId+'-description">'+picker.element.getElementsByTagName('label')[0].innerText+'</p>';
		list = list + '<ul class="language-picker__list" role="listbox">';
		for(var i = 0; i < picker.options.length; i++) {
			var selected = picker.options[i].hasAttribute('selected') ? ' aria-selected="true"' : '',
				language = picker.options[i].getAttribute('lang');
			list = list + '<li><a lang="'+language+'" hreflang="'+language+'" href="'+getLanguageUrl(picker.options[i])+'"'+selected+' role="option" data-value="'+picker.options[i].value+'" class="language-picker__item language-picker__flag language-picker__flag--'+picker.options[i].value+'"><span>'+picker.options[i].text+'</span></a></li>';
		};
		return list;
	};

	function getSelectedOptionText(picker) { // used to initialize the label of the picker trigger button
		var label = '';
		if('selectedIndex' in picker.select) {
			label = picker.options[picker.select.selectedIndex].text;
		} else {
			label = picker.select.querySelector('option[selected]').text;
		}
		return label;
	};

	function getLanguageUrl(option) {
		// ⚠️ Important: You should replace this return value with the real link to your website in the selected language
		// option.value gives you the value of the language that you can use to create your real url (e.g, 'english' or 'italiano')
		return '#';
	};

	function initLanguageSelection(picker) {
		picker.element.getElementsByClassName('language-picker__list')[0].addEventListener('click', function(event){
			var language = event.target.closest('.language-picker__item');
			if(!language) return;
			
			if(language.hasAttribute('aria-selected') && language.getAttribute('aria-selected') == 'true') {
				// selecting the same language
				event.preventDefault();
				picker.trigger.setAttribute('aria-expanded', 'false'); // hide dropdown
			} else { 
				// ⚠️ Important: this 'else' code needs to be removed in production. 
				// The user has to be redirected to the new url -> nothing to do here
				event.preventDefault();
				picker.element.getElementsByClassName('language-picker__list')[0].querySelector('[aria-selected="true"]').removeAttribute('aria-selected');
				language.setAttribute('aria-selected', 'true');
				picker.trigger.getElementsByClassName('language-picker__label')[0].setAttribute('class', 'language-picker__label language-picker__flag language-picker__flag--'+language.getAttribute('data-value'));
				picker.trigger.getElementsByClassName('language-picker__label')[0].getElementsByTagName('em')[0].innerText = language.innerText;
				picker.trigger.setAttribute('aria-expanded', 'false');
			}
		});
	};

	//initialize the LanguagePicker objects
	var languagePicker = document.getElementsByClassName('js-language-picker');
	if( languagePicker.length > 0 ) {
		var pickerArray = [];
		for( var i = 0; i < languagePicker.length; i++) {
			(function(i){pickerArray.push(new LanguagePicker(languagePicker[i]));})(i);
		}

		// listen for key events
		window.addEventListener('keyup', function(event){
			if( event.keyCode && event.keyCode == 27 || event.key && event.key.toLowerCase() == 'escape' ) {
				// close language picker on 'Esc'
				pickerArray.forEach(function(element){
					moveFocusToPickerTrigger(element); // if focus is within dropdown, move it to dropdown trigger
					toggleLanguagePicker(element, 'false'); // close dropdown
				});
			} 
		});
		// close language picker when clicking outside it
		window.addEventListener('click', function(event){
			pickerArray.forEach(function(element){
				checkLanguagePickerClick(element, event.target);
			});
		});
	}
}());

// ---------------scrolling-data-news-by-anjani-------------
