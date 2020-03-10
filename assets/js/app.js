/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../scss/main.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

import Swiper from 'swiper';
import 'swiper/css/swiper.min.css';

new Swiper ('.home__plannings', {
  // Optional parameters
  direction: 'horizontal',
  slidesPerView: 'auto',
  centeredSlides : true,
  spaceBetween: 15,
})

// new Swiper ('.swiper-container', {
//   direction: 'horizontal',
//   loop: true,
//   navigation: {
//     nextEl: '.swiper-button-next',
//     prevEl: '.swiper-button-prev',
//   },
// })
