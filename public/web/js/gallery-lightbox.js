/* ==============================
   Gallery Page - Image Lightbox
   Ye wahi jQuery Magnific Popup config hai jo product-detail page ke
   "full-view" slider mein already use ho raha hai (main.js ~line 133),
   bas naye ".gallery-lightbox" grid pe bandha hai (slider-big/slick se
   clash na ho isliye alag class use ki hai).

   HATANA HO TO: bas gallery.blade.php se is file ka <script> tag hata do.
   Grid normal images ke saath dikhta rahega, sirf click-to-zoom band ho jayega.
   ============================== */
$(document).ready(function () {
    $('.gallery-lightbox').magnificPopup({
        delegate: 'a.gallery-item',
        type: 'image',
        showCloseBtn: true,
        closeBtnInside: false,
        midClick: true,
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    });
});
