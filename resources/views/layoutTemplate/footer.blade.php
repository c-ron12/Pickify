<!-- info section -->
<section class="info_section  layout_padding2-top">
    <div class="social_container">
        <div class="social_box">
            <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
            <a href="">
                <i class="fa fa-youtube" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <div class="info_container ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <h6>
                        ABOUT US
                    </h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet,
                        consectetur
                        adipiscing elit, sed doLorem ipsum dolor sit amet,
                    </p>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="info_form ">
                        <h5>
                            Newsletter
                        </h5>
                        <form action="#">
                            <input type="email" name="email" placeholder="Enter your email">
                            <button>
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6>
                        NEED HELP
                    </h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet,
                        consectetur
                        adipiscing elit, sed doLorem ipsum dolor sit amet,
                    </p>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6>
                        CONTACT US
                    </h6>
                    <div class="info_link-box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span> Gb road 123 london Uk </span>
                        </a>
                        <a href="">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>+01 12345678901</span>
                        </a>
                        <a href="">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span> demo@gmail.com</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section -->
    <footer class=" footer_section">
        <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
                <p class="no-margin-bottom">copyright &copy; pickify.com | All right reserved 2020 | Deploved by c-ron12
                </p>
            </div>
        </div>
    </footer>
    <!-- footer section -->

</section>

<!-- end info section -->

{{-- <script src="{{ asset('/js/custom.js') }}"></script> --}}
<script src="js/jquery-3.4.1.min.js"></script>

<!-- jQuery (required for Toastr) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    @if(Session::has('toastr'))
    toastr.options.closeButton = true;
    toastr.options.timeOut = 2000;
    toastr.success("{{ Session::get('toastr') }}");
    @endif
</script>

<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<script src="js/custom.js"></script>


</body>

</html>